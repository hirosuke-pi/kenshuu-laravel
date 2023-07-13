<?php

namespace Packages\Handlers\News;

use Packages\Domains\Entities\User;
use Packages\Domains\Interfaces\Repositories\NewsRepositoryInterface;

final class NewsGetByUserHandler
{
    /**
     * ニュース全件取得ユースケースのコンストラクタ
     *
     * @param NewsRepositoryInterface $repository ニュースリポジトリ
     */
    public function __construct(
        private readonly NewsRepositoryInterface $repository,
    ) {}

    /**
     * ニュースを全件取得するハンドラ
     *
     * @param User $user ユーザーEntity
     * @return array ニュースEntityの配列
     */
    public function handle(User $user): array
    {
        return $this->repository->findByUser($user);
    }
}
