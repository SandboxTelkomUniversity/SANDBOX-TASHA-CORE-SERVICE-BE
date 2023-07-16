<?php

namespace App\Http\Controllers;

use App\Models\Withdraw;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

class WithdrawController extends Controller
{
    public function index(Request $request)
    {
        $current_page = $request->query('current_page', 1);
        $data = new Withdraw;

        // Apply filters
        $fillable_column = (new Withdraw())->getFillable();
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
            'server_time' => (int) round(microtime(true) * 1000),
        ]);
    }

    public function store(Request $request)
    {
        $id_campaign = $request->id_campaign;
        $status = DB::table('campaigns')->where('id', $id_campaign)->value('status');

        if ($status == "ACHIEVED") {
            $field_withdraw = $request->only((new Withdraw())->getFillable());
            $field_withdraw['id_user'] = $request->user()->id;
            $data = Withdraw::create($field_withdraw);
            return response()->json([
                'status' => 'success',
                'message' => 'Data created successfully',
                'data' => $data,
                'server_time' => (int) round(microtime(true) * 1000),
            ]);
        } else{
            return response()->json([
                'status' => 'error',
                'message' => 'The project funds have not been collected yet.',
                'server_time' => (int) round(microtime(true) * 1000),
            ]);
        }
    }

    public function show(Request $request, $id)
    {
        $data = new Withdraw();
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
        $data = Withdraw::find($id);
        $field_withdraw = $request->only((new Withdraw())->getFillable());
        $field_withdraw['id_user'] = null;
        unset($field_withdraw['id_user']);
        $data->update($field_withdraw);
        return response()->json([
            'status' => 'success',
            'message' => 'Data updated successfully',
            'data' => $data,
            'server_time' => (int) round(microtime(true) * 1000),
        ]);
    }


    public function destroy($id)
    {
        $data = Withdraw::find($id);
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
    
    public function detail_withdraw(Request $request, $id)
    {
        $data = DB::table('campaigns')
            ->join('users', 'campaigns.id_user', '=', 'users.id')
            ->join('user_banks', 'users.id_user_bank', '=', 'user_banks.id')
            ->where('campaigns.id', $id)
            ->select('campaigns.id','campaigns.name', 'campaigns.start_date', 'campaigns.closing_date', 'campaigns.type', 'campaigns.category', 'campaigns.target_funding_amount', 'campaigns.status', 'users.full_name', 'user_banks.bank_name', 'user_banks.account_number')
            ->get();

        return response()->json([
            'status' => 'success',
            'data' => $data,
            'server_time' => (int) round(microtime(true) * 1000),
        ]);
    }
}
