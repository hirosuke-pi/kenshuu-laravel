<?php

namespace Packages\Handlers\News;

use Packages\Domains\Interfaces\Repositories\NewsRepositoryInterface;

final class NewsGetAllHandler
{
    /**
     * ニュース全件取得ユースケースのコンストラクタ
     *
     * @param NewsRepositoryInterface $repository ニュースリポジトリ
     */
    public function __construct(
        private readonly NewsRepositoryInterface $repository,
    ) {}

    /**
     * ニュースを全件取得するハンドラ
     *
     * @return array $newsEntities ニュースEntityの配列
     */
    public function handle(): array
    {
        return $this->repository->findAll() ?? [];
    }
}
