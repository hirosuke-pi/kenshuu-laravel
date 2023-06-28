<?php

namespace Packages\Infrastructure\Factories;

use Packages\Domains\Interfaces\Factories\NewsFactory;
use Packages\Domains\Interfaces\Repositories\ImageRepository;
use Packages\Domains\Interfaces\Repositories\TagRepository;
use Packages\Domains\Interfaces\Repositories\UserRepository;
use Packages\Domains\Entities\News;

final class RepositoryNewsFactory implements NewsFactory
{
    /**
     * NewsFactoryのコンストラクタ
     *
     * @param UserRepository $userRepository ユーザーリポジトリ
     * @param TagRepository $tagRepository タグリポジトリ
     * @param ImageRepository $imageRepository 画像リポジトリ
     */
    public function __construct(
        private UserRepository $userRepository,
        private TagRepository $tagRepository,
        private ImageRepository $imageRepository,
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
     * @return News ニュースEntity
     */
    public function create(string $id, string $userId, string $title, string $body, string $createdAt, ?string $updatedAt): News
    {
        return new News(
            id: $id,
            user: $this->userRepository->find($userId),
            title: $title,
            body: $body,
            tags: $this->tagRepository->findByPostId($id),
            images: $this->imageRepository->findByPostId($id),
            createdAt: $createdAt,
            updatedAt: $updatedAt,
        );
    }
}
