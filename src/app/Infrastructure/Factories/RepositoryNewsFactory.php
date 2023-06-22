<?php

namespace App\Infrastructure\Factories;

use App\Domains\Contracts\Factories\NewsFactory;
use App\Domains\Contracts\Repositories\ImageRepository;
use App\Domains\Contracts\Repositories\TagRepository;
use App\Domains\Contracts\Repositories\UserRepository;
use App\Domains\Entities\News;

final class EloquentNewsFactory implements NewsFactory
{
    public function __construct(
        private UserRepository $userRepository,
        private TagRepository $tagRepository,
        private ImageRepository $imageRepository,
    ) {}

    public function create(string $id, string $userId, string $title, string $body, string $createdAt, string $updatedAt): News
    {
        return new News(
            id: $id,
            user: $this->userRepository->find($userId),
            title: $title,
            body: $body,
            tags: $this->tagRepository->findByPostId($id),
            images: $this->imageRepository->findByPostId($id),
            createdAt: $createdAt,
            updatedAt: $updatedAt,
        );
    }
}
