<?php

namespace Tests\Unit\Repositories;

use Packages\Domains\Entities\News;
use Packages\Domains\Entities\User;

use Packages\Infrastructure\Factories\RepositoryNewsFactory;
use Packages\Infrastructure\Repositories\EloquentImageRepository;
use Packages\Infrastructure\Repositories\EloquentNewsRepository;
use Packages\Infrastructure\Repositories\EloquentTagRepository;
use Packages\Infrastructure\Repositories\InMemoryUserRepository;
use Tests\TestCase;

class NewsRepositoryTest extends TestCase
{

    private array $distUsers = [];
    private array $distNews = [];

    private readonly EloquentNewsRepository $repository;
    private readonly RepositoryNewsFactory $factory;

    public function setUp(): void
    {
        parent::setUp();

        $userRepository = new InMemoryUserRepository();
        $tagRepository = new EloquentTagRepository();
        $imageRepository = new EloquentImageRepository();

        $this->repository = new EloquentNewsRepository($tagRepository, $imageRepository);
        $this->factory = new RepositoryNewsFactory(
            userRepository: $userRepository,
            tagRepository: $tagRepository,
            imageRepository: $imageRepository
        );

        $this->distUsers['user-test1'] = new User(
            id: 'user-test1',
            name: 'test1',
            email: 'test1@gmail.com',
            password: 'password1',
            profileImagePath: 'test1',
            createdAt: '2021-01-01 00:00:00',
            postsCount: 1,
        );

        $this->distUsers['user-test2'] = new User(
            id: 'user-test2',
            name: 'test2',
            email: 'test2@gmail.com',
            password: 'password2',
            profileImagePath: 'test2',
            createdAt: '2022-02-02 00:00:00',
            postsCount: 2,
        );

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

    public function test_ニュースを全件取得できるか(): void
    {
        $newsEntities = $this->repository->findAll($this->factory);
        $this->assertCount(2, $newsEntities);

        foreach($newsEntities as $newsEntity) {
            $this->assertInstanceOf(News::class, $newsEntity);
            $this->assertSame($newsEntity->getId(), $this->distNews[$newsEntity->getId()]->getId());
        }
    }


}
