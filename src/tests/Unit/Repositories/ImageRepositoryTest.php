<?php
/** @noinspection NonAsciiCharacters */

namespace Tests\Unit\Repositories;

use Illuminate\Foundation\Testing\RefreshDatabase;

use Packages\Infrastructure\Factories\ImageTestFactory;
use Packages\Infrastructure\Factories\NewsTestFactory;
use Packages\Infrastructure\Factories\TagTestFactory;
use Packages\Infrastructure\Factories\UserTestFactory;
use Packages\Infrastructure\Repositories\EloquentImageRepository;
use Packages\Infrastructure\Repositories\EloquentNewsRepository;
use Packages\Infrastructure\Repositories\EloquentTagRepository;
use Packages\Infrastructure\Repositories\EloquentUserRepository;
use Tests\TestCase;

class ImageRepositoryTest extends TestCase
{
    use RefreshDatabase;

    private array $distNews = [];

    private readonly EloquentImageRepository $imageRepository;

    public function setUp(): void
    {
        parent::setUp();

        $userRepository = new EloquentUserRepository();
        $tagRepository = new EloquentTagRepository();
        $this->imageRepository = new EloquentImageRepository();
        $newsRepository = new EloquentNewsRepository($tagRepository, $this->imageRepository, $userRepository);

        $userTest = new UserTestFactory($userRepository);
        $tagTest = new TagTestFactory($tagRepository);
        $imageTest = new ImageTestFactory($this->imageRepository);
        $newsTest = new NewsTestFactory($newsRepository, $userTest, $tagTest, $imageTest);
        $this->distNews = $newsTest->createMultiple(10);
    }

    public function test_画像IDから画像を取得できるか(): void
    {
        foreach($this->distNews as $news) {
            foreach ($news->getImages() as $image) {
                $imageEntity = $this->imageRepository->find($image->getId());
                $this->assertNotNull($imageEntity);
                $this->assertSame($image->getId(), $imageEntity->getId());
            }
        }
    }

    public function test_ニュースに対応する画像を取得できるか(): void
    {
        foreach($this->distNews as $news) {
            $imageEntities = $this->imageRepository->findByPostId($news->getId()) ?? [];
            $this->assertSame(count($news->getImages()), count($imageEntities));
        }
    }
}
