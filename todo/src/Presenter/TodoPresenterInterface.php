<?php


namespace App\Presenter;

use Symfony\Component\HttpFoundation\Response;

interface TodoPresenterInterface
{
    public function getResponse(): Response;
}