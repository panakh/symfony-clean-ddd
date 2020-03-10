<?php

namespace App\UseCase;

interface UpdateTodoInteractorInterface
{
    public function execute(string $username, int $todoId, string $description): void;
}