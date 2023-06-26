<?php

namespace Packages\Domains\Interfaces\Repositories;

use Packages\Domains\Entities\Tag;

interface TagRepository
{
    /**
     * タグリポジトリのコンストラクタ
     *
     * @param string $id タグID
     * @return Tag タグEntity
     */
    public function find(string $id): Tag;

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
     * タグIDを生成する
     *
     * @return string タグID
     */
    public function generateId(): string;
}
