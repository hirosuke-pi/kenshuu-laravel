<?php

namespace Packages\Domains\Interfaces\Repositories;

use Packages\Domains\Entities\Image;

interface ImageRepository
{
    /**
     * 画像リポジトリのコンストラクタ
     *
     * @param string $id 画像ID
     * @return Image 画像Entity
     */
    public function find(string $id): Image;

    /**
     * 投稿IDから画像を取得する
     *
     * @param string $postId 投稿ID
     * @return array 画像Entityの配列
     */
    public function findByPostId(string $postId): array;

    /**
     * 画像IDを生成する
     *
     * @return string 画像ID
     */
    public function generateId(): string;
}
