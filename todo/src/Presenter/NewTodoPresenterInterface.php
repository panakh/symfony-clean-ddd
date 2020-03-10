<?php

namespace App\Presenter;

use App\Entity\Todo;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpFoundation\Response;

interface NewTodoPresenterInterface
{
    public function getRepsonse(Todo $todo, FormInterface $form): Response;
}