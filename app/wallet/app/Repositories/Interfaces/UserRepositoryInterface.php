<?php

namespace App\Repositories\Interfaces;

interface UserRepositoryInterface
{
    public function create(object $userData);
    public function checkIfUserExist(object $userData);
}
