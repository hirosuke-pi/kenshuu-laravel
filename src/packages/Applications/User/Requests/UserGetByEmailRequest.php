<?php

namespace Packages\Applications\User\Requests;

final class UserGetByEmailRequest
{
    public function __construct(
        private readonly string $email
    ) {}

    public function getEmail(): string
    {
        return $this->email;
    }
}
