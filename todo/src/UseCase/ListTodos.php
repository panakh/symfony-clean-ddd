<?php

namespace App\UseCase;

use App\UseCase\Ports\ListTodosInteractorInterface;
use App\UseCase\Ports\ListTodosOutputPortInterface;
use Hash\Domain\Todo\User\UserService;

class ListTodos
{
    private UserService $userService;
    private ListTodosOutputPortInterface $outputPort;

    public function __construct(UserService $userService, ListTodosOutputPortInterface $outputPort)
    {
        $this->userService = $userService;
        $this->outputPort = $outputPort;
    }

    public function execute(string $username): void
    {
        $user = $this->userService->getUser($username);
        $this->outputPort->writeTodos($user->getTodos());
    }
}