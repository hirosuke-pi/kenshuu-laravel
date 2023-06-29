<?php

namespace Packages\Infrastructure\Repositories;

use Packages\Domains\Interfaces\Repositories\ImageRepository;
use Packages\Domains\Entities\Image;

final class EloquentImageRepository implements ImageRepository
{
    private const PREFIX = 'image';

    /**
     * 画像IDから画像を取得する
     *
     * @param string $id 画像ID
     * @return Image 画像Entity
     */
    public function find(string $id): Image
    {
        $tag = \App\Models\Image::find($id);
        return new Image(
            id: $tag->id,
            isThumbnail: $tag->thumbnail_flag,
            filePath: $tag->name,
        );
    }

    /**
     * 投稿IDから画像を取得する
     *
     * @param string $postId 投稿ID
     * @return array 画像Entityの配列
     */
    public function findByPostId(string $postId): array
    {
        $tags = \App\Models\Image::where('post_id', $postId)->get();

        $tagEntities = [];
        foreach($tags as $tag) {
            $tagEntities[] = new Image(
                id: $tag->id,
                isThumbnail: $tag->thumbnail_flag,
                filePath: $tag->name,
            );
        }
        return $tagEntities;
    }

    /**
     * 画像を保存する
     *
     * @param Image $image 画像Entity
     * @param string $postId 投稿ID
     * @return void
     */
    public function save(Image $image, string $postId): void
    {
        $imageModel = new \App\Models\Image();
        $imageModel->id = $image->getId();
        $imageModel->post_id = $postId;
        $imageModel->thumbnail_flag = $image->isThumbnail();
        $imageModel->file_path = $image->getFilePath();
        $imageModel->save();
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
