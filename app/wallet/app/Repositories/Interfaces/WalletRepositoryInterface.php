<?php

namespace App\Repositories\Interface;

interface WalletRepositoryInterface
{
    public function getBalance(int $userId);
}
