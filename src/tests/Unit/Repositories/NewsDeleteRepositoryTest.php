<?php
/** @noinspection NonAsciiCharacters */

namespace Tests\Unit\Repositories;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Packages\Domains\Entities\News;

use Packages\Infrastructure\Factories\ImageTestFactory;
use Packages\Infrastructure\Factories\NewsTestFactory;
use Packages\Infrastructure\Factories\TagTestFactory;
use Packages\Infrastructure\Factories\UserTestFactory;
use Packages\Infrastructure\Repositories\EloquentImageRepository;
use Packages\Infrastructure\Repositories\EloquentNewsRepository;
use Packages\Infrastructure\Repositories\EloquentTagRepository;
use Packages\Infrastructure\Repositories\EloquentUserRepository;
use Tests\TestCase;

class NewsDeleteRepositoryTest extends TestCase
{
    use RefreshDatabase;

    private array $distNews = [];
    private readonly EloquentNewsRepository $newsRepository;

    public function setUp(): void
    {
        parent::setUp();

        $userRepository = new EloquentUserRepository();
        $tagRepository = new EloquentTagRepository();
        $imageRepository = new EloquentImageRepository();
        $this->newsRepository = new EloquentNewsRepository($tagRepository, $imageRepository, $userRepository);

        $userTest = new UserTestFactory($userRepository);
        $tagTest = new TagTestFactory($tagRepository);
        $imageTest = new ImageTestFactory($imageRepository);
        $newsTest = new NewsTestFactory($this->newsRepository, $userTest, $tagTest, $imageTest);
        $this->distNews = $newsTest->createMultiple(10);
    }

    public function test_ニュースを削除できるか(): void
    {
        foreach($this->distNews as $news) {
            $this->assertTrue($this->newsRepository->remove($news->getId()));
            $this->assertNull($this->newsRepository->find($news->getId()));
        }
    }

    public function test_存在しないニュースを削除できないか(): void
    {
        foreach($this->distNews as $news) {
            $this->assertFalse($this->newsRepository->remove($news->getId() . 'aaaa'));
        }
    }
}
