<?php

namespace Packages\Domains\Interfaces\Repositories;

use Packages\Domains\Entities\User;

interface UserRepository
{
    public function find(string $id): ?User;
    public function findByEmail(string $email): ?User;
    public function save(User $user): string;
    public function delete(string $id): bool;
    public function generateId(): string;
}
