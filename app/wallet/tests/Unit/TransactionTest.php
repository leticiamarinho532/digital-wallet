<?php

namespace Tests\Unit;

use Tests\TestCase;

use App\Services\TransactionService;
use App\Repositories\Interface\WalletRepositoryInterface;
use App\Repositories\Interface\UserRepositoryInterface;
use App\Interface\TransactionAuthorizerInterface;

class TransactionTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_example()
    {
        $this->assertTrue(true);
    }

    public function testCannotSendInvalidValue()
    {
        $UserRepositoryMock = $this->mock(UserRepositoryInterface::class);
        $UserRepositoryMock->shouldReceive('checkIfUserExist')->andReturn(true);

        $walletRepositoryMock = $this->mock(WalletRepositoryInterface::class);
        $walletRepositoryMock->shouldReceive('getBalance')->andReturn(10.00);
        $walletRepositoryMock->shouldReceive('rollBackTransactionWatch')->andReturn(true);
        $walletRepositoryMock->shouldReceive('startTransactionWatch')->andReturn(true);
        $walletRepositoryMock->shouldReceive('updateBalance')->andReturn(true);
        $walletRepositoryMock->shouldReceive('insertTransactionValue')->andReturn(true);

        $transactionAuthorizerMock = $this->mock(TransactionAuthorizerInterface::class);
        $transactionAuthorizerMock->shouldReceive('authorize')->andReturn(true);

        $userSender = 1;
        $userReciever = 2;
        $value = '@96.0';

        $transactionService = new TransactionService(
            $walletRepositoryMock,
            $UserRepositoryMock,
            $transactionAuthorizerMock
        );
        $transferValue = $transactionService->transferValue($userSender, $userReciever, $value);

        $this->assertEquals(
            $transferValue,
            'erro ao transferir valor'
        );
    }

    // public function testCannotSendValueToInvalidUser()
    // {
    //     $UserRepositoryMock = $this->mock(UserRepositoryInterface::class);
    //     $UserRepositoryMock->shouldReceive('checkIfUserExist')->andReturn(10.00);

    //     $walletRepositoryMock = $this->mock(WalletRepositoryInterface::class);
    //     $walletRepositoryMock->shouldReceive('getBalance')->andReturn(10.00);

    //     $transactionRepositoryMock = $this->mock(TransacionRepositoryInterface::class);
    //     $transactionRepositoryMock->shouldReceive('transfer')->andReturn(false);

    //     $transactionAuthorizerMock = $this->mock(AuthorizerInterface::class);
    //     $transactionAuthorizerMock->shouldReceive('transfer')->andReturn(true);

    //     $userSender = 1;
    //     $userReciever = 'user_000';
    //     $value = 5.00;

    //     $transactionService = new TransactionService(
    //         $transactionRepositoryMock,
    //         $walletRepositoryMock,
    //         $UserRepositoryMock,
    //         $transactionAuthorizerMock
    //     );
    //     $transferValue = $transactionService->transfer($userSender, $userReciever, $value);

    //     $this->assertEquals(
    //         $transferValue,
    //         false
    //     );
    // }

    // public function testCannotSendValueDueNotAvaibleValueInBalance()
    // {
    //     $UserRepositoryMock = $this->mock(UserRepositoryInterface::class);
    //     $UserRepositoryMock->shouldReceive('checkIfUserExist')->andReturn(10.00);

    //     $walletRepositoryMock = $this->mock(WalletRepositoryInterface::class);
    //     $walletRepositoryMock->shouldReceive('getBalance')->andReturn(1.00);

    //     $transactionRepositoryMock = $this->mock(TransacionRepositoryInterface::class);
    //     $transactionRepositoryMock->shouldReceive('transfer')->andReturn(false);

    //     $transactionAuthorizerMock = $this->mock(AuthorizerInterface::class);
    //     $transactionAuthorizerMock->shouldReceive('transfer')->andReturn(true);

    //     $userSender = 1;
    //     $userReciever = 2;
    //     $value = 5.00;

    //     $transactionService = new TransactionService(
    //         $transactionRepositoryMock,
    //         $walletRepositoryMock,
    //         $UserRepositoryMock,
    //         $transactionAuthorizerMock
    //     );
    //     $transferValue = $transactionService->transfer($userSender, $userReciever, $value);

    //     $this->assertEquals(
    //         $transferValue,
    //         false
    //     );
    // }

    public function testCanSendValue()
    {
        $UserRepositoryMock = $this->mock(UserRepositoryInterface::class);
        $UserRepositoryMock->shouldReceive('checkIfUserExist')->andReturn(true);

        $walletRepositoryMock = $this->mock(WalletRepositoryInterface::class);
        $walletRepositoryMock->shouldReceive('getBalance')->andReturn(10.00);
        $walletRepositoryMock->shouldReceive('startTransactionWatch')->andReturn(true);
        $walletRepositoryMock->shouldReceive('updateBalance')->andReturn(true);
        $walletRepositoryMock->shouldReceive('commitTransactionWatch')->andReturn(true);
        $walletRepositoryMock->shouldReceive('rollBackTransactionWatch')->andReturn(false);

        $transactionAuthorizerMock = $this->mock(TransactionAuthorizerInterface::class);
        $transactionAuthorizerMock->shouldReceive('authorize')->andReturn(true);

        $userSender = 1;
        $userReciever = 2;
        $value = 5.00;

        $transactionService = new TransactionService(
            $walletRepositoryMock,
            $UserRepositoryMock,
            $transactionAuthorizerMock
        );
        $transferValue = $transactionService->transferValue($userSender, $userReciever, $value);

        $this->assertEquals(
            $transferValue,
            'valor transferido com sucesso'
        );
    }
}
