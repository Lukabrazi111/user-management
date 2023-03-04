<?php

namespace App\Interfaces;

interface UserRepositoryInterface
{
    public function store(array $data);

    public function show($id);

    public function update($id, array $data);

    public function destroy($id);
}
