<?php

namespace App\UseCase;

use Hash\Domain\Todo\User\UserService;

class ShowTodo implements ShowTodoInteractorInterface
{
    private UserService $userService;
    private ShowTodoOutputPortInterface $output;

    public function __construct(UserService $userService, ShowTodoOutputPortInterface $output)
    {
        $this->userService = $userService;
        $this->output = $output;
    }

    public function execute(string $username, int $todoId): void
    {
        $user = $this->userService->getUser($username);
        $this->output->writeTodoAsArray($user->getTodo($todoId));
    }
}