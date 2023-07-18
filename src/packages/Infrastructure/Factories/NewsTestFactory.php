<?php

namespace Packages\Infrastructure\Factories;

use DateTimeInterface;
use Packages\Domains\Entities\News;
use Packages\Domains\Interfaces\Repositories\NewsRepositoryInterface;

final class NewsTestFactory
{
    /**
     * NewsTestFactory constructor.
     *
     * @param NewsRepositoryInterface $newsRepository NewsRepositoryInterfaceの実装
     * @param UserTestFactory $userTestFactory UserTestFactoryの実装
     * @param TagTestFactory $tagTestFactory TagTestFactoryの実装
     * @param ImageTestFactory $imageTestFactory ImageTestFactoryの実装
     * @param boolean $isSaveRepository リポジトリに保存するか
     */
    public function __construct(
        private readonly NewsRepositoryInterface $newsRepository,
        private readonly UserTestFactory $userTestFactory,
        private readonly TagTestFactory $tagTestFactory,
        private readonly ImageTestFactory $imageTestFactory,
        private readonly bool $isSaveRepository = true,
    ) {}

    /**
     * NewsEntity のTest生成
     *
     * @return News NewsEntity
     */
    public function create(): News {
        $faker = fake();

        $newsId = $this->newsRepository->generateId();
        $news = new News(
            id: $newsId,
            author: $this->userTestFactory->create(),
            title: $faker->title(),
            body: $faker->text(),
            createdAt: $faker->dateTime()->format(DateTimeInterface::ATOM),
            updatedAt: $faker->dateTime()->format(DateTimeInterface::ATOM),
            tags: $this->tagTestFactory->create(),
            images: $this->imageTestFactory->create(),
        );

        if ($this->isSaveRepository) $this->newsRepository->save($news);

        return $news;
    }

    /**
     * 複数のNewsEntityのTest生成
     *
     * @param int $size 生成する数
     * @return array NewsEntityの配列
     */
    public function createMultiple(int $size): array {
        $newsList = [];
        for ($i = 0; $i < $size; $i++) {
            $news = $this->create();
            $newsList[$news->getId()] = $news;
        }
        return $newsList;
    }
}
