<?php

namespace Packages\Domains\Interfaces\Factories;

use Packages\Domains\Interfaces\Repositories\UserRepositoryInterface;
use Packages\Domains\Interfaces\Repositories\TagRepositoryInterface;
use Packages\Domains\Interfaces\Repositories\ImageRepositoryInterface;
use Packages\Domains\Entities\News;

interface NewsFactoryInterface {
    /**
     * NewsFactoryのコンストラクタ
     *
     * @param UserRepositoryInterface $userRepository ユーザーリポジトリ
     * @param TagRepositoryInterface $newsRepository タグリポジトリ
     * @param ImageRepositoryInterface $imageRepository 画像リポジトリ
     */
    public function __construct(UserRepositoryInterface $userRepository, TagRepositoryInterface $newsRepository, ImageRepositoryInterface $imageRepository);

    /**
     * ニュースを生成する
     *
     * @param string $id ニュースID
     * @param string $userId ユーザーID
     * @param string $title タイトル
     * @param string $body 本文
     * @param string $createdAt 作成日時
     * @param string|null $updatedAt 更新日時
     * @return News ニュースEntity
     */
    public function create(string $id, string $userId, string $title, string $body, string $createdAt, ?string $updatedAt): News;
}
