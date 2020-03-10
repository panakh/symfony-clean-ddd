<?php

namespace App\Presenter;

use App\Entity\Todo;
use App\UseCase\ListTodosOutputPortInterface;
use Symfony\Component\HttpFoundation\Response;
use Twig\Environment;

class ListTodosPresenter implements ListTodosOutputPortInterface, ListTodosPresenterInterface
{
    private Environment $twig;
    private array $todos = [];

    public function __construct(Environment $twig)
    {
        $this->twig = $twig;
    }

    public function writeTodos(array $todos): void
    {
        foreach ($todos as $todo) {
            $persisted = new Todo();
            if (isset($todo['id'])) {
                $persisted->setId($todo['id']);
            }

            if (isset($todo['description'])) {
                $persisted->setDescription($todo['description']);
            }

            $this->todos[] = $persisted;
        }
    }

    public function getResponse(): Response
    {
        return new Response(
            $this->twig->render('todo/index.html.twig', [
                'todos' => $this->todos,
            ])
        );
    }
}