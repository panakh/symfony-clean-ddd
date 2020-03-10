<?php

namespace App\ViewModel;

use App\Entity\Todo;

class TodoListViewModel
{
    private array $persistenceModel = [];

    public function __construct(array $todos)
    {
        foreach ($todos as $todo) {
            $persisted = new Todo();
            if (isset($todo['id'])) {
                $persisted->setId($todo['id']);
            }

            if (isset($todo['description'])) {
                $persisted->setDescription($todo['description']);
            }

            $this->persistenceModel[] = $persisted;
        }
    }

    public function getPersistenceModel(): array
    {
        return $this->persistenceModel;
    }
}