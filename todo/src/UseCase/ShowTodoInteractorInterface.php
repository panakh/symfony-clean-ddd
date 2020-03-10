<?php


namespace App\UseCase;


interface ShowTodoInteractorInterface
{
    public function execute(string $username, int $todoId): void;
}