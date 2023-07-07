<?php

namespace Packages\Applications\News\Interfaces;

use Packages\Applications\News\Requests\NewsCreateRequest;
use Packages\Applications\News\Responses\NewsCreateResponse;
use Packages\Domains\Interfaces\Repositories\NewsRepositoryInterface;

interface NewsCreateInterface
{
    /**
     * ニュース作成ユースケースのコンストラクタ
     *
     * @param NewsRepositoryInterface $repository ニュースリポジトリ
     */
    public function __construct(NewsRepositoryInterface $repository);

    /**
     * ニュースを作成するハンドラ
     *
     * @param NewsCreateRequest $request ニュース取得リクエスト
     * @return NewsCreateResponse ニュース取得レスポンス
     */
    public function handle(NewsCreateRequest $request): NewsCreateResponse;
}
