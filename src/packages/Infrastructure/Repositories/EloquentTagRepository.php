<?php

namespace Packages\Infrastructure\Repositories;

use Packages\Domains\Interfaces\Repositories\TagRepositoryInterface;
use Packages\Domains\Entities\Tag;
use \App\Models\Tag as TagModel;
use \App\Models\PostsTag as PostsTagModel;

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
        $tag = TagModel::find($id);
        return new Tag(
            id: $tag->id,
            name: $tag->tag_name,
        );
    }

    /**
     * タグを全件取得する
     *
     * @return array タグEntityの配列
     */
    public function findAll(): array
    {
        $tags = TagModel::all();

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
        $tags = PostsTagModel::where('post_id', $postId)->get();

        $tagEntities = [];
        foreach($tags as $tag) {
            $tagEntities[] = $this->find($tag->tag_id);
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
