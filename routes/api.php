<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BannerController;
use App\Http\Controllers\CampaignBannerController;
use App\Http\Controllers\CampaignController;
use App\Http\Controllers\CampaignReportController;
use App\Http\Controllers\CampaignReportDetailController;
use App\Http\Controllers\CampaignReportGroupController;
use App\Http\Controllers\UserActiveController;
use App\Http\Controllers\UserBankController;
use App\Http\Controllers\FileController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ReceiptController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\UserBusinessController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\UserHeirController;
use App\Http\Controllers\UserImageController;
use App\Http\Controllers\WithdrawController;
use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

/*
|-------------------------------------------------------------------------------------------|
| Note                                                                                      |
|-------------------------------------------------------------------------------------------|
| 1. when you want allow all user roles acces api you can use "auth" only                   |
| 2. when you want allow specific user roles acces api you can use "auth:1,2"               |
| 3. you want spesific api like post only can acces by investor, you can try like this      |
| "$router->middleware('auth:3')->get('', [UserBankController::class, 'index']);"           |
| 4. 1 = for investor, 2 = UMKM, 3 = Reviewer                                               |
|-------------------------------------------------------------------------------------------|
*/


$version = env('APP_VERSION', 'v1');

Route::post("$version/login", [AuthController::class, 'login']);
Route::post("$version/register", [UserController::class, 'store']);
Route::post("$version/midtrans-callback", [TransactionController::class, 'callback']);
Route::post("$version/logout", [AuthController::class, 'logout'])->middleware('auth');
Route::post("$version/refresh", [AuthController::class, 'refresh'])->middleware('auth');

/*
|---------------------------------------------------------------------------|
| API Each Table Routes                                                     |
|---------------------------------------------------------------------------|
| http://127.0.0.1:8000/api/upload                          |POST|          |
| http://127.0.0.1:8000/api/user-banks                  |GET|POST|PUT|DELETE|
| http://127.0.0.1:8000/api/user-actives                |GET|POST|PUT|DELETE|
| http://127.0.0.1:8000/api/users                       |GET|POST|PUT|DELETE|
| http://127.0.0.1:8000/api/user-businesses             |GET|POST|PUT|DELETE|
| http://127.0.0.1:8000/api/user-heirs                  |GET|POST|PUT|DELETE|
| http://127.0.0.1:8000/api/user-images                 |GET|POST|PUT|DELETE|
| http://127.0.0.1:8000/api/payments                    |GET|POST|PUT|DELETE|
| http://127.0.0.1:8000/api/receipts                    |GET|POST|PUT|DELETE|
| http://127.0.0.1:8000/api/transactions                |GET|POST|PUT|DELETE|
| http://127.0.0.1:8000/api/withdraws                   |GET|POST|PUT|DELETE|
| http://127.0.0.1:8000/api/campaigns                   |GET|POST|PUT|DELETE|
| http://127.0.0.1:8000/api/campaign-banners            |GET|POST|PUT|DELETE|
| http://127.0.0.1:8000/api/campaign-reports            |GET|POST|PUT|DELETE|
| http://127.0.0.1:8000/api/campaign-report-details     |GET|POST|PUT|DELETE|
| http://127.0.0.1:8000/api/banners                     |GET|POST|PUT|DELETE|
|---------------------------------------------------------------------------|
| Note :                                                                    |
|---------------------------------------------------------------------------|
| 1. want add realation to another table add "include[]" parameter          |
|    example : http://127.0.0.1:8000/api/users?include[]=user_bank&include[]=user_active
| 2. want add filter to another table add name of your filter parameter     |
|    example : http://127.0.0.1:8000/api/users?name=John
|---------------------------------------------------------------------------|
*/

// user_banks
Route::group(['prefix' => "$version/upload"], function ($router) {
    Route::group(['middleware' => 'auth:1,2,3'], function ($router) {
        $router->post('', [FileController::class, 'store']);
    });
});

// users
Route::group(['prefix' => "$version/users"], function ($router) {
    Route::group(['middleware' => 'auth:1,2,3'], function ($router) {
        $router->get('', [UserController::class, 'index']);
        $router->get('/{id}', [UserController::class, 'show']);
        $router->post('', [UserController::class, 'store']);
        $router->post('{id}', [UserController::class, 'update']);
        $router->delete('{id}', [UserController::class, 'destroy']);
    });
});

// user
Route::group(['prefix' => "$version/user"], function ($router) {
    Route::group(['middleware' => 'auth:1,2,3'], function ($router) {
        $router->get('', [UserController::class, 'show_user_by_token']);
        $router->post('', [UserController::class, 'update_user_by_token']);
        $router->post('change-password', [UserController::class, 'change_password_user_by_token']);
        $router->post('logout', [AuthController::class, 'logout']);
    });
});

// user custom
Route::group(['prefix' => "$version/user-custom"], function ($router) {
    Route::group(['middleware' => 'auth:1,2,3'], function ($router) {
        $router->post('change-password/{id}', [UserController::class, 'change_password_user']);
    });
});

// user_banks
Route::group(['prefix' => "$version/user-banks"], function ($router) {
    Route::group(['middleware' => 'auth:1,2,3'], function ($router) {
        $router->get('', [UserBankController::class, 'index']);
        $router->get('/{id}', [UserBankController::class, 'show']);
        $router->post('', [UserBankController::class, 'store']);
        $router->post('{id}', [UserBankController::class, 'update']);
        $router->delete('{id}', [UserBankController::class, 'destroy']);
    });
});

// user_actives
Route::group(['prefix' => "$version/user-actives"], function ($router) {
    Route::group(['middleware' => 'auth:1,2,3,verified'], function ($router) {
        $router->get('', [UserActiveController::class, 'index']);
        $router->get('/{id}', [UserActiveController::class, 'show']);
        $router->post('', [UserActiveController::class, 'store']);
        $router->post('{id}', [UserActiveController::class, 'update']);
        $router->delete('{id}', [UserActiveController::class, 'destroy']);
    });
});

// user_bussiness
Route::group(['prefix' => "$version/user-business"], function ($router) {
    Route::group(['middleware' => 'auth:1,2,3'], function ($router) {
        $router->get('', [UserBusinessController::class, 'index']);
        $router->get('/{id}', [UserBusinessController::class, 'show']);
        $router->post('', [UserBusinessController::class, 'store']);
        $router->post('{id}', [UserBusinessController::class, 'update']);
        $router->delete('{id}', [UserBusinessController::class, 'destroy']);
    });
});

// user_heir
Route::group(['prefix' => "$version/user-heir"], function ($router) {
    Route::group(['middleware' => 'auth:1,2,3'], function ($router) {
        $router->get('', [UserHeirController::class, 'index']);
        $router->get('/{id}', [UserHeirController::class, 'show']);
        $router->post('', [UserHeirController::class, 'store']);
        $router->post('{id}', [UserHeirController::class, 'update']);
        $router->delete('{id}', [UserHeirController::class, 'destroy']);
    });
});

// user_image
Route::group(['prefix' => "$version/user-image"], function ($router) {
    Route::group(['middleware' => 'auth:1,2,3'], function ($router) {
        $router->get('', [UserImageController::class, 'index']);
        $router->get('/{id}', [UserImageController::class, 'show']);
        $router->post('', [UserImageController::class, 'store']);
        $router->post('{id}', [UserImageController::class, 'update']);
        $router->delete('{id}', [UserImageController::class, 'destroy']);
    });
});

// banner
Route::group(['prefix' => "$version/banner"], function ($router) {
    Route::group(['middleware' => 'auth:1,2,3,verified'], function ($router) {
        $router->get('', [BannerController::class, 'index']);
        $router->get('/{id}', [BannerController::class, 'show']);
        $router->post('', [BannerController::class, 'store']);
        $router->post('{id}', [BannerController::class, 'update']);
        $router->delete('{id}', [BannerController::class, 'destroy']);
    });
});

// receipt
Route::group(['prefix' => "$version/receipt"], function ($router) {
    Route::group(['middleware' => 'auth:1,2,3,verified'], function ($router) {
        $router->get('', [ReceiptController::class, 'index']);
        $router->get('/{id}', [ReceiptController::class, 'show']);
        $router->post('', [ReceiptController::class, 'store']);
        $router->post('{id}', [ReceiptController::class, 'update']);
        $router->delete('{id}', [ReceiptController::class, 'destroy']);
    });
});

// withdraw
Route::group(['prefix' => "$version/withdraw"], function ($router) {
    Route::group(['middleware' => 'auth:1,2,3,verified'], function ($router) {
        $router->get('detail/{id}', [WithdrawController::class, 'detail_withdraw']);
        $router->get('', [WithdrawController::class, 'index']);
        $router->get('/{id}', [WithdrawController::class, 'show']);
        $router->post('', [WithdrawController::class, 'store']);
        $router->post('{id}', [WithdrawController::class, 'update']);
        $router->delete('{id}', [WithdrawController::class, 'destroy']);
    });
});

// campaign
Route::group(['prefix' => "$version/campaign"], function ($router) {
    Route::group(['middleware' => 'auth:1,2,3,verified'], function ($router) {
        $router->get('', [CampaignController::class, 'index']);
        $router->get('total-investor', [CampaignController::class, 'index_total_investor']);
        $router->get('/{id}', [CampaignController::class, 'show']);
        $router->post('', [CampaignController::class, 'store']);
        $router->post('{id}', [CampaignController::class, 'update']);
        $router->delete('{id}', [CampaignController::class, 'destroy']);
    });
});

// transaction
Route::group(['prefix' => "$version/transaction"], function ($router) {
    Route::group(['middleware' => 'auth:1,2,3,verified'], function ($router) {
        $router->post('/midtrans-transaction', [TransactionController::class, 'midtrans_transaction']);
        $router->post('transaction-aprroval/{id}', [TransactionController::class, 'transaction_approval']);
        $router->get('portfolio', [TransactionController::class, 'show_portfolio']);
        $router->get('', [TransactionController::class, 'index']);
        $router->get('/{id}', [TransactionController::class, 'show']);
        $router->post('', [TransactionController::class, 'store']);
        $router->post('{id}', [TransactionController::class, 'update']);
        $router->delete('{id}', [TransactionController::class, 'destroy']);
    });
});

// campaign_report
Route::group(['prefix' => "$version/campaign-report"], function ($router) {
    Route::group(['middleware' => 'auth:1,2,3,verified'], function ($router) {
        $router->get('', [CampaignReportController::class, 'index']);
        $router->get('/{id}', [CampaignReportController::class, 'show']);
        $router->post('', [CampaignReportController::class, 'store']);
        $router->post('{id}', [CampaignReportController::class, 'update']);
        $router->delete('{id}', [CampaignReportController::class, 'destroy']);
    });
});

// campaign_report_group
Route::group(['prefix' => "$version/campaign-report-group"], function ($router) {
    Route::group(['middleware' => 'auth:1,2,3,verified'], function ($router) {
        $router->get('', [CampaignReportGroupController::class, 'index']);
        $router->get('/{id}', [CampaignReportGroupController::class, 'show']);
        $router->post('', [CampaignReportGroupController::class, 'store']);
        $router->post('{id}', [CampaignReportGroupController::class, 'update']);
        $router->delete('{id}', [CampaignReportGroupController::class, 'destroy']);
    });
});

// campaign_report_detail
Route::group(['prefix' => "$version/campaign-report-detail"], function ($router) {
    Route::group(['middleware' => 'auth:1,2,3,verified'], function ($router) {
        $router->get('', [CampaignReportDetailController::class, 'index']);
        $router->get('/{id}', [CampaignReportDetailController::class, 'show']);
        $router->post('', [CampaignReportDetailController::class, 'store']);
        $router->post('{id}', [CampaignReportDetailController::class, 'update']);
        $router->delete('{id}', [CampaignReportDetailController::class, 'destroy']);
    });
});

// campaign_banner
Route::group(['prefix' => "$version/campaign-banner"], function ($router) {
    Route::group(['middleware' => 'auth:1,2,3,verified'], function ($router) {
        $router->get('', [CampaignBannerController::class, 'index']);
        $router->get('/{id}', [CampaignBannerController::class, 'show']);
        $router->post('', [CampaignBannerController::class, 'store']);
        $router->post('{id}', [CampaignBannerController::class, 'update']);
        $router->delete('{id}', [CampaignBannerController::class, 'destroy']);
    });
});

// payment
Route::group(['prefix' => "$version/payment"], function ($router) {
    Route::group(['middleware' => 'auth:1,2,3,verified'], function ($router) {
        $router->get('detail-payment/{id}', [PaymentController::class, 'detail_payment']);
        $router->post('do-payment', [PaymentController::class, 'do_payment']);
        $router->get('', [PaymentController::class, 'index']);
        $router->get('with-campaign', [PaymentController::class, 'payment_with_campaign']);
        $router->get('/{id}', [PaymentController::class, 'show']);
        $router->post('', [PaymentController::class, 'store']);
        $router->post('{id}', [PaymentController::class, 'update']);
        $router->post('do-payment', [PaymentController::class, 'do_payment']);
        $router->delete('{id}', [PaymentController::class, 'destroy']);
    });
});


// dashboard
Route::group(['prefix' => "$version/dashboard"], function ($router){
    Route::group(['middleware' => 'auth:1,2,3'], function ($router) {
        $router->get('', [DashboardController::class, 'index']);
    });
});

