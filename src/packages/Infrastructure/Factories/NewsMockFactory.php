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

    public function create(bool $save = true): News {
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
            images: $this->imageMockFactory->create($newsId),
        );

        if ($this->isSaveRepository) $this->newsRepository->save($news);
        return $news;
    }
}
