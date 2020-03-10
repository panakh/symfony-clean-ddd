<?php

namespace Hash\Domain\Todo\User;

use Hash\Domain\Todo\User\User;
use PhpSpec\ObjectBehavior;

/**
 * @mixin User
 */
class UserSpec extends ObjectBehavior
{
    function let()
    {
        $this->beConstructedWith('hashin');
    }

    function it_has_username()
    {
        $this->shouldHaveUsername('hashin');
        $this->shouldNotHaveUsername('something else');
    }

    function it_is_initializable()
    {
        $this->shouldHaveType(User::class);
    }

    function it_adds_todo()
    {
        $this->addTodo(null, 'buy milk');
        $this->shouldHaveTodoWithDescription('buy milk');
    }

    function it_adds_todo_with_an_id()
    {
        $this->addTodo(100, 'buy milk');
        $this->shouldHaveTodoWithId(100);
        $this->shouldNotHaveTodoWithId(1000);
    }
}
