<?php

namespace Packages\Applications\News\Interfaces;

use Packages\Applications\News\Requests\NewsGetRequest;
use Packages\Applications\News\Responses\NewsGetResponse;
use Packages\Domains\Interfaces\Repositories\NewsRepositoryInterface;

interface NewsGetInterface
{
    /**
     * ニュース取得ユースケースのコンストラクタ
     *
     * @param NewsRepositoryInterface $repository ニュースリポジトリ
     */
    public function __construct(NewsRepositoryInterface $repository);

    /**
     * ニュースを取得するハンドラ
     *
     * @param NewsGetRequest $request ニュース取得リクエスト
     * @return NewsGetResponse ニュース取得レスポンス
     */
    public function handle(NewsGetRequest $request): NewsGetResponse;
}
