<?php

namespace Packages\Handlers\User;

use DateTime;
use Illuminate\Support\Facades\DB;
use Packages\Domains\Entities\User;
use Packages\Domains\Interfaces\Repositories\UserRepositoryInterface;

final class UserCreateHandler
{
    /**
     * ユーザーを作成するハンドラのコンストラクタ
     *
     * @param UserRepositoryInterface $repository ユーザーリポジトリ
     */
    public function __construct(
        private readonly UserRepositoryInterface $repository
    ) {}

    /**
     * ユーザーを作成するハンドラ
     *
     * @param string $name ユーザー名
     * @param string $email メールアドレス
     * @param string $password パスワード
     * @param string|null $profileImagePath プロフィール画像パス
     * @return User ユーザー
     */
    public function handle(
        string $name,
        string $email,
        string $password,
        ?string $profileImagePath
    ): User
    {
        $user = new User(
            id: $this->repository->generateId(),
            email: $email,
            name: $name,
            password: $this->repository->hashPassword($password),
            profileImagePath: $profileImagePath,
            createdAt: (new DateTime())->format(DateTime::ATOM),
        );

        DB::transaction(function () use ($user) {
            $this->repository->save($user);
        });

        return $user;
    }
}
