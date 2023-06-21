<?php

namespace App\Domains\UseCases;

use \App\Domains\Contracts\Repositories\NewsRepository;
use App\Domains\Entities\News;

class NewsGetUseCase {


    public function __construct(
        private NewsRepository $newsRepository,
    ) {}

    public function get(string $id): News {
        return $this->newsRepository->find($id);
    }

    public function getAll(): array {
        return $this->newsRepository->findAll();
    }
}
