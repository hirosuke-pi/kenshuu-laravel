<?php

namespace App\Infrastructure\Repositories;

use App\Domains\Contracts\Repositories\ImageRepository;
use App\Domains\Entities\Image;

class EloquentImageRepository implements ImageRepository
{
    public static function find(string $id): Image
    {
        $tag = \App\Models\Image::find($id);
        return new Image(
            id: $tag->id,
            isThumbnail: $tag->thumbnail_flag,
            filePath: $tag->name,
        );
    }

    public static function findByPostId(string $postId): array
    {
        $tags = \App\Models\Image::where('post_id', $postId)->get();

        $tagEntities = [];
        foreach($tags as $tag) {
            $tagEntities[] = new Image(
                id: $tag->id,
                isThumbnail: $tag->thumbnail_flag,
                filePath: $tag->name,
            );
        }
        return $tagEntities;
    }
}
