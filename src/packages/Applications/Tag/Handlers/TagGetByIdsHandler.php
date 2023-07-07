<?php

namespace Packages\Applications\Tag\Handlers;

use Packages\Applications\Tag\Requests\TagGetByIdsRequest;
use Packages\Applications\Tag\Responses\TagGetArrayResponse;
use Packages\Applications\Tag\Interfaces\TagGetByIdsInterface;
use Packages\Domains\Interfaces\Repositories\TagRepositoryInterface;

final class TagGetByIdsHandler implements TagGetByIdsInterface
{
    private TagRepositoryInterface $tagRepository;

    /**
     * タグIDリストからタグリストを取得するハンドラのコンストラクタ
     *
     * @param TagRepositoryInterface $tagRepository タグリポジトリ
     */
    public function __construct(TagRepositoryInterface $tagRepository) {
        $this->tagRepository = $tagRepository;
    }

    /**
     * タグIDリストからタグリストを取得するハンドラ
     *
     * @param TagGetByIdsRequest $request リクエスト
     * @return TagGetArrayResponse レスポンス
     */
    public function handle(TagGetByIdsRequest $request): TagGetArrayResponse {
        $tagEntities = $this->tagRepository->findByIds($request->getTagIds());

        return new TagGetArrayResponse(
            tagEntities: $tagEntities
        );
    }
}
