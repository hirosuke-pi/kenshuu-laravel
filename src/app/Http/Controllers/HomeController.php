<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Packages\Applications\User\Requests\UserGetByEmailRequest;
use Packages\Applications\User\Interfaces\UserGetByEmailInterface;

use Packages\Applications\News\Requests\NewsGetAllRequest;
use Packages\Applications\News\Interfaces\NewsGetAllInterface;

class HomeController extends Controller
{
    /**
     * ホーム画面を表示する
     *
     * @param UserGetByEmailInterface $userGetByEmail メールアドレスからユーザーを取得するユースケース
     * @param NewsGetAllInterface $newsGetAll ニュースを全件取得するユースケース
     * @return void
     */
    public static function index(
        UserGetByEmailInterface $userGetByEmail,
        NewsGetAllInterface $newsGetAll
    ): \Illuminate\Contracts\View\Factory | \Illuminate\Contracts\View\View
    {
        $userGetByEmailRequest = new UserGetByEmailRequest(config('test.user1.email'));
        $userGetByEmailResponse = $userGetByEmail->handle($userGetByEmailRequest);

        $newsGetAllRequest = new NewsGetAllRequest();
        $newsGetAllResponse = $newsGetAll->handle($newsGetAllRequest);

        return view('components.pages.home', [
            'newsList' => $newsGetAllResponse->getNewsAll(),
            'loginUser' => $userGetByEmailResponse->getUser()
        ]);
    }
}
