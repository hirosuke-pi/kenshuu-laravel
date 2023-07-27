<?php

/** @noinspection NonAsciiCharacters */

namespace Tests\Feature\Controller;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\UploadedFile;
use Packages\Domains\Entities\User;
use Packages\Infrastructure\Factories\UserTestFactory;
use Packages\Infrastructure\Repositories\EloquentUserRepository;
use Tests\TestCase;

class AuthControllerRegisterTest extends TestCase
{
    use RefreshDatabase;

    private array $distUsers = [];
    private User $distUser;

    private readonly EloquentUserRepository $repository;

    public function setUp(): void
    {
        parent::setUp();

        $this->repository = new EloquentUserRepository();

        $userTest = new UserTestFactory($this->repository, false);
        $this->distUsers = $userTest->createMultiple(3);
        $this->distUser = $userTest->create();
    }

    public function test_ユーザー登録できるか(): void
    {
        foreach($this->distUsers as $user) {
            $response = $this->post('/register', [
                'username' => $user->getName(),
                'email' => $user->getEmail(),
                'password' => $user->getRawPassword(),
                'password_confirmation' => $user->getRawPassword(),
            ]);
            $response->assertStatus(302);
            $response->assertRedirect('/');
        }
    }

    public function test_サムネイル付きでユーザー登録できるか(): void
    {
        foreach($this->distUsers as $user) {
            $response = $this->post('/register', [
                'username' => $user->getName(),
                'email' => $user->getEmail(),
                'password' => $user->getRawPassword(),
                'password_confirmation' => $user->getRawPassword(),
                'input-user-thumbnail' => UploadedFile::fake()->image($user->getProfileImagePath()),
            ]);
            $response->assertStatus(302);
            $response->assertRedirect('/');
        }
    }

    public function test_不正なサムネイル画像はユーザー登録できないか(): void
    {
        foreach($this->distUsers as $user) {
            $response = $this->post('/register', [
                'username' => $user->getName(),
                'email' => $user->getEmail(),
                'password' => $user->getRawPassword(),
                'password_confirmation' => $user->getRawPassword(),
                'input-user-thumbnail' => UploadedFile::fake()->create('test.txt', 1),
            ]);
            $response->assertStatus(302);
            $response->assertRedirect('/register');
        }
    }

    public function test_不正なユーザー名の場合、ユーザー登録できないか(): void
    {
        foreach($this->distUsers as $user) {
            $response = $this->post('/register', [
                'username' => $user->getName() . fake()->text(),
                'email' => $user->getEmail(),
                'password' => $user->getRawPassword(),
                'password_confirmation' => $user->getRawPassword(),
                'input-user-thumbnail' => UploadedFile::fake()->create('test.txt', 1),
            ]);
            $response->assertStatus(302);
            $response->assertRedirect('/register');
        }
    }

    public function test_不正なメールアドレスの場合、ユーザー登録できないか(): void
    {
        foreach($this->distUsers as $user) {
            $response = $this->post('/register', [
                'username' => $user->getName(),
                'email' => fake()->text(),
                'password' => $user->getRawPassword(),
                'password_confirmation' => $user->getRawPassword(),
                'input-user-thumbnail' => UploadedFile::fake()->create('test.txt', 1),
            ]);
            $response->assertStatus(302);
            $response->assertRedirect('/register');
        }
    }

    public function test_不正なパスワードの場合、ユーザー登録できないか(): void
    {
        $user = $this->distUser;
        $response = $this->post('/register', [
            'username' => $user->getName(),
            'email' => fake()->text(),
            'password' => 'a',
            'password_confirmation' => $user->getRawPassword(),
            'input-user-thumbnail' => UploadedFile::fake()->create('test.txt', 1),
        ]);
        $response->assertStatus(302);
        $response->assertRedirect('/register');

        $response = $this->post('/register', [
            'username' => $user->getName(),
            'email' => fake()->text(),
            'password' => 'a',
            'password_confirmation' => 'a',
            'input-user-thumbnail' => UploadedFile::fake()->create('test.txt', 1),
        ]);
        $response->assertStatus(302);
        $response->assertRedirect('/register');
    }
}
