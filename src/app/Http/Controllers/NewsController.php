<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Packages\Applications\News\Requests\NewsGetRequest;
use Packages\Applications\News\Interfaces\NewsGetInterface;
use Packages\Applications\User\Requests\UserGetByEmailRequest;
use Packages\Applications\User\Interfaces\UserGetByEmailInterface;

class NewsController extends Controller
{
    /**
     * ニュース詳細画面を表示する
     *
     * @param string $newsId ニュースID
     * @param UserGetByEmailInterface $userGetByEmail メールアドレスからユーザーを取得するユースケース
     * @param NewsGetInterface $newsGet ニュースを取得するユースケース
     * @return void
     */
    public function view(
        string $newsId,
        Request $request,
        NewsGetInterface $newsGet
    ): \Illuminate\Contracts\View\Factory | \Illuminate\Contracts\View\View | \Illuminate\Http\RedirectResponse
    {
        $loginUser = $request->input(config('session.user'))['entity'];

        $newsGetRequest = new NewsGetRequest($newsId);
        $newsGetResponse = $newsGet->handle($newsGetRequest);

        if (!$newsGetResponse->hasNews()) {
            session()->flash(config('define.session.status'), ['type' => 'error', 'message' => 'ニュースが見つかりませんでした。']);
            return redirect()->route('home');
        }

        $news = $newsGetResponse->getNews();

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
     * @param UserGetByEmailInterface $userGetByEmail メールアドレスからユーザーを取得するユースケース
     * @param NewsGetInterface $newsGet ニュースを取得するユースケース
     * @return void
     */
    public function edit(
        string $newsId,
        Request $request,
        NewsGetInterface $newsGet
    ): \Illuminate\Contracts\View\Factory | \Illuminate\Contracts\View\View | \Illuminate\Http\RedirectResponse
    {
        $loginUser = $request->input(config('session.user'))['entity'];

        $newsGetRequest = new NewsGetRequest($newsId);
        $newsGetResponse = $newsGet->handle($newsGetRequest);

        if (!$newsGetResponse->hasNews()) {
            session()->flash(config('define.session.status'), ['type' => 'error', 'message' => 'ニュースが見つかりませんでした。']);
            return redirect()->route('home');
        }

        $news = $newsGetResponse->getNews();

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
     * @param UserGetByEmailInterface $userGetByEmail メールアドレスからユーザーを取得するユースケース
     * @param NewsGetInterface $newsGet ニュースを取得するユースケース
     * @return void
     */
    public function create(
        Request $request,
        NewsGetInterface $newsGet
    ): \Illuminate\Contracts\View\Factory | \Illuminate\Contracts\View\View | \Illuminate\Http\RedirectResponse
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
