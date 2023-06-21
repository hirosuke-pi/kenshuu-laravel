<?php

namespace App\Infrastructure\Repositories;

use App\Domains\Contracts\Repositories\NewsRepository;
use App\Domains\Entities\News;
use App\Models\Post;

class EloquentNewsRepository implements NewsRepository
{
    public static function findAll(): array
    {
        $posts = Post::whereNotNull('deleted_at')->get();
        $newsEntities = [];
        foreach($posts as $post) {
            $newsEntities[] = new News(
                id: $post->id,
                user: InMemoryUserRepository::find($post->user_id),
                title: $post->title,
                body: $post->body,
                tags: EloquentTagRepository::findByPostId($post->id),
                images: EloquentImageRepository::findByPostId($post->id),
                createdAt: $post->created_at,
                updatedAt: $post->updated_at,
            );
        }

        return $newsEntities;
    }

    public static function find(string $id): News
    {
        $post = Post::whereNotNull('deleted_at')->find($id);
        return new News(
            id: $post->id,
            user: InMemoryUserRepository::find($post->user_id),
            title: $post->title,
            body: $post->body,
            tags: EloquentTagRepository::findByPostId($post->id),
            images: EloquentImageRepository::findByPostId($post->id),
            createdAt: $post->created_at,
            updatedAt: $post->updated_at,
        );
    }

    public static function save(News $news): string
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

    public static function delete(string $id): bool
    {
        return Post::find($id)->delete();
    }
}
