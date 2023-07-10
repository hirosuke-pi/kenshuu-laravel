<?php

namespace Packages\Applications\News\Requests;

use DateTime;
use Packages\Domains\Entities\News;
use Packages\Domains\Entities\User;
use Packages\Domains\Interfaces\Repositories\NewsRepositoryInterface;

final class NewsCreateRequest
{
    /**
     * ニュース作成リクエストのコンストラクタ
     *
     * @param string $title タイトル
     * @param string $body 本文
     * @param User $user ユーザーEntity
     * @param array $tags タグEntityの配列
     * @param array $images 画像Entityの配列
     */
    public function __construct(
        private readonly string $title,
        private readonly string $body,
        private readonly User $user,
        private readonly array $tags,
        private readonly array $images,
    ) {}

    /**
     * ニュースEntityを生成する
     *
     * @param NewsRepositoryInterface $repository ニュースリポジトリ
     * @return News ニュースEntity
     */
    public function generateNews(NewsRepositoryInterface $repository): News
    {
        return new News(
            id: $repository->generateId(),
            author: $this->user,
            title: $this->title,
            body: $this->body,
            createdAt: (new DateTime())->format(DateTime::ATOM),
            updatedAt: null,
            tags: $this->tags,
            images: $this->images,
        );
    }
}
