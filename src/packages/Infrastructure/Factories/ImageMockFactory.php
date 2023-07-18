<?php

namespace Packages\Infrastructure\Factories;

use Packages\Domains\Entities\Image;
use Packages\Domains\Interfaces\Repositories\ImageRepositoryInterface;

final class ImageMockFactory
{
    public function __construct(
        private ImageRepositoryInterface $imageRepository,
    ) {}

    public function create(): array {
        $facker = fake();
        $size = $facker->numberBetween(0, 10);
        $images = [];

        for ($i = 0; $i < $size; $i++) {
            $image = new Image(
                id: $this->imageRepository->generateId(),
                isThumbnail: false,
                filePath: $facker->imageUrl(),
            );
            $images[] = $image;
        }

        return $images;
    }
}
