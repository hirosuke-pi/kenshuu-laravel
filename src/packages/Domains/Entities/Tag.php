<?php

namespace Packages\Domains\Entities;

final class Tag {

    /**
     * タグエンティティ
     *
     * @param string $id タグID
     * @param string $name タグ名
     */
    public function __construct(
        private string $id,
        private string $name,
    ) {}

    /**
     * タグIDを取得する
     *
     * @return string タグID
     */
    public function getId(): string
    {
        return $this->id;
    }

    /**
     * タグ名を取得する
     *
     * @return string タグ名
     */
    public function getName(): string
    {
        return $this->name;
    }
}
