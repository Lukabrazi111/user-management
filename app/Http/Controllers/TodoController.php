<?php

namespace App\Http\Controllers;

use App\Http\Requests\Todo\TodoRequest;
use App\Http\Requests\Todo\UpdateTodoRequest;
use App\Interfaces\TodoRepositoryInterface;
use App\Models\Todo;

class TodoController extends Controller
{
    private TodoRepositoryInterface $todoRepository;

    public function __construct(TodoRepositoryInterface $todoRepository)
    {
        $this->todoRepository = $todoRepository;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param TodoRequest $request
     */
    public function store(TodoRequest $request)
    {
        try {
            $validated = $request->validated();
            $validated['user_id'] = auth()->id();
            $this->todoRepository->create($validated);
            return back()->with('success', __('todo.created'));
        } catch (\Throwable $e) {
            throw $e;
        }
    }

    /**
     * Get all todos.
     *
     */
    public function create()
    {
        return view('todo.index', ['todos' => $this->todoRepository->get(request(), 5)]);
    }

    /**
     * Update stored data from database.
     *
     * @param UpdateTodoRequest $request
     * @param Todo $todo
     */
    public function update(UpdateTodoRequest $request, Todo $todo)
    {
        try {
            $validated = $request->validated();

            $todo = $this->todoRepository->getById($todo->id);

            if ($todo->status === 'incomplete') {
                $validated['status'] = 'completed';
            } else {
                $validated['status'] = 'incomplete';
            }

            $this->todoRepository->update($todo->id, $validated);
            return back()->with('success', __('todo.updated'));
        } catch (\Throwable $e) {
            throw $e;
        }
    }

    /**
     * Delete stored data from storage.
     *
     * @param Todo $todo
     */
    public function destroy(Todo $todo)
    {
        try {
            $this->todoRepository->destroy($todo->id);

            return back()->with('success', __('todo.deleted'));
        } catch (\Throwable $e) {
            throw($e);
        }
    }
}
