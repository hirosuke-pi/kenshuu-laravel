<?php

namespace Packages\Infrastructure\Repositories;

use Packages\Domains\Interfaces\Repositories\TagRepository;
use Packages\Domains\Entities\Tag;

final class EloquentTagRepository implements TagRepository
{
    private const PREFIX = 'tag';

    public function find(string $id): Tag
    {
        $tag = \App\Models\Tag::find($id);
        return new Tag(
            id: $tag->id,
            name: $tag->name,
        );
    }

    public function findAll(): array
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

    public function findByPostId(string $postId): array
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

    public function generateId(): string
    {
        return self::PREFIX .'-'. uniqid(mt_rand());
    }
}
