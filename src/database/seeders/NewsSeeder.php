<?php

namespace Database\Seeders;

use Exception;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use Packages\Applications\News\Requests\NewsCreateRequest;
use Packages\Applications\News\UseCases\NewsCreateUseCase;
use Packages\Applications\Tag\Requests\TagGetByIdsRequest;
use Packages\Applications\Tag\UseCases\TagGetByIdsUseCase;
use Packages\Applications\User\Requests\UserGetByEmailRequest;
use Packages\Applications\User\UseCases\UserGetByEmailUseCase;

class NewsSeeder extends Seeder
{
    private function getTagIdsToTagEntities(array $ids, TagGetByIdsUseCase $tagGetHandler) {
        $tagResponse = $tagGetHandler->handle(
            request: new TagGetByIdsRequest($ids)
        );

        return $tagResponse->getTagEntities();
    }

    /**
     * Run the database seeds.
     */
    public function run(NewsCreateUseCase $newsHandler, UserGetByEmailUseCase $userGetHandler, TagGetByIdsUseCase $tagGetHandler): void
    {
        $userResponse = $userGetHandler->handle(
            new UserGetByEmailRequest(
                email: config('test.user1.email')
            )
        );
        $user = $userResponse->getUser();
        if (is_null($user)) {
            throw new Exception('テストユーザーが取得できませんでした。');
        }

        $newsList = [
            new NewsCreateRequest(
                title: 'ニュースタイトル1',
                body: 'ニュース本文1',
                user: $user,
                tags: $this->getTagIdsToTagEntities([1, 2, 5], $tagGetHandler),
                images: []
            ),
            new NewsCreateRequest(
                title: 'ニュースタイトル2',
                body: 'ニュース本文2',
                user: $user,
                tags: $this->getTagIdsToTagEntities([4, 6, 7, 8, 10], $tagGetHandler),
                images: []
            ),
        ];

        foreach ($newsList as $news) {
            $newsHandler->handle($news);
        }
    }
}
