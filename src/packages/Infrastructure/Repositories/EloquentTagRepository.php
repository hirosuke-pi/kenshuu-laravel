<?php

namespace Packages\Infrastructure\Repositories;

use Packages\Domains\Interfaces\Repositories\TagRepositoryInterface;
use Packages\Domains\Entities\Tag;

final class EloquentTagRepository implements TagRepositoryInterface
{
    private const PREFIX = 'tag';

    /**
     * タグIDからタグを取得する
     *
     * @param string $id タグID
     * @return Tag
     */
    public function find(string $id): Tag
    {
        $tag = \App\Models\Tag::find($id);
        return new Tag(
            id: $tag->id,
            name: $tag->name,
        );
    }

    /**
     * タグを全件取得する
     *
     * @return array タグEntityの配列
     */
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

    /**
     * 投稿IDからタグを取得する
     *
     * @param string $postId 投稿ID
     * @return array タグEntityの配列
     */
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

    /**
     * タグIDを生成する
     *
     * @return string タグID
     */
    public function generateId(): string
    {
        return self::PREFIX .'-'. uniqid(mt_rand());
    }
}
