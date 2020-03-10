<?php

namespace App\UseCase;

interface ListTodosOutputPortInterface
{
    public function writeTodos(array $todos): void;
}