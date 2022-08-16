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

    public function getBalance($userId)
    {
        # Add validation
        try {
            $getBlanceReponse = $this->WalletRepository->getBalance($userId);

            if ($getBlanceReponse === false) {
                throw new \Exception('não foi possível recuperar saldo');
            }

            return $getBlanceReponse;
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }
}
