<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \Illuminate\Contracts\View\Factory;
use \Illuminate\Contracts\View\View;

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
    ): Factory | View
    {
        $user = $userGetByEmail->handle(config('test.user1.email'));
        $newsEntities = $newsGetAll->handle();

        return view('components.pages.home', [
            'newsList' => $newsEntities,
            'user' => $user
        ]);
    }
}
