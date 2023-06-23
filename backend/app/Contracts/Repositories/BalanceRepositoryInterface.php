<?php

namespace App\Contracts\Repositories;

interface BalanceRepositoryInterface
{
    /**
     * Get the balance of the user
     */
    public function get($userId);
}
