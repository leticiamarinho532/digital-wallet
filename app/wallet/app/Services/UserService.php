<?php

namespace App\Serices;

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
        try {
            $createUserReponse = $this->userRepository->createUser($userData);

            if ($createUserReponse !== true) {
                throw new \Exception('não foi possível criar o usuário');
            }
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }
}
