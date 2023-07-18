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

class NewsRepositoryTest extends TestCase
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

        $userMock = new UserMockFactory($userRepository);
        $tagMock = new TagMockFactory($tagRepository);
        $imageMock = new ImageMockFactory($imageRepository);
        $newsMock = new NewsMockFactory($this->newsRepository, $userMock, $tagMock, $imageMock, false);
        $this->distNews = $newsMock->createMultiple(10);
    }

    public function test_ニュースを保存できるか(): void
    {
        foreach($this->distNews as $news) {
            $this->assertTrue($this->newsRepository->save($news));
            $this->assertDatabaseHas('posts', [
                'id' => $news->getId(),
                'user_id' => $news->getAuthor()->getId(),
                'title' => $news->getTitle(),
                'body' => $news->getBody(),
            ]);
        }
    }

    /**
     * @depends test_ニュースを保存できるか
     */
    public function test_ニュースを全件取得できるか(): void
    {
        foreach($this->distNews as $news) {
            $this->newsRepository->save($news);
        }

        $findAllEntities = $this->newsRepository->findAll();
        foreach($findAllEntities as $entity) {
            $this->assertInstanceOf(News::class, $entity);
            $newsId = $entity->getId();

            if (isset($this->distNews[$newsId])) {
                $this->assertSame($newsId, $this->distNews[$newsId]->getId());
            }
        }
    }

    /**
     * @depends test_ニュースを保存できるか
     */
    public function test_IDを指定してニュースを取得できるか(): void
    {
        foreach($this->distNews as $news) {
            $this->newsRepository->save($news);
            $newsGet = $this->newsRepository->find($news->getId());

            $this->assertInstanceOf(News::class, $newsGet);
            $this->assertSame($news->getId(), $newsGet->getId());
        }
    }

    /**
     * @depends test_ニュースを保存できるか
     */
    public function test_Userを指定してニュースを取得できるか(): void
    {
        foreach($this->distNews as $news) {
            $this->newsRepository->save($news);
        }

        $newsGet = $this->newsRepository->findByUser($news->getAuthor());
        foreach($newsGet as $entity) {
            $this->assertInstanceOf(News::class, $entity);
            $this->assertSame($news->getAuthor()->getId(), $entity->getAuthor()->getId());
        }
    }
}
