<?php

namespace App\Services;

use App\Repositories\Interface\UserRepositoryInterface;

class UserService
{
    private $userRepository;

    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function createUser(object $userData)
    {
        # Add validation
        try {
            $createUserResponse = $this->userRepository->create($userData);

            if ($createUserResponse !== true) {
                throw new \Exception('não foi possível criar o usuário');
            }

            return 'usuário criado com sucesso';
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    public function checkIfUserExist($userData)
    {
        try {
            return $this->userRepository->checkIfUserExist($userData);
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    # Move to right Service
    public function logIn(object $userData)
    {
        # Add Validation
        try {
            $checkUserExistRespose = $this->userRepository->checkIfUserExist($userData);

            if ($checkUserExistRespose === false) {
                throw new \Exception('email ou/e senha incorretos');
            }

            $verifyPassword = $this->verifyPassword($userData);

            if ($verifyPassword !== true) {
                throw new \Exception('email ou/e senha incorretos');
            }

            return $this->generateToken($checkUserExistRespose);
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    # Move to right Service
    public function verifyPassword($userData)
    {
        try {
            $checkUserPassword = $this->userRepository->checkPassword($userData);

            if ($checkUserPassword === false) {
                throw new \Exception('não foi possível realizar o login');
            }

            return true;
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
