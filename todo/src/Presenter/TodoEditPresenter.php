<?php


namespace App\Presenter;

use App\Entity\Todo;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpFoundation\Response;
use Twig\Environment;

class TodoEditPresenter
{
    private Environment $twig;

    public function __construct(Environment $twig)
    {
        $this->twig = $twig;
    }

    public function getResponse(Todo $todo, FormInterface $form): Response
    {
        return new Response($this->twig->render('todo/edit.html.twig', [
            'todo' => $todo,
            'form' => $form->createView(),
        ]));
    }

}