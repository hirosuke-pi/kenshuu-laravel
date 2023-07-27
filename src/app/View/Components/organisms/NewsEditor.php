<?php

namespace App\View\Components\organisms;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use Packages\Domains\Entities\Image;
use Packages\Domains\Entities\News;

class NewsEditor extends Component
{
    public readonly ?News $news;
    public readonly ?Image $thumbnailImage;
    public readonly string $title;
    public readonly string $body;
    public readonly bool $isNewNews;
    public readonly string $formLink;

    /**
     * ニュースエディタを表示するコンポーネント
     *
     * @param News|null $news ニュースEntity
     */
    public function __construct(?News $news = null)
    {
        if (is_null($news)) {
            $this->news = null;
            $this->thumbnailImage = null;
            $this->title = '';
            $this->body = '';
            $this->isNewNews = true;
            $this->formLink = route('news.create');
        }
        else {
            $this->news = $news;
            $this->thumbnailImage = $news->getThumbnailImage();
            $this->title = $news->getTitle();
            $this->body = $news->getBody();
            $this->isNewNews = false;
            $this->formLink = route('news.edit', ['newsId' => $news->getId()]);
        }
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.organisms.news-editor');
    }
}
