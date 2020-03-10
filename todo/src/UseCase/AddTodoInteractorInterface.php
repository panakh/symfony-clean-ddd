<?php

namespace App\UseCase;

interface AddTodoInteractorInterface
{
    public function execute(string $username, string $description): void;
}