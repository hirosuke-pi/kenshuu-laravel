<?php

namespace Packages\Applications\User\Handlers;

use Packages\Applications\User\Requests\UserGetByEmailRequest;
use Packages\Applications\User\Responses\UserGetResponse;
use Packages\Applications\User\Interfaces\UserGetByEmailInterface;
use Packages\Domains\Interfaces\Repositories\UserRepositoryInterface;

final class UserGetByEmailHandler implements UserGetByEmailInterface
{
    /**
     * メールアドレスからユーザーを取得するコンストラクタ
     *
     * @param UserRepositoryInterface $repository ユーザーリポジトリ
     */
    public function __construct(
        private readonly UserRepositoryInterface $repository
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
