<?php

namespace App\UseCase;

use App\UseCase\Ports\AddTodoOutputPortInterface;
use Hash\Domain\Todo\User\User;
use Hash\Domain\Todo\User\UserService;
use Mockery;
use Mockery\Adapter\Phpunit\MockeryPHPUnitIntegration;
use PHPUnit\Framework\TestCase;

class AddTodoTest extends TestCase
{
    use MockeryPHPUnitIntegration;

    private UserService $userService;
    private AddTodo $useCase;
    private AddTodoOutputPortInterface $outputPort;
    private string $username = 'hashin';
    private User $user;
    private string $description = 'buy milk';

    public function setUp(): void
    {
        $this->userService = Mockery::mock(UserService::class);
        $this->useCase = new AddTodo($this->userService);
        $this->user = Mockery::mock(User::class);
    }

    public function testAddUseCase()
    {
        $this->userService->expects()->getUser($this->username)->andReturn($this->user);
        $this->user->expects()->addTodo(null, 'buy milk');
        $this->userService->expects()->saveUser($this->user);
        $this->useCase->execute($this->username, $this->description);
    }
}