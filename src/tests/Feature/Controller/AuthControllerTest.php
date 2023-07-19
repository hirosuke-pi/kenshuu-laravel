<?php
/** @noinspection NonAsciiCharacters */

namespace Tests\Feature\Controller;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Packages\Infrastructure\Factories\UserTestFactory;
use Packages\Infrastructure\Repositories\EloquentUserRepository;
use Tests\TestCase;

class AuthControllerTest extends TestCase
{
    use RefreshDatabase;

    private array $distUsers = [];

    private readonly EloquentUserRepository $repository;

    public function setUp(): void
    {
        parent::setUp();

        $this->repository = new EloquentUserRepository();

        $userTest = new UserTestFactory($this->repository);
        $this->distUsers = $userTest->createMultiple(3);
    }

    public function test_ログインできるか(): void
    {
        foreach($this->distUsers as $user) {
            $response = $this->post('/auth/login', [
                'email' => $user->getEmail(),
                'password' => $user->getRawPassword(),
            ]);
            $response->assertStatus(302);
            $response->assertRedirect('/');
        }
    }

    public function test_不正なメールアドレスの場合、ログインできないか(): void
    {
        foreach($this->distUsers as $user) {
            $response = $this->post('/auth/login', [
                'email' => $user->getEmail() .'dummy',
                'password' => $user->getRawPassword(),
            ]);
            $response->assertStatus(302);
            $response->assertRedirect('/login');
        }

        $response = $this->post('/auth/login', [
            'email' => 'a',
            'password' => $user->getRawPassword(),
        ]);
        $response->assertStatus(302);
        $response->assertRedirect('/login');

        $response = $this->post('/auth/login', [
            'email' => 'a@d.',
            'password' => $user->getRawPassword(),
        ]);
        $response->assertStatus(302);
        $response->assertRedirect('/login');

        $response = $this->post('/auth/login', [
            'password' => $user->getRawPassword(),
        ]);
        $response->assertStatus(302);
        $response->assertRedirect('/login');
    }

    public function test_不正なパスワードの場合、ログインできないか(): void
    {
        foreach($this->distUsers as $user) {
            $response = $this->post('/auth/login', [
                'email' => $user->getEmail(),
                'password' => $user->getRawPassword() .'dummy',
            ]);
            $response->assertStatus(302);
            $response->assertRedirect('/login');

            $response = $this->post('/auth/login', [
                'email' => $user->getEmail(),
            ]);
            $response->assertStatus(302);
            $response->assertRedirect('/login');
        }
    }
}
