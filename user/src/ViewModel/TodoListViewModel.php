<?php

namespace App\ViewModel;

use App\Entity\Todo;

class TodoListViewModel
{
    private array $todos = [];
    /**
     * @var string
     */
    private string $username;

    public function __construct(string $username)
    {
        $this->username = $username;
    }

    public function getTodos(): array
    {
        return $this->todos;
    }

    public function getUsername(): string
    {
        return $this->username;
    }

    public function readTodosFromUserAggregate(\Hash\User\User $user)
    {
        foreach ($user->getTodos() as $todo) {
            $this->addTodo($todo['id'], $todo['description']);
        }
    }

    private function addTodo(int $id, string $description): void
    {
        $this->todos[] = (new Todo())->setDescription($description)->setId($id);
    }
}