<?php

namespace Packages\Handlers\News;

use Illuminate\Support\Facades\DB;
use Packages\Domains\Entities\News;
use Packages\Domains\Interfaces\Repositories\NewsRepositoryInterface;

final class NewsEditHandler
{
    /**
     * ニュースを編集するハンドラのコンストラクタ
     *
     * @param NewsRepositoryInterface $repository ニュースリポジトリ
     */
    public function __construct(
        private readonly NewsRepositoryInterface $repository,
    ) {}

    /**
     * ニュースを編集するハンドラ
     *
     * @param News $news タイトル
     * @return bool 成功したかどうか
     */
    public function handle(News $news): bool
    {
        return DB::transaction(function () use ($news) {
            return $this->repository->save($news);
        });
    }
}
