<?php

namespace Packages\Applications\News\Interfaces;

use Packages\Applications\News\Requests\NewsGetByUserRequest;
use Packages\Applications\News\Responses\NewsGetAllResponse;
use Packages\Domains\Interfaces\Repositories\NewsRepositoryInterface;

interface NewsGetByUserInterface
{
    /**
     * ユーザーIDからニュースを取得するユースケースのコンストラクタ
     *
     * @param NewsRepositoryInterface $repository ニュースリポジトリ
     */
    public function __construct(NewsRepositoryInterface $repository);

    /**
     * ユーザーIDからニュースを取得するハンドラ
     *
     * @param NewsGetByUserRequest $request ニュース取得リクエスト
     * @return NewsGetAllResponse ニュース取得レスポンス
     */
    public function handle(NewsGetByUserRequest $request): NewsGetAllResponse;
}
