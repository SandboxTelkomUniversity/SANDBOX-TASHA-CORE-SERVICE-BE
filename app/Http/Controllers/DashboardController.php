<?php

namespace App\Http\Controllers;

use App\Models\Campaign;
use App\Models\CampaignReport;
use App\Models\Payment;
use App\Models\User;
use App\Models\Withdraw;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $user = User::find($request->user()->id);
        $authorization_level = $user->authorization_level;

        $response = [
            'status' => 'success',
            'message' => 'Data retrieved successfully',
            'data' => [],
        ];

        if ($authorization_level == 1) {
            $response['data']['total_asset'] = 1;
        } elseif ($authorization_level == 2) {
            $userCampaigns = Campaign::where('id_user', $user->id)->pluck('id');

            $response['data']['total_campaign'] = $userCampaigns->count();
            $response['data']['total_campaign_report'] = CampaignReport::whereIn('id_campaign', $userCampaigns)->count();
            $response['data']['total_payment'] = CampaignReport::whereIn('id_campaign', $userCampaigns)->where('is_exported', 0)->count();
            $response['data']['total_withdraw'] = Withdraw::where('id_user', $user->id)->count();
            $response['data']['campaigns'] = Campaign::where('id_user', $user->id)
                ->with('banners')
                ->get();
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
