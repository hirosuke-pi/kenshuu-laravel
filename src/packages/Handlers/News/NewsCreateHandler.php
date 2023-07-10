<?php

namespace Packages\Handlers\News;

use Packages\Domains\Entities\News;
use Packages\Domains\Entities\User;
use Packages\Domains\Interfaces\Factories\NewsFactoryInterface;
use Packages\Domains\Interfaces\Repositories\NewsRepositoryInterface;

final class NewsCreateHandler
{
    /**
     * ニュース作成ハンドラのコンストラクタ
     *
     * @param NewsRepositoryInterface $repository ニュースリポジトリ
     */
    public function __construct(
        private readonly NewsRepositoryInterface $repository,
        private readonly NewsFactoryInterface $factory
    ) {}

    /**
     * ニュースを作成するハンドラ
     *
     * @param string $title タイトル
     * @param string $body 本文
     * @param User $user ユーザーEntity
     * @param array $tags タグEntityの配列
     * @param array $images 画像Entityの配列
     * @return News ニュースEntity
     */
    public function handle(
        string $title,
        string $body,
        User $user,
        array $tags = [],
        array $images = [],
    ): News
    {
        $news = new $this->factory->createNew(
            author: $user,
            title: $title,
            body: $body,
            tags: $tags,
            images: $images,
        );

        $this->repository->save($news);

        return $news;
    }
}
