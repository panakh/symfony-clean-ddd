<?php

namespace App\UseCase;

use App\ViewModel\TodoListViewModel;
use Hash\User\UserService;

class ListTodos
{
    private UserService $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function execute(TodoListViewModel $viewModel)
    {
        $user = $this->userService->getUser($viewModel->getUsername());
        $viewModel->readTodosFromUserAggregate($user);
    }
}