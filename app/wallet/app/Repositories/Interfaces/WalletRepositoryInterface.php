<?php

namespace App\Repositories\Interface;

interface WalletRepositoryInterface
{
    public function displayBalance(int $userId);
    public function checkBalance(int $userId, float $value);
}
