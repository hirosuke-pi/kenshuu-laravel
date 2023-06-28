<?php

namespace Packages\Applications\News\Handlers;

use Packages\Applications\News\Requests\NewsCreateRequest;
use Packages\Applications\News\Responses\NewsCreateResponse;
use Packages\Applications\News\UseCases\NewsCreateUseCase;
use Packages\Domains\Interfaces\Repositories\NewsRepository;

final class NewsCreateHandler implements NewsCreateUseCase
{
    /**
     * ニュース作成ハンドラのコンストラクタ
     *
     * @param NewsRepository $repository ニュースリポジトリ
     */
    public function __construct(
        private readonly NewsRepository $repository
    ) {}

    /**
     * ニュースを作成するハンドラ
     *
     * @param NewsCreateRequest $request ニュース作成リクエスト
     * @return NewsCreateResponse ニュース作成レスポンス
     */
    public function handle(NewsCreateRequest $request): NewsCreateResponse
    {
        $news = $request->generateNews($this->repository);
        $this->repository->save($news);

        return new NewsCreateResponse(
            news: $news
        );
    }
}
