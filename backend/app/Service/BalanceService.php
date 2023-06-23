<?php

namespace App\Services;

use App\Contracts\Repositories\BalanceRepositoryInterface;
use Exception;

class BalanceService
{
    private $balanceRepository;

    public function __construct(
        BalanceRepositoryInterface $balanceRepository
    ) {
    }

    /**
     * Returns the balance of the user
     *
     * @param int $userId
     * @return array
     * @throws Exception
     */
    public function get($userId)
    {
        //TODO: by other service, verify if user exists

        try {
            $balance = $this->balanceRepository->get($userId);
            return $balance;
        } catch (Exception $exception) {
            return [
                'errorMessage' => $exception->getMessage()
            ];
        }
    }
}
