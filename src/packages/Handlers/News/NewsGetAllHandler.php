<?php

namespace Packages\Handlers\News;

use Packages\Domains\Interfaces\Factories\NewsFactoryInterface;
use Packages\Domains\Interfaces\Repositories\NewsRepositoryInterface;

final class NewsGetAllHandler
{
    /**
     * ニュース全件取得ユースケースのコンストラクタ
     *
     * @param NewsRepositoryInterface $repository ニュースリポジトリ
     * @param NewsFactoryInterface $factory ニュースファクトリ
     */
    public function __construct(
        private readonly NewsRepositoryInterface $repository,
        private readonly NewsFactoryInterface $newsFactory
    ) {}

    /**
     * ニュースを全件取得するハンドラ
     *
     * @return array $newsEntities ニュースEntityの配列
     */
    public function handle(): array
    {
        return $this->repository->findAll($this->newsFactory);
    }
}
