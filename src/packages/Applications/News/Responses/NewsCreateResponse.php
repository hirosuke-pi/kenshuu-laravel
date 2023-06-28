<?php

namespace Packages\Applications\News\Responses;

use Packages\Domains\Entities\News;

final class NewsCreateResponse
{
    /**
     * ニュースを作成するレスポンスのコンストラクタ
     *
     * @param News|null $news ニュース
     */
    public function __construct(
        private readonly News $news
    ) {}

    /**
     * ニュースを取得する
     *
     * @return News ニュースEntity
     */
    public function getNews(): News
    {
        return $this->news;
    }
}
