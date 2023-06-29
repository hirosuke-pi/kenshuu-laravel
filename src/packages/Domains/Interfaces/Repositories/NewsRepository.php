<?php

namespace Packages\Domains\Interfaces\Repositories;

use Packages\Domains\Interfaces\Factories\NewsFactory;
use Packages\Domains\Entities\News;

interface NewsRepository
{
    /**
     * NewsRepositoryのコンストラクタ
     *
     * @param UserRepository $userRepository ユーザーリポジトリ
     * @param TagRepository $newsRepository タグリポジトリ
     * @param ImageRepository $imageRepository 画像リポジトリ
     */
    public function __construct(
        UserRepository $userRepository,
        TagRepository $newsRepository,
        ImageRepository $imageRepository
    );

    /**
     * ニュースを全件取得する
     *
     * @return array ニュースEntityの配列
     */
    public function findAll(): array;

    /**
     * ニュースIDからニュースを取得する
     *
     * @param string $id ニュースID
     * @return News|null ニュースEntity
     */
    public function find(string $id): ?News;

    /**
     * ニュースを保存する
     *
     * @param News $news ニュースEntity
     * @return void
     */
    public function save(News $news): void;

    /**
     * ニュースIDを生成する
     *
     * @return string ニュースID
     */
    public function generateId(): string;
}
