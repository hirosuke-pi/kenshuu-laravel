<?php

namespace App\Domains\Contracts\Repositories;

use App\Domains\Entities\Image;

interface ImageRepository
{
    public static function find(string $id): Image;
}
