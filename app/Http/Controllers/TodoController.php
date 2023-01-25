<?php

namespace App\Http\Controllers;

use App\Http\Requests\TodoRequest;
use App\Interfaces\TodoRepositoryInterface;

class TodoController extends Controller
{
    private TodoRepositoryInterface $todoRepository;

    public function __construct(TodoRepositoryInterface $todoRepository)
    {
        $this->todoRepository = $todoRepository;
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(TodoRequest $request)
    {
        $validated = $request->validated();
        $validated['user_id'] = auth()->id();
        $this->todoRepository->create($validated);
        return back()->with('success', 'Todo Created Successfully');
    }

    /**
     * Get all todos.
     *
     */
    public function create()
    {
        return view('todo.index', ['todos' => $this->todoRepository->get(request(), 5)]);
    }
}
