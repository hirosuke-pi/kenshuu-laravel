<?php

namespace App\Infrastructure\Repositories;

use App\Domains\Contracts\Repositories\UserRepository;
use App\Domains\Entities\User;

final class EloquentUserRepository implements UserRepository
{
    private const PREFIX = 'user';

    public function find(string $id): ?User
    {
        $user = \App\Models\User::find($id);
        if (is_null($user)) {
            return null;
        }

        return new User(
            id: $user->id,
            name: $user->name,
            email: $user->email,
            password: $user->password,
            profileImagePath: $user->profile_image_path,
            createdAt: $user->createdAt,
        );
    }

    public function findByEmail(string $email): ?User {
        $user = \App\Models\User::where('email', $email)->first();
        if (is_null($user)) {
            return null;
        }

        return new User(
            id: $user->id,
            name: $user->name,
            email: $user->email,
            password: $user->password,
            profileImagePath: $user->profile_image_path,
            createdAt: $user->createdAt,
        );
    }

    public function save(User $user): string
    {
        $user = new \App\Models\User();
        $user->id = $user->getId();
        $user->username = $user->getName();
        $user->email = $user->getEmail();
        $user->password = $user->getPassword();
        $user->profile_image_path = $user->getProfileImagePath();
        $user->save();

        return $user->id;
    }

    public function delete(string $id): bool
    {
        return true;
    }

    public function generateId(): string
    {
        return self::PREFIX .'-'. uniqid(mt_rand());
    }
}
