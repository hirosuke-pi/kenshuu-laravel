<?php

namespace App\Domains\Contracts\Repositories;

use App\Domains\Entities\Image;

interface ImageRepository
{
    public function find(string $id): Image;
    public function findByPostId(string $postId): array;
    public function generateId(): string;
}
