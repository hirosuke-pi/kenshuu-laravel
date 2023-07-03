<?php

namespace Packages\Applications\News\Requests;
use Packages\Domains\Entities\User;

final class NewsGetByUserRequest
{
    /**
     * ユーザーを指定してニュースを取得するリクエストのコンストラクタ
     *
     * @param User $userID ユーザーEntity
     */
    public function __construct(
        private readonly User $user,
    ) {}

    /**
     * ユーザーを取得する
     *
     * @return User ユーザーEntity
     */
    public function getUser(): User
    {
        return $this->user;
    }
}
