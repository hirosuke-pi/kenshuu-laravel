<?php

namespace App\Domains\Entities;

use DateTime;
use App\Domains\Entities\Tag;
use App\Domains\Entities\Image;
use App\Domains\Entities\User;

class News
{
    public function __construct(
        private string $id,
        private User $user,

        private string $title,
        private string $body,
        private string $createdAt,
        private ?string $updatedAt,

        private array $tags,
        private array $images,
    ) {}

    public function edit(string $title, string $body): void
    {
        $this->title = $title;
        $this->body = $body;
        $this->updatedAt = (new DateTime())->format(DateTime::ATOM);
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function getUser(): User {
        return $this->user;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function getBody(): string
    {
        return $this->body;
    }

    public function getCreatedAt(): string
    {
        return $this->createdAt;
    }

    public function getUpdatedAt(): ?string
    {
        return $this->updatedAt;
    }

    public function getThumbnailImageUrl(): ?string
    {
        foreach($this->images as $image) {
            if ($image->isThumbnail()) {
                return $image->getUrl();
            }
        }
        return null;
    }

    public function applyTags(array $tags): void
    {
        $this->tags = [];
        foreach($tags as $tag) {
            $this->tags[$tag->getId()] = $tag;
        }
    }

    public function applyImages(array $images): void
    {
        $this->images = [];
        foreach($images as $image) {
            $this->images[$image->getId()] = $image;
        }
    }
}
