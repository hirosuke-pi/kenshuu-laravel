<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Packages\Applications\User\Requests\UserGetByEmailRequest;
use Packages\Applications\User\Interface\UserGetByEmailInterface;

class HomeController extends Controller
{
    /**
     * ホーム画面を表示する
     *
     * @param UserGetByEmailInterface $userGetByEmailInterface メールアドレスからユーザーを取得するユースケース
     * @return \Illuminate\View\View ホーム画面のView
     */
    public static function index(UserGetByEmailInterface $userGetByEmail): \Illuminate\View\View
    {
        $userGetByEmailRequest = new UserGetByEmailRequest('test@gmail.com');
        $userGetByEmailResponse = $userGetByEmail->handle($userGetByEmailRequest);

        return view('components.pages.home', [
            'user' => $userGetByEmailResponse->getUser()
        ]);
    }
}
