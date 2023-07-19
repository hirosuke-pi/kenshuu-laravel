<?php

namespace Packages\Handlers\Tag;

use Packages\Domains\Interfaces\Repositories\TagRepositoryInterface;

final class TagGetByIdsHandler
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
     * @param array $tagIds タグIDリスト
     * @return array タグリスト
     */
    public function handle(array $tagIds): array {
        return $this->tagRepository->findByIds($tagIds) ?? [];
    }
}
