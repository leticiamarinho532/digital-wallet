<?php

namespace Tests\Unit;

use PhpParser\Node\Expr\FuncCall;
use Tests\TestCase;

use App\Services\WalletService;
use App\Repositories\WalletRepository;
use App\Repositories\Interface\WalletRepositoryInterface;

class WalletTest extends TestCase
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

    public function testCanSeeAccountBalanceWhenNoValueIn(): void
    {
        $walletRepositoryMock = $this->mock(WalletRepositoryInterface::class);
        $walletRepositoryMock->shouldReceive('displayBalance')->andReturn(0.00);

        $checkBalanceValue = new WalletService($walletRepositoryMock);
        $seeValue = $checkBalanceValue->displayBalance(1);

        $this->assertEquals(
            $seeValue,
            0.00
        );
    }

    public function testCanSeeAccountBalanceWhenValueIn(): void
    {
        $walletRepositoryMock = $this->mock(WalletRepositoryInterface::class);
        $walletRepositoryMock->shouldReceive('displayBalance')->andReturn(3.00);

        $checkBalanceValue = new WalletService($walletRepositoryMock);
        $seeValue = $checkBalanceValue->displayBalance(1);

        $this->assertEquals(
            $seeValue,
            3.00
        );
    }

    public function testCheckIfHasAnValueHavingIt(): void
    {
        $walletRepositoryMock = $this->mock(WalletRepositoryInterface::class);
        $walletRepositoryMock->shouldReceive('checkBalance')->andReturn(true);

        $checkBalanceValue = new WalletService($walletRepositoryMock);
        $checkValue = $checkBalanceValue->checkBalance(1, 3.00);

        $this->assertTrue(
            $checkValue
        );
    }

    public function testCheckIfHasAnValueNotHavingIt(): void
    {
        $walletRepositoryMock = $this->mock(WalletRepositoryInterface::class);
        $walletRepositoryMock->shouldReceive('checkBalance')->andReturn(false);

        $checkBalanceValue = new WalletService($walletRepositoryMock);
        $checkValue = $checkBalanceValue->checkBalance(1, 3.00);

        $this->assertFalse(
            $checkValue
        );
    }
}
