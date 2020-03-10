<?php

namespace App\UseCase;

use Hash\Domain\Todo\User\UserService;

class UpdateTodo implements UpdateTodoInteractorInterface
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