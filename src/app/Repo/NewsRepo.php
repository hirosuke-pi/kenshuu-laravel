<?php

namespace App\Repo;

use App\Models\Post;

class NewsRepo
{
    private Post $post;

    public function __construct(string $id = null, Post $post = null)
    {
        if (!is_null($id)) {
            $this->post = Post::find($id);
            return;
        }
        elseif (!is_null($post)) {
            $this->post = $post;
            return;
        }

        throw new \Exception('引数が不正です');
    }

    public function getEditUrl(): string
    {
        return $this->post->id;
    }

    public function getViewUrl(): string
    {
        return $this->post->id;
    }

    public static function getAllNews(string $word = ''): array
    {
        $posts = Post::whereNotNull('deleted_at')->where('title', 'like', "%{$word}%")->get();
        $news = [];
        foreach($posts as $post) {
            $news[] = new NewsRepo(null, $post);
        }
        return $news;
    }
}
