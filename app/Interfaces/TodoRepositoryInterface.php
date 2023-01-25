<?php

namespace App\Interfaces;

interface TodoRepositoryInterface {
    public function get();

    public function create(array $data);

    public function update($id, array $data);

    public function destroy($id);
}
