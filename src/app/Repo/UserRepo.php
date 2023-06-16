<?php

namespace App\Repo;

use App\Models\User;

class UserRepo {
    private User $user;

    public function __construct(string $id)
    {
        $this->user = User::find($id);
    }

    public function getEditUrl(): string
    {
        return $this->user->id;
    }

    public function getViewUrl(): string
    {
        return $this->user->id;
    }

}
