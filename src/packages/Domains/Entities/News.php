<?php

namespace Packages\Domains\Entities;

use DateTime;
use DateTimeInterface;
use Exception;
use Packages\Domains\Entities\Tag;
use Packages\Domains\Entities\Image;
use Packages\Domains\Entities\User;

final class News
{
    private const NEWS_DEFAULT_IMAGE_URL = 'img/assets/thumbnail.jpg';

    /**
     * ニュースエンティティ
     *
     * @param string $id ニュースID
     * @param User $user ユーザーEntity
     * @param string $title タイトル
     * @param string $body 本文
     * @param string $createdAt 作成日時
     * @param string|null $updatedAt 更新日時
     * @param array $tags タグEntityの配列
     * @param array $images 画像Entityの配列
     */
    public function __construct(
        private string $id,
        private User $user,

        private string $title,
        private string $body,
        private string $createdAt,
        private ?string $updatedAt,

        private array $tags,
        private array $images,
    ) {}

    /**
     * ニュースを編集する
     *
     * @param string $title タイトル
     * @param string $body 本文
     * @return void
     */
    public function edit(string $title, string $body): void
    {
        $this->title = $title;
        $this->body = $body;
        $this->updatedAt = (new DateTime())->format(DateTimeInterface::ATOM);
    }

    /**
     * ニュースIDを取得する
     *
     * @return string ニュースID
     */
    public function getId(): string
    {
        return $this->id;
    }

    /**
     * ユーザーEntityを取得する
     *
     * @return User ユーザーEntity
     */
    public function getUser(): User {
        return $this->user;
    }

    /**
     * タイトルを取得する
     *
     * @return string タイトル
     */
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * 本文を取得する
     *
     * @return string 本文
     */
    public function getBody(): string
    {
        return $this->body;
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
     * 作成日時をフォーマットして取得する
     *
     * @return string 作成日時
     */
    public function getCreatedAtFormat(): string
    {
        return (new DateTime($this->createdAt))->format('Y/m/d H:i:s');
    }

    /**
     * 更新日時を取得する
     *
     * @return string|null 更新日時
     */
    public function getUpdatedAt(): ?string
    {
        return $this->updatedAt;
    }

    /**
     * 更新日時をフォーマットして取得する
     *
     * @return string 更新日時
     */
    public function getUpdatedAtFormat(): string
    {
        return (new DateTime($this->updatedAt))->format('Y/m/d H:i:s');
    }

    /**
     * タグEntityの配列を取得する
     *
     * @return array タグEntityの配列
     */
    public function getTags(): array {
        return $this->tags;
    }

    /**
     *画像Entityの配列を取得する
     *
     * @return array 画像Entityの配列
     */
    public function getImages(): array {
        return $this->images;
    }

    /**
     * ニュースのサムネイルの画像Entityを取得
     *
     * @return Image|null
     */
    public function getThumbnailImage(): ?Image {
        foreach($this->images as $image) {
            if ($image->isThumbnail()) {
                return $image;
            }
        }
        return null;
    }

    /**
     * サムネイル画像のURLを取得する
     *
     * @return string
     */
    public function getThumbnailImageUrl(): string
    {
        foreach($this->images as $image) {
            if ($image->isThumbnail()) {
                return $image->getUrl();
            }
        }
        return self::getDefaultImageUrl();
    }

    /**
     * タグを適応する
     *
     * @param array $tags タグEntityの配列
     * @throws Exception タグクラス以外のオブジェクトが含まれている場合
     * @return void
     */
    public function applyTags(array $tags): void
    {
        $this->tags = [];
        foreach($tags as $tag) {
            if (!($tag instanceof Tag)) {
                throw new Exception('Tagクラス以外のオブジェクトが含まれています');
            }
            $this->tags[$tag->getId()] = $tag;
        }
    }

    /**
     * 画像を適応する
     *
     * @param array $images
     * @throws Exception 画像クラス以外のオブジェクトが含まれている場合
     * @return void
     */
    public function applyImages(array $images): void
    {
        $this->images = [];
        foreach($images as $image) {
            if (!($image instanceof Image)) {
                throw new Exception('Imageクラス以外のオブジェクトが含まれています');
            }
            $this->images[$image->getId()] = $image;
        }
    }

    /**
     * ニュースがアップデート済みかどうか
     *
     * @return boolean
     */
    public function isUpdated(): bool
    {
        return !is_null($this->updatedAt);
    }

    /**
     * ニュースのデフォルト画像のURLを取得する
     *
     * @return string ニュースのデフォルト画像のURL
     */
    public static function getDefaultImageUrl(): string
    {
        return asset(self::NEWS_DEFAULT_IMAGE_URL);
    }
}
