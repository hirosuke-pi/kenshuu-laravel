<?php

namespace Packages\Applications\User\Requests;

final class UserGetByIdRequest
{
    /**
     * ユーザーIDからユーザーを取得するコンストラクタ
     *
     * @param string $userId ユーザーID
     */
    public function __construct(
        private readonly string $userId
    ) {}

    /**
     * ユーザーIDを取得する
     *
     * @return string ユーザーID
     */
    public function getUserId(): string
    {
        return $this->userId;
    }
}
