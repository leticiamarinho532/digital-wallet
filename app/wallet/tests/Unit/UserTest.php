<?php

namespace Tests\Unit;

use Tests\TestCase;

use App\Services\UserService;
use App\Repositories\Interface\UserRepositoryInterface;

class UserTest extends TestCase
{
    public function testCannotCreateUserWithoutEmail()
    {
        $userRepositoryMock = $this->mock(UserRepositoryInterface::class);
        $userRepositoryMock->shouldReceive('create')->andReturn(false);

        $userData = json_decode(json_encode([
            'fullName' => 'Maria João',
            'cpf' => '000.000.000-00',
            'email' => '',
            'password' => '123456',
            'userType' => '2'
        ]));

        $userService = new UserService($userRepositoryMock);
        $createUser = $userService->createUser($userData);

        $this->assertEquals(
            $createUser,
            'não foi possível criar o usuário'
        );
    }

    public function testCannotCreateUserWithoutFullName()
    {
        $UserRepositoryMock = $this->mock(UserRepositoryInterface::class);
        $UserRepositoryMock->shouldReceive('create')->andReturn(false);

        $userData = json_decode(json_encode([
            'fullName' => '',
            'cpf' => '000.000.000-00',
            'email' => 'marinajoao@email.com',
            'password' => '123456',
            'userType' => '2'
        ]));

        $userService = new UserService($UserRepositoryMock);
        $createUser = $userService->createUser($userData);

        $this->assertEquals(
            $createUser,
            'não foi possível criar o usuário'
        );
    }

    public function testCannotCreateUserWithoutPassword()
    {
        $UserRepositoryMock = $this->mock(UserRepositoryInterface::class);
        $UserRepositoryMock->shouldReceive('create')->andReturn(false);

        $userData = json_decode(json_encode([
            'fullName' => 'Maria João',
            'cpf' => '000.000.000-00',
            'email' => 'marinajoao@email.com',
            'password' => '',
            'userType' => '2'
        ]));

        $userService = new UserService($UserRepositoryMock);
        $createUser = $userService->createUser($userData);

        $this->assertEquals(
            $createUser,
            'não foi possível criar o usuário'
        );
    }

    public function testCannotCreateUserWithoutCpf()
    {
        $UserRepositoryMock = $this->mock(UserRepositoryInterface::class);
        $UserRepositoryMock->shouldReceive('create')->andReturn(false);

        $userData = json_decode(json_encode([
            'fullName' => 'Maria João',
            'cpf' => '',
            'email' => 'marinajoao@email.com',
            'password' => '123456',
            'userType' => '2'
        ]));

        $userService = new UserService($UserRepositoryMock);
        $createUser = $userService->createUser($userData);

        $this->assertEquals(
            $createUser,
            'não foi possível criar o usuário'
        );
    }

    public function testCannotCreateUserWithoutUserType()
    {
        $UserRepositoryMock = $this->mock(UserRepositoryInterface::class);
        $UserRepositoryMock->shouldReceive('create')->andReturn(false);

        $userData = json_decode(json_encode([
            'fullName' => 'Maria João',
            'cpf' => '000.000.000-00',
            'email' => 'marinajoao@email.com',
            'password' => '123456',
            'userType' => ''
        ]));

        $userService = new UserService($UserRepositoryMock);
        $createUser = $userService->createUser($userData);

        $this->assertEquals(
            $createUser,
            'não foi possível criar o usuário'
        );
    }

    public function testCanCreateUserWithAllRightInformation()
    {
        $UserRepositoryMock = $this->mock(UserRepositoryInterface::class);
        $UserRepositoryMock->shouldReceive('create')->andReturn(true);

        $userData = json_decode(json_encode([
            'fullName' => 'Maria João',
            'cpf' => '000.000.000-00',
            'email' => 'marinajoao@email.com',
            'password' => '123456',
            'userType' => '2'
        ]));

        $userService = new UserService($UserRepositoryMock);
        $createUser = $userService->createUser($userData);

        $this->assertEquals(
            $createUser,
            'usuário criado com sucesso'
        );
    }

    // public function testCannotLoginInWithoutEmail()
    // {
    // }

    // public function testCannotLoginInWithoutPassword()
    // {
    // }

    // public function testCannotLoginWithInvalidCredentials()
    // {
    // }

    // public function testCanLogInWithValidCredentials()
    // {
    // }

    public function testCannotVerifyIfUserIsValidWithouEmail()
    {
        $UserRepositoryMock = $this->mock(UserRepositoryInterface::class);
        $UserRepositoryMock->shouldReceive('checkIfUserExist')->andReturn(false);

        $userData = json_decode(json_encode([
            'email' => '',
        ]));

        $userService = new UserService($UserRepositoryMock);
        $checkIfUserExist = $userService->checkIfUserExist($userData);

        $this->assertEquals(
            $checkIfUserExist,
            false
        );
    }

    public function testCanVerifyIfUserIsValidWithEmail()
    {
        $UserRepositoryMock = $this->mock(UserRepositoryInterface::class);
        $UserRepositoryMock->shouldReceive('checkIfUserExist')->andReturn(true);

        $userData = json_decode(json_encode([
            'email' => 'marinajoao@email.com',
        ]));

        $userService = new UserService($UserRepositoryMock);
        $checkIfUserExist = $userService->checkIfUserExist($userData);

        $this->assertEquals(
            $checkIfUserExist,
            true
        );
    }
}
