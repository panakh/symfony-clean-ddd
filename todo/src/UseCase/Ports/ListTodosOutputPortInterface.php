<?php

namespace App\UseCase\Ports;

interface ListTodosOutputPortInterface
{
    public function writeTodos(array $todos): void;
}