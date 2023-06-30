<?php

namespace Packages\Applications\User\UseCases;

use Packages\Applications\User\Requests\UserGetByEmailRequest;
use Packages\Applications\User\Responses\UserGetResponse;

use Packages\Domains\Interfaces\Repositories\UserRepository;

interface UserGetByEmailUseCase
{
    /**
     * コンストラクタ
     *
     * @param UserRepository $repository ユーザーリポジトリ
     */
    public function __construct(UserRepository $repository);

    /**
     * メールアドレスからユーザーを取得する
     *
     * @param UserGetByEmailRequest $request ユーザー取得リクエスト
     * @return UserGetResponse ユーザー取得レスポンス
     */
    public function handle(UserGetByEmailRequest $request): UserGetResponse;
}
