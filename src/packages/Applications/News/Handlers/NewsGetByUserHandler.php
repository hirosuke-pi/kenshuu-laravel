<?php

namespace Packages\Applications\News\Handlers;

use Packages\Applications\News\Requests\NewsGetByUserRequest;
use Packages\Applications\News\Interfaces\NewsGetByUserInterface;
use Packages\Applications\News\Responses\NewsGetAllResponse;
use Packages\Domains\Interfaces\Repositories\NewsRepositoryInterface;

final class NewsGetByUserHandler implements NewsGetByUserInterface
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
     * @param NewsGetByUserRequest $request ニュース取得リクエスト
     * @return NewsGetAllResponse ニュース取得レスポンス
     */
    public function handle(NewsGetByUserRequest $request): NewsGetAllResponse
    {
        return new NewsGetAllResponse(
            newsEntities: $this->repository->findByUser($request->getAuthor())
        );
    }
}
