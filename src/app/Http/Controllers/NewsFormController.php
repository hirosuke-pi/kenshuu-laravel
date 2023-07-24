<?php

namespace App\Http\Controllers;

use App\Http\Requests\NewsPostRequest;
use Exception;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Packages\Domains\Entities\Image;
use Packages\Domains\Interfaces\Repositories\ImageRepositoryInterface;
use Packages\Handlers\News\NewsCreateHandler;
use Packages\Handlers\Tag\TagGetByIdsHandler;

class NewsFormController extends Controller
{
    /**
     * ニュースを投稿する
     *
     * @param NewsPostRequest $request リクエスト
     * @param ImageRepositoryInterface $imageRepository 画像リポジトリ
     * @param NewsCreateHandler $newsCreatehandler ニュースを作成するハンドラ
     * @param TagGetByIdsHandler $tagGetByIdsHandler タグを取得するハンドラ
     * @return RedirectResponse リダイレクトレスポンス
     */
    public function post(
        NewsPostRequest $request,
        ImageRepositoryInterface $imageRepository,
        NewsCreateHandler $newsCreatehandler,
        TagGetByIdsHandler $tagGetByIdsHandler
    ): RedirectResponse {
        try {
            $newsImages = [];
            foreach($request->file() as $key => $image) {
                $newsImages[] = new Image(
                    id: $imageRepository->generateId(),
                    isThumbnail: $key === 'input-new-thumbnail',
                    filePath: $image->store('images/news'),
                );
            }

            $news = $newsCreatehandler->handle(
                title: $request->input('title'),
                body: $request->input('body'),
                author: $request->input('loginUser')['entity'],
                tags: $tagGetByIdsHandler->handle($request->input('tags', [])),
                images: $newsImages
            );

            status('success', 'ニュースを投稿しました。: '. $news->getId());
            return redirect()->route('home');
        } catch (Exception $e) {
            status('error', 'ニュースの投稿に失敗しました。');
            return redirect()->route('home');
        }
    }

    public function edit(NewsPostRequest $request) {
        dd($request);
    }

    public function delete(Request $request) {
        dd($request);
    }
}
