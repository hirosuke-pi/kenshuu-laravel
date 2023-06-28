<?php

namespace Packages\Domains\Interfaces\Factories;

use Packages\Domains\Interfaces\Repositories\UserRepository;
use Packages\Domains\Interfaces\Repositories\TagRepository;
use Packages\Domains\Interfaces\Repositories\ImageRepository;
use Packages\Domains\Entities\News;

interface NewsFactory {
    /**
     * NewsFactoryのコンストラクタ
     *
     * @param UserRepository $userRepository ユーザーリポジトリ
     * @param TagRepository $newsRepository タグリポジトリ
     * @param ImageRepository $imageRepository 画像リポジトリ
     */
    public function __construct(UserRepository $userRepository, TagRepository $newsRepository, ImageRepository $imageRepository);

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
    public function create(string $id, string $userId, string $title, string $body, string $createdAt, string $updatedAt): News;
}
