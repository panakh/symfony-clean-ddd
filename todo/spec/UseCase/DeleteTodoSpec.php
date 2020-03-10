<?php

namespace App\UseCase;

use Hash\Domain\Todo\User\User;
use Hash\Domain\Todo\User\UserService;
use PhpSpec\ObjectBehavior;

/**
 * @mixin DeleteTodo
 */
class DeleteTodoSpec extends ObjectBehavior
{
    function let(UserService $userService)
    {
        $this->beConstructedWith($userService);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType(DeleteTodo::class);
    }

    function it_deletes(UserService $userService, User $hashin)
    {
        $username = 'hashin';
        $todoId = 1;
        $userService->getUser($username)->willReturn($hashin);
        $hashin->deleteTodo($todoId)->shouldBeCalled();
        $userService->saveUser($hashin)->shouldBeCalled();
        $this->execute($username, $todoId);
    }
}
