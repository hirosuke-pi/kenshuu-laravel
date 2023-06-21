<?php

namespace App\Domains\Contracts\Repositories;

use App\Domains\Entities\Tag;

interface TagRepository
{
    public static function find(string $id): Tag;
    public static function findByPostId(string $postId): array;
    public static function findAll(): array;
}
