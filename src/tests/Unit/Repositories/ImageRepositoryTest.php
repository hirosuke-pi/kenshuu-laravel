<?php

namespace Tests\Unit\Repositories;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Artisan;
use Packages\Domains\Entities\News;
use Packages\Domains\Entities\User;

use Packages\Infrastructure\Factories\RepositoryNewsFactory;
use Packages\Infrastructure\Repositories\EloquentImageRepository;
use Packages\Infrastructure\Repositories\EloquentNewsRepository;
use Packages\Infrastructure\Repositories\EloquentTagRepository;
use Packages\Infrastructure\Repositories\EloquentUserRepository;
use Tests\TestCase;

class ImageRepositoryTest extends TestCase
{
    use RefreshDatabase;

    private array $distUsers = [];
    private array $distNews = [];
    private array $distImages = [];

    private readonly EloquentNewsRepository $repository;

    public function setUp(): void
    {
        parent::setUp();

        $userRepository = new EloquentUserRepository();
        $tagRepository = new EloquentTagRepository();
        $imageRepository = new EloquentImageRepository();

        $this->repository = new EloquentNewsRepository($tagRepository, $imageRepository, $userRepository);

        $this->distUsers['user-test1'] = new User(
            id: 'user-test1',
            name: 'test1',
            email: 'test1@gmail.com',
            password: 'password1',
            profileImagePath: 'test1',
            createdAt: '2021-01-01 00:00:00',
            postsCount: 1,
        );
        $userRepository->save($this->distUsers['user-test1']);

        $this->distUsers['user-test2'] = new User(
            id: 'user-test2',
            name: 'test2',
            email: 'test2@gmail.com',
            password: 'password2',
            profileImagePath: 'test2',
            createdAt: '2022-02-02 00:00:00',
            postsCount: 2,
        );
        $userRepository->save($this->distUsers['user-test2']);

        $this->distNews['news-test1'] = new News(
            id: 'news-test1',
            author: $this->distUsers['user-test1'],
            title: 'test1',
            body: 'test1',
            createdAt: '2021-01-01 00:00:00',
            updatedAt: '2021-01-01 00:00:00',
            tags: [],
            images: [],
        );

        $this->distNews['news-test2'] = new News(
            id: 'news-test2',
            author: $this->distUsers['user-test2'],
            title: 'test2',
            body: 'test2',
            createdAt: '2022-01-01 00:00:00',
            updatedAt: '2022-01-01 00:00:00',
            tags: [],
            images: [],
        );
    }

    public function test_ニュースを保存できるか(): void
    {
        foreach($this->distNews as $news) {
            $this->assertTrue($this->repository->save($news));
            $this->assertDatabaseHas('posts', [
                'id' => $news->getId(),
                'user_id' => $news->getAuthor()->getId(),
                'title' => $news->getTitle(),
                'body' => $news->getBody(),
                'created_at' => $news->getCreatedAt(),
                'updated_at' => $news->getUpdatedAt(),
            ]);
        }
    }

    /**
     * @depends test_ニュースを保存できるか
     */
    public function test_ニュースを全件取得できるか(): void
    {
        foreach($this->distNews as $news) {
            $this->repository->save($news);
        }

        $findAllEntities = $this->repository->findAll();
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
            $this->repository->save($news);
            $newsGet = $this->repository->find($news->getId());

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
            $this->repository->save($news);
        }

        $newsGet = $this->repository->findByUser($news->getAuthor());
        foreach($newsGet as $entity) {
            $this->assertInstanceOf(News::class, $entity);
            $this->assertSame($news->getAuthor()->getId(), $entity->getAuthor()->getId());
        }
    }
}
