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
            $newsEntities[] = $newsFactory->createWithUserId(
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

        return $newsFactory->createWithUserId(
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
     * @param NewsFactoryInterface $newsFactory ニュースファクトリ
     * @param User $user ユーザーエンティティ
     * @return array ニュースEntityの配列
     */
    public function findByUser(NewsFactoryInterface $newsFactory, User $user): array {
        $posts = PostModel::where('user_id', $user->getId())->whereNull('deleted_at')->get();
        $newsEntities = [];
        foreach($posts as $post) {
            $newsEntities[] = $newsFactory->create(
                id: $post->id,
                author: $user,
                title: $post->title,
                body: $post->body,
                createdAt: $post->created_at,
                updatedAt: $post->updated_at,
            );
        }

        return $newsEntities;
    }

    /**
     * ニュースを保存する
     *
     * @param News $news ニュースEntity
     * @return bool 保存結果
     */
    public function save(News $news): bool
    {
        $post = new PostModel();
        $post->id = $news->getId();
        $post->user_id = $news->getAuthor()->getId();
        $post->title = $news->getTitle();
        $post->body = $news->getBody();
        $post->created_at = $news->getCreatedAt();
        $post->updated_at = $news->getUpdatedAt();
        $result['news'] = $post->save();

        foreach($news->getTags() as $tag) {
            $result[$tag->getId()] = $this->tagRepository->saveWithPostId($tag, $news->getId());
        }

        foreach($news->getImages() as $image) {
            $result[$image->getId()] = $this->imageRepository->save($image, $news->getId());
        }

        return !in_array(false, $result, true);
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
