<?php

namespace App\Http\Controllers;

use App\Models\Campaign;
use App\Models\CampaignReport;
use App\Models\Receipt;
use App\Models\Transaction;
use App\Models\User;
use App\Models\Withdraw;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Midtrans\Config;
use Midtrans\Snap;
use Midtrans\Notification;

class TransactionController extends Controller
{
    public function index(Request $request)
    {
        CampaignController::triggerCampaignStatusBySystem();
        $this->triggerTransactionStatusBySystem();
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
        $this->triggerTransactionStatusBySystem();
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
        $this->triggerTransactionStatusBySystem();
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
            'data' => $snapToken,
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
            'enabled_payments' => ['bank_transfer'],
            'vtweb' => []
        ];
    }

    public function callback(Request $request)
    {
        $this->triggerTransactionStatusBySystem();
        // Configure Midtrans
        Config::$clientKey = env('MIDTRANS_CLIENT_KEY');
        Config::$serverKey = env('MIDTRANS_SERVER_KEY');
        Config::$isProduction = false;
        Config::$isSanitized = true;
        Config::$is3ds = true;

        // Create Instance Midtrans Notification
        $notification = new Notification();

        // Assign variables for readability
        $status = $notification->transaction_status;
        $id_transaction = $notification->order_id;
        $total_transaction = $notification->gross_amount - 10000;

        // Search Transaction from ID
        $transaction = Transaction::findOrFail($id_transaction);

        // Notification Handle Midtrans Status
        switch ($status) {
            case 'capture':
            case 'settlement':
                // Update campaign's current_funding_amount if status is 'APPROVED'
                $campaign_id = $transaction->id_campaign;
                $current_funding_amount = Campaign::where('id', $transaction->id_campaign)->pluck('current_funding_amount')->first();
                $campaign = Campaign::where('id', $campaign_id)->first();
                $new_current_funding_amount = $current_funding_amount + $total_transaction;
                if ($campaign) {
                    $campaign->current_funding_amount = $new_current_funding_amount;
                    $campaign->updated_by = 'midtrans';
                    $campaign->save();
                }

                $transaction->status = 'APPROVED';
                break;
            case 'pending':
                $transaction->status = 'WAITING_VERIFICATION';
                break;
            case 'deny':
            case 'expire':
            case 'failure':
            case 'cancel':
                $transaction->status = 'REJECTED';
                break;
        }

        // Save Transaction
        $transaction->save();
    }

    public function show(Request $request, $id)
    {
        CampaignController::triggerCampaignStatusBySystem();
        $this->triggerTransactionStatusBySystem();

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
        $this->triggerTransactionStatusBySystem();

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
        $this->triggerTransactionStatusBySystem();

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

    public function triggerTransactionStatusBySystem(): void
    {
        $transactions = Transaction::where('status', 'WAITING_VERIFICATION ')->get();

        foreach ($transactions as $transaction) {
            $updatedAt = Carbon::parse($transaction->updated_at);
            $currentTime = Carbon::now();

            if ($updatedAt->diffInHours($currentTime) > 24 && (!is_null($transaction->payment_url) && $transaction->payment_url !== '')) {
                $transaction->update(['status' => 'REJECTED']);
            }
        }
    }
}

