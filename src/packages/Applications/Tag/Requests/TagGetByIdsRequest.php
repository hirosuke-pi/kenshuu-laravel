<?php

namespace Packages\Applications\Tag\Requests;

final class TagGetByIdsRequest {

    /**
    * タグID配列からタグEntity配列を取得するハンドラのリクエスト
    *
    * @param array $tagIds タグIDリスト
    */
    public function __construct(
        private readonly array $tagIds,
    ) {}

    /**
    * タグIDリストを取得する
    *
    * @return array タグIDリスト
    */
    public function getTagIds(): array
    {
        return $this->tagIds;
    }
}
