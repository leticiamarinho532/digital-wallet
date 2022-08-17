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

Route::post('/user/create', [UserController::class, 'create']);
Route::post('/user/login', [UserController::class, 'logIn']);
Route::get('/wallet/balance/{userId}', [WalletController::class, 'getBalance']);
Route::post('/transaction/do', [TransactionController::class, 'doTransaction']);
;
