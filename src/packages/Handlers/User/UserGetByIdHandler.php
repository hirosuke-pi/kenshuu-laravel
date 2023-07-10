<?php

namespace Packages\Handlers\User;

use Packages\Domains\Entities\User;
use Packages\Domains\Interfaces\Repositories\UserRepositoryInterface;

final class UserGetByIdHandler
{
    /**
     * ユーザーIDからユーザーを取得するコンストラクタ
     *
     * @param UserRepositoryInterface $repository ユーザーリポジトリ
     */
    public function __construct(
        private readonly UserRepositoryInterface $repository
    ) {}

    /**
     * ユーザーIDからユーザーを取得するハンドラ
     *
     * @param string $userId ユーザーID
     * @return User|null ユーザー
     */
    public function handle(string $userId): ?User
    {
        return $this->repository->find($userId);
    }
}
