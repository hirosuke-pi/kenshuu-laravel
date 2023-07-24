<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginFormRequest;
use App\Http\Requests\UserFormRequest;
use Exception;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Packages\Handlers\User\UserCreateHandler;

class AuthController extends Controller
{
    /**
     * ログイン処理
     *
     * @param LoginFormRequest $request リクエスト
     * @return RedirectResponse リダイレクトレスポンス
     */
    public function login(LoginFormRequest $request): RedirectResponse {
        $credentials = $request->validated();

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            status('success', 'ログインしました。');
            return redirect()->route('home');
        }

        status('error', 'メールアドレスまたはパスワードが間違っています。');
        return redirect()->route('view.login');
    }

    /**
     * ログアウト処理
     *
     * @return RedirectResponse リダイレクトレスポンス
     */
    public function logout(): RedirectResponse {
        Auth::logout();
        status('success', 'ログアウトしました。');
        return redirect()->route('home');
    }

    /**
     * ユーザー登録処理
     *
     * @param UserFormRequest $request リクエスト
     * @param UserCreateHandler $handler ユーザーを作成するハンドラ
     * @return RedirectResponse リダイレクトレスポンス
     */
    public function registerAndLogin(UserFormRequest $request, UserCreateHandler $handler): RedirectResponse {
        $userForm = $request->validated();
        if (isset($userForm['input-user-thumbnail'])) {
            $userForm['user-thumbnail'] = $request->file('input-user-thumbnail')->store('images/user-thumbnail');
        }

        try {
            $handler->handle(
                name: $userForm['username'],
                email: $userForm['email'],
                password: $userForm['password'],
                profileImagePath: $userForm['user-thumbnail'] ?? null
            );
        } catch (Exception $e) {
            status('error', 'ユーザーの登録に失敗しました。既に登録されているメールアドレスです。');
            return redirect()->route('view.register');
        }

        if (Auth::attempt(['email' => $userForm['email'], 'password' => $userForm['password']])) {
            $request->session()->regenerate();
            status('success', 'ユーザーを登録しました。');
            return redirect()->route('home');
        }

        status('error', 'ログインに失敗しました。');
        return redirect()->route('view.login');
    }
}
