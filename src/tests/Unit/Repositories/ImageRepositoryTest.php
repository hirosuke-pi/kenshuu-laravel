<?php

namespace Tests\Unit\Repositories;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Artisan;
use Packages\Domains\Entities\News;
use Packages\Domains\Entities\User;

use Packages\Infrastructure\Factories\ImageMockFactory;
use Packages\Infrastructure\Factories\NewsMockFactory;
use Packages\Infrastructure\Factories\RepositoryNewsFactory;
use Packages\Infrastructure\Factories\TagMockFactory;
use Packages\Infrastructure\Factories\UserMockFactory;
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

        $userMock = new UserMockFactory($userRepository);
        $tagMock = new TagMockFactory($tagRepository);
        $imageMock = new ImageMockFactory($this->imageRepository);
        $newsMock = new NewsMockFactory($newsRepository, $userMock, $tagMock, $imageMock);
        $this->distNews = $newsMock->createMultiple(10);
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
            $imageEntities = $this->imageRepository->findByPostId($news->getId());
            $this->assertSame(count($news->getImages()), count($imageEntities));
        }
    }
}
