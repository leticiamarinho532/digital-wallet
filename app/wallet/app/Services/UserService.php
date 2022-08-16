<?php

namespace App\Services;

use App\Repositories\Interfaces\UserRepositoryInterface;

class UserService
{
    private $userRepository;

    public function __constructor(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function createUser(object $userData)
    {
        # Add validation
        try {
            $createUserReponse = $this->userRepository->create($userData);

            if ($createUserReponse !== true) {
                throw new \Exception('não foi possível criar o usuário');
            }
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    # Change Method Name
    public function logIn(object $userData)
    {
        # Add Validation
        try {
            $checkUserExistRespose = $this->userRepository->checkIfUserExist($userData);

            if ($checkUserExistRespose === false) {
                throw new \Exception('não foi possível criar o usuário');
            }

            return self::generateToken($checkUserExistRespose);
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    # Move to right Service
    public function generateToken($value)
    {
        return $value;
    }

    # Move to right Service
    public function decryptToken($token)
    {
        return $token;
    }
}
