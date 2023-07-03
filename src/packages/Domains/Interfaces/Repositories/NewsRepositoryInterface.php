<?php

namespace Packages\Domains\Interfaces\Repositories;


use Packages\Domains\Entities\News;
use Packages\Domains\Entities\User;

interface NewsRepositoryInterface
{
    /**
     * NewsRepositoryのコンストラクタ
     *
     * @param UserRepositoryInterface $userRepository ユーザーリポジトリ
     * @param TagRepositoryInterface $newsRepository タグリポジトリ
     * @param ImageRepositoryInterface $imageRepository 画像リポジトリ
     */
    public function __construct(
        UserRepositoryInterface $userRepository,
        TagRepositoryInterface $newsRepository,
        ImageRepositoryInterface $imageRepository
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
     * ユーザーIDに紐づくニュースを取得する
     *
     * @param User $user ユーザーエンティティ
     * @return array ニュースEntityの配列
     */
    public function findByUser(User $user): array;

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