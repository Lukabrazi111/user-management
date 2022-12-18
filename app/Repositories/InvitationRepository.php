<?php

namespace App\Repositories;

use App\Interfaces\InvitationRepositoryInterface;
use App\Models\Invitation;

class InvitationRepository implements InvitationRepositoryInterface
{
    public function store(array $data)
    {
        return Invitation::create($data);
    }

    public function getByToken($token)
    {
        return Invitation::where('token', $token)->first();
    }

    public function destroy($id)
    {
        return Invitation::destroy($id);
    }

    public function deleteByToken($token)
    {
        return Invitation::where('token', $token)->delete();
    }
}
