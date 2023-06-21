<?php

namespace App\Domains\Contracts\Repositories;

use App\Domains\Entities\News;

interface NewsRepository
{
    public static function findAll(): array;
    public static function find(string $id): News;
    public static function save(News $news): string;
    public static function delete(string $id): bool;
}
