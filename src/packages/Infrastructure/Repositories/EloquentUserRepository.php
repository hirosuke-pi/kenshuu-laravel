<?php

namespace Packages\Infrastructure\Repositories;

use Packages\Domains\Interfaces\Repositories\UserRepositoryInterface;
use Packages\Domains\Entities\User;
use App\Models\User as UserModel;

final class EloquentUserRepository implements UserRepositoryInterface
{
    private const PREFIX = 'user';

    /**
     * ユーザーIDからユーザーを取得する
     *
     * @param string $id ユーザーID
     * @return User|null ユーザーEntity
     */
    public function find(string $id): ?User
    {
        $user = UserModel::find($id)->whereNotNull('deleted_at')->first();
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

    /**
     * メールアドレスからユーザーを取得する
     *
     * @param string $email メールアドレス
     * @return User|null ユーザーEntity
     */
    public function findByEmail(string $email): ?User {
        $user = UserModel::where('email', $email)->whereNotNull('deleted_at')->first();
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

    /**
     * ユーザーを保存する
     *
     * @param User $userEntity ユーザーEntity
     * @return void
     */
    public function save(User $userEntity): void
    {
        $user = new UserModel();
        $user->id = $userEntity->getId();
        $user->username = $userEntity->getName();
        $user->email = $userEntity->getEmail();
        $user->password = $userEntity->getHashedPassword();
        $user->created_at = $userEntity->getCreatedAt();
        if ($userEntity->hasUserProfileImage()) {
            $user->profile_image_path = $userEntity->getProfileImagePath();
        }
        $user->save();
    }

    public function generateId(): string
    {
        return self::PREFIX .'-'. uniqid(mt_rand());
    }
}
