<?php

namespace Packages\Infrastructure\Factories;

use DateTimeInterface;
use Packages\Domains\Entities\News;
use Packages\Domains\Interfaces\Repositories\NewsRepositoryInterface;

final class NewsMockFactory
{
    /**
     * NewsMockFactory constructor.
     *
     * @param NewsRepositoryInterface $newsRepository NewsRepositoryInterfaceの実装
     * @param UserMockFactory $userMockFactory UserMockFactoryの実装
     * @param TagMockFactory $tagMockFactory TagMockFactoryの実装
     * @param ImageMockFactory $imageMockFactory ImageMockFactoryの実装
     * @param boolean $isSaveRepository リポジトリに保存するか
     */
    public function __construct(
        private readonly NewsRepositoryInterface $newsRepository,
        private readonly UserMockFactory $userMockFactory,
        private readonly TagMockFactory $tagMockFactory,
        private readonly ImageMockFactory $imageMockFactory,
        private bool $isSaveRepository = true,
    ) {}

    /**
     * NewsEntity のMock生成
     *
     * @return News NewsEntity
     */
    public function create(): News {
        $facker = fake();

        $newsId = $this->newsRepository->generateId();
        $news = new News(
            id: $newsId,
            author: $this->userMockFactory->create(),
            title: $facker->title(),
            body: $facker->text(),
            createdAt: $facker->dateTime()->format(DateTimeInterface::ATOM),
            updatedAt: $facker->dateTime()->format(DateTimeInterface::ATOM),
            tags: $this->tagMockFactory->create(),
            images: $this->imageMockFactory->create(),
        );

        if ($this->isSaveRepository) $this->newsRepository->save($news);

        return $news;
    }

    /**
     * 複数のNewsEntityのMock生成
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
