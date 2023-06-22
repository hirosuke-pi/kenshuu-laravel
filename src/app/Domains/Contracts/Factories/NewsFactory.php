<?php

namespace App\Domains\Contracts\Factories;

use App\Domains\Contracts\Repositories\UserRepository;
use App\Domains\Contracts\Repositories\TagRepository;
use App\Domains\Contracts\Repositories\ImageRepository;
use App\Domains\Entities\News;

interface NewsFactory {
    public function __construct(UserRepository $userRepository, TagRepository $newsRepository, ImageRepository $imageRepository);
    public function create(string $id, string $userId, string $title, string $body, string $createdAt, string $updatedAt): News;
}
