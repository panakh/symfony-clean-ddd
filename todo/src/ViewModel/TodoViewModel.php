<?php

namespace App\ViewModel;

use App\Entity\Todo;
use InvalidArgumentException;

class TodoViewModel
{
    private Todo $todo;
    private $inputTodoId;

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

    public function getId()
    {
        return $this->todo->getId();
    }

    public function setId($id)
    {
        $this->todo->setId($id);
    }

    public function setTodoFromArrayValues(array $todoValues)
    {
        $this->todo->setId($todoValues['id']);
        $this->todo->setDescription($todoValues['description']);
    }
}