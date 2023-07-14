<?php

namespace Packages\Infrastructure\Factories;

use Packages\Domains\Entities\Image;
use Packages\Domains\Interfaces\Repositories\ImageRepositoryInterface;
use Packages\Domains\Interfaces\Repositories\TagRepositoryInterface;

final class ImageMockFactory
{
    public function __construct(
        private ImageRepositoryInterface $imageRepository,
        private bool $isSaveRepository = true,
    ) {}

    public function create(string $postId): array {
        $facker = fake();
        $size = $facker->numberBetween(0, 10);
        $images = [];

        for ($i = 0; $i < $size; $i++) {
            $image = new Image(
                id: $this->imageRepository->generateId(),
                isThumbnail: false,
                filePath: $facker->imageUrl(),
            );
            if ($this->isSaveRepository) $this->imageRepository->save($image, $postId);
            $images[] = $image;
        }

        return $images;
    }
}
