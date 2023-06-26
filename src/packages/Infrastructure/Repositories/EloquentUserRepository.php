<?php

namespace Packages\Infrastructure\Repositories;

use Packages\Domains\Interfaces\Repositories\UserRepository;
use Packages\Domains\Entities\User;

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
            name: $user->username,
            email: $user->email,
            password: $user->password,
            profileImagePath: $user->profile_image_path,
            createdAt: $user->created_at,
        );
    }

    public function save(User $userEntity): string
    {
        $user = new \App\Models\User();
        $user->id = $userEntity->getId();
        $user->username = $userEntity->getName();
        $user->email = $userEntity->getEmail();
        $user->password = $userEntity->getPasswordHash();
        $user->created_at = $userEntity->getCreatedAt();
        if ($userEntity->hasUserProfileImage()) {
            $user->profile_image_path = $userEntity->getProfileImagePath();
        }
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
