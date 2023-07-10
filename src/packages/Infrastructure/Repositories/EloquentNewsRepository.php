<?php

namespace Packages\Infrastructure\Repositories;

use Packages\Domains\Interfaces\Repositories\NewsRepositoryInterface;
use Packages\Domains\Entities\News;
use Packages\Domains\Interfaces\Factories\NewsFactoryInterface;

use App\Models\Post as PostModel;

final class EloquentNewsRepository implements NewsRepositoryInterface
{
    private const PREFIX = 'news';

    /**
     * ニュースを全件取得する
     *
     * @param NewsFactoryInterface $newsFactory ニュースファクトリ
     * @return array
     */
    public function findAll(NewsFactoryInterface $newsFactory): array
    {

        $posts = PostModel::whereNull('deleted_at')->get();
        $newsEntities = [];
        foreach($posts as $post) {
            $newsEntities[] = $newsFactory->create(
                id: $post->id,
                userId: $post->user_id,
                title: $post->title,
                body: $post->body,
                createdAt: $post->created_at,
                updatedAt: $post->updated_at,
            );
        }

        return $newsEntities;
    }

    /**
     * ニュースを取得する
     *
     * @param NewsFactoryInterface $newsFactory ニュースファクトリ
     * @param string $id ニュースID
     * @return News|null ニュースEntity
     */
    public function find(NewsFactoryInterface $newsFactory, string $id): ?News
    {
        $post = PostModel::whereNull('deleted_at')->find($id);
        if (is_null($post)) {
            return null;
        }

        return $newsFactory->create(
            id: $post->id,
            userId: $post->user_id,
            title: $post->title,
            body: $post->body,
            createdAt: $post->created_at,
            updatedAt: $post->updated_at,
        );
    }

    /**
     * ニュースを保存する
     *
     * @param News $news ニュースEntity
     * @return void
     */
    public function save(News $news): void
    {
        $post = new PostModel();
        $post->id = $news->getId();
        $post->user_id = $news->getUser()->getId();
        $post->title = $news->getTitle();
        $post->body = $news->getBody();
        $post->created_at = $news->getCreatedAt();
        $post->updated_at = $news->getUpdatedAt();
        $post->save();
    }

    /**
     * ニュースIDを生成する
     *
     * @return string ニュースID
     */
    public function generateId(): string
    {
        return self::PREFIX .'-'. uniqid(mt_rand());
    }
}
