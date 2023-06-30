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
        UserGetByEmailInterface $userGetByEmail,
        NewsGetInterface $newsGet
    ): \Illuminate\Contracts\View\Factory | \Illuminate\Contracts\View\View | \Illuminate\Http\RedirectResponse
    {
        $userGetByEmailRequest = new UserGetByEmailRequest(config('test.user1.email'));
        $userGetByEmailResponse = $userGetByEmail->handle($userGetByEmailRequest);

        $newsGetRequest = new NewsGetRequest($newsId);
        $newsGetResponse = $newsGet->handle($newsGetRequest);

        $news = $newsGetResponse->getNews();
        if (is_null($news)) {
            session()->flash(config('define.session.status'), ['type' => 'error', 'message' => 'ニュースが見つかりませんでした。']);
            return redirect()->route('home');
        }

        return view('components.pages.news', [
            'news' => $news,
            'user' => $userGetByEmailResponse->getUser()
        ]);
    }
}
