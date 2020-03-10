<?php

namespace App\UseCase;

use App\UseCase\Ports\AddTodoInteractorInterface;
use Hash\Domain\Todo\User\UserService;

class AddTodo
{
    private UserService $service;

    public function __construct(UserService $service)
    {
        $this->service = $service;
    }

    public function execute(string $username, string $description): void
    {
        $user = $this->service->getUser($username);
        $user->addTodo(null, $description);
        $this->service->saveUser($user);
    }
}