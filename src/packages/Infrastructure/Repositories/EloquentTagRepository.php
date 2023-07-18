<?php

namespace Packages\Infrastructure\Repositories;

use Illuminate\Support\Facades\DB;
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
     * @return Tag|null タグEntity
     */
    public function find(string $id): ?Tag
    {
        $tag = TagModel::find($id);
        if (is_null($tag)) {
            return null;
        }

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
        $tags = TagModel::whereIn('id', $ids)->get();

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
        $tags = PostsTagModel::join('tags', 'tags.id', '=', 'posts_tags.tag_id')->where('post_id', $postId)->get();
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
     * @return bool 保存結果
     */
    public function saveWithPostId(Tag $tag, string $postId): bool
    {
        $postsTag = PostsTagModel::where('post_id', $postId)->
            where('tag_id', $tag->getId())->first() ?? new PostsTagModel();
        $postsTag->post_id = $postId;
        $postsTag->tag_id = $tag->getId();
        return $postsTag->save();
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
