<?php

namespace Packages\Applications\News\Responses;

use Packages\Domains\Entities\News;

final class NewsGetResponse
{
    /**
     * ニュースを取得するレスポンスのコンストラクタ
     *
     * @param News|null $news ニュース
     */
    public function __construct(
        private readonly ?News $news
    ) {}

    /**
     * ニュースを取得する
     *
     * @return News|null ニュースエンティティ
     */
    public function getNews(): ?News
    {
        return $this->news;
    }

    /**
     * ニュースを保持しているか
     *
     * @return boolean 保持しているか
     */
    public function hasNews(): bool
    {
        return !is_null($this->news);
    }
}
