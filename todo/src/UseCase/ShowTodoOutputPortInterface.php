<?php


namespace App\UseCase;

interface ShowTodoOutputPortInterface
{
    public function writeTodoAsArray(array $values): void;
}