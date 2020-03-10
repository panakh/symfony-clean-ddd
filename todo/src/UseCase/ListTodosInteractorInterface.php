<?php

namespace App\UseCase;

interface ListTodosInteractorInterface
{
    public function execute(string $username): void;
}