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

class NewsGetRepositoryTest extends TestCase
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

    public function test_ニュースを全件取得できるか(): void
    {
        $findAllEntities = $this->newsRepository->findAll();
        $this->assertIsArray($findAllEntities);
        foreach($findAllEntities as $entity) {
            $this->assertInstanceOf(News::class, $entity);
            $newsId = $entity->getId();

            if (isset($this->distNews[$newsId])) {
                $this->assertSame($newsId, $this->distNews[$newsId]->getId());
            }
        }
    }

    public function test_IDを指定してニュースを取得できるか(): void
    {
        foreach($this->distNews as $news) {
            $newsGet = $this->newsRepository->find($news->getId());

            $this->assertInstanceOf(News::class, $newsGet);
            $this->assertSame($news->getId(), $newsGet->getId());
        }
    }

    public function test_Userを指定してニュースを取得できるか(): void
    {
        foreach($this->distNews as $news) {
            $newsGet = $this->newsRepository->findByUser($news->getAuthor());
            $this->assertIsArray($newsGet);
            foreach($newsGet as $entity) {
                $this->assertInstanceOf(News::class, $entity);
                $this->assertSame($news->getAuthor()->getId(), $entity->getAuthor()->getId());
            }
        }
    }
}
