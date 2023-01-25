<?php

namespace App\Http\Controllers;

use App\Interfaces\TodoRepositoryInterface;

class TodoController extends Controller
{
    private TodoRepositoryInterface $todoRepository;

    public function __construct(TodoRepositoryInterface $todoRepository)
    {
        $this->todoRepository = $todoRepository;
    }

    /**
     * Get all todos.
     *
     */
    public function index()
    {
        return view('todo.index', ['todos' => $this->todoRepository->get()]);
    }
}
