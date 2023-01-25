<?php

namespace App\Repositories;

use App\Interfaces\TodoRepositoryInterface;
use App\Models\Todo;

class TodoRepository implements TodoRepositoryInterface
{
    public function get()
    {
        return Todo::all();
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
