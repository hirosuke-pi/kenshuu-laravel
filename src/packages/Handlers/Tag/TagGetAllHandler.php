<?php

namespace Packages\Handlers\Tag;

use Packages\Domains\Interfaces\Repositories\TagRepositoryInterface;

final class TagGetAllHandler
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
     * @return array タグリスト
     */
    public function handle(): array {
        return $this->tagRepository->findAll() ?? [];
    }
}
