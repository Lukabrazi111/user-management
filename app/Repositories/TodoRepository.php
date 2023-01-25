<?php

namespace App\Repositories;

use App\Interfaces\TodoRepositoryInterface;
use App\Models\Todo;

class TodoRepository implements TodoRepositoryInterface
{
    public function get($request, $pagination = null)
    {
        $todos = Todo::query()
            ->latest();

        if (is_null($pagination)) {
            return $todos->get();
        }

        $todos = $todos->paginate($pagination);

        return $todos;
    }

    public function create(array $data)
    {
        return Todo::create($data);
    }

    public function update($id, array $data)
    {
        return Todo::whereId($id)->update($data);
    }

    public function destroy($id)
    {
        return Todo::destroy($id);
    }
}
