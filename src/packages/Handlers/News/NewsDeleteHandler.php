<?php

namespace Packages\Handlers\News;

use Packages\Domains\Entities\News;
use Packages\Domains\Interfaces\Repositories\NewsRepositoryInterface;

final class NewsDeleteHandler
{
    /**
     * ニュース削除ユースケースのコンストラクタ
     *
     * @param NewsRepositoryInterface $repository ニュースリポジトリ
     */
    public function __construct(
        private readonly NewsRepositoryInterface $repository,
    ) {}

    /**
     * ニュースを削除するハンドラ
     *
     * @param string $newsId ニュースID
     * @return boolean 削除に成功したかどうか
     */
    public function handle(string $newsId): bool
    {
        return $this->repository->remove($newsId);
    }
}
