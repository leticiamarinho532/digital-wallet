<?php

namespace App\Repositories;

use App\Models\User;
use App\Repositories\Interfaces\UserRepositoryInterface;

class UserRepository implements UserRepositoryInterface
{
    public function create(object $userData)
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
        )
        ->fisrt();

        if ($checkUser) {
            return false;
        }

        return $checkUser->id;
    }

    public function checkPassword(object $userData)
    {
        $checkUser = User::where(
            ['password', '=', $userData->password],
        )
        ->fisrt();

        if ($checkUser) {
            return false;
        }

        return $checkUser->id;
    }
}
