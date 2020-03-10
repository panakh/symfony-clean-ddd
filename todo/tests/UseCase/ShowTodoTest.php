<?php


namespace App\UseCase;


use App\UseCase\Ports\ShowTodoOutputPortInterface;
use Hash\Domain\Todo\User\User;
use Hash\Domain\Todo\User\UserService;
use Mockery;
use Mockery\Adapter\Phpunit\MockeryPHPUnitIntegration;
use PHPUnit\Framework\TestCase;

class ShowTodoTest extends TestCase
{
    use MockeryPHPUnitIntegration;

    private ShowTodo $usecase;
    private UserService $userService;
    private ShowTodoOutputPortInterface $outputPort;
    private string $username = 'hashin';
    private int $todoId = 1;
    private array $todoArrayValues;

    public function setUp(): void
    {
        $this->userService = Mockery::mock(UserService::class);
        $this->outputPort = Mockery::mock(ShowTodoOutputPortInterface::class);
        $this->usecase = new ShowTodo($this->userService, $this->outputPort);
        $this->todoArrayValues = [
            'id' => $this->todoId,
            'description' => 'buy milk',
        ];
    }

    public function testShowsTodo()
    {
        $hashin = Mockery::mock(User::class);
        $this->userService->expects()->getUser('hashin')->andReturn($hashin);
        $hashin->expects()->getTodo($this->todoId)->andReturn($this->todoArrayValues);
        $this->outputPort->expects()->writeTodoAsArray($this->todoArrayValues);
        $this->usecase->execute($this->username, $this->todoId);
    }
}