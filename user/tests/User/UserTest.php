<?php

namespace Hash\User;

use PHPUnit\Framework\TestCase;

class UserTest extends TestCase
{
    private User $user;

    public function setUp(): void
    {
        $this->user = new User('hashin');
    }

    public function testUserMustHaveUsername()
    {
        $user = $this->user;
        $this->assertTrue($user->hasUsername('hashin'));
        $this->assertFalse($user->hasUsername('john'));
    }

    public function testCanAddToDo()
    {
        $user = $this->user;
        $user->addTodo(null, 'buy milk');
        $this->assertTrue($user->hasTodoWithDescription('buy milk'));
        $this->assertFalse($user->hasTodoWithDescription('something else'));
        $this->assertTrue($user->isTodoCount(1));
    }

    public function testRemovesTodo()
    {
        $user = $this->user;
        $user->addTodo(null, 'new todo');
        $user->addTodo(null, 'buy milk');
        $this->assertTrue($user->hasTodoWithDescription('new todo'));
        $this->assertTrue($user->isTodoCount(2));
        $user->removeTodoWithDescription('buy milk');
        $this->assertTrue($user->isTodoCount(1));
        $this->assertFalse($user->hasTodoWithDescription('buy milk'));
    }

    public function testCannotRemoveTodo()
    {
        $user = $this->user;
        $this->expectException(TodoNotFoundException::class);
        $this->expectExceptionMessage('Todo not found');
        $user->removeTodoWithDescription('something');
    }
}