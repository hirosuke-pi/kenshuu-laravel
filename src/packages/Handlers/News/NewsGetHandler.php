<?php

namespace Packages\Handlers\News;

use Packages\Domains\Entities\News;
use Packages\Domains\Interfaces\Factories\NewsFactoryInterface;
use Packages\Domains\Interfaces\Repositories\NewsRepositoryInterface;

final class NewsGetHandler
{
    /**
     * ニュース取得ユースケースのコンストラクタ
     *
     * @param NewsFactoryInterface $factory ニュースファクトリ
     * @param NewsRepositoryInterface $repository ニュースリポジトリ
     */
    public function __construct(
        private readonly NewsRepositoryInterface $repository,
        private readonly NewsFactoryInterface $newsFactory
    ) {}

    /**
     * ニュースを取得するハンドラ
     *
     * @param string $newsId ニュースID
     * @return News|null ニュースEntity
     */
    public function handle(string $newsId): ?News
    {
        return $this->repository->find($this->newsFactory, $newsId);
    }
}
