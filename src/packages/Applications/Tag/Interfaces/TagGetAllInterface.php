<?php

namespace Packages\Applications\Tag\Interfaces;

use Packages\Applications\Tag\Responses\TagGetArrayResponse;

interface TagGetAllInterface
{
    /**
     * タグを全て取得するハンドラ
     *
     * @return TagGetArrayResponse レスポンス
     */
    public function handle(): TagGetArrayResponse;
}
