<?php

namespace App\Repositories;

use App\Models\User;
use App\Repositories\Interfaces\UserRepositoryInterface;

class UserRepository implements UserRepositoryInterface
{
    public function createUser(object $userData)
    {
        $createUser = User::create($userData);

        if (!$createUser) {
            return false;
        }

        return true;
    }

    public function checkIfUserExist(object $userData)
    {
        $checkUser = User::where(
            ['email', '=', $userData->email],
            ['password', '=', $userData->password]
        )
        ->fisrt();

        if ($checkUser) {
            return false;
        }

        return true;
    }
}
