<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Packages\Applications\User\Requests\UserGetByEmailRequest;
use Packages\Applications\User\UseCases\UserGetByEmailUseCase;

use Packages\Applications\News\Requests\NewsGetAllRequest;
use Packages\Applications\News\UseCases\NewsGetAllUseCase;

class HomeController extends Controller
{
    /**
     * ホーム画面を表示する
     *
     * @param UserGetByEmailUseCase $userGetByEmailUseCase メールアドレスからユーザーを取得するユースケース
     * @param NewsGetAllUseCase $newsGetAllUseCase ニュースを全件取得するユースケース
     * @return void
     */
    public static function index(
        UserGetByEmailUseCase $userGetByEmailUseCase,
        NewsGetAllUseCase $newsGetAllUseCase
    ): \Illuminate\Contracts\View\Factory | \Illuminate\Contracts\View\View
    {
        $userGetByEmailRequest = new UserGetByEmailRequest(config('test.user1.email'));
        $userGetByEmailResponse = $userGetByEmailUseCase->handle($userGetByEmailRequest);

        $newsGetAllRequest = new NewsGetAllRequest();
        $newsGetAllResponse = $newsGetAllUseCase->handle($newsGetAllRequest);

        return view('components.pages.home', [
            'newsList' => $newsGetAllResponse->getNewsAll(),
            'user' => $userGetByEmailResponse->getUser()
        ]);
    }
}
