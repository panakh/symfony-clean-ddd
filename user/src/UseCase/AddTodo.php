<?php

namespace App\UseCase;

use App\ViewModel\TodoViewModel;
use Hash\User\UserService;

class AddTodo
{
    private UserService $service;

    public function __construct(UserService $service)
    {
        $this->service = $service;
    }

    public function execute(TodoViewModel $viewModel)
    {
        $user = $this->service->getUser($viewModel->getUsername());
        $user->addTodo(null, $viewModel->getDescription());
        $this->service->saveUser($user);
    }
}