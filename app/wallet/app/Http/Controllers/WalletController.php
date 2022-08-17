<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\WalletRepository;

class WalletController extends Controller
{
    private $walletRepository;

    public function __construct(WalletRepository $walletRepository)
    {
        $this->walletRepository = $walletRepository;
    }

    public function getBalance($userId)
    {
        $response = $this->walletRepository->getBalance($userId);

        return response()->json(['data' => ['amount' => $response], 'message' => 'sucesso']);
    }
}
