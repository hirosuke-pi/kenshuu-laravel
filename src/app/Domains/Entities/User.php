<?php

namespace App\Domains\Entities;

class User {
    public function __construct(
        private string $id,
        private string $name,
        private string $email,
        private string $password,
        private ?string $profileImagePath,
        private string $createdAt,
    ) {}

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

    public function getProfileImageName(): ?string
    {
        return $this->id . '.' . $this->profileImagePath;
    }
}
