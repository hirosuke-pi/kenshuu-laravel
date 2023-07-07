<?php

namespace Packages\Applications\User\Interfaces;

use Packages\Applications\User\Requests\UserCreateRequest;
use Packages\Applications\User\Responses\UserCreateResponse;
use Packages\Domains\Interfaces\Repositories\UserRepositoryInterface;

interface UserCreateInterface
{
    /**
     * ユーザーを作成するユースケースのコンストラクタ
     *
     * @param UserRepositoryInterface $repository ユーザーリポジトリ
     */
    public function __construct(UserRepositoryInterface $repository);

    /**
     * ユーザーを作成するハンドラ
     *
     * @param UserCreateRequest $request ユーザー作成リクエスト
     * @return UserCreateResponse ユーザー作成レスポンス
     */
    public function handle(UserCreateRequest $request): UserCreateResponse;
}
