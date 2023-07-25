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

class NewsSaveRepositoryTest extends TestCase
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
        $newsTest = new NewsTestFactory($this->newsRepository, $userTest, $tagTest, $imageTest, false);
        $this->distNews = $newsTest->createMultiple(10);
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

    public function test_保存したニュースを編集する事ができるか(): void
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

        foreach($this->distNews as $news) {
            $newNews = new News(
                id: $news->getId(),
                author: $news->getAuthor(),
                title: $news->getTitle() . '編集後A',
                body: $news->getBody() . '編集後B',
                createdAt: $news->getCreatedAt(),
                updatedAt: $news->getUpdatedAt(),
                tags: $news->getTags(),
                images: $news->getImages(),
            );
            $this->assertTrue($this->newsRepository->save($newNews));
            $this->assertDatabaseHas('posts', [
                'id' => $news->getId(),
                'user_id' => $news->getAuthor()->getId(),
                'title' => $news->getTitle() . '編集後A',
                'body' => $news->getBody() . '編集後B',
            ]);
        }
    }
}
