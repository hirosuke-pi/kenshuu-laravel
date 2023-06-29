<?php

namespace Packages\Infrastructure\Repositories;

use Packages\Domains\Interfaces\Repositories\ImageRepository;
use Packages\Domains\Interfaces\Repositories\NewsRepository;
use Packages\Domains\Entities\News;
use Packages\Domains\Interfaces\Factories\NewsFactory;
use Packages\Domains\Interfaces\Repositories\TagRepository;
use Packages\Domains\Interfaces\Repositories\UserRepository;
use Packages\Infrastructure\Factories\RepositoryNewsFactory;

final class EloquentNewsRepository implements NewsRepository
{
    private const PREFIX = 'news';
    private NewsFactory $newsFactory;

    /**
     * NewsRepositoryのコンストラクタ
     *
     * @param UserRepository $userRepository ユーザーリポジトリ
     * @param TagRepository $tagRepository タグリポジトリ
     * @param ImageRepository $imageRepository 画像リポジトリ
     */
    public function __construct(
        private readonly UserRepository $userRepository,
        private readonly TagRepository $tagRepository,
        private readonly ImageRepository $imageRepository
    ) {
        $this->newsFactory = new RepositoryNewsFactory(
            userRepository: $this->userRepository,
            tagRepository: $this->tagRepository,
            imageRepository: $this->imageRepository,
        );
    }

    /**
     * ニュースを全件取得する
     *
     * @return array
     */
    public function findAll(): array
    {
        $posts = \App\Models\Post::whereNull('deleted_at')->get();
        $newsEntities = [];
        foreach($posts as $post) {
            $newsEntities[] = $this->newsFactory->create(
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
     * @param string $id ニュースID
     * @return News|null ニュースEntity
     */
    public function find(string $id): ?News
    {
        $post = \App\Models\Post::whereNull('deleted_at')->find($id);
        if (is_null($post)) {
            return null;
        }

        return $this->newsFactory->create(
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
        $post = new \App\Models\Post();
        $post->id = $news->getId();
        $post->user_id = $news->getUser()->getId();
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
