<?php

namespace Database\Seeders;

use Exception;
use Illuminate\Database\Seeder;
use Packages\Handlers\Tag\TagGetByIdsHandler;
use Packages\Handlers\News\NewsCreateHandler;
use Packages\Handlers\User\UserGetByEmailHandler;

class NewsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(NewsCreateHandler $newsHandler, UserGetByEmailHandler $userGetHandler, TagGetByIdsHandler $tagGetHandler): void
    {
        $user = $userGetHandler->handle(config('test.user1.email'));
        if (is_null($user)) {
            throw new Exception('テストユーザーが取得できませんでした。');
        }

        $newsList = [
            [
                'title' => 'ニュースタイトル1',
                'body' => 'ニュース本文1',
                'author' => $user,
                'tags' => $tagGetHandler->handle([1, 2, 3]),
                'images' => [],
            ],
            [
                'title' => 'ニュースタイトル2',
                'body' => 'ニュース本文2',
                'author' => $user,
                'tags' => $tagGetHandler->handle([3, 4, 6, 7, 8]),
                'images' => [],
            ],
        ];

        foreach ($newsList as $news) {
            $newsHandler->handle(
                title: $news['title'],
                body: $news['body'],
                author: $news['author'],
                tags: $news['tags'],
                images: $news['images'],
            );
        }
    }
}
