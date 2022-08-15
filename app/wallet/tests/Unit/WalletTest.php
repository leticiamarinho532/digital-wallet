<?php

namespace Tests\Unit;

use PhpParser\Node\Expr\FuncCall;
use PHPUnit\Framework\TestCase;

class LoadBalanceRepositoryMock implements LoadBalanceRepository
{
    public $value;

    public function loadBalance(int $userId, float $value)
    {
        $this->value = $value;
    }
}

interface LoadBalanceRepository
{
    public function loadBalance(int $userId, float $value);
}

class Wallet
{
    private $LoadBalanceRepository;

    public function __construct(LoadBalanceRepository $LoadBalanceRepository)
    {
        $this->LoadBalanceRepository = $LoadBalanceRepository;
    }

    public function seeValue($userId)
    {
        return $this->LoadBalanceRepository->loadBalance($userId, 0.00);
    }
}

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
        $loadBalanceRepository = new LoadBalanceRepositoryMock();
        $checkBalanceValue = new Wallet($loadBalanceRepository);
        $seeValue = $checkBalanceValue->seeValue(1, 0.00);

        $this->assertEquals(
            $seeValue,
            0.00
        );
    }
}
