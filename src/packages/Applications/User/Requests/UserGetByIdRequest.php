<?php

namespace Packages\Applications\User\Requests;

final class UserGetByIdRequest
{
    public function __construct(
        private readonly string $userId
    ) {}

    public function getUserId(): string
    {
        return $this->userId;
    }
}
