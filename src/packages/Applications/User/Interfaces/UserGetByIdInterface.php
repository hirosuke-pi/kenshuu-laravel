<?php

namespace Packages\Applications\User\Interface;

use Packages\Applications\User\Requests\UserGetByIdRequest;
use Packages\Applications\User\Responses\UserGetResponse;

use Packages\Domains\Interfaces\Repositories\UserRepositoryInterface;

interface UserGetByIdInterface
{
    /**
     * ユーザーIDからユーザーを取得するコンストラクタ
     *
     * @param UserRepositoryInterface $repository ユーザーリポジトリ
     */
    public function __construct(UserRepositoryInterface $repository);

    /**
     * ユーザーIDからユーザーを取得する
     *
     * @param UserGetByIdRequest $request ユーザー取得リクエスト
     * @return UserGetResponse ユーザー取得レスポンス
     */
    public function handle(UserGetByIdRequest $request): UserGetResponse;
}
