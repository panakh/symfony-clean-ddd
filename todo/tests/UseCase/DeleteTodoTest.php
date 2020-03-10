<?php

namespace App\UseCase;

use Hash\Domain\Todo\User\User;
use Hash\Domain\Todo\User\UserService;
use Mockery;
use PHPUnit\Framework\TestCase;

class DeleteTodoTest extends TestCase
{
    use Mockery\Adapter\Phpunit\MockeryPHPUnitIntegration;

    private DeleteTodo $usecase;
    private int $deletableTodoId = 1;
    private UserService $userService;
    private string $username = 'hashin';
    private User $user;

    public function setUp(): void
    {
        $this->userService = Mockery::mock(UserService::class);
        $this->usecase = new DeleteTodo($this->userService);
        $this->user = Mockery::mock(User::class);
    }

    public function testDeletesTodo()
    {
        $this->userService->expects()->getUser($this->username)->andReturn($this->user);
        $this->user->expects()->deleteTodo($this->deletableTodoId);
        $this->userService->expects()->saveUser($this->user);
        $this->usecase->execute($this->username, $this->deletableTodoId);
    }
}