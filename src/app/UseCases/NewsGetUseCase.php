<?php

namespace App\UseCases;

use \App\Domains\Contracts\Repositories\NewsRepository;
use App\Domains\Entities\News;
use App\Infrastructure\Factories\EloquentNewsFactory;
use App\Infrastructure\Repositories\EloquentImageRepository;
use App\Infrastructure\Repositories\EloquentNewsRepository;
use App\Infrastructure\Repositories\EloquentTagRepository;
use App\Infrastructure\Repositories\InMemoryUserRepository;

class NewsGetUseCase {
    public function __construct(
        private NewsRepository $newsRepository
    ) {}

    public function get(string $id): News {
        return $this->newsRepository->find($id);
    }

    public function getAll(): array {
        return $this->newsRepository->findAll();
    }
}
