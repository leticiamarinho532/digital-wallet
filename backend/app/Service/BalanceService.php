<?php

namespace App\Services;

use App\Contracts\Repositories\BalanceRepositoryInterface;
use App\Services\ExtractService;

use Exception;

class BalanceService
{
    private $balanceRepository;
    private $extractService;

    public function __construct(
        BalanceRepositoryInterface $balanceRepository,
        ExtractService $extractService
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
            //TODO: store error in long at minimun

            return [
                'errorMessage' => $exception->getMessage()
            ];
        }
    }

    /**
     * Verify if value to transfer is avaible in balance
     *
     * @param int $userId
     * @param float $value
     * @return boolean
     * @throws Exception
     */
    public function verifyBalanceAvability($userId, $value)
    {
        try {
            $balance = $this->balanceRepository->get($userId);

            $result = $balance - $value;

            if ($result < 0) {
                return false;
            }

            return true;
        } catch (Exception $exception) {
            //TODO: store error in long at minimun

            return [
                'errorMessage' => $exception->getMessage()
            ];
        }
    }

    /**
     * Update balance
     *
     * @param int $userId
     * @param string $extractType
     * @param float $value
     * @return void
     * @throws void
     */
    public function update($userId, $extractType, $value)
    {
        try {
            return $this->extractService->store($userId, $extractType, $value);
        } catch (Exception $exception) {
            //TODO: store error in long at minimun

            return [
                'errorMessage' => $exception->getMessage()
            ];
        }
    }
}
