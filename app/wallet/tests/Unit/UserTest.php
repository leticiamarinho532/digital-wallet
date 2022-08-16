<?php

namespace Tests\Unit;

use Tests\TestCase;

use App\Services\UserService;
use App\Repositories\UserRepository;
use App\Repositories\Interface\UserRepositoryInterface;

class UserTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_example()
    {
        $this->assertTrue(true);
    }

    # TESTS TO DO
    #   create user
    #       - criar usuario sem email
    #       - criar usuario sem nome completo
    #       - criar usuario sem senha
    #       - criar usuario sem cpf
    #
    #       - criar usuario com email duplicado
    #       - criar usuario com cpf duplicado
    #
    #       - criar usuario com sucesso
    #   login
    #       - login com usuario invalido
    #       - login com usuario valido

    public function testCannotCreateUserWithoutEmail()
    {
        $UserRepositoryMock = $this->mock(UserRepositoryInterface::class);
        $UserRepositoryMock->shouldReceive('createUser')->andReturn(false);

        $userData = [
            'fullName' => 'Maria João',
            'cpf' => '000.000.000-00',
            'email' => '',
            'password' => '123456',
            'userType' => '2'
        ];

        $userService = new UserService($UserRepositoryMock);
        $userService->createUser($userData);

        $this->assertEquals(
            $userService,
            false
        );
    }

    public function testCannotCreateUserWithoutFullName()
    {
        $UserRepositoryMock = $this->mock(UserRepositoryInterface::class);
        $UserRepositoryMock->shouldReceive('createUser')->andReturn(false);

        $userData = [
            'fullName' => '',
            'cpf' => '000.000.000-00',
            'email' => 'marinajoao@email.com',
            'password' => '123456',
            'userType' => '2'
        ];

        $userService = new UserService($UserRepositoryMock);
        $userService->createUser($userData);

        $this->assertEquals(
            $userService,
            false
        );
    }

    public function testCannotCreateUserWithoutPassword()
    {
        $UserRepositoryMock = $this->mock(UserRepositoryInterface::class);
        $UserRepositoryMock->shouldReceive('createUser')->andReturn(false);

        $userData = [
            'fullName' => 'Maria João',
            'cpf' => '000.000.000-00',
            'email' => 'marinajoao@email.com',
            'password' => '',
            'userType' => '2'
        ];

        $userService = new UserService($UserRepositoryMock);
        $userService->createUser($userData);

        $this->assertEquals(
            $userService,
            false
        );
    }

    public function testCannotCreateUserWithoutCpf()
    {
        $UserRepositoryMock = $this->mock(UserRepositoryInterface::class);
        $UserRepositoryMock->shouldReceive('createUser')->andReturn(false);

        $userData = [
            'fullName' => 'Maria João',
            'cpf' => '',
            'email' => 'marinajoao@email.com',
            'password' => '123456',
            'userType' => '2'
        ];

        $userService = new UserService($UserRepositoryMock);
        $userService->createUser($userData);

        $this->assertEquals(
            $userService,
            false
        );
    }

    public function testCannotCreateUserWithoutUserType()
    {
        $UserRepositoryMock = $this->mock(UserRepositoryInterface::class);
        $UserRepositoryMock->shouldReceive('createUser')->andReturn(false);

        $userData = [
            'fullName' => 'Maria João',
            'cpf' => '',
            'email' => 'marinajoao@email.com',
            'password' => '123456',
            'userType' => ''
        ];

        $userService = new UserService($UserRepositoryMock);
        $userService->createUser($userData);

        $this->assertEquals(
            $userService,
            false
        );
    }
}
