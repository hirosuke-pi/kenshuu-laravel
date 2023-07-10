<?php

namespace Packages\Applications\News\Requests;

final class NewsGetRequest
{
    /**
     * ニュースIDからニュースを取得するリクエストのコンストラクタ
     *
     * @param string $newsId ニュースID
     */
    public function __construct(
        private readonly string $newsId
    ) {}

    /**
     * ニュースIDを取得する
     *
     * @return string ニュースID
     */
    public function getNewsId(): string
    {
        return $this->newsId;
    }
}
