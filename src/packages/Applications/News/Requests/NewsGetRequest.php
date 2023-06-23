<?php

namespace Packages\Applications\News\Requests;

final class NewsGetRequest
{
    public function __construct(
        private readonly string $newsId
    ) {}

    public function getNewsId(): string
    {
        return $this->newsId;
    }
}
