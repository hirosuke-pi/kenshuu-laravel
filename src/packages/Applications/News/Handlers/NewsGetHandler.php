<?php

namespace Packages\Applications\News\Handlers;

use Packages\Applications\News\Requests\NewsGetRequest;
use Packages\Applications\News\Responses\NewsGetResponse;
use Packages\Applications\News\Interfaces\NewsGetInterface;
use Packages\Domains\Interfaces\Repositories\NewsRepositoryInterface;

final class NewsGetHandler implements NewsGetInterface
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
     * @param NewsGetRequest $request ニュース取得リクエスト
     * @return NewsGetResponse ニュース取得レスポンス
     */
    public function handle(NewsGetRequest $request): NewsGetResponse
    {
        return new NewsGetResponse(
            news: $this->repository->find($request->getNewsId())
        );
    }
}
