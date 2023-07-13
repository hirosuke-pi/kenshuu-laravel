<?php

namespace Packages\Domains\Interfaces\Repositories;

use Packages\Domains\Entities\Tag;

interface TagRepositoryInterface
{
    /**
     * タグIDからタグEntityを取得する
     *
     * @param string $id タグID
     * @return Tag タグEntity
     */
    public function find(string $id): Tag;

    /**
     * タグID配列からタグEntity配列を取得する
     *
     * @param array $ids タグID配列
     * @return array タグEntity配列
     */
    public function findByIds(array $ids): array;

    /**
     * 投稿IDからタグを取得する
     *
     * @param string $postId 投稿ID
     * @return array タグEntityの配列
     */
    public function findByPostId(string $postId): array;

    /**
     * タグを全件取得する
     *
     * @return array タグEntityの配列
     */
    public function findAll(): array;

    /**
     * タグを保存する
     *
     * @param Tag $tag タグEntity
     * @param string $postId 投稿ID
     * @return bool 保存結果
     */
    public function saveWithPostId(Tag $tag, string $postId): bool;

    /**
     * タグIDを生成する
     *
     * @return string タグID
     */
    public function generateId(): string;
}
