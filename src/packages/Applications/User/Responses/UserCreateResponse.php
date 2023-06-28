<?php

namespace Packages\Applications\User\Responses;

use Packages\Domains\Entities\User;

final class UserCreateResponse
{
    /**
     * ユーザー作成レスポンスのコンストラクタ
     *
     * @param User $user ユーザーエンティティ
     */
    public function __construct(
        private readonly User $user
    ) {}

    /**
     * ユーザーを取得する
     *
     * @return User ユーザーエンティティ
     */
    public function getUser(): User
    {
        return $this->user;
    }
}
