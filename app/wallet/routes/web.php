<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::post('/user/create', '\App\Controllers\UserController::create');
Route::post('/user/login', '\App\Controllers\UserController::logIn');
Route::get('/wallet/balance', '\App\Controllers\WalletController::getBalance');
Route::post('/transaction/do', '\App\Controllers\TransactionController::doTransaction');
