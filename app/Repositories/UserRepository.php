<?php

namespace App\Repositories;

use App\Interfaces\UserRepositoryInterface;
use App\Models\User;

class UserRepository implements UserRepositoryInterface
{
    public function store(array $data)
    {
        return User::create($data);
    }

    public function show($id)
    {
        return User::findOrFail($id);
    }

    public function update($id, array $data)
    {
        return User::whereId($id)->update($data);
    }

    public function destroy($id)
    {
        return User::destroy($id);
    }
}
