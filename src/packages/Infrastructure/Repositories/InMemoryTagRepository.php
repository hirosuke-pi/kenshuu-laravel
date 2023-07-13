<?php

namespace Packages\Infrastructure\Repositories;

use Packages\Domains\Interfaces\Repositories\TagRepositoryInterface;
use Packages\Domains\Entities\Tag;

final class InMemoryTagRepository implements TagRepositoryInterface
{
    private const PREFIX = 'tag';
    private array $tags = [];
    private array $postsTag = [];

    public function __construct() {
        $this->tags = [
            new Tag(
                id: 'tag-test1',
                name: 'test1',
            ),
            new Tag(
                id: 'tag-test2',
                name: 'test2',
            ),
            new Tag(
                id: 'tag-test3',
                name: 'test3',
            ),
        ];
    }

    /**
     * タグIDからタグを取得する
     *
     * @param string $id タグID
     * @return Tag タグEntity
     */
    public function find(string $id): Tag
    {
        return $this->tags[$id] ?? null;
    }

    /**
     * タグIDからタグを取得する
     *
     * @param string $id タグID
     * @return array タグEntity配列
     */
    public function findByIds(array $ids): array
    {
        $tagEntities = [];
        foreach($ids as $id) {
            if (isset($this->tags[$id])) {
                $tagEntities[] = $this->tags[$id];
            }
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
        return $this->tags;
    }

    /**
     * 投稿IDからタグを取得する
     *
     * @param string $postId 投稿ID
     * @return array タグEntityの配列
     */
    public function findByPostId(string $postId): array
    {
        $tagEntities = [];
        foreach($this->postsTag as $postsTag) {
            if ($postsTag['post_id'] === $postId) {
                $tagEntities[] = $this->tags[$postsTag['tag_id']];
            }
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
        $this->postsTag[] = [
            'post_id' => $postId,
            'tag_id' => $tag->getId(),
        ];
        return true;
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
