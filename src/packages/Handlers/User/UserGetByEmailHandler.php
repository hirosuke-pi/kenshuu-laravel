<?php

namespace Packages\Handlers\User;

use Packages\Domains\Entities\User;
use Packages\Domains\Interfaces\Repositories\UserRepositoryInterface;

final class UserGetByEmailHandler
{
    /**
     * メールアドレスからユーザーを取得するコンストラクタ
     *
     * @param UserRepositoryInterface $repository ユーザーリポジトリ
     */
    public function __construct(
        private readonly UserRepositoryInterface $repository
    ) {}

    /**
     * メールアドレスからユーザーを取得するハンドラ
     *
     * @param string $email メールアドレス
     * @return User ユーザー
     */
    public function handle(string $email): User
    {
        return $this->repository->findByEmail($email);
    }
}
