<?php

use App\Http\Controllers\api\WishesController;
use App\Http\Controllers\WishesController as ControllersWishesController;
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
Route::post('/wishes', [WishesController::class, 'store']);
Route::get('/wishes/{id}', [WishesController::class, 'show_detail']);
Route::put('/wishes/{id}', [WishesController::class, 'update']);
Route::delete('/wishes/{id}', [WishesController::class, 'destroy']);