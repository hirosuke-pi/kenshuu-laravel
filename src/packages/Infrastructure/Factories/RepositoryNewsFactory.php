<?php

namespace Packages\Infrastructure\Factories;

use Packages\Domains\Entities\User;
use Packages\Domains\Interfaces\Factories\NewsFactoryInterface;
use Packages\Domains\Interfaces\Repositories\ImageRepositoryInterface;
use Packages\Domains\Interfaces\Repositories\TagRepositoryInterface;
use Packages\Domains\Interfaces\Repositories\UserRepositoryInterface;
use Packages\Domains\Entities\News;

final class RepositoryNewsFactory implements NewsFactoryInterface
{
    /**
     * NewsFactoryのコンストラクタ
     *
     * @param UserRepositoryInterface $userRepository ユーザーリポジトリ
     * @param TagRepositoryInterface $tagRepository タグリポジトリ
     * @param ImageRepositoryInterface $imageRepository 画像リポジトリ
     */
    public function __construct(
        private UserRepositoryInterface $userRepository,
        private TagRepositoryInterface $tagRepository,
        private ImageRepositoryInterface $imageRepository,
    ) {}

    /**
     * ニュースを生成する
     *
     * @param string $id ニュースID
     * @param string $userId ユーザーID
     * @param string $title タイトル
     * @param string $body 本文
     * @param string $createdAt 作成日時
     * @param string $updatedAt 更新日時
     * @param User|null $user ユーザーエンティティ
     * @return News ニュースEntity
     */
    public function create(string $id, string $userId, string $title, string $body, string $createdAt, ?string $updatedAt, ?User $user = null): News
    {
        return new News(
            id: $id,
            author: $user ?? $this->userRepository->find($userId),
            title: $title,
            body: $body,
            tags: $this->tagRepository->findByPostId($id),
            images: $this->imageRepository->findByPostId($id),
            createdAt: $createdAt,
            updatedAt: $updatedAt,
        );
    }
}
