<?php

namespace Hash\Domain\Todo\User;

use PHPUnit\Framework\TestCase;

class TodoTest extends TestCase
{
    public function testCreateTodo()
    {
        $todo = new Todo(null, 'buy milk');
        $this->assertTrue($todo->hasDescription('buy milk'));
        $this->assertFalse($todo->hasDescription('something else'));
    }
}