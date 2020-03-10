<?php

namespace App\UseCase;

use App\UseCase\Ports\UpdateTodoInteractorInterface;
use Hash\Domain\Todo\User\UserService;

class UpdateTodo
{
    private UserService $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function execute(string $username, int $todoId, string $description): void
    {
        $user = $this->userService->getUser($username);
        $user->updateTodo($todoId, ['description' => $description]);
        $this->userService->saveUser($user);
    }
}