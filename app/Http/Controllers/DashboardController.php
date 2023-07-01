<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $data = User::find($request->user()->id);
        $authorization_level = $data->authorization_level;

        $response = [
            'status' => 'success',
            'message' => 'Data retrieved successfully',
            'data' => [],
        ];

        if ($authorization_level == 1) {
            $response['data']['total_asset'] = 1;
        } elseif ($authorization_level == 2) {
            $response['data']['total_campaign'] = 1;
            $response['data']['total_campaign_report'] = 2;
            $response['data']['total_payment'] = 3;
            $response['data']['total_withdraw'] = 4;
            $response['data']['campaigns'] = 5;
        } elseif ($authorization_level == 3) {
            $response['data']['total_investor_submission'] = 1;
            $response['data']['total_sme_submission'] = 2;
            $response['data']['total_campaign_submission'] = 3;
            $response['data']['total_transaction_submission'] = 4;
            $response['data']['total_withdraw_submission'] = 5;
            $response['data']['total_report_submission'] = 6;
            $response['data']['total_user_bank_submission'] = 7;
        }

        return response()->json($response);
    }


}
