<?php

namespace Tests\Unit\Repositories;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Artisan;
use Packages\Domains\Entities\User;

use \App\Models\User as UserModel;
use Packages\Infrastructure\Repositories\EloquentUserRepository;
use Tests\TestCase;

class UserRepositoryTest extends TestCase
{
    use RefreshDatabase;

    private array $distUsers = [];

    private readonly EloquentUserRepository $repository;

    public function setUp(): void
    {
        parent::setUp();

        $this->repository = new EloquentUserRepository();

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

        $this->distUsers['user-test3'] = new User(
            id: 'user-test3',
            name: 'test3',
            email: 'test3@gmail.com',
            password: 'password3',
            profileImagePath: 'test3',
            createdAt: '2023-03-03 00:00:00',
            postsCount: 3,
        );
    }

    public function test_UserEntityが保存されるか(): void
    {
        foreach($this->distUsers as $distUser) {
            $this->assertTrue($this->repository->save($distUser));
        }
    }

    /**
     * @test
     * @depends test_UserEntityが保存されるか
     */
    public function test_保存したUserEntityをUserIDで取得できるか(): void
    {
        foreach($this->distUsers as $distUser) {
            $this->repository->save($distUser);
        }

        foreach($this->distUsers as $userId => $distUser) {
            $testUser = $this->repository->find($userId);
            $this->assertNotNull($testUser);
            $this->assertSame($distUser->getId(), $testUser->getId());
        }
    }

    /**
     * @test
     * @depends test_UserEntityが保存されるか
     */
    public function test_保存したUserEntityをメールアドレスから取得できるか(): void
    {
        foreach($this->distUsers as $distUser) {
            $this->repository->save($distUser);
        }

        foreach($this->distUsers as $userId => $distUser) {
            $testUser = $this->repository->findByEmail($distUser->getEmail());
            $this->assertNotNull($testUser);
            $this->assertSame($distUser->getId(), $testUser->getId());
        }
    }
}
