<?php

namespace App\UseCase;

use Hash\Domain\Todo\User\User;

interface AddTodoOutputPortInterface
{
    public function writeUser(User $user): void;
}