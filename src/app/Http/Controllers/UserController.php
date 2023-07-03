<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Packages\Applications\User\Interfaces\UserGetByIdInterface;
use Packages\Applications\User\Requests\UserGetByIdRequest;

class UserController extends Controller
{
    public function index(string $userId, UserGetByIdInterface $userGetById)
    {
        $userRequest = new UserGetByIdRequest($userId);
        $userResponse = $userGetById->handle($userRequest);

        if (!$userResponse->hasUser()) {
            session()->flash(config('define.session.status'), ['type' => 'error', 'message' => 'ユーザーが見つかりませんでした。']);
            return redirect()->route('home');
        }

        return view('components.pages.user', [
            'user' => $userResponse->getUser()
        ]);
    }
}
