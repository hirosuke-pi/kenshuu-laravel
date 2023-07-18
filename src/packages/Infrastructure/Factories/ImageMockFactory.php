<?php

namespace Packages\Infrastructure\Factories;

use Packages\Domains\Entities\Image;
use Packages\Domains\Interfaces\Repositories\ImageRepositoryInterface;

final class ImageMockFactory
{
    /**
     * ImageMockFactory constructor.
     *
     * @param ImageRepositoryInterface $imageRepository ImageRepositoryInterfaceの実装
     */
    public function __construct(
        private ImageRepositoryInterface $imageRepository,
    ) {}

    /**
     * ImageEntityのMock生成
     *
     * @return array ImageEntityの配列
     */
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
