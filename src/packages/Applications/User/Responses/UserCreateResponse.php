<?php

namespace Packages\Applications\User\Responses;

use Packages\Domains\Entities\User;

final class UserCreateResponse
{
    public function __construct(
        private readonly User $user
    ) {}

    public function getUser(): User
    {
        return $this->user;
    }
}
