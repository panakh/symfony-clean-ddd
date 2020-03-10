<?php

namespace App\Controller;

use App\Entity\Todo;
use App\Form\TodoType;
use App\Presenter\ListTodosPresenterInterface;
use App\Presenter\NewTodoPresenterInterface;
use App\Presenter\TodoEditPresenterInterface;
use App\Presenter\TodoPresenterInterface;
use App\UseCase\AddTodoInteractorInterface;
use App\UseCase\DeleteTodoInteractorInterface;
use App\UseCase\ListTodosInteractorInterface;
use App\UseCase\ShowTodoInteractorInterface;
use App\UseCase\UpdateTodoInteractorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/todo")
 */
class TodoController extends AbstractController
{
    /**
     * @Route("/", name="todo_index", methods={"GET"})
     * @param ListTodosInteractorInterface $usecase
     * @param ListTodosPresenterInterface $presenter
     * @return Response
     */
    public function index(
        ListTodosInteractorInterface $usecase,
        ListTodosPresenterInterface $presenter
    ): Response {
        $usecase->execute('hashin');
        return $presenter->getResponse();
    }

    /**
     * @Route("/new", name="todo_new", methods={"GET","POST"})
     * @param Request $request
     * @param AddTodoInteractorInterface $addTodo
     * @param NewTodoPresenterInterface $presenter
     * @return Response
     */
    public function new(
        Request $request,
        AddTodoInteractorInterface $addTodo,
        NewTodoPresenterInterface $presenter
    ): Response {
        $todo = new Todo();
        $form = $this->createForm(TodoType::class, $todo);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $addTodo->execute($todo->getUser()->getUsername(), $todo->getDescription());
            return $this->redirectToRoute('todo_index');
        }

        return $presenter->getRepsonse($todo, $form);
    }

    /**
     * @Route("/{id}", name="todo_show", methods={"GET"})
     * @param Todo $todo
     * @param ShowTodoInteractorInterface $usecase
     * @param TodoPresenterInterface $presenter
     * @return Response
     */
    public function show(
        Todo $todo,
        ShowTodoInteractorInterface $usecase,
        TodoPresenterInterface $presenter
    ): Response {
        $usecase->execute('hashin', $todo->getId());
        return $presenter->getResponse();
    }

    /**
     * @Route("/{id}/edit", name="todo_edit", methods={"GET","POST"})
     * @param Request $request
     * @param Todo $todo
     * @param UpdateTodoInteractorInterface $usecase
     * @param TodoEditPresenterInterface $presenter
     * @return Response
     */
    public function edit(
        Request $request,
        Todo $todo,
        UpdateTodoInteractorInterface $usecase,
        TodoEditPresenterInterface $presenter
    ): Response {

        $form = $this->createForm(TodoType::class, $todo);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $usecase->execute('hashin', $todo->getId(), $todo->getDescription());

            return $this->redirectToRoute('todo_index');
        }

        return $presenter->getResponse($todo, $form);
    }

    /**
     * @Route("/{id}", name="todo_delete", methods={"DELETE"})
     * @param Request $request
     * @param Todo $todo
     * @param DeleteTodoInteractorInterface $deleteTodo
     * @return Response
     */
    public function delete(Request $request, Todo $todo, DeleteTodoInteractorInterface $deleteTodo): Response
    {
        if ($this->isCsrfTokenValid('delete'.$todo->getId(), $request->request->get('_token'))) {
            $deleteTodo->execute('hashin', $todo->getId());
        }

        return $this->redirectToRoute('todo_index');
    }
}
