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
        $user = UserModel::whereNull('deleted_at')->find($id);
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
            postsCount: \App\Models\Post::where('user_id', $user->id)->whereNull('deleted_at')->count(),
        );
    }

    /**
     * メールアドレスからユーザーを取得する
     *
     * @param string $email メールアドレス
     * @return User|null ユーザーEntity
     */
    public function findByEmail(string $email): ?User {
        $user = UserModel::where('email', $email)->whereNull('deleted_at')->first();
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
            postsCount: \App\Models\Post::where('user_id', $user->id)->whereNull('deleted_at')->count(),
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

    /**
     * ユーザーIDを生成する
     *
     * @return string ユーザーID
     */
    public function generateId(): string
    {
        return self::PREFIX .'-'. uniqid(mt_rand());
    }

    /**
     * パスワードをハッシュ化する
     *
     * @param string $password パスワード
     * @return string ハッシュ化されたパスワード
     */
    public function hashPassword(string $password): string
    {
        return password_hash($password, PASSWORD_DEFAULT);
    }
}
