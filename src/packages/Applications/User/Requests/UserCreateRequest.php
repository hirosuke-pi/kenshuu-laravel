<?php

namespace Packages\Applications\User\Requests;

final class UserCreateRequest
{
    /**
     * ユーザー作成リクエストのコンストラクタ
     *
     * @param string $name ユーザー名
     * @param string $email メールアドレス
     * @param string $password パスワード
     * @param string|null $profileImagePath プロフィール画像パス
     */
    public function __construct(
        private readonly string $name,
        private readonly string $email,
        private readonly string $password,
        private readonly ?string $profileImagePath
    ) {}

    /**
     * ユーザー名を取得する
     *
     * @return string ユーザー名
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * メールアドレスを取得する
     *
     * @return string メールアドレス
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * パスワードを取得する
     *
     * @return string パスワード
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    /**
     * プロフィール画像パスを取得する
     *
     * @return string|null プロフィール画像パス
     */
    public function getProfileImagePath(): ?string
    {
        return $this->profileImagePath;
    }
}
