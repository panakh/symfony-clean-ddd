<?php

namespace App\Controller;

use App\Entity\Todo;
use App\Form\TodoType;
use App\Presenter\ListTodosPresenter;
use App\Presenter\NewTodoPresenter;
use App\Presenter\TodoEditPresenter;
use App\Presenter\TodoEditPresenterInterface;
use App\Presenter\TodoPresenter;
use App\Presenter\TodoPresenterInterface;
use App\UseCase\AddTodo;
use App\UseCase\DeleteTodo;
use App\UseCase\ListTodos;
use App\UseCase\Ports\DeleteTodoInteractorInterface;
use App\UseCase\Ports\ShowTodoInteractorInterface;
use App\UseCase\Ports\UpdateTodoInteractorInterface;
use App\UseCase\ShowTodo;
use App\UseCase\UpdateTodo;
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
     * @param ListTodos $usecase
     * @param ListTodosPresenter $presenter
     * @return Response
     */
    public function index(
        ListTodos $usecase,
        ListTodosPresenter $presenter
    ): Response {
        $usecase->execute('hashin');
        return $presenter->getResponse();
    }

    /**
     * @Route("/new", name="todo_new", methods={"GET","POST"})
     * @param Request $request
     * @param AddTodo $addTodo
     * @param NewTodoPresenter $presenter
     * @return Response
     */
    public function new(
        Request $request,
        AddTodo $addTodo,
        NewTodoPresenter $presenter
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
     * @param ShowTodo $usecase
     * @param TodoPresenter $presenter
     * @return Response
     */
    public function show(
        Todo $todo,
        ShowTodo $usecase,
        TodoPresenter $presenter
    ): Response {
        $usecase->execute('hashin', $todo->getId());
        return $presenter->getResponse();
    }

    /**
     * @Route("/{id}/edit", name="todo_edit", methods={"GET","POST"})
     * @param Request $request
     * @param Todo $todo
     * @param UpdateTodo $usecase
     * @param TodoEditPresenter $presenter
     * @return Response
     */
    public function edit(
        Request $request,
        Todo $todo,
        UpdateTodo $usecase,
        TodoEditPresenter $presenter
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
     * @param DeleteTodo $deleteTodo
     * @return Response
     */
    public function delete(Request $request, Todo $todo, DeleteTodo $deleteTodo): Response
    {
        if ($this->isCsrfTokenValid('delete'.$todo->getId(), $request->request->get('_token'))) {
            $deleteTodo->execute('hashin', $todo->getId());
        }

        return $this->redirectToRoute('todo_index');
    }
}
