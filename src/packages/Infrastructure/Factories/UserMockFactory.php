<?php

namespace Packages\Infrastructure\Factories;

use DateTimeInterface;
use Packages\Domains\Entities\User;
use Packages\Domains\Interfaces\Repositories\UserRepositoryInterface;

final class UserMockFactory
{
    private string $password = '';

    /**
     * UserMockFactory constructor.
     *
     * @param UserRepositoryInterface $userRepository UserRepositoryInterfaceの実装
     * @param boolean $isSaveRepository リポジトリに保存するか
     */
    public function __construct(
        private readonly UserRepositoryInterface $userRepository,
        private bool $isSaveRepository = true,
    ) {}

    /**
     * UserEntityのMock生成
     *
     * @return User UserEntity
     */
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

    /**
     * 複数のUserEntityのMock生成
     *
     * @param integer $size 生成する数
     * @return array UserEntityの配列
     */
    public function createMultiple(int $size): array {
        $users = [];
        for ($i = 0; $i < $size; $i++) {
            $user = $this->create();
            $users[$user->getId()] = $user;
        }
        return $users;
    }
}
