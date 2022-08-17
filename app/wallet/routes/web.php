<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\TransactionController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\WalletController;

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

Route::post('/user/create', [UserController::class, 'create']);
Route::post('/user/login', [UserController::class, 'logIn']);
Route::get('/wallet/balance/{userId}', [WalletController::class, 'getBalance']);
Route::post('/transaction/do', [TransactionController::class, 'doTransaction']);
