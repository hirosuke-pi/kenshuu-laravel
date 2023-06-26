<?php

namespace Packages\Applications\User\Requests;

final class UserCreateRequest
{
    public function __construct(
        private readonly string $name,
        private readonly string $email,
        private readonly string $password,
        private readonly ?string $profileImagePath
    ) {}

    public function getName(): string
    {
        return $this->name;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function getPassword(): string
    {
        return $this->password;
    }

    public function getProfileImagePath(): ?string
    {
        return $this->profileImagePath;
    }
}
