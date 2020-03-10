<?php

namespace Hash\Domain\Todo\User;

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

    public function testGetTodo()
    {
        $description = 'buy milk';
        $this->user->addTodo(1, $description);
        //todo cast
        $todo = $this->user->getTodo(1);
        $this->assertEquals(1, $todo['id']);
        $this->assertEquals($description, $todo['description']);
    }

    public function testUpdatesTodo()
    {
        $todoId = 1;
        $this->user->addTodo($todoId, 'buy milk');
        $description = 'buy semi skimmed milk';
        $this->user->updateTodo($todoId, ['description' => $description]);
        $todo = $this->user->getTodo($todoId);
        $this->assertEquals($todoId, $todo['id']);
        $this->assertEquals( $description, $todo['description']);
    }

    public function testDeletesTodo()
    {
        $this->user->addTodo(1, 'buy milk');
        $this->user->deleteTodo(1);
        $this->assertFalse($this->user->hasTodoWithDescription('buy milk'));
    }
}