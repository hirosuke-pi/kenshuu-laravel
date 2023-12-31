<?php

namespace Packages\Domains\Entities;

final class User {
    private const NEWS_DEFAULT_IMAGE_URL = 'img/assets/thumbnail.jpg';

    /**
     * ユーザーエンティティ
     *
     * @param string $id ユーザーID
     * @param string $name ユーザー名
     * @param string $email メールアドレス
     * @param string $password パスワード (ハッシュ済み)
     * @param string|null $profileImagePath プロフィール画像パス
     * @param string $createdAt 作成日時
     * @param int $postsCount 投稿数
     * @param string|null $rawPassword パスワード (ハッシュ前)
     */
    public function __construct(
        private readonly string $id,
        private readonly string $name,
        private readonly string $email,
        private readonly string $password,
        private readonly ?string $profileImagePath,
        private readonly string $createdAt,
        private readonly int $postsCount = 0,
        private readonly ?string $rawPassword = null,
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
     * ユーザータグを取得する
     *
     * @return string ユーザータグ
     */
    public function getNameTag(): string
    {
        return '@' . $this->name;
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
     * ハッシュ前のパスワードを取得する
     *
     * @return string|null パスワード
     */
    public function getRawPassword(): ?string
    {
        return $this->rawPassword;
    }

    /**
     * 投稿数を取得する
     *
     * @return int 投稿数
     */
    public function getPostsCount(): int
    {
        return $this->postsCount;
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
     * プロフィール画像のURLを取得する
     *
     * @return string プロフィール画像のURL
     */
    public function getProfileImageUrl(): ?string
    {
        if ($this->hasUserProfileImage()) {
            return asset($this->profileImagePath);
        }
        return self::getBaseUserImageUrl();
    }

    /**
     * ユーザーが自分自身かどうかを検証する
     *
     * @param User $user ユーザーEntity
     * @return boolean 検証結果
     */
    public function validate(User $user): bool {
        return $this->id === $user->id;
    }

    /**
     * ユーザーのプロフィール画像のデフォルトURLを取得する
     *
     * @return string ユーザーのプロフィール画像のデフォルトURL
     */
    public static function getBaseUserImageUrl(): string
    {
        return asset(self::NEWS_DEFAULT_IMAGE_URL);
    }
}
