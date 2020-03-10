<?php


namespace App\UseCase\Ports;

interface ShowTodoOutputPortInterface
{
    public function writeTodoAsArray(array $values): void;
}