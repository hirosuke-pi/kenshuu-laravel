<?php

namespace Packages\Infrastructure\Factories;

use Packages\Domains\Entities\Image;
use Packages\Domains\Interfaces\Repositories\ImageRepositoryInterface;

final class ImageTestFactory
{
    /**
     * ImageTestFactory constructor.
     *
     * @param ImageRepositoryInterface $imageRepository ImageRepositoryInterfaceの実装
     */
    public function __construct(
        private ImageRepositoryInterface $imageRepository,
    ) {}

    /**
     * ImageEntityのTest生成
     *
     * @return array ImageEntityの配列
     */
    public function create(): array {
        $faker = fake();
        $size = $faker->numberBetween(0, 10);
        $images = [];

        for ($i = 0; $i < $size; $i++) {
            $image = new Image(
                id: $this->imageRepository->generateId(),
                isThumbnail: false,
                filePath: $faker->imageUrl(),
            );
            $images[] = $image;
        }

        return $images;
    }
}
