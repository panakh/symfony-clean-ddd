<?php

namespace App\UseCase;

use App\ViewModel\TodoListViewModel;
use App\ViewModel\TodoViewModel;
use Hash\User\User;
use Hash\User\UserService;
use Mockery;
use Mockery\Adapter\Phpunit\MockeryPHPUnitIntegration;
use PHPUnit\Framework\TestCase;

class AddTodoTest extends TestCase
{
    use MockeryPHPUnitIntegration;

    private UserService $userService;
    private AddTodo $useCase;

    public function setUp(): void
    {
        $this->userService = Mockery::mock(UserService::class);
        $this->useCase = new AddTodo($this->userService);
    }

    public function testAddUseCase()
    {
        $viewModel = Mockery::mock(TodoViewModel::class);
        $user = Mockery::mock(User::class);
        $viewModel->expects()->getUsername()->andReturn('hashin');
        $this->userService->expects()->getUser('hashin')->andReturn($user);
        $viewModel->expects()->getDescription()->andReturn('buy milk');
        $user->expects()->addTodo(null, 'buy milk');
        $this->userService->expects()->saveUser($user);
        $this->useCase->execute($viewModel);
    }
}