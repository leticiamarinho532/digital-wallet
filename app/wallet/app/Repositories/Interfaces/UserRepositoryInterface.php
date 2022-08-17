<?php

namespace App\Repositories\Interface;

interface UserRepositoryInterface
{
    public function create(object $userData);
    public function checkIfUserExist(object $userData);
    public function checkPassword(object $userData);
}
