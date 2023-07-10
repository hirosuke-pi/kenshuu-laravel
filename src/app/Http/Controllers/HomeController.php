<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Packages\Handlers\User\UserGetByEmailHandler;
use Packages\Handlers\News\NewsGetAllHandler;

class HomeController extends Controller
{
    /**
     * ホーム画面を表示する
     *
     * @param UserGetByEmailHandler $userGetByEmail メールアドレスからユーザーを取得するハンドラ
     * @param NewsGetAllHandler $newsGetAll ニュースを全件取得するハンドラ
     * @return void
     */
    public static function index(
        UserGetByEmailHandler $userGetByEmail,
        NewsGetAllHandler $newsGetAll
    ): \Illuminate\Contracts\View\Factory | \Illuminate\Contracts\View\View
    {
        $user = $userGetByEmail->handle(config('test.user1.email'));
        $newsEntities = $newsGetAll->handle();

        return view('components.pages.home', [
            'newsList' => $newsEntities,
            'user' => $user
        ]);
    }
}
