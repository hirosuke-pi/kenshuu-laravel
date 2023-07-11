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
     * @param Request $request リクエスト
     * @param NewsGetAllHandler $newsGetAll ニュースを全件取得するハンドラ
     * @return Factory|View
     */
    public static function index(
        Request $request,
        NewsGetAllHandler $newsGetAll
    ): Factory | View
    {
        $loginUser = $request->input('loginUser')['entity'];
        $newsEntities = $newsGetAll->handle();

        return view('components.pages.home', [
            'newsList' => $newsEntities,
            'loginUser' => $loginUser
        ]);
    }
}
