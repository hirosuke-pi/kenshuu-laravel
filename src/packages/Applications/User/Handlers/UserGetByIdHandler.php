<?php

namespace Packages\Applications\User\Handlers;

use Packages\Applications\User\Requests\UserGetByIdRequest;
use Packages\Applications\User\Responses\UserGetResponse;
use Packages\Applications\User\Interface\UserGetByIdInterface;
use Packages\Domains\Interfaces\Repositories\UserRepositoryInterface;

final class UserGetByIdHandler implements UserGetByIdInterface
{
    /**
     * ユーザーIDからユーザーを取得するコンストラクタ
     *
     * @param UserRepositoryInterface $repository ユーザーリポジトリ
     */
    public function __construct(
        private readonly UserRepositoryInterface $repository
    ) {}

    /**
     * ユーザーIDからユーザーを取得するハンドラ
     *
     * @param UserGetByIdRequest $request ユーザー取得リクエスト
     * @return UserGetResponse ユーザー取得レスポンス
     */
    public function handle(UserGetByIdRequest $request): UserGetResponse
    {
        return new UserGetResponse(
            user: $this->repository->find($request->getUserId())
        );
    }
}
