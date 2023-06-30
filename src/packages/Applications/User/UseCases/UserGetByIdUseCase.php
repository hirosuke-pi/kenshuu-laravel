<?php

namespace Packages\Applications\User\UseCases;

use Packages\Applications\User\Requests\UserGetByIdRequest;
use Packages\Applications\User\Responses\UserGetResponse;

use Packages\Domains\Interfaces\Repositories\UserRepository;

interface UserGetByIdUseCase
{
    /**
     * ユーザーIDからユーザーを取得するコンストラクタ
     *
     * @param UserRepository $repository ユーザーリポジトリ
     */
    public function __construct(UserRepository $repository);

    /**
     * ユーザーIDからユーザーを取得する
     *
     * @param UserGetByIdRequest $request ユーザー取得リクエスト
     * @return UserGetResponse ユーザー取得レスポンス
     */
    public function handle(UserGetByIdRequest $request): UserGetResponse;
}
