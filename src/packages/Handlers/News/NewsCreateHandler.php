<?php

namespace Packages\Handlers\News;

use DateTime;
use DateTimeInterface;
use Packages\Domains\Entities\News;
use Packages\Domains\Entities\User;
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
    ) {}

    /**
     * ニュースを作成するハンドラ
     *
     * @param string $title タイトル
     * @param string $body 本文
     * @param User $author ユーザーEntity
     * @param array $tags タグEntityの配列
     * @param array $images 画像Entityの配列
     * @return News ニュースEntity
     */
    public function handle(
        string $title,
        string $body,
        User $author,
        array $tags = [],
        array $images = [],
    ): News
    {
        $news = new News(
            id: $this->repository->generateId(),
            author: $author,
            title: $title,
            body: $body,
            tags: $tags,
            images: $images,
            createdAt: (new DateTime())->format(DateTimeInterface::ATOM),
            updatedAt: null,
        );

        $this->repository->save($news);

        return $news;
    }
}
