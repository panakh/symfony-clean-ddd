<?php

namespace Hash\Domain\Todo\Ports;

use Hash\Domain\Todo\User\User;

interface UserRepositoryInterface
{
    public function findByUsername(string $username): User;

    public function saveUser(User $userAggregate): void;
}