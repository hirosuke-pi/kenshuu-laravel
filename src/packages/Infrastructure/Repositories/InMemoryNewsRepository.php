<?php

namespace Packages\Infrastructure\Repositories;

use Packages\Domains\Entities\User;
use Packages\Domains\Interfaces\Repositories\ImageRepositoryInterface;
use Packages\Domains\Interfaces\Repositories\NewsRepositoryInterface;
use Packages\Domains\Entities\News;
use Packages\Domains\Interfaces\Factories\NewsFactoryInterface;
use Packages\Domains\Interfaces\Repositories\TagRepositoryInterface;

final class InMemoryNewsRepository implements NewsRepositoryInterface
{
    private const PREFIX = 'news';
    private array $news = [];

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
        return $this->news;
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
        return $this->news[$id] ?? null;
    }

    /**
     * ユーザーIDに紐づくニュースを取得する
     *
     * @param NewsFactoryInterface $newsFactory ニュースファクトリ
     * @param User $user ユーザーエンティティ
     * @return array ニュースEntityの配列
     */
    public function findByUser(NewsFactoryInterface $newsFactory, User $user): array {
        $newsEntities = [];
        foreach($this->news as $news) {
            if ($news->getAuthor()->getId() === $user->getId()) {
                $newsEntities[] = $news;
            }
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
        $this->news[$news->getId()] = $news;
        $result[$news->getId()] = true;

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
