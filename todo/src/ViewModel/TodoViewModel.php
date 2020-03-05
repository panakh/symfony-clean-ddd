<?php

namespace App\ViewModel;

use App\Entity\Todo;
use InvalidArgumentException;

class TodoViewModel
{
    private Todo $todo;

    public function __construct(Todo $todo)
    {
        $this->todo = $todo;
        if (null === $todo->getUser()) {
            throw new InvalidArgumentException('user can not be null');
        }
    }

    public function getDescription(): ?string
    {
        return $this->todo->getDescription();
    }

    public function getUsername(): ?string
    {
        return $this->todo->getUser()->getUsername();
    }
}