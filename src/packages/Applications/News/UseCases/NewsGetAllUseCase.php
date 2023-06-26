<?php

namespace Packages\Applications\News\UseCases;

use Packages\Applications\News\Requests\NewsGetAllRequest;
use Packages\Applications\News\Responses\NewsGetAllResponse;
use Packages\Domains\Interfaces\Repositories\NewsRepository;

interface NewsGetAllUseCase
{
    /**
     * ニュース取得ユースケースのコンストラクタ
     *
     * @param NewsRepository $repository ニュースリポジトリ
     */
    public function __construct(NewsRepository $repository);

    /**
     * ニュースを全件取得するハンドラ
     *
     * @param NewsGetAllRequest $request ニュース取得リクエスト
     * @return NewsGetAllResponse ニュース取得レスポンス
     */
    public function handle(NewsGetAllRequest $request): NewsGetAllResponse;
}
