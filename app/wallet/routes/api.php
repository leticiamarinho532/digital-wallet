<?php

use Illuminate\Http\Request;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/user/create', '\App\Controllers\UserController::create');
Route::post('/user/login', '\App\Controllers\UserController::logIn');
Route::get('/wallet/balance', '\App\Controllers\WalletController::getBalance');
Route::post('/transaction/do', '\App\Controllers\TransactionController::doTransaction');
