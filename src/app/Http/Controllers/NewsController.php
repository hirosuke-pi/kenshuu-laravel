<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Packages\Applications\News\Requests\NewsGetRequest;
use Packages\Applications\News\UseCases\NewsGetUseCase;
use Packages\Applications\User\Requests\UserGetByEmailRequest;
use Packages\Applications\User\UseCases\UserGetByEmailUseCase;

class NewsController extends Controller
{
    /**
     * ニュース詳細画面を表示する
     *
     * @param string $newsId ニュースID
     * @param UserGetByEmailUseCase $userGetByEmailUseCase メールアドレスからユーザーを取得するユースケース
     * @param NewsGetUseCase $newsGetUseCase ニュースを取得するユースケース
     * @return void
     */
    public function view(
        string $newsId,
        UserGetByEmailUseCase $userGetByEmailUseCase,
        NewsGetUseCase $newsGetUseCase
    ): \Illuminate\Contracts\View\Factory | \Illuminate\Contracts\View\View | \Illuminate\Http\RedirectResponse
    {
        $userGetByEmailRequest = new UserGetByEmailRequest(config('test.user1.email'));
        $userGetByEmailResponse = $userGetByEmailUseCase->handle($userGetByEmailRequest);

        $newsGetRequest = new NewsGetRequest($newsId);
        $newsGetResponse = $newsGetUseCase->handle($newsGetRequest);

        if (!$newsGetResponse->hasNews()) {
            session()->flash(config('define.session.status'), ['type' => 'error', 'message' => 'ニュースが見つかりませんでした。']);
            return redirect()->route('home');
        }

        $news = $newsGetResponse->getNews();
        return view('components.pages.news', [
            'news' => $news,
            'user' => $userGetByEmailResponse->getUser(),
            'isGuest' => !$userGetByEmailResponse->hasUser(),
            'paths' => [
                ['name' => 'ニュース - '. $news->getTitle(), 'link' => '#']
            ]
        ]);
    }
}
