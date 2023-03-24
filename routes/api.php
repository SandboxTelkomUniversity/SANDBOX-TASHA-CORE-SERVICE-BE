<?php

use App\Http\Controllers\api\WishesController;
use App\Http\Controllers\api\AuthController;
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

//authentication
Route::controller(AuthController::class)->group(function () {
    Route::post('/login', 'login');
    Route::post('/register', 'register');
    Route::post('/logout', 'logout');
    Route::post('/refresh', 'refresh');

});

//wishes
Route::controller(WishesController::class)->group(function () {
Route::get('/wishes', 'index');
Route::post('/wishes', 'store');
Route::get('/wishes/{id}', 'show_detail');
Route::put('/wishes/{id}', 'update');
Route::delete('/wishes/{id}', 'destroy');
});