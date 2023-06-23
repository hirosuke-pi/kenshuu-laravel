<?php

namespace Packages\Applications\News\Responses;

final class NewsGetAllResponse
{
    public function __construct(
        private readonly array $newsEntities
    ) {}

    public function getNewsAll(): array
    {
        return $this->newsEntities;
    }

    public function hasNews(): bool
    {
        return count($this->newsEntities) > 0;
    }
}
