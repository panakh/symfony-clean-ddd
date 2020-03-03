<?php

namespace Hash\User;

class User
{
    private array $todos = [];
    private string $username;

    public function __construct(string $username)
    {
        $this->username = $username;
    }

    public function addTodo(?int $id, string $description)
    {
        $this->todos[] = new Todo($id, $description);
    }

    public function hasTodoWithDescription(string $description): bool
    {
        foreach ($this->todos as $todo) {
            if ($todo->hasDescription($description)) {
                return true;
            }
        }

        return false;
    }

    public function isTodoCount(int $count): bool
    {
        return count($this->todos) === $count;
    }

    public function removeTodoWithDescription(string $description): void
    {
        $found = false;
        foreach ($this->todos as $todo) {
            if ($todo->hasDescription($description)) {
                $found = true;
            }
        }

        if (false === $found) {
            throw new TodoNotFoundException('Todo not found');
        }

        $newTodos = [];
        foreach ($this->todos as $todo) {
            if ($todo->hasDescription($description)) {
                continue;
            }
            $newTodos[] = $todo;
        }

        $this->todos = $newTodos;
    }

    public function hasUsername(string $username)
    {
        return $this->username === $username;
    }

    public function getUsername(): string
    {
        return (string) $this->username;
    }

    public function getTodos(): array
    {
        $todos = [];

        foreach ($this->todos as $todo) {
            $todos[] = [
                'id' => $todo->getId(),
                'description' => $todo->getDescription()
            ];
        }

        return $todos;
    }
}