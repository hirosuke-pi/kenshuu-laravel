<?php

namespace Packages\Applications\News\Interfaces;

use Packages\Applications\News\Requests\NewsGetAllRequest;
use Packages\Applications\News\Responses\NewsGetAllResponse;
use Packages\Domains\Interfaces\Repositories\NewsRepositoryInterface;

interface NewsGetAllInterface
{
    /**
     * ニュース取得ユースケースのコンストラクタ
     *
     * @param NewsRepositoryInterface $repository ニュースリポジトリ
     */
    public function __construct(NewsRepositoryInterface $repository);

    /**
     * ニュースを全件取得するハンドラ
     *
     * @param NewsGetAllRequest $request ニュース取得リクエスト
     * @return NewsGetAllResponse ニュース取得レスポンス
     */
    public function handle(NewsGetAllRequest $request): NewsGetAllResponse;
}
