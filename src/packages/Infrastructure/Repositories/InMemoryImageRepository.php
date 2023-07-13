<?php

namespace Packages\Infrastructure\Repositories;

use Packages\Domains\Interfaces\Repositories\ImageRepositoryInterface;
use Packages\Domains\Entities\Image;

final class InMemoryImageRepository implements ImageRepositoryInterface
{
    private const PREFIX = 'image';
    private array $images = [];

    /**
     * 画像IDから画像を取得する
     *
     * @param string $id 画像ID
     * @return Image 画像Entity
     */
    public function find(string $id): Image
    {
        return $this->images[$id] ?? null;
    }

    /**
     * 投稿IDから画像を取得する
     *
     * @param string $postId 投稿ID
     * @return array 画像Entityの配列
     */
    public function findByPostId(string $postId): array
    {
        $imageEntities = [];
        foreach($this->images as $image) {
            if ($image->getPostId() === $postId) {
                $imageEntities[] = $image;
            }
        }
        return $imageEntities;
    }

    /**
     * 画像を保存する
     *
     * @param Image $image 画像Entity
     * @param string $postId 投稿ID
     * @return bool 保存結果
     */
    public function save(Image $image, string $postId): bool
    {
        $this->images[$image->getId()] = $image;
        return true;
    }

    /**
     * 画像IDを生成する
     *
     * @return string 画像ID
     */
    public function generateId(): string
    {
        return self::PREFIX .'-'. uniqid(mt_rand());
    }
}
