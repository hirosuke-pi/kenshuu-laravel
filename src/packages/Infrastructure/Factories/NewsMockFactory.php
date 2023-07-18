<?php

namespace Packages\Infrastructure\Factories;

use DateTimeInterface;
use Packages\Domains\Entities\News;
use Packages\Domains\Interfaces\Repositories\NewsRepositoryInterface;

final class NewsMockFactory
{
    public function __construct(
        private readonly NewsRepositoryInterface $newsRepository,
        private readonly UserMockFactory $userMockFactory,
        private readonly TagMockFactory $tagMockFactory,
        private readonly ImageMockFactory $imageMockFactory,
        private bool $isSaveRepository = true,
    ) {}

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

    public function createMultiple(int $size): array {
        $newsList = [];
        for ($i = 0; $i < $size; $i++) {
            $news = $this->create();
            $newsList[$news->getId()] = $news;
        }
        return $newsList;
    }
}
