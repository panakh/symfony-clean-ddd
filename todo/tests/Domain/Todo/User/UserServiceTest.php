<?php


namespace Hash\Domain\Todo\User;

use Hash\Domain\Todo\Ports\UserRepositoryInterface;
use PHPUnit\Framework\TestCase;

class UserServiceTest extends TestCase
{
    private UserRepositoryInterface $repository;
    private UserService $service;

    public function setUp(): void
    {
        $this->repository = $this->createMock(UserRepositoryInterface::class);
        $this->service = new UserService($this->repository);
    }

    public function testCanGetUser()
    {
        $user = new User('hashin');

        $this->repository
            ->expects($this->once())
            ->method('findByUsername')
            ->with($this->equalTo('hashin'))
            ->willReturn($user);

        $this->assertSame($user, $this->service->getUser('hashin'));
    }

    public function testSavesUser()
    {
        $user = new User('hashin');
        $this->repository
            ->expects($this->once())
            ->method('saveUser')
            ->with($this->equalTo($user));
        $this->service->saveUser($user);
    }
}