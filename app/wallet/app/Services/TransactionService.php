<?php

namespace App\Services;

use App\Repositories\Interface\TransactionsRepositoryInterface;
use App\Repositories\Interface\WalletRepositoryInterface;
use App\Repositories\Interface\UserRepositoryInterface;
use App\Interface\TransactionAuthorizerInterface;
use App\Interface\NotifyServiceInterface;

class TransactionService
{
    private $walletRepository;
    private $userRepository;
    private $transferAutorizerService;
    private $notifyService;

    public function __construct(
        WalletRepositoryInterface $walletRepository,
        UserRepositoryInterface $userRepository,
        TransactionAuthorizerInterface $transferAutorizerService,
        NotifyServiceInterface $notifyService
    ) {
        $this->walletRepository = $walletRepository;
        $this->userRepository = $userRepository;
        $this->transferAutorizerService = $transferAutorizerService;
        $this->notifyService = $notifyService;
    }

    public function transferValue($userIdSender, $userIdReciever, $value)
    {
        try {
            $verifyUserRecieverExists = $this->userRepository->checkIfUserExist($userIdReciever);

            if ($verifyUserRecieverExists === false) {
                throw new \Exception('erro ao transferir valor');
            }

            $getBalanceValue = $this->walletRepository->getBalance($userIdSender);

            if ($verifyUserRecieverExists === false) {
                throw new \Exception('erro ao transferir valor');
            }

            $verifyIfUserHasBalanceToSend = $this->verifyIfUserHasBalanceToSend($getBalanceValue, $value);

            $responseExecuteTransaction = $this->executeTransaction(
                $userIdSender,
                $userIdReciever,
                $value,
                $verifyIfUserHasBalanceToSend
            );

            if ($responseExecuteTransaction !== true) {
                throw new \Exception('erro ao transferir valor');
            }

            $this->notifyService->notify($verifyUserRecieverExists);

            return 'valor transferido com sucesso';
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    public function executeTransaction($userIdSender, $userIdReciever, $value, $verifyIfUserHasBalanceToSend)
    {
        try {
            $this->walletRepository->startTransactionWatch();

            $updateBalanceValue = $this->walletRepository->updateBalance($userIdSender, $verifyIfUserHasBalanceToSend);

            if ($updateBalanceValue === false) {
                throw new \Exception('erro ao transferir valor');
            }

            $authorizeTransfer = $this->transferAutorizerService->authorize($userIdSender, $userIdReciever, $value);

            if ($authorizeTransfer === false) {
                throw new \Exception('erro ao transferir valor');
            }

            $this->walletRepository->commitTransactionWatch();
            return true;
        } catch (\Exception $e) {
            $this->walletRepository->rollBackTransactionWatch();

            return false;
        }
    }

    public function verifyIfUserHasBalanceToSend($balanceValue, $value)
    {
        $verifyIfUserHasBalanceToSend = floatval($balanceValue) - floatval($value);

        if ($verifyIfUserHasBalanceToSend < 0) {
            return false;
        }

        return true;
    }
}
