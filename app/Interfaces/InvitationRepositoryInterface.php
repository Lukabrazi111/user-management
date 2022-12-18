<?php

namespace App\Interfaces;

interface InvitationRepositoryInterface
{
    public function store(array $data);

    public function getByToken($token);

    public function destroy($id);

    public function deleteByToken($token);
}
