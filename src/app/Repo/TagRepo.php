<?php

namespace App\Repo;

use App\Models\Tag;

class TagRepo {
    private Tag $tag;

    public function __construct(string $id)
    {
        $this->tag = Tag::find($id);
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
