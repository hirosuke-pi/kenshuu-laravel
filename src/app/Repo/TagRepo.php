<?php

namespace App\Repo;

use App\Models\Tag;

class TagRepo {
    private ?Tag $tag = null;

    public function __construct(string $id)
    {
        $tag = Tag::find($id) ?? null;
    }

    public function getTagName(): string
    {
        return $this->tag->tag_name;
    }

    public function getTagId(): string
    {
        return $this->tag->tag_name;
    }

    public static function getAllTags(): array
    {
        $tags = Tag::all();
        $tagNames = [];
        foreach($tags as $tag) {
            $tagNames[] = new TagRepo($tag->id);
        }
        return $tagNames;
    }
}
