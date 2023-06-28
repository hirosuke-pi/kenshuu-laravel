<?php

namespace Packages\Applications\User\Handlers;

use Packages\Applications\User\Requests\UserGetByIdRequest;
use Packages\Applications\User\Responses\UserGetResponse;
use Packages\Applications\User\UseCases\UserGetByIdUseCase;
use Packages\Domains\Interfaces\Repositories\UserRepository;

final class UserGetByIdHandler implements UserGetByIdUseCase
{
    /**
     * ユーザーIDからユーザーを取得するコンストラクタ
     *
     * @param UserRepository $repository ユーザーリポジトリ
     */
    public function __construct(
        private readonly UserRepository $repository
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
