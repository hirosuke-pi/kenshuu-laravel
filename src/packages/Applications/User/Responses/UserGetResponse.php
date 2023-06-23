<?php

namespace Packages\Applications\User\Responses;

use Packages\Domains\Entities\User;

final class UserGetResponse
{
    public function __construct(
        private readonly ?User $user
    ) {}

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function hasUser(): bool
    {
        return !is_null($this->user);
    }
}
