<?php

namespace App\Presenter;

use Symfony\Component\HttpFoundation\Response;

interface ListTodosPresenterInterface
{
    public function getResponse(): Response;
}