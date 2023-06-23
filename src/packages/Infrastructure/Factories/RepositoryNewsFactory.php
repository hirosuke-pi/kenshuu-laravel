<?php

namespace Packages\Infrastructure\Factories;

use Packages\Domains\Interfaces\Factories\NewsFactory;
use Packages\Domains\Interfaces\Repositories\ImageRepository;
use Packages\Domains\Interfaces\Repositories\TagRepository;
use Packages\Domains\Interfaces\Repositories\UserRepository;
use Packages\Domains\Entities\News;

final class RepositoryNewsFactory implements NewsFactory
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
