<?php

namespace Packages\Infrastructure\Repositories;

use Packages\Domains\Interfaces\Repositories\ImageRepositoryInterface;
use Packages\Domains\Interfaces\Repositories\NewsRepositoryInterface;
use Packages\Domains\Entities\News;
use Packages\Domains\Interfaces\Factories\NewsFactoryInterface;
use Packages\Domains\Interfaces\Repositories\TagRepositoryInterface;
use Packages\Domains\Interfaces\Repositories\UserRepositoryInterface;
use Packages\Infrastructure\Factories\RepositoryNewsFactory;

use App\Models\Post as PostModel;

final class EloquentNewsRepository implements NewsRepositoryInterface
{
    private const PREFIX = 'news';
    private NewsFactoryInterface $newsFactory;

    /**
     * NewsRepositoryのコンストラクタ
     *
     * @param UserRepositoryInterface $userRepository ユーザーリポジトリ
     * @param TagRepositoryInterface $tagRepository タグリポジトリ
     * @param ImageRepositoryInterface $imageRepository 画像リポジトリ
     */
    public function __construct(
        private readonly UserRepositoryInterface $userRepository,
        private readonly TagRepositoryInterface $tagRepository,
        private readonly ImageRepositoryInterface $imageRepository
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

        $posts = PostModel::whereNull('deleted_at')->get();
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
        $post = PostModel::whereNull('deleted_at')->find($id);
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
        $post = new PostModel();
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
