<?php

namespace App\Domains\Contracts\Repositories;

use App\Domains\Entities\Tag;

interface TagRepository
{
    public function find(string $id): Tag;
    public function findByPostId(string $postId): array;
    public function findAll(): array;
    public function generateId(): string;
}
