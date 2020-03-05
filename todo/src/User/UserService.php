<?php

namespace Hash\User;

class UserService
{
    private UserRepositoryInterface $repository;

    public function __construct(UserRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    public function getUser(string $username): User
    {
        return $this->repository->findByUsername($username);
    }

    public function saveUser(User $user): void
    {
        $this->repository->saveUser($user);
    }
}