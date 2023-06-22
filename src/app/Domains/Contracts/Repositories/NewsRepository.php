<?php

namespace App\Domains\Contracts\Repositories;

use App\Domains\Contracts\Factories\NewsFactory;
use App\Domains\Entities\News;

interface NewsRepository
{
    public function __construct(NewsFactory $newsFactory);
    public function findAll(): array;
    public function find(string $id): ?News;
    public function save(News $news): string;
    public function delete(string $id): bool;
    public function generateId(): string;
}
