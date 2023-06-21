<?php

namespace App\Infrastructure\Repositories;

use App\Domains\Contracts\Repositories\UserRepository;
use App\Domains\Entities\User;

class InMemoryUserRepository implements UserRepository
{
    public static function find(string $id): User
    {
        return new User(
            id: $id,
            name: 'test',
            email: 'test@test.com',
            password: '',
            profileImagePath: null,
            createdAt: '',
        );
    }

    public static function save(User $user): string
    {
        return 'test';
    }

    public static function delete(string $id): bool
    {
        return true;
    }
}
