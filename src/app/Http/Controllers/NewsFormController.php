<?php

namespace App\Http\Controllers;

use App\Http\Requests\NewsPostRequest;
use Exception;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Packages\Domains\Entities\Image;
use Packages\Domains\Entities\News;
use Packages\Domains\Interfaces\Repositories\ImageRepositoryInterface;
use Packages\Handlers\News\NewsCreateHandler;
use Packages\Handlers\News\NewsDeleteHandler;
use Packages\Handlers\News\NewsEditHandler;
use Packages\Handlers\News\NewsGetHandler;
use Packages\Handlers\Tag\TagGetByIdsHandler;
use Packages\Infrastructure\Factories\RepositoryNewsFactory;

class NewsFormController extends Controller
{
    /**
     * ニュースを投稿する
     *
     * @param NewsPostRequest $request リクエスト
     * @param ImageRepositoryInterface $imageRepository 画像リポジトリ
     * @param NewsCreateHandler $newsCreatehandler ニュースを作成するハンドラ
     * @param TagGetByIdsHandler $tagGetByIdsHandler タグを取得するハンドラ
     * @return RedirectResponse リダイレクトレスポンス
     */
    public function post(
        NewsPostRequest $request,
        ImageRepositoryInterface $imageRepository,
        NewsCreateHandler $newsCreateHandler,
        TagGetByIdsHandler $tagGetByIdsHandler
    ): RedirectResponse {
        try {
            $newsForm = $request->validated();

            $newsImages = [];
            if (isset($newsForm['input-new-thumbnail'])) {
                $newsImages[] = new Image(
                    id: $imageRepository->generateId(),
                    isThumbnail: true,
                    filePath: $newsForm['input-new-thumbnail']->store('images/news'),
                );
            }
            foreach($request->file('news-images', []) as $image) {
                $newsImages[] = new Image(
                    id: $imageRepository->generateId(),
                    isThumbnail: false,
                    filePath: $image->store('images/news'),
                );
            }

            $news = $newsCreateHandler->handle(
                title: $newsForm['title'],
                body: $newsForm['body'],
                author: $request->input('loginUser')['entity'],
                tags: $tagGetByIdsHandler->handle($newsForm['tags'] ?? []),
                images: $newsImages
            );

            status('success', 'ニュースを投稿しました。: '. $news->getId());
            return redirect()->route('home');
        } catch (Exception $e) {
            status('error', 'ニュースの投稿に失敗しました。');
            return redirect()->route('home');
        }
    }

    /**
     * ニュースを編集する
     *
     * @param string $newsId ニュースID
     * @param NewsPostRequest $request リクエスト
     * @param NewsGetHandler $newsGetHandler ニュースを取得するハンドラ
     * @param NewsEditHandler $newsEditHandler ニュースを更新するハンドラ
     * @return RedirectResponse リダイレクトレスポンス
     */
    public function edit(
        string $newsId,
        NewsPostRequest $request,
        NewsGetHandler $newsGetHandler,
        NewsEditHandler $newsEditHandler,
    ): RedirectResponse {
        try {
            $newsForm = $request->validated();
            $oldNewsEntity = $newsGetHandler->handle($newsId);
            $news = new News(
                id: $oldNewsEntity->getId(),
                author: $oldNewsEntity->getAuthor(),
                title: $newsForm['title'],
                body: $newsForm['body'],
                createdAt: $oldNewsEntity->getCreatedAt(),
                updatedAt: $oldNewsEntity->getUpdatedAt(),
                tags: $oldNewsEntity->getTags(),
                images: $oldNewsEntity->getImages(),
            );

            if (!$newsEditHandler->handle($news)) {
                throw new Exception('ニュースの更新に失敗しました。');
            }

            status('success', 'ニュースを更新しました。: '. $news->getId());
            return redirect()->route('home');
        } catch (Exception $e) {
            status('error', $e->getMessage());
            return redirect()->route('home');
        }
    }

    /**
     * ニュースを削除する
     *
     * @param string $newsId ニュースID
     * @param NewsDeleteHandler $newsDeleteHandler ニュースを削除するハンドラ
     * @return RedirectResponse リダイレクトレスポンス
     */
    public function delete(
        string $newsId,
        NewsDeleteHandler $newsDeleteHandler
    ): RedirectResponse {
        try {
            if (!$newsDeleteHandler->handle($newsId)) {
                throw new Exception('ニュースの削除に失敗しました。');
            }

            status('success', 'ニュースを削除しました。: '. $newsId);
            return redirect()->route('home');
        } catch (Exception $e) {
            status('error', $e->getMessage());
            return redirect()->route('home');
        }
    }
}
