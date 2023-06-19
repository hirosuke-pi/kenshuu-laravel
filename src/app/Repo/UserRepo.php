<?php

namespace App\Repo;

use App\Models\User;
use Exception;

class UserRepo {
    private ?User $user = null;

    public function __construct(string $id)
    {
        $this->user = User::find($id) ?? null;
    }

    public function isGuest(): string
    {
        return is_null($this->user);
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
