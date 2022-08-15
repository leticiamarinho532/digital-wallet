<?php

namespace Tests\Unit;

use PhpParser\Node\Expr\FuncCall;
// use PHPUnit\Framework\TestCase;
use Tests\TestCase;
use Mockery\MockInterface;
use Mockery;

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

    # TESTS TO DO
    # see balance
    # check balance value

    public function testCanSeeAccountBalanceWhenNoValueIn(): void
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
}
