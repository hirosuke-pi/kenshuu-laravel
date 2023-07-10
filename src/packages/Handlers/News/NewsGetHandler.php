<?php

namespace Packages\Handlers\News;

use Packages\Domains\Entities\News;
use Packages\Domains\Interfaces\Repositories\NewsRepositoryInterface;

final class NewsGetHandler
{
    /**
     * ニュース取得ユースケースのコンストラクタ
     *
     * @param NewsRepositoryInterface $repository ニュースリポジトリ
     */
    public function __construct(
        private readonly NewsRepositoryInterface $repository
    ) {}

    /**
     * ニュースを取得するハンドラ
     *
     * @param string $newsId ニュースID
     * @return News|null ニュースEntity
     */
    public function handle(string $newsId): ?News
    {
        return $this->repository->find($newsId);
    }
}
