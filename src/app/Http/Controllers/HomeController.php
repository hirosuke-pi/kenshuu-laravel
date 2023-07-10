<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Packages\Handlers\User\UserGetByEmailHandler;

use Packages\Applications\News\Requests\NewsGetAllRequest;
use Packages\Applications\News\Interfaces\NewsGetAllInterface;

class HomeController extends Controller
{
    /**
     * ホーム画面を表示する
     *
     * @param UserGetByEmailHandler $userGetByEmail メールアドレスからユーザーを取得するユースケース
     * @param NewsGetAllInterface $newsGetAll ニュースを全件取得するユースケース
     * @return void
     */
    public static function index(
        UserGetByEmailHandler $userGetByEmail,
        NewsGetAllInterface $newsGetAll
    ): \Illuminate\Contracts\View\Factory | \Illuminate\Contracts\View\View
    {
        $user = $userGetByEmail->handle(config('test.user1.email'));

        $newsGetAllRequest = new NewsGetAllRequest();
        $newsGetAllResponse = $newsGetAll->handle($newsGetAllRequest);

        return view('components.pages.home', [
            'newsList' => $newsGetAllResponse->getNewsAll(),
            'user' => $user
        ]);
    }
}
