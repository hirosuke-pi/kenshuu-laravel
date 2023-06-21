<?php

namespace App\Infrastructure\Repositories;

use App\Domains\Contracts\Repositories\TagRepository;
use App\Domains\Entities\Tag;

class EloquentTagRepository implements TagRepository
{
    public static function find(string $id): Tag
    {
        $tag = \App\Models\Tag::find($id);
        return new Tag(
            id: $tag->id,
            name: $tag->name,
        );
    }

    public static function findAll(): array
    {
        $tags = \App\Models\Tag::all();

        $tagEntities = [];
        foreach($tags as $tag) {
            $tagEntities[] = new Tag(
                id: $tag->id,
                name: $tag->name,
            );
        }
        return $tagEntities;
    }

    public static function findByPostId(string $postId): array
    {
        $tags = \App\Models\Tag::where('post_id', $postId)->get();

        $tagEntities = [];
        foreach($tags as $tag) {
            $tagEntities[] = new Tag(
                id: $tag->id,
                name: $tag->name,
            );
        }
        return $tagEntities;
    }
}
