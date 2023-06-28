<?php

namespace Packages\Applications\News\Handlers;

use Packages\Applications\News\Requests\NewsGetRequest;
use Packages\Applications\News\Responses\NewsGetResponse;
use Packages\Applications\News\UseCases\NewsGetUseCase;
use Packages\Domains\Interfaces\Repositories\NewsRepository;

final class NewsGetHandler implements NewsGetUseCase
{
    /**
     * ニュース取得ユースケースのコンストラクタ
     *
     * @param NewsRepository $repository ニュースリポジトリ
     */
    public function __construct(
        private readonly NewsRepository $repository
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
