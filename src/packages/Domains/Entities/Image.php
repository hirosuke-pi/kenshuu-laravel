<?php

namespace Packages\Domains\Entities;

final class Image {
    private const BASE_NEWS_IMAGE_URL = '/img/news/';

    public function __construct(
        private string $id,
        private bool $isThumbnail,
        private string $filePath,
    ) {}

    public function getId(): string
    {
        return $this->id;
    }

    public function isThumbnail(): bool
    {
        return $this->isThumbnail;
    }

    public function getUrl(): string
    {
        return self::BASE_NEWS_IMAGE_URL . $this->id . '.' . $this->filePath;
    }
}
