<?php

use Packages\Domains\Interfaces\Repositories\TagRepository;

interface TagsGetUseCase
{
    /**
     * タグ一覧を取得するユースケース
     *
     * @param TagRepository $repository
     */
    public function __construct(TagRepository $repository);

    /**
     * タグ一覧を取得する
     *
     * @return array タグEntityの配列
     */
    public function handle(): array;
}
