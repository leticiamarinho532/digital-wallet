<?php

namespace App\Repositories;

use App\Models\Wallet;
use App\Repositories\Interface\WalletRepositoryInterface;

class WalletRepository implements WalletRepositoryInterface
{
    public function displayBalance($userId)
    {
        return Wallet::where('user_id', $userId);
    }

    public function checkBalance($userId, $value)
    {
    }
}
