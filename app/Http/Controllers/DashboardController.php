<?php

namespace App\Http\Controllers;

use App\Models\Campaign;
use App\Models\CampaignReport;
use App\Models\Payment;
use App\Models\Transaction;
use App\Models\User;
use App\Models\UserActive;
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
            $response['data']['total_asset'] = 3500000;
            $response['data']['campaigns'] = Campaign::where('status', 'ACTIVE')->limit(5)->get();

            $apiKey = '2094e9cb485e4145b44c2b9fc7c82620';
            $apiUrl = 'https://newsapi.org/v2/top-headlines';
            $country = 'id';
            $category = 'business';
            $query = 'invest';
            $page = 1;

            $newsUrl = $apiUrl . '?apiKey=' . $apiKey . '&country=' . $country . '&category=' . $category . '&q=' . $query . '&page=' . $page;

            try {
                $curl = curl_init();

                curl_setopt_array($curl, [
                    CURLOPT_URL => $newsUrl,
                    CURLOPT_RETURNTRANSFER => true,
                    CURLOPT_FOLLOWLOCATION => true,
                    CURLOPT_HTTPHEADER => [
                        'Content-Type: application/json',
                    ],
                ]);

                $newsData = curl_exec($curl);

                if ($newsData === false) {
                    throw new \Exception(curl_error($curl), curl_errno($curl));
                }

                curl_close($curl);

                $newsData = json_decode($newsData, true);

                $response['data']['news'] = [
                    'error' => null,
                    'articles' => ($newsData && isset($newsData['articles'])) ? $newsData['articles'] : null,
                ];
            } catch (\Exception $e) {
                $errorCode = $e->getCode();
                $errorMessage = $e->getMessage();
                $response['data']['news'] = [
                    'error' => "Failed to fetch news data - $errorCode - $errorMessage",
                    'articles' => null,
                ];
            }
        } elseif ($authorization_level == 2) {
            $userCampaigns = Campaign::where('id_user', $user->id)->pluck('id');

            $response['data']['total_campaign'] = $userCampaigns->count();
            $response['data']['total_campaign_report'] = CampaignReport::whereIn('id_campaign', $userCampaigns)->count();
            $response['data']['total_payment'] = Payment::where('id_user', $user->id)->count();
            $response['data']['total_withdraw'] = Withdraw::where('id_user', $user->id)->count();
            $response['data']['campaigns'] = Campaign::where('id_user', $user->id)
                ->with('banners')
                ->get();
        } elseif ($authorization_level == 3) {
            $response['data']['total_investor_submission'] = $this->getTotalSubmission(1);
            $response['data']['total_sme_submission'] = $this->getTotalSubmission(2);
            $response['data']['total_campaign_submission'] = Campaign::where('status', 'WAITING_VERIFICATION')->count();
            $response['data']['total_transaction_submission'] = Transaction::where('status', 'WAITING_VERIFICATION')->count();
            $response['data']['total_withdraw_submission'] = Withdraw::where('status', 'WAITING_VERIFICATION')->count();
            $response['data']['total_report_submission'] = CampaignReport::where('is_exported', 0)->count();
            $response['data']['total_user_bank_submission'] = UserActive::where('user_bank', 0)->count();
        }

        return response()->json($response);
    }

    private function getTotalSubmission($authorizationLevel)
    {
        $requiredFields = ['phone_number', 'email', 'id_card', 'tax_registration_number', 'user_bank'];

        if ($authorizationLevel == 2) {
            $requiredFields[] = 'user_business';
        }

        return User::where('authorization_level', $authorizationLevel)
            ->whereHas('user_active', function ($query) use ($requiredFields) {
                $query->where(function ($query) use ($requiredFields) {
                    foreach ($requiredFields as $field) {
                        $query->where($field, 0);
                    }
                });
            })
            ->count();
    }

}
