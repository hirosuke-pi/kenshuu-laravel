<?php

namespace Packages\Infrastructure\Factories;

use DateTimeInterface;
use Packages\Domains\Entities\User;
use Packages\Domains\Interfaces\Repositories\UserRepositoryInterface;

final class UserMockFactory
{
    private string $password = '';

    public function __construct(
        private readonly UserRepositoryInterface $userRepository,
        private bool $isSaveRepository = true,
    ) {}

    public function create(): User {
        $facker = fake();
        $this->password = $facker->password();

        $user = new User(
            id: $this->userRepository->generateId(),
            name: $facker->name(),
            email: $facker->email(),
            password: $this->userRepository->hashPassword($this->password),
            profileImagePath: $facker->imageUrl(),
            createdAt: $facker->dateTime()->format(DateTimeInterface::ATOM),
            postsCount: 0,
            rawPassword: $this->password,
        );
        if ($this->isSaveRepository) $this->userRepository->save($user);

        return $user;
    }

    public function createMultiple(int $size): array {
        $users = [];
        for ($i = 0; $i < $size; $i++) {
            $user = $this->create();
            $users[$user->getId()] = $user;
        }
        return $users;
    }
}
