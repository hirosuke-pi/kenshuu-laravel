<?php

namespace Packages\Infrastructure\Repositories;

use Packages\Domains\Interfaces\Repositories\ImageRepository;
use Packages\Domains\Entities\Image;

final class EloquentImageRepository implements ImageRepository
{
    private const PREFIX = 'image';

    public function find(string $id): Image
    {
        $tag = \App\Models\Image::find($id);
        return new Image(
            id: $tag->id,
            isThumbnail: $tag->thumbnail_flag,
            filePath: $tag->name,
        );
    }

    public function findByPostId(string $postId): array
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

    public function generateId(): string
    {
        return self::PREFIX .'-'. uniqid(mt_rand());
    }
}
