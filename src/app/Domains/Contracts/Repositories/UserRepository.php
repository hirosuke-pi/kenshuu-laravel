<?php

namespace App\Domains\Contracts\Repositories;

use App\Domains\Entities\User;

interface UserRepository
{
    public static function find(string $id): User;
    public static function save(User $user): string;
    public static function delete(string $id): bool;
}
