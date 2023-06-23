<?php

namespace Packages\Domains\Interfaces\Repositories;

use Packages\Domains\Interfaces\Factories\NewsFactory;
use Packages\Domains\Entities\News;

interface NewsRepository
{
    public function __construct(NewsFactory $newsFactory);
    public function findAll(): array;
    public function find(string $id): ?News;
    public function save(News $news): string;
    public function delete(string $id): bool;
    public function generateId(): string;
}
