<?php

namespace App\Presenter;

use App\UseCase\ListTodosOutputPortInterface;
use App\ViewModel\TodoListViewModel;
use Symfony\Component\HttpFoundation\Response;
use Twig\Environment;

class ListTodosPresenter implements ListTodosOutputPortInterface, ListTodosPresenterInterface
{
    private TodoListViewModel $viewModel;
    private Environment $twig;

    public function __construct(Environment $twig)
    {
        $this->twig = $twig;
    }

    public function writeTodos(array $todos): void
    {
        $this->viewModel = new TodoListViewModel($todos);
    }

    public function getResponse(): Response
    {
        return new Response(
            $this->twig->render('todo/index.html.twig', [
                'todos' => $this->viewModel->getPersistenceModel(),
            ])
        );
    }
}