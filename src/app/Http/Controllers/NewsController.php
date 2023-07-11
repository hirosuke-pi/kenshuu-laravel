<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use \Illuminate\Contracts\View\Factory;
use \Illuminate\Contracts\View\View;
use \Illuminate\Http\RedirectResponse;

use Packages\Handlers\News\NewsGetHandler;
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
     * @param string $newsId ニュースID
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
}
