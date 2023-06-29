<?php

namespace Packages\Applications\Tag\UseCases;

use Packages\Applications\Tag\Requests\TagGetByIdsRequest;
use Packages\Applications\Tag\Responses\TagGetByIdsResponse;
use Packages\Domains\Interfaces\Repositories\TagRepository;

interface TagGetByIdsUseCase
{
    /**
     * タグIDリストからタグリストを取得するユースケースのコンストラクタ
     *
     * @param TagRepository $tagRepository タグリポジトリ
     */
    public function __construct(TagRepository $tagRepository);

    /**
     * タグIDリストからタグリストを取得するハンドラ
     *
     * @param TagGetByIdsRequest $request リクエスト
     * @return TagGetByIdsResponse レスポンス
     */
    public function handle(TagGetByIdsRequest $request): TagGetByIdsResponse;
}
