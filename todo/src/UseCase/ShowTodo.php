<?php

namespace App\UseCase;

use App\UseCase\Ports\ShowTodoInteractorInterface;
use App\UseCase\Ports\ShowTodoOutputPortInterface;
use Hash\Domain\Todo\User\UserService;

class ShowTodo
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