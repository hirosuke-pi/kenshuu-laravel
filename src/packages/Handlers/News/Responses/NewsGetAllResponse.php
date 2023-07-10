<?php

namespace Packages\Applications\News\Responses;

final class NewsGetAllResponse
{
    /**
     * ニュースを全件取得するレスポンスのコンストラクタ
     *
     * @param array $newsEntities ニュースエンティティの配列
     */
    public function __construct(
        private readonly array $newsEntities
    ) {}

    /**
     * ニュースを全件取得する
     *
     * @return array ニュースエンティティの配列
     */
    public function getNewsAll(): array
    {
        return $this->newsEntities;
    }

    /**
     * ニュースを保持しているか
     *
     * @return boolean 保持しているか
     */
    public function hasNews(): bool
    {
        return count($this->newsEntities) > 0;
    }
}
