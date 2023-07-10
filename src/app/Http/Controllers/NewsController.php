<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Packages\Handlers\News\NewsGetHandler;
use Packages\Handlers\User\UserGetByEmailHandler;

class NewsController extends Controller
{
    /**
     * ニュース詳細画面を表示する
     *
     * @param string $newsId ニュースID
     * @param UserGetByEmailHandler $userGetByEmail メールアドレスからユーザーを取得するユースケース
     * @param NewsGetHandler $newsGet ニュースを取得するユースケース
     * @return void
     */
    public function view(
        string $newsId,
        UserGetByEmailHandler $userGetByEmail,
        NewsGetHandler $newsGet
    ): \Illuminate\Contracts\View\Factory | \Illuminate\Contracts\View\View | \Illuminate\Http\RedirectResponse
    {
        $loginUser = $userGetByEmail->handle(config('test.user1.email'));

        $news = $newsGet->handle($newsId);
        if (is_null($news)) {
            session()->flash(config('define.session.status'), ['type' => 'error', 'message' => 'ニュースが見つかりませんでした。']);
            return redirect()->route('home');
        }

        return view('components.pages.news', [
            'news' => $news,
            'user' => $loginUser
        ]);
    }
}
