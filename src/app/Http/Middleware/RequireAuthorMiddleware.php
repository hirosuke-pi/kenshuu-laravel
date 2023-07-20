<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Packages\Handlers\News\NewsGetHandler;
use Packages\Infrastructure\Repositories\EloquentImageRepository;
use Packages\Infrastructure\Repositories\EloquentNewsRepository;
use Packages\Infrastructure\Repositories\EloquentTagRepository;
use Packages\Infrastructure\Repositories\EloquentUserRepository;
use Symfony\Component\HttpFoundation\Response;

class RequireAuthorMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (!Auth::check()) {
            status('error', 'ログインしていないため、ログイン画面に遷移します。');
            return redirect()->route('view.login');
        }

        $userRepository = new EloquentUserRepository();
        $tagRepository = new EloquentTagRepository();
        $imageRepository = new EloquentImageRepository();

        $newsRepository = new EloquentNewsRepository($tagRepository, $imageRepository, $userRepository);
        $handler = new NewsGetHandler($newsRepository);
        $news = $handler->handle($request->route('newsId'));
        if (is_null($news)) {
            status('error', 'ニュースが見つかりませんでした。');
            return redirect()->route('home');
        }

        $loginUser = $request->input(config('session.user'))['entity'];
        if (!$news->getAuthor()->validate($loginUser)) {
            status('error', 'ニュースの編集権限がありません。');
            return redirect()->route('home');
        }

        return $next($request);
    }
}
