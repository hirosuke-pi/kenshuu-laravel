<?php

namespace Packages\Applications\News\Responses;

use Packages\Domains\Entities\News;

final class NewsGetResponse
{
    public function __construct(
        private readonly ?News $news
    ) {}

    public function getNews(): ?News
    {
        return $this->news;
    }

    public function hasNews(): bool
    {
        return !is_null($this->news);
    }
}
