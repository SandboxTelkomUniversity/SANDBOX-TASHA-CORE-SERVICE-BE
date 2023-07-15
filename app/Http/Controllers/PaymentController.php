<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use App\Models\Receipt;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class PaymentController extends Controller
{
    public function index(Request $request)
    {
        $current_page = $request->query('current_page', 1);
        $data = new Payment;

        // Apply filters
        $fillable_column = (new Payment())->getFillable();
        foreach ($fillable_column as $column) {
            if ($request->query($column)) {
                $data = $data->where($column, 'like', '%' . $request->query($column) . '%');
            }
        }

        // Include related data
        if ($request->query('include')) {
            $includes = $request->query('include');
            foreach ($includes as $include) {
                $data = $data->with($include);
            }
        }

        // Apply is_active condition and paginate
        $data = $data->where('is_deleted', false)->paginate(10, ['*'], 'page', $current_page);

        return response()->json([
            'status' => 'success',
            'data' => $data->items(),
            'meta' => [
                'current_page' => $data->currentPage(),
                'last_page' => $data->lastPage(),
                'total_records' => $data->total(),
            ],
            'server_time' => (int) round(microtime(true) * 1000),
        ]);
    }

    public function payment_with_campaign(Request $request)
    {
        $data = DB::table('campaign_reports')
            ->join('payments', 'campaign_reports.id_payment', '=', 'payments.id')
            ->join('campaigns', 'campaign_reports.id_campaign', '=', 'campaigns.id')
            ->select('campaigns.name', 'payments.id', 'payments.id_user', 'payments.id_receipt', 'payments.amount', 'payments.status', 'payments.created_by', 'payments.updated_by', 'payments.is_deleted', 'payments.version', 'payments.created_at', 'payments.updated_at')
            ->get();

        return response()->json([
            'status' => 'success',
            'data' => $data,
            'server_time' => (int) round(microtime(true) * 1000),
        ]);
    }

    public function store(Request $request)
    {
        $id_campaign = $request->id_campaign;
        $status = DB::table('campaigns')->where('id', $id_campaign)->value('status');

        $sudahbayar = DB::table('campaign_reports')
            ->join('payments', 'campaign_reports.id_payment', '=', 'payments.id')
            ->select('campaign_reports.is_exported', 'payments.status', 'payments.amount')
            ->where('campaign_reports.is_exported', '1')
            ->where('payments.status', 'APPROVED')
            ->whereNotNull('payments.amount')
            ->count();

        $cicilanke = $sudahbayar + 1;

        $reported = DB::table('campaign_reports')->where('id_campaign', $id_campaign)->where('is_exported', '1')->count();

        if ($status == "RUNNING" && $reported == $cicilanke) {
            $field_receipts = $request->only((new Receipt())->getFillable());
            if ($request->hasFile('file_receipt')) {
                $file_receipt = $request->file('file_receipt');
                $original_name = $file_receipt->getClientOriginalName();
                $timestamp = now()->timestamp;
                $new_file_name = $timestamp . '_' . str_replace(' ', '_', $original_name); // Replace spaces with underscores
                $path_of_file_receipt = $file_receipt->storeAs('public/receipt', $new_file_name);
                $receipt_url = Storage::url($path_of_file_receipt);
                $field_receipts['receipt_url'] = $receipt_url;
            }
            $receipts = Receipt::create($field_receipts);
            $field_payment = $request->only((new Payment())->getFillable());
            $field_payment['id_user'] = $request->user()->id;
            $field_payment['id_receipt'] = $receipts->id;
            $data = Payment::create($field_payment);
            return response()->json([
                'status' => 'success',
                'message' => 'Data created successfully',
                'data' => $data,
                'server_time' => (int) round(microtime(true) * 1000),
            ]);
        } else {
            return response()->json([
                'status' => 'error',
                'message' => 'lapor dulu'
            ]);
        }

    }

    public function show(Request $request, $id)
    {
        $data = new Payment();
        // Include related data
        if ($request->query('include')) {
            $includes = $request->query('include');
            foreach ($includes as $include) {
                $data = $data->with($include);
            }
        }

        $data = $data->find($id);

        return response()->json([
            'status' => 'success',
            'message' => 'Data retrieved successfully',
            'data' => $data,
        ]);
    }

    public function update(Request $request, $id)
    {
        $data = Payment::find($id);

        if ($data->receipt) {
            $field_receipts = $request->only((new Receipt())->getFillable());

            if ($request->hasFile('file_receipt')) {
                $file_receipt = $request->file('file_receipt');
                $original_name = $file_receipt->getClientOriginalName();
                $timestamp = now()->timestamp;
                $new_file_name = $timestamp . '_' . str_replace(' ', '_', $original_name); // Replace spaces with underscores
                $path_of_file_receipt = $file_receipt->storeAs('public/receipt', $new_file_name);
                $receipt_url = Storage::url($path_of_file_receipt);
                $field_receipts['receipt_url'] = $receipt_url;
            }

            $field_payment = $request->only((new Payment())->getFillable());
            $field_payment['id_user'] = null;
            $field_payment['id_receipt'] = null;
            unset($field_payment['id_user']);
            unset($field_payment['id_receipt']);

            $data->receipt->update($field_receipts);
        }

        $data->update($field_payment);

        return response()->json([
            'status' => 'success',
            'message' => 'Data updated successfully',
            'data' => $data,
            'server_time' => (int) round(microtime(true) * 1000),
        ]);
    }

    public function do_payment(Request $request)
    {
        $id_campaign = $request->id_campaign;
        $status = DB::table('campaigns')->where('id', $id_campaign)->value('status');

        $payed = DB::table('campaign_reports')
                        ->join('payments', 'campaign_reports.id_payment', '=', 'payments.id')
                        ->select('campaign_reports.is_exported', 'payments.status', 'payments.amount')
                        ->where('campaign_reports.is_exported', '1')
                        ->where('campaign_reports.id_campaign', $id_campaign)
                        ->where('payments.status', 'APPROVED')
                        ->whereNotNull('payments.amount')
                        ->count();

        $installment = $payed + 1;

        $reported = DB::table('campaign_reports')->where('id_campaign', $id_campaign)->where('is_exported', '1')->count();

        $id_payment = DB::table('campaign_reports')
                        ->join('payments', 'campaign_reports.id_payment', '=', 'payments.id')
                        ->select('campaign_reports.id_payment')
                        ->where('campaign_reports.id_campaign', $id_campaign)
                        ->where('campaign_reports.is_exported', '1')
                        ->where('payments.status', 'WAITING_VERIFICATION')
                        ->whereNull('payments.amount')
                        ->value('campaign_reports.id_payment');

        $notpayedyet = DB::table('campaign_reports')
                        ->join('payments', 'campaign_reports.id_payment', '=', 'payments.id')
                        ->select('campaign_reports.id_payment')
                        ->where('campaign_reports.id_campaign', $id_campaign)
                        ->where('campaign_reports.is_exported', '1')
                        ->where('payments.status', 'WAITING_VERIFICATION')
                        ->whereNull('payments.amount')
                        ->count();

        $data = Payment::find($id_payment);
        if ($notpayedyet == 1) {
            if ($status == "RUNNING" && $reported == $installment) {
                if ($data->receipt) {
                    $field_receipts = $request->only((new Receipt())->getFillable());

                    if ($request->hasFile('file_receipt')) {
                        $file_receipt = $request->file('file_receipt');
                        $original_name = $file_receipt->getClientOriginalName();
                        $timestamp = now()->timestamp;
                        $new_file_name = $timestamp . '_' . str_replace(' ', '_', $original_name); // Replace spaces with underscores;
                        $path_of_file_receipt = $file_receipt->storeAs('public/receipt', $new_file_name);
                        $receipt_url = Storage::url($path_of_file_receipt);
                        $field_receipts['receipt_url'] = $receipt_url;
                    }

                    $field_payment = $request->only((new Payment())->getFillable());
                    $field_payment['id_user'] = null;
                    $field_payment['id_receipt'] = null;
                    unset($field_payment['id_user']);
                    unset($field_payment['id_receipt']);

                    $data->receipt->update($field_receipts);
                }

                $data->update($field_payment);

                return response()->json([
                    'status' => 'success',
                    'message' => 'Data updated successfully',
                    'data' => $data,
                    'server_time' => (int) round(microtime(true) * 1000),
                ]);
            }else{
                return response()->json([
                    'status' => 'error',
                    'message' => 'Your previous payment has not been verified by the administrator.',
                    'server_time' => (int) round(microtime(true) * 1000),
                ]);
            }
        }

        else{
            return response()->json([
                'status' => 'error',
                'message' => 'You have not reported the project or your report has not been verified yet. Please make a report before initiating a refund.',
                'server_time' => (int) round(microtime(true) * 1000),
            ]);
        }
    }


    public function destroy($id)
    {
        $data = Payment::find($id);
        $data->is_deleted = true;
        $data->save();
        // $data->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'Data deleted successfully',
            'data' => $data,
            'server_time' => (int) round(microtime(true) * 1000),
        ]);
    }
}
