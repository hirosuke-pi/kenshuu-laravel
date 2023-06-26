<?php

namespace Database\Seeders;

use DateTime;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Packages\Applications\User\Handlers\UserCreateHandler;
use Packages\Applications\User\Requests\UserCreateRequest;
use Packages\Domains\Entities\User;
use Packages\Infrastructure\Repositories\EloquentUserRepository;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $userRepository = new EloquentUserRepository();
        $user = new UserCreateHandler($userRepository);

        $user->handle(
            new UserCreateRequest(
                name: config('app.test.user1.name'),
                email: config('app.test.user1.email'),
                password: config('app.test.user1.password'),
                profileImagePath: null,
            )
        );
    }
}
