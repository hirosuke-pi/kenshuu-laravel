<?php

namespace Packages\Applications\Tag\Interfaces;

use Packages\Applications\Tag\Requests\TagGetByIdsRequest;
use Packages\Applications\Tag\Responses\TagGetByIdsResponse;
use Packages\Domains\Interfaces\Repositories\TagRepositoryInterface;

interface TagGetByIdsInterface
{
    /**
     * タグIDリストからタグリストを取得するユースケースのコンストラクタ
     *
     * @param TagRepositoryInterface $tagRepository タグリポジトリ
     */
    public function __construct(TagRepositoryInterface $tagRepository);

    /**
     * タグIDリストからタグリストを取得するハンドラ
     *
     * @param TagGetByIdsRequest $request リクエスト
     * @return TagGetByIdsResponse レスポンス
     */
    public function handle(TagGetByIdsRequest $request): TagGetByIdsResponse;
}
