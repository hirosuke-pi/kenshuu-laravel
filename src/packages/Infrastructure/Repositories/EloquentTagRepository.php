<?php

namespace Packages\Infrastructure\Repositories;

use Illuminate\Support\Facades\DB;
use Packages\Domains\Interfaces\Repositories\TagRepository;
use Packages\Domains\Entities\Tag;

final class EloquentTagRepository implements TagRepository
{
    private const PREFIX = 'tag';

    /**
     * タグIDからタグを取得する
     *
     * @param string $id タグID
     * @return Tag タグEntity
     */
    public function find(string $id): Tag
    {
        $tag = \App\Models\Tag::find($id);
        return new Tag(
            id: $tag->id,
            name: $tag->tag_name,
        );
    }

    /**
     * タグIDからタグを取得する
     *
     * @param string $id タグID
     * @return array タグEntity配列
     */
    public function findByIds(array $ids): array
    {
        $tags = \App\Models\Tag::whereIn('id', $ids)->get();

        $tagEntities = [];
        foreach($tags as $tag) {
            $tagEntities[] = new Tag(
                id: $tag->id,
                name: $tag->tag_name,
            );
        }
        return $tagEntities;
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
                name: $tag->tag_name,
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
        $tags = \App\Models\PostsTag::join('tags', 'tags.id', '=', 'posts_tags.tag_id')->where('posts_tags.post_id', $postId)->get();

        $tagEntities = [];
        foreach($tags as $tag) {
            $tagEntities[] = new Tag(
                id: $tag->id,
                name: $tag->tag_name,
            );
        }
        return $tagEntities;
    }

    /**
     * タグをPost IDと紐付けて保存する
     *
     * @param Tag $tag タグEntity
     * @param string $postId 投稿ID
     * @return void
     */
    public function saveWithPostId(Tag $tag, string $postId): void
    {
        $postsTag = new \App\Models\PostsTag();
        $postsTag->post_id = $postId;
        $postsTag->tag_id = $tag->getId();
        $postsTag->save();
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
