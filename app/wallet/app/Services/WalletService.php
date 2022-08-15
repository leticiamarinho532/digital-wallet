<?php

namespace App\Services;

use App\Repositories\Interface\WalletRepositoryInterface;

class WalletService
{
    private $WalletRepository;

    public function __construct(WalletRepositoryInterface $WalletRepository)
    {
        $this->WalletRepository = $WalletRepository;
    }

    public function displayBalance($userId)
    {
        return $this->WalletRepository->displayBalance($userId);
    }
}
