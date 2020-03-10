<?php

namespace App\UseCase;

interface DeleteTodoInteractorInterface
{
    public function execute(string $username, int $todoId): void;
}