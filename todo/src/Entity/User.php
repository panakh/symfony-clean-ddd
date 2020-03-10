<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use RuntimeException;

/**
 * @ORM\Entity(repositoryClass="App\Repository\UserRepository")
 */
class User
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $username;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Todo", mappedBy="user", cascade={"persist"})
     */
    private $todos;

    public function __construct()
    {
        $this->todos = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUsername(): ?string
    {
        return $this->username;
    }

    public function setUsername(string $username): self
    {
        $this->username = $username;

        return $this;
    }

    /**
     * @return Collection|Todo[]
     */
    public function getTodos(): Collection
    {
        return $this->todos;
    }

    public function addTodo(Todo $todo): self
    {
        if (!$this->todos->contains($todo)) {
            $this->todos[] = $todo;
            $todo->setUser($this);
        }

        return $this;
    }

    public function removeTodo(Todo $todo): self
    {
        if ($this->todos->contains($todo)) {
            $this->todos->removeElement($todo);
            // set the owning side to null (unless already changed)
            if ($todo->getUser() === $this) {
                $todo->setUser(null);
            }
        }

        return $this;
    }

    public function __toString()
    {
        return $this->username;
    }

    private function updateTodo(array $find): void
    {
        /** @var Todo $toUpdate */
        $toUpdate = null;
        foreach ($this->todos as $todo) {
            if ($todo->getId() === $find['id']) {
                $toUpdate = $todo;
                break;
            }
        }

        if (null === $toUpdate) {
            throw new RuntimeException('todo not found');
        }

        $toUpdate->setDescription($find['description']);
    }

    public function syncFromDomainModel(\Hash\Domain\Todo\User\User $user)
    {
        foreach ($user->getTodos() as $todo) {
            if (null === $todo['id']) {
                $this->addTodo((new Todo())->setDescription($todo['description']));
                continue;
            }

            $this->updateTodo($todo);
        }
    }
}
