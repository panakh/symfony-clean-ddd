<?php

namespace App\UseCase;

use App\Entity\Todo;
use App\ViewModel\TodoListViewModel;
use Hash\User\User;
use Hash\User\UserService;
use Mockery;
use Mockery\Adapter\Phpunit\MockeryPHPUnitIntegration;
use PHPUnit\Framework\TestCase;

class ListTodosTest extends TestCase
{
    use MockeryPHPUnitIntegration;

    private ListTodos $usecase;
    private UserService $userService;

    public function setUp(): void
    {
        $this->userService = Mockery::mock(UserService::class);
        $this->usecase = new ListTodos($this->userService);
    }

    public function testAddUseCase()
    {
        $viewModel = Mockery::mock(TodoListViewModel::class);
        $user = Mockery::mock(User::class);
        $username = 'hashin';
        $viewModel->expects()->getUsername()->andReturn($username);
        $this->userService->expects()->getUser($username)->andReturn($user);
        $viewModel->expects()->readTodosFromUserAggregate($user);
        $this->usecase->execute($viewModel);
    }
}