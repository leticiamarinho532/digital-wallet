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

            $verifyIfUserHasBalanceToSend = floatval($getBalanceValue) - floatval($value);

            if ($verifyIfUserHasBalanceToSend < 0) {
                throw new \Exception('saldo insuficiente');
            }

            # A PARTIR DAQUI

            $updateBalanceValue = $this->walletRepository->updateBalance($verifyIfUserHasBalanceToSend);

            if ($updateBalanceValue === false) {
                throw new \Exception('erro ao transferir valor');
            }

            $authorizeTransfer = $this->transferAutorizerService->authorize($userIdSender, $userIdReciever, $value);

            if ($updateBalanceValue === false) {
                throw new \Exception('erro ao transferir valor');
            }

            # ATE AQUI

            return 'valor transferido com sucesso';
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }
}
