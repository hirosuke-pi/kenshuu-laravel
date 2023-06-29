<?php

namespace Packages\Applications\Tag\Handlers;

use Packages\Applications\Tag\Requests\TagGetByIdsRequest;
use Packages\Applications\Tag\Responses\TagGetByIdsResponse;
use Packages\Applications\Tag\UseCases\TagGetByIdsUseCase;
use Packages\Domains\Interfaces\Repositories\TagRepository;

final class TagGetByIdsHandler implements TagGetByIdsUseCase
{
    private TagRepository $tagRepository;

    /**
     * タグIDリストからタグリストを取得するハンドラのコンストラクタ
     *
     * @param TagRepository $tagRepository タグリポジトリ
     */
    public function __construct(TagRepository $tagRepository) {
        $this->tagRepository = $tagRepository;
    }

    /**
     * タグIDリストからタグリストを取得するハンドラ
     *
     * @param TagGetByIdsRequest $request リクエスト
     * @return TagGetByIdsResponse レスポンス
     */
    public function handle(TagGetByIdsRequest $request): TagGetByIdsResponse {
        $tagEntities = $this->tagRepository->findByIds($request->getTagIds());

        return new TagGetByIdsResponse(
            tagEntities: $tagEntities
        );
    }
}
