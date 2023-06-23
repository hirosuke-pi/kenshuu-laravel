<?php

namespace Packages\Domains\Entities;

final class User {
    public function __construct(
        private string $id,
        private string $name,
        private string $email,
        private string $password,
        private ?string $profileImagePath,
        private string $createdAt,
    ) {
        $this->password = password_hash($this->password, PASSWORD_DEFAULT);
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function verifyPassword(string $password): bool
    {
        return password_verify($password, $this->password);
    }

    public function getProfileImageName(): ?string
    {
        return $this->id . '.' . $this->profileImagePath;
    }
}
