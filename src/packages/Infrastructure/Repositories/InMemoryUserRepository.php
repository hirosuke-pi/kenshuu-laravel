<?php

namespace Packages\Infrastructure\Repositories;

use Packages\Domains\Interfaces\Repositories\UserRepositoryInterface;
use Packages\Domains\Entities\User;

final class InMemoryUserRepository implements UserRepositoryInterface
{
    private const PREFIX = 'user';
    private array $users = [];

    /**
     * ユーザーIDからユーザーを取得する
     *
     * @param string $id ユーザーID
     * @return User|null ユーザーEntity
     */
    public function find(string $id): ?User
    {
        return $this->users[$id] ?? null;
    }

    /**
     * メールアドレスからユーザーを取得する
     *
     * @param string $email メールアドレス
     * @return User|null ユーザーEntity
     */
    public function findByEmail(string $email): ?User {
        foreach($this->users as $user) {
            if ($user->getEmail() === $email) {
                return $user;
            }
        }
        return null;
    }

    /**
     * ユーザーを保存する
     *
     * @param User $userEntity ユーザーEntity
     * @return bool 保存結果
     */
    public function save(User $userEntity): bool
    {
        $this->users[$userEntity->getId()] = $userEntity;
        return true;
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
