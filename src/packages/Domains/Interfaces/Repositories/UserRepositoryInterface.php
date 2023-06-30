<?php

namespace Packages\Domains\Interfaces\Repositories;

use Packages\Domains\Entities\User;

interface UserRepositoryInterface
{
    /**
     * ユーザーIDからユーザーを取得する
     *
     * @param string $id ユーザーID
     * @return User|null ユーザーEntity
     */
    public function find(string $id): ?User;

    /**
     * メールアドレスからユーザーを取得する
     *
     * @param string $email メールアドレス
     * @return User|null ユーザーEntity
     */
    public function findByEmail(string $email): ?User;

    /**
     * Undocumented function
     *
     * @param User $user ユーザーEntity
     * @return void
     */
    public function save(User $user): void;

    /**
     * ユーザーIDを生成する
     *
     * @return string ユーザーID
     */
    public function generateId(): string;
}
