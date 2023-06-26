<?php

namespace Packages\Applications\User\Handlers;

use Packages\Applications\User\Requests\UserGetByEmailRequest;
use Packages\Applications\User\Responses\UserGetResponse;
use Packages\Applications\User\UseCases\UserGetByEmailUseCase;
use Packages\Domains\Interfaces\Repositories\UserRepository;

final class UserGetByEmailHandler implements UserGetByEmailUseCase
{
    /**
     * メールアドレスからユーザーを取得するコンストラクタ
     *
     * @param UserRepository $repository ユーザーリポジトリ
     */
    public function __construct(
        private readonly UserRepository $repository
    ) {}

    /**
     * メールアドレスからユーザーを取得するハンドラ
     *
     * @param UserGetByEmailRequest $request ユーザー取得リクエスト
     * @return UserGetResponse ユーザー取得レスポンス
     */
    public function handle(UserGetByEmailRequest $request): UserGetResponse
    {
        return new UserGetResponse(
            user: $this->repository->findByEmail($request->getEmail())
        );
    }
}
