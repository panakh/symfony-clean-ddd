<?php

namespace App\Presenter;

use App\Entity\Todo;
use App\UseCase\ShowTodoOutputPortInterface;
use Twig\Environment;
use Symfony\Component\HttpFoundation\Response;

class TodoPresenter implements ShowTodoOutputPortInterface, TodoPresenterInterface
{
    /**
     * @var Environment
     */
    private Environment $twig;
    private Todo $todo;

    public function __construct(Environment $twig)
    {
        $this->twig = $twig;
    }

    public function writeTodoAsArray(array $values): void
    {
        $this->todo = new Todo();
        $this->todo
            ->setId($values['id'] ?? null)
            ->setDescription($values['description'] ?? null);
    }

    public function getResponse(): Response
    {
        return new Response($this->twig->render('todo/show.html.twig', [
            'todo' => $this->todo,
        ]));
    }
}