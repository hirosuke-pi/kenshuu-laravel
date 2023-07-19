<?php

namespace Packages\Infrastructure\Repositories;

use Packages\Domains\Interfaces\Repositories\ImageRepositoryInterface;
use Packages\Domains\Entities\Image;
use \App\Models\Image as ImageModel;

final class EloquentImageRepository implements ImageRepositoryInterface
{
    private const PREFIX = 'image';

    /**
     * 画像IDから画像を取得する
     *
     * @param string $id 画像ID
     * @return Image|null 画像Entity
     */
    public function find(string $id): ?Image
    {
        $image = ImageModel::find($id);
        if (is_null($image)) return null;
        return new Image(
            id: $image->id,
            isThumbnail: $image->thumbnail_flag,
            filePath: $image->file_path,
        );
    }

    /**
     * 投稿IDから画像を取得する
     *
     * @param string $postId 投稿ID
     * @return array|null 画像Entityの配列
     */
    public function findByPostId(string $postId): ?array
    {
        $images = ImageModel::where('post_id', $postId)->get();
        if ($images->isEmpty()) return null;

        $imageEntities = [];
        foreach($images as $image) {
            $imageEntities[] = new Image(
                id: $image->id,
                isThumbnail: $image->thumbnail_flag,
                filePath: $image->file_path,
            );
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
        $imageModel = ImageModel::find($image->getId()) ?? new ImageModel();
        $imageModel->id = $image->getId();
        $imageModel->post_id = $postId;
        $imageModel->thumbnail_flag = $image->isThumbnail();
        $imageModel->file_path = $image->getFilePath();
        return $imageModel->save();
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
