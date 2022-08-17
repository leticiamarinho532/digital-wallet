<?php

namespace App\Repositories;

use App\Models\Wallet;
use App\Repositories\Interface\WalletRepositoryInterface;

class WalletRepository implements WalletRepositoryInterface
{
    public function getBalance($userId)
    {
        $balance = Wallet::where('user_id', $userId)->first();

        return $balance->amount;
    }

    public function startTransactionWatch()
    {
        return \DB::beginTransaction();
    }

    public function updateBalance($userId, $value)
    {
        return Wallet::where('user_id', $userId)
            ->update(['balance' => $value]);
    }

    public function commitTransactionWatch()
    {
        return \DB::commit();
    }

    public function rollBackTransactionWatch()
    {
        return \DB::rollBack();
    }
}
