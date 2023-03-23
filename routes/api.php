<?php

use App\Http\Controllers\api\WishesController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\Wishes;
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

//wishes
Route::get('/wishes', [WishesController::class, 'index']);
Route::post('/wishes/store', [WishesController::class, 'store']);
