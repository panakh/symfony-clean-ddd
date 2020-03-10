<?php

namespace Hash\Domain\Todo\User;

class Todo
{
    private const DESCRIPTION = 'description';
    private string $description;
    private ?int $id;

    public function __construct(?int $id, string $description)
    {
        $this->description = $description;
        $this->id = $id;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function hasDescription(string $description): bool
    {
        return $this->description === $description;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function updateFromArrayValues(array $values): void
    {
        if (isset($values[static::DESCRIPTION])) {
            $this->description = $values[static::DESCRIPTION];
        }
    }
}