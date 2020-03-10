<?php

namespace App\UseCase;

use App\UseCase\Ports\DeleteTodoInteractorInterface;
use Hash\Domain\Todo\User\UserService;

class DeleteTodo
{
    private UserService $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function execute(string $username, int $todoId): void
    {
        $user = $this->userService->getUser($username);
        $user->deleteTodo($todoId);
        $this->userService->saveUser($user);
    }
}