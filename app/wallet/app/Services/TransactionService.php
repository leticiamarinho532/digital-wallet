<?php

namespace App\Services;

class TrasactionService
{
    private $transactionRepository;
    private $walletRepository;
    private $userRepository;
    private $transferAutorizerService;

    public function __construct(
        TransactionsRepositoryInterface $transactionsRepository,
        WalletRepositoryInterface $walletRepository,
        UserRepositoryInterface $userRepository,
        TrasferAuthorizerinterface $transferAutorizerService
    ) {
        $this->transactionRepository = $transactionsRepository;
        $this->walletRepository = $walletRepository;
        $this->userRepository = $userRepository;
        $this->transferAutorizerService = $transferAutorizerService;
    }

    public function transferValue($userIdSender, $userIdReciever, $value)
    {
        # verificar usuario enviador
        # verificar usuario recebedor
        # verificar valor de saldo do usuario enviador
        # descontar valor do saldo
        # autorizar transferencia
        # retornar mensagem

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

            $insertTransactionValueOnWallet = $this->walletRepository->insertTransactionValue(
                $userIdSender,
                $userIdReciever,
                $value
            );

            if ($insertTransactionValueOnWallet === false) {
                throw new \Exception('erro ao transferir valor');
            }

            $this->walletRepository->commitTransactionWatch();

            return true;
        } catch (\Exception $e) {
            $this->walletRepository->rollBackTransactionWatch();
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
