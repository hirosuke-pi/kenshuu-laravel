<?php

namespace Packages\Infrastructure\Factories;

use Packages\Domains\Entities\Tag;
use App\Models\Tag as TagModel;
use Packages\Domains\Interfaces\Repositories\TagRepositoryInterface;

final class TagMockFactory
{
    public function __construct(
        private readonly TagRepositoryInterface $tagRepository,
        private bool $isSaveRepository = true,
    ) {
        self::initializeTable();
    }

    public function createWithPostId(string $postId): array {
        $allTags = $this->tagRepository->findAll();
        shuffle($allTags);

        $selectedTags = [];
        for($i = 0; $i < fake()->numberBetween(0, 10); $i++) {
            $selectedTags[] = $allTags[$i];
            if ($this->isSaveRepository) {
                $this->tagRepository->saveWithPostId($allTags[$i], $postId);
            }
        }
        return $selectedTags;
    }

    public static function initializeTable(): bool {
        $tagModel = new TagModel();
        if ($tagModel->count() > 0) {
            return false;
        }

        $tags = [
            ['id' => '1',  'tag_name' => 'テクノロジー'],
            ['id' => '2',  'tag_name' => 'モバイル'],
            ['id' => '3',  'tag_name' => 'アプリ'],
            ['id' => '4',  'tag_name' => 'エンタメ'],
            ['id' => '5',  'tag_name' => 'ビューティー'],
            ['id' => '6',  'tag_name' => 'ファッション'],
            ['id' => '7',  'tag_name' => 'ライフスタイル'],
            ['id' => '8',  'tag_name' => 'ビジネス'],
            ['id' => '9',  'tag_name' => 'グルメ'],
            ['id' => '10', 'tag_name' => 'スポーツ'],
        ];

        foreach($tags as $tag) {
            $tagModel->create($tag);
        }

        return true;
    }
}
