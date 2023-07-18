<?php

namespace Tests\Unit\Repositories;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Artisan;
use Packages\Domains\Entities\User;

use \App\Models\User as UserModel;
use Packages\Infrastructure\Factories\UserTestFactory;
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

        $userTest = new UserTestFactory($this->repository, false);
        $this->distUsers = $userTest->createMultiple(10);
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
