<?php


namespace App\Presenter;


use App\Entity\Todo;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpFoundation\Response;

interface TodoEditPresenterInterface
{
    public function getResponse(Todo $todo, FormInterface $form): Response;
}