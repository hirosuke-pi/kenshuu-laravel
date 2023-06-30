<?php

namespace Packages\Applications\User\Handlers;

use DateTime;
use Packages\Applications\User\Requests\UserCreateRequest;
use Packages\Applications\User\Responses\UserCreateResponse;
use Packages\Applications\User\UseCases\UserCreateUseCase;
use Packages\Domains\Entities\User;
use Packages\Domains\Interfaces\Repositories\UserRepository;

final class UserCreateHandler implements UserCreateUseCase
{
    /**
     * ユーザーを作成するハンドラのコンストラクタ
     *
     * @param UserRepository $repository ユーザーリポジトリ
     */
    public function __construct(
        private readonly UserRepository $repository
    ) {}

    /**
     * ユーザーを作成するハンドラ
     *
     * @param UserCreateRequest $request ユーザー作成リクエスト
     * @return UserCreateResponse ユーザー作成レスポンス
     */
    public function handle(UserCreateRequest $request): UserCreateResponse
    {
        $user = new User(
            id: $this->repository->generateId(),
            email: $request->getEmail(),
            name: $request->getName(),
            password: $request->getPassword(),
            profileImagePath: $request->getProfileImagePath(),
            createdAt: (new DateTime())->format(DateTime::ATOM),
            postsCount: 0
        );
        $this->repository->save($user);

        return new UserCreateResponse(
            user: $user
        );
    }
}
