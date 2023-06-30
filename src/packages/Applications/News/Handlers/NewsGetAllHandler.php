<?php

namespace Packages\Applications\News\Handlers;

use Packages\Applications\News\Requests\NewsGetAllRequest;
use Packages\Applications\News\UseCases\NewsGetAllUseCase;
use Packages\Applications\News\Responses\NewsGetAllResponse;
use Packages\Domains\Interfaces\Repositories\NewsRepositoryInterface;

final class NewsGetAllHandler implements NewsGetAllUseCase
{
    /**
     * ニュース全件取得ユースケースのコンストラクタ
     *
     * @param NewsRepositoryInterface $repository ニュースリポジトリ
     */
    public function __construct(
        private readonly NewsRepositoryInterface $repository
    ) {}

    /**
     * ニュースを全件取得するハンドラ
     *
     * @param NewsGetAllRequest $request ニュース取得リクエスト
     * @return NewsGetAllResponse ニュース取得レスポンス
     */
    public function handle(NewsGetAllRequest $request): NewsGetAllResponse
    {
        return new NewsGetAllResponse(
            newsEntities: $this->repository->findAll()
        );
    }
}
