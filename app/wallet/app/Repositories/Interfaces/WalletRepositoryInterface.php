<?php

namespace App\Repositories\Interface;

interface WalletRepositoryInterface
{
    public function getBalance(int $userId);
    public function startTransactionWatch();
    public function updateBalance($userId, $value);
    public function commitTransactionWatch();
    public function rollBackTransactionWatch();
}
