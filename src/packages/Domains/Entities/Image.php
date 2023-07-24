<?php

namespace Packages\Domains\Entities;

final class Image {

    /**
     * 画像エンティティ
     *
     * @param string $id 画像ID
     * @param boolean $isThumbnail サムネイルかどうか
     * @param string $filePath ファイルパス
     */
    public function __construct(
        private string $id,
        private bool $isThumbnail,
        private string $filePath,
    ) {}

    /**
     * 画像IDを取得する
     *
     * @return string 画像ID
     */
    public function getId(): string
    {
        return $this->id;
    }

    /**
     * サムネイルかどうか
     *
     * @return boolean サムネイルかどうか
     */
    public function isThumbnail(): bool
    {
        return $this->isThumbnail;
    }

    /**
     * 画像ファイルパスを取得する
     *
     * @return string 画像ファイルパス
     */
    public function getFilePath(): string
    {
        return $this->filePath;
    }

    /**
     * 画像URLを取得する
     *
     * @return string 画像URL
     */
    public function getUrl(): string
    {
        return asset($this->filePath);
    }
}
