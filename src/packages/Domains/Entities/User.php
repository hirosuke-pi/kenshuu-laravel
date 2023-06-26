<?php

namespace Packages\Domains\Entities;

final class User {

    /**
     * ユーザーエンティティ
     *
     * @param string $id ユーザーID
     * @param string $name ユーザー名
     * @param string $email メールアドレス
     * @param string $password パスワード (ハッシュ済み)
     * @param string|null $profileImagePath プロフィール画像パス
     * @param string $createdAt 作成日時
     */
    public function __construct(
        private string $id,
        private string $name,
        private string $email,
        private string $password,
        private ?string $profileImagePath,
        private string $createdAt,
    ) {}

    /**
     * ユーザーIDを取得する
     *
     * @return string ユーザーID
     */
    public function getId(): string
    {
        return $this->id;
    }

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
     * ハッシュ済みパスワードを取得する
     *
     * @return string パスワード
     */
    public function getHashedPassword(): string
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

    /**
     * プロフィール画像を持っているかどうかを取得する
     *
     * @return boolean
     */
    public function hasUserProfileImage(): bool
    {
        return !is_null($this->profileImagePath);
    }

    /**
     * 作成日時を取得する
     *
     * @return string 作成日時
     */
    public function getCreatedAt(): string
    {
        return $this->createdAt;
    }

    /**
     * パスワードを検証する
     *
     * @param string $password パスワード
     * @return boolean 検証結果
     */
    public function verifyPassword(string $password): bool
    {
        return password_verify($password, $this->password);
    }

    /**
     * プロフィール画像のファイル名を取得する
     *
     * @return string|null プロフィール画像のファイル名
     */
    public function getProfileImageName(): ?string
    {
        return $this->id . '.' . $this->profileImagePath;
    }
}
