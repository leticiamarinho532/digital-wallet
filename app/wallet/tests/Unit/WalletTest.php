<?php

namespace Tests\Unit;

use Tests\TestCase;

use App\Services\WalletService;
use App\Repositories\Interface\WalletRepositoryInterface;

class WalletTest extends TestCase
{
    public function testCanSeeAccountBalanceWhenNoValueIn(): void
    {
        $walletRepositoryMock = $this->mock(WalletRepositoryInterface::class);
        $walletRepositoryMock->shouldReceive('getBalance')->andReturn(0.00);

        $checkBalanceValue = new WalletService($walletRepositoryMock);
        $seeValue = $checkBalanceValue->getBalance(1);

        $this->assertEquals(
            $seeValue,
            0.00
        );
    }

    public function testCanSeeAccountBalanceWhenValueIn(): void
    {
        $walletRepositoryMock = $this->mock(WalletRepositoryInterface::class);
        $walletRepositoryMock->shouldReceive('getBalance')->andReturn(3.00);

        $checkBalanceValue = new WalletService($walletRepositoryMock);
        $seeValue = $checkBalanceValue->getBalance(1);

        $this->assertEquals(
            $seeValue,
            3.00
        );
    }
}
