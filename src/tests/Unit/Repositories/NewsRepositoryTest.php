<?php

namespace Tests\Unit\Repositories;

use Packages\Domains\Entities\User;

use \App\Models\User as UserModel;
use Packages\Infrastructure\Repositories\EloquentImageRepository;
use Packages\Infrastructure\Repositories\EloquentNewsRepository;
use Packages\Infrastructure\Repositories\EloquentTagRepository;
use Packages\Infrastructure\Repositories\EloquentUserRepository;
use Tests\TestCase;

class PostRepositoryTest extends TestCase
{

    private array $distUsers = [];

    private readonly EloquentUserRepository $repository;

    public function setUp(): void
    {
        parent::setUp();

        $tagRepository = new EloquentTagRepository();
        $imageRepository = new EloquentImageRepository();

        $this->repository = new EloquentNewsRepository($tagRepository, $imageRepository);

        $this->distUsers['user-test1'] = new User(
            id: 'user-test1',
            name: 'test1',
            email: 'test1@gmail.com',
            password: 'password1',
            profileImagePath: 'test1',
            createdAt: '2021-01-01 00:00:00',
            postsCount: 1,
        );
    }
}
