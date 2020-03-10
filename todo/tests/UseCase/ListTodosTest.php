<?php

namespace App\UseCase;

use App\Entity\Todo;
use App\ViewModel\TodoListViewModel;
use Hash\Domain\Todo\User\User;
use Hash\Domain\Todo\User\UserService;
use Mockery;
use Mockery\Adapter\Phpunit\MockeryPHPUnitIntegration;
use PHPUnit\Framework\TestCase;

class ListTodosTest extends TestCase
{
    use MockeryPHPUnitIntegration;

    private ListTodos $usecase;
    private UserService $userService;
    private ListTodosOutputPortInterface $outputPort;
    private string $username = 'hashin';
    private User $user;
    private array $todos = [
        [
            'id' => 1,
            'description' => 'buy milk',
        ]
    ];


    public function setUp(): void
    {
        $this->userService = Mockery::mock(UserService::class);
        $this->outputPort = Mockery::mock(ListTodosOutputPortInterface::class);
        $this->usecase = new ListTodos($this->userService, $this->outputPort);
        $this->user = Mockery::mock(User::class);
    }

    public function testAddUseCase()
    {
        $this->userService->expects()->getUser($this->username)->andReturn($this->user);
        $this->user->expects()->getTodos()->andReturn($this->todos);
        $this->outputPort->expects()->writeTodos($this->todos);
        $this->usecase->execute($this->username);
    }
}