<?php

namespace Packages\Applications\Tag\Handlers;

use Packages\Applications\Tag\Responses\TagGetArrayResponse;
use Packages\Applications\Tag\Interfaces\TagGetAllInterface;
use Packages\Domains\Interfaces\Repositories\TagRepositoryInterface;

final class TagGetAllHandler implements TagGetAllInterface
{
    private TagRepositoryInterface $tagRepository;

    /**
     * タグを全て取得するハンドラのコンストラクタ
     *
     * @param TagRepositoryInterface $tagRepository タグリポジトリ
     */
    public function __construct(TagRepositoryInterface $tagRepository) {
        $this->tagRepository = $tagRepository;
    }

    /**
     * タグを全て取得するハンドラ
     *
     * @return TagGetArrayResponse レスポンス
     */
    public function handle(): TagGetArrayResponse {
        $tagEntities = $this->tagRepository->findAll();

        return new TagGetArrayResponse(
            tagEntities: $tagEntities
        );
    }
}
