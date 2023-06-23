<?php

namespace Packages\Domains\Interfaces\Repositories;

use Packages\Domains\Entities\Tag;

interface TagRepository
{
    public function find(string $id): Tag;
    public function findByPostId(string $postId): array;
    public function findAll(): array;
    public function generateId(): string;
}
