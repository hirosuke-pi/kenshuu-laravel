<?php

namespace Packages\Applications\News\UseCases;

use Packages\Applications\News\Requests\NewsGetRequest;
use Packages\Applications\News\Responses\NewsGetResponse;
use Packages\Domains\Interfaces\Repositories\NewsRepository;

interface NewsGetUseCase
{
    /**
     * ニュース取得ユースケースのコンストラクタ
     *
     * @param NewsRepository $repository ニュースリポジトリ
     */
    public function __construct(NewsRepository $repository);

    /**
     * ニュースを取得するハンドラ
     *
     * @param NewsGetRequest $request ニュース取得リクエスト
     * @return NewsGetResponse ニュース取得レスポンス
     */
    public function handle(NewsGetRequest $request): NewsGetResponse;
}
