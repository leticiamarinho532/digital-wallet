<?php

namespace App\Repositories\Interfaces;

interface UserRepositoryInterface
{
    public function createUser(object $userData);
    public function checkIfUserExist(object $userData);
}
