<?php

namespace Packages\Applications\News\UseCases;

use Packages\Applications\News\Requests\NewsCreateRequest;
use Packages\Applications\News\Responses\NewsCreateResponse;
use Packages\Domains\Interfaces\Repositories\NewsRepository;

interface NewsCreateUseCase
{
    /**
     * ニュース作成ユースケースのコンストラクタ
     *
     * @param NewsRepository $repository ニュースリポジトリ
     */
    public function __construct(NewsRepository $repository);

    /**
     * ニュースを作成するハンドラ
     *
     * @param NewsCreateRequest $request ニュース取得リクエスト
     * @return NewsCreateResponse ニュース取得レスポンス
     */
    public function handle(NewsCreateRequest $request): NewsCreateResponse;
}
