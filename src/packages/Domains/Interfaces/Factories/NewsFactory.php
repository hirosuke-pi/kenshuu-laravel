<?php

namespace Packages\Domains\Interfaces\Factories;

use Packages\Domains\Interfaces\Repositories\UserRepository;
use Packages\Domains\Interfaces\Repositories\TagRepository;
use Packages\Domains\Interfaces\Repositories\ImageRepository;
use Packages\Domains\Entities\News;

interface NewsFactory {
    public function __construct(UserRepository $userRepository, TagRepository $newsRepository, ImageRepository $imageRepository);
    public function create(string $id, string $userId, string $title, string $body, string $createdAt, string $updatedAt): News;
}
