<?php

namespace App\UseCase;

use Hash\Domain\Todo\User\User;
use Hash\Domain\Todo\User\UserService;
use Mockery;
use PHPUnit\Framework\TestCase;

class UpdateTodoTest extends TestCase
{
    use Mockery\Adapter\Phpunit\MockeryPHPUnitIntegration;

    private $username = 'hashin';
    private UpdateTodo $usecase;
    private $userService;
    private $updateableTodoId = 1;
    private User $user;
    private string $updateableTodoDescription = 'buy milk';

    public function setUp(): void
    {
        $this->userService = Mockery::mock(UserService::class);
        $this->user = Mockery::mock(User::class);
        $this->usecase = new UpdateTodo($this->userService);
    }

    public function testUpdatesATodo()
    {
        $this->userService->expects()->getUser($this->username)->andReturn($this->user);
        $this->user->expects()->updateTodo($this->updateableTodoId, ['description' => $this->updateableTodoDescription]);
        $this->userService->expects()->saveUser($this->user);
        $this->usecase->execute($this->username, $this->updateableTodoId, $this->updateableTodoDescription);
    }
}