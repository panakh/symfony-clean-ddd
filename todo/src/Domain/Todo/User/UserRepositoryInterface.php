<?php

namespace Hash\Domain\Todo\User;

interface UserRepositoryInterface
{
    public function findByUsername(string $username): User;

    public function saveUser(User $userAggregate): void;
}