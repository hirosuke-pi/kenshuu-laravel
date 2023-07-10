<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use Packages\Handlers\User\UserCreateHandler;
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
            name: config('test.user1.name'),
            email: config('test.user1.email'),
            password: $userRepository->hashPassword(config('test.user1.password')),
            profileImagePath: null,
        );
    }
}
