<?php

namespace App\Http\Controllers;

use App\Models\Campaign;
use App\Models\Receipt;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Midtrans\Config;
use Midtrans\Snap;

class TransactionController extends Controller
{
    public function index(Request $request)
    {
        CampaignController::triggerCampaignStatusBySystem();
        $current_page = $request->query('current_page', 1);
        $data = new Transaction;

        // Apply filters
        $fillable_column = (new Transaction())->getFillable();
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
        $data = $data->where('is_deleted', false)->paginate(20, ['*'], 'page', $current_page);

        return response()->json([
            'status' => 'success',
            'data' => $data->items(),
            'meta' => [
                'current_page' => $data->currentPage(),
                'last_page' => $data->lastPage(),
                'total_records' => $data->total(),
            ],
            'server_time' => (int)round(microtime(true) * 1000),
        ]);
    }

    public function store(Request $request)
    {
        CampaignController::triggerCampaignStatusBySystem();
        // create receipt
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
        $receipts = Receipt::create($field_receipts);
        $field_transactions = $request->only((new Transaction())->getFillable());
        $field_transactions['id_user'] = $request->user()->id;
        $field_transactions['id_receipt'] = $receipts->id;
        $data = Transaction::create($field_transactions);

        $midtrans = $this->getMidtransConfiguration($data);

        try {
            $snapToken = Snap::createTransaction($midtrans);
            $data->payment_url = $snapToken->redirect_url;
            $data->save();

            return response()->json([
                'status' => 'success',
                'message' => 'Data created successfully',
                'data' => $data,
                'server_time' => (int)round(microtime(true) * 1000),
            ]);
        } catch (\Throwable $e) {
            return response()->json([
                'status' => 'success',
                'message' => 'Payment gateway error. Please use a manual payment method.',
                'data' => $data,
                'server_time' => (int)round(microtime(true) * 1000),
            ]);
        }
    }

    public function midtrans_transaction(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'id_transaction' => 'required',
            ]
        );

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => 'id transaction required',
                'server_time' => (int)round(microtime(true) * 1000),
            ], 403);
        }

        $transaction = Transaction::findOrFail($request->id_transaction);
        $midtrans = $this->getMidtransConfiguration($transaction);
        $snapToken = Snap::createTransaction($midtrans);

        return response()->json([
            'status' => 'success',
            'message' => 'Data created successfully',
            'data' => ['snap_token' => $snapToken],
            'server_time' => (int)round(microtime(true) * 1000),
        ]);
    }

    private function getMidtransConfiguration($transaction)
    {
        Config::$clientKey = env('MIDTRANS_CLIENT_KEY');
        Config::$serverKey = env('MIDTRANS_SERVER_KEY');
        Config::$isProduction = false;
        Config::$isSanitized = true;
        Config::$is3ds = true;

        $user = User::findOrFail($transaction->id_user);

        return [
            'transaction_details' => [
                'order_id' => $transaction->id,
                'gross_amount' => (int)$transaction->investor_amount + (int)$transaction->service_fee,
            ],
            'customer_details' => [
                'first_name' => $user->full_name,
                'email' => $user->email,
                'phone' => $user->phone_number
            ],
            'enabled_payments' => ['gopay', 'bank_transfer', 'credit_card'],
            'vtweb' => []
        ];
    }

    public function callback(Request $request){
        $serverKey = config('midtrans.server_key');
        $hashed = hash("sha512", $request->order_id.$request->status_code.$request->gross_amount.$serverKey);
        if($hashed == $request->signature_key){
            if($request->transaction_status == 'capture'){
                $data = Transaction::find($request->order_id);
                $data->update(['status' => 'APPROVED']);
            }
        }
    }

    public function show(Request $request, $id)
    {
        CampaignController::triggerCampaignStatusBySystem();
        $data = new Transaction();
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
        CampaignController::triggerCampaignStatusBySystem();
        $data = Transaction::find($id);
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
        $field_transactions = $request->only((new Transaction())->getFillable());
        $field_transactions['id_campaign'] = null;
        $field_transactions['id_user'] = null;
        $field_transactions['id_receipt'] = null;
        unset($field_transactions['id_campaign']);
        unset($field_transactions['id_user']);
        unset($field_transactions['id_receipt']);
        $data->receipt->update($field_receipts);
        $data->update($field_transactions);

        // add logical here
        // TODO: add logical here


        return response()->json([
            'status' => 'success',
            'message' => 'Data updated successfully',
            'data' => $data,
            'server_time' => (int)round(microtime(true) * 1000),
        ]);
    }

    public function transaction_approval(Request $request, $id)
    {
        CampaignController::triggerCampaignStatusBySystem();
        $data = Transaction::find($id);
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
        $field_transactions = $request->only((new Transaction())->getFillable());
        $field_transactions['id_campaign'] = null;
        $field_transactions['id_user'] = null;
        $field_transactions['id_receipt'] = null;
        unset($field_transactions['id_campaign']);
        unset($field_transactions['id_user']);
        unset($field_transactions['id_receipt']);
        $data->receipt->update($field_receipts);
        $data->update($field_transactions);

        // add logical here
        // TODO: add logical here
        if ($request->status == 'APPROVED') {
            $campaign_id = Transaction::where('id', $id)->pluck('id_campaign')->first();
            $investor_amount = Transaction::where('id', $id)->pluck('investor_amount')->first();
            $current_funding_amount = Campaign::where('id', $campaign_id)->pluck('current_funding_amount')->first();
            $campaign = Campaign::where('id', $campaign_id)->first();
            $new_current_funding_amount = $current_funding_amount + $investor_amount;
            if ($campaign) {
                $campaign->current_funding_amount = $new_current_funding_amount;
                $campaign->save(); // Melakukan update pada kolom "name"
            }
        }
        return response()->json([
            'status' => 'success',
            'message' => 'Data updated successfully',
            'data' => $data,
            'server_time' => (int)round(microtime(true) * 1000),
        ]);
    }

    public function destroy($id)
    {
        CampaignController::triggerCampaignStatusBySystem();
        $data = Transaction::find($id);
        $data->is_deleted = true;
        $data->save();
        // $data->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'Data deleted successfully',
            'data' => $data,
            'server_time' => (int)round(microtime(true) * 1000),
        ]);
    }

    public function show_portfolio(Request $request)
    {
        CampaignController::triggerCampaignStatusBySystem();
        $current_page = $request->query('current_page', 1);
        $data = Transaction::where('id_user', $request->user()->id);

        // Apply filters
        $fillable_columns = (new Transaction())->getFillable();
        foreach ($fillable_columns as $column) {
            if ($request->query($column)) {
                $data = $data->where($column, 'like', '%' . $request->query($column) . '%');
            }
        }

        // Include related data (campaign with banner)
        $data = $data->with('campaign.banners');

        // Apply is_active condition and paginate
        $data = $data->where('is_deleted', false)->paginate(20, ['*'], 'page', $current_page);

        return response()->json([
            'status' => 'success',
            'data' => $data->items(),
            'meta' => [
                'current_page' => $data->currentPage(),
                'last_page' => $data->lastPage(),
                'total_records' => $data->total(),
            ],
            'server_time' => (int)round(microtime(true) * 1000),
        ]);
    }
}

