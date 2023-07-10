<?php

namespace Packages\Infrastructure\Repositories;

use Packages\Domains\Entities\User;
use Packages\Domains\Interfaces\Repositories\ImageRepositoryInterface;
use Packages\Domains\Interfaces\Repositories\NewsRepositoryInterface;
use Packages\Domains\Entities\News;
use Packages\Domains\Interfaces\Factories\NewsFactoryInterface;
use Packages\Domains\Interfaces\Repositories\TagRepositoryInterface;

use App\Models\Post as PostModel;

final class EloquentNewsRepository implements NewsRepositoryInterface
{
    private const PREFIX = 'news';

    /**
     * NewsRepositoryのコンストラクタ
     *
     * @param TagRepositoryInterface $tagRepository タグリポジトリ
     * @param ImageRepositoryInterface $imageRepository 画像リポジトリ
     */
    public function __construct(
        private readonly TagRepositoryInterface $tagRepository,
        private readonly ImageRepositoryInterface $imageRepository
    ) {}

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
     * ユーザーIDに紐づくニュースを取得する
     *
     * @param User $user ユーザーエンティティ
     * @return array ニュースEntityの配列
     */
    public function findByUser(User $user): array {
        $posts = PostModel::where('user_id', $user->getId())->whereNull('deleted_at')->get();
        $newsEntities = [];
        foreach($posts as $post) {
            $newsEntities[] = $this->newsFactory->create(
                id: $post->id,
                userId: $post->user_id,
                title: $post->title,
                body: $post->body,
                createdAt: $post->created_at,
                updatedAt: $post->updated_at,
                user: $user
            );
        }

        return $newsEntities;
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
        $post->user_id = $news->getAuthor()->getId();
        $post->title = $news->getTitle();
        $post->body = $news->getBody();
        $post->created_at = $news->getCreatedAt();
        $post->updated_at = $news->getUpdatedAt();
        $post->save();

        foreach($news->getTags() as $tag) {
            $this->tagRepository->saveWithPostId($tag, $news->getId());
        }

        foreach($news->getImages() as $image) {
            $this->imageRepository->save($image, $news->getId());
        }
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
