<?php

namespace Hash\User;

interface UserRepositoryInterface
{
    public function findByUsername(string $username): User;

    public function saveUser(User $user): void;
}