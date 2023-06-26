<?php

namespace Packages\Applications\User\UseCases;

use Packages\Applications\User\Requests\UserCreateRequest;
use Packages\Applications\User\Responses\UserCreateResponse;
use Packages\Domains\Interfaces\Repositories\UserRepository;

interface UserCreateUseCase
{
    /**
     * ユーザーを作成するユースケースのコンストラクタ
     *
     * @param UserRepository $repository ユーザーリポジトリ
     */
    public function __construct(UserRepository $repository);

    /**
     * ユーザーを作成するハンドラ
     *
     * @param UserCreateRequest $request ユーザー作成リクエスト
     * @return UserCreateResponse ユーザー作成レスポンス
     */
    public function handle(UserCreateRequest $request): UserCreateResponse;
}
