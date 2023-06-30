<?php

namespace Packages\Applications\User\Requests;

final class UserGetByEmailRequest
{
    /**
     * メールアドレスからユーザーを取得するコンストラクタ
     *
     * @param string $email メールアドレス
     */
    public function __construct(
        private readonly string $email
    ) {}

    /**
     * メールアドレスを取得する
     *
     * @return string メールアドレス
     */
    public function getEmail(): string
    {
        return $this->email;
    }
}
