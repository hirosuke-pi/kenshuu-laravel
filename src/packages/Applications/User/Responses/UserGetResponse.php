<?php

namespace Packages\Applications\User\Responses;

use Packages\Domains\Entities\User;

final class UserGetResponse
{
    /**
     * ユーザーを取得するレスポンスのコンストラクタ
     *
     * @param User|null $user ユーザー
     */
    public function __construct(
        private readonly ?User $user
    ) {}

    /**
     * ユーザーを取得する
     *
     * @return User|null ユーザーエンティティ
     */
    public function getAuthor(): ?User
    {
        return $this->user;
    }

    /**
     * ユーザーを保持しているか
     *
     * @return boolean 保持しているか
     */
    public function hasUser(): bool
    {
        return !is_null($this->user);
    }
}
