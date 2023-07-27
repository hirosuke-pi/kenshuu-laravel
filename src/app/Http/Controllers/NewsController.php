<?php

namespace App\Http\Controllers;

use App\Http\Requests\NewsPostRequest;
use Exception;
use Illuminate\Http\Request;

use \Illuminate\Contracts\View\Factory;
use \Illuminate\Contracts\View\View;
use \Illuminate\Http\RedirectResponse;

use Packages\Domains\Entities\Image;
use Packages\Domains\Entities\News;
use Packages\Domains\Interfaces\Repositories\ImageRepositoryInterface;
use Packages\Handlers\News\NewsCreateHandler;
use Packages\Handlers\News\NewsDeleteHandler;
use Packages\Handlers\News\NewsEditHandler;
use Packages\Handlers\News\NewsGetHandler;
use Packages\Handlers\Tag\TagGetByIdsHandler;
use Packages\Handlers\User\UserGetByEmailHandler;

class NewsController extends Controller
{
    /**
     * ニュース詳細画面を表示する
     *
     * @param string $newsId ニュースID
     * @param Request $request リクエスト
     * @param NewsGetHandler $newsGet ニュースを取得するハンドラ
     * @return Factory | View | RedirectResponse
     */
    public function view(
        string $newsId,
        Request $request,
        NewsGetHandler $newsGet
    ): Factory|View|RedirectResponse
    {
        $loginUser = $request->input(config('session.user'))['entity'];

        $news = $newsGet->handle($newsId);
        if (is_null($news)) {
            status('error', 'ニュースが見つかりませんでした。');
            return redirect()->route('home');
        }

        return view('components.pages.news', [
            'news' => $news,
            'loginUser' => $loginUser,
            'isAdmin' => is_null($loginUser) ? false : $loginUser->validate($news->getAuthor()),
            'isEditorMode' => false,
            'isNewCreate' => false,
            'author' => $news->getAuthor(),
            'paths' => [
                ['name' => 'ニュース - '. $news->getTitle(), 'link' => '#']
            ]
        ]);
    }

    /**
     * ニュースを編集する
     *
     * @param string $newsId ニュースID
     * @param Request $request リクエスト
     * @param NewsGetHandler $newsGet ニュースを取得するハンドラ
     * @return void
     */
    public function edit(
        string $newsId,
        Request $request,
        NewsGetHandler $newsGet
    ): Factory|View|RedirectResponse
    {
        $loginUser = $request->input(config('session.user'))['entity'];

        $news = $newsGet->handle($newsId);
        if (is_null($news)) {
            status('error', 'ニュースが見つかりませんでした。');
            return redirect()->route('home');
        }

        return view('components.pages.news', [
            'news' => $news,
            'loginUser' => $loginUser,
            'isAdmin' => is_null($loginUser) ? false : $loginUser->validate($news->getAuthor()),
            'isEditorMode' => true,
            'isNewCreate' => false,
            'author' => $news->getAuthor(),
            'paths' => [
                ['name' => 'ニュース - '. $news->getTitle(), 'link' => route('news.view', ['newsId' => $news->getId()])],
                ['name' => 'ニュースを編集', 'link' => '#']
            ]
        ]);
    }

    /**
     * ニュースを新規作成する
     *
     * @param Request $request リクエスト
     * @return void
     */
    public function create(
        Request $request,
    ): Factory | View | RedirectResponse
    {
        $loginUser = $request->input(config('session.user'))['entity'];

        return view('components.pages.news', [
            'news' => null,
            'loginUser' => $loginUser,
            'isAdmin' => false,
            'isEditorMode' => true,
            'isNewCreate' => true,
            'author' => $loginUser,
            'paths' => [
                ['name' => 'ユーザー - '. $loginUser->getNameTag(), 'link' => route('user.index', ['userId' => $loginUser->getId()])],
                ['name' => 'ニュースを作成', 'link' => '#']
            ]
        ]);
    }


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
    public function put(
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
