<?php

namespace Packages\Applications\User\Interfaces;

use Packages\Applications\User\Requests\UserGetByEmailRequest;
use Packages\Applications\User\Responses\UserGetResponse;

use Packages\Domains\Interfaces\Repositories\UserRepositoryInterface;

interface UserGetByEmailInterface
{
    /**
     * コンストラクタ
     *
     * @param UserRepositoryInterface $repository ユーザーリポジトリ
     */
    public function __construct(UserRepositoryInterface $repository);

    /**
     * メールアドレスからユーザーを取得する
     *
     * @param UserGetByEmailRequest $request ユーザー取得リクエスト
     * @return UserGetResponse ユーザー取得レスポンス
     */
    public function handle(UserGetByEmailRequest $request): UserGetResponse;
}
