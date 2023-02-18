<?php

namespace App\Http\Controllers;

use App\Http\Requests\Todo\TodoRequest;
use App\Http\Requests\Todo\UpdateTodoRequest;
use App\Http\Requests\UpdateTodoStatusRequest;
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
     * Update status of stored data from database.
     *
     * @param UpdateTodoStatusRequest $request
     * @param Todo $todo
     */
    public function updateStatus(UpdateTodoStatusRequest $request, Todo $todo)
    {
        $this->authorize('update', $todo);

        try {
            $validated = $request->validated();

            if ($todo->status === 'completed') {
                $validated['status'] = 'incomplete';
            } else {
                $validated['status'] = 'completed';
            }

            $this->todoRepository->update($todo->id, $validated);
            return back()->with('success', __('todo.status'));
        } catch (\Throwable $e) {
            throw $e;
        }
    }

    /**
     * Update stored data from database.
     *
     * @param UpdateTodoRequest $request
     * @param Todo $todo
     */
    public function update(UpdateTodoRequest $request, Todo $todo)
    {
        $this->authorize('update', $todo);

        try {
            $validated = $request->validated();

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
        $this->authorize('delete', $todo);

        try {
            $this->todoRepository->destroy($todo->id);

            return back()->with('success', __('todo.deleted'));
        } catch (\Throwable $e) {
            throw($e);
        }
    }
}
