<?php

namespace App\Infrastructure\Repositories;

use App\Domains\Contracts\Repositories\NewsRepository;
use App\Domains\Entities\News;
use App\Domains\Contracts\Factories\NewsFactory;
use App\Models\Post;

final class EloquentNewsRepository implements NewsRepository
{
    private const PREFIX = 'news';

    public function __construct(private NewsFactory $newsFactory) {}

    public function findAll(): array
    {
        $posts = Post::whereNotNull('deleted_at')->get();
        $newsEntities = [];
        foreach($posts as $post) {
            $newsEntities[] = $this->newsFactory->create(
                id: $post->id,
                userId:    $post->user_id,
                title:     $post->title,
                body:      $post->body,
                createdAt: $post->created_at,
                updatedAt: $post->updated_at,
            );
        }

        return $newsEntities;
    }

    public function find(string $id): ?News
    {
        $post = Post::whereNotNull('deleted_at')->find($id);
        if (is_null($post)) {
            return null;
        }

        return $this->newsFactory->create(
            id: $post->id,
            userId:    $post->user_id,
            title:     $post->title,
            body:      $post->body,
            createdAt: $post->created_at,
            updatedAt: $post->updated_at,
        );
    }

    public function save(News $news): string
    {
        $post = new Post();
        $post->id = $news->getId();
        $post->user_id = $news->getUser()->getId();
        $post->title = $news->getTitle();
        $post->body = $news->getBody();
        $post->created_at = $news->getCreatedAt();
        $post->updated_at = $news->getUpdatedAt();
        $post->save();

        return $news->getId();
    }

    public function delete(string $id): bool
    {
        return Post::find($id)->delete();
    }

    public function generateId(): string
    {
        return self::PREFIX .'-'. uniqid(mt_rand());
    }
}
