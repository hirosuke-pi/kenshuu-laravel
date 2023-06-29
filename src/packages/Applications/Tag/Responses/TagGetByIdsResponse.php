<?php

namespace Packages\Applications\Tag\Responses;

final class TagGetByIdsResponse {

    /**
     * タグID配列からタグEntity配列を取得するハンドラのレスポンス
     *
     * @param array $tagEntities タグEntityの配列
     */
    public function __construct(
        private readonly array $tagEntities,
    ) {}

    /**
     * タグEntity配列を取得する
     *
     * @return array タグEntityの配列
     */
    public function getTagEntities(): array
    {
        return $this->tagEntities;
    }
}
