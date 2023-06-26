<div class="flex flex-col justify-center items-center">
    <div class="w-11/12">
        <x-organisms.news-search />
    </div>
    <div class="w-11/12">
        <div class="m-3">
            <x-molecules.alert-status />
        </div>
        <div>
            <ul class="flex justify-center flex-wrap">
                @if (count($newsList) > 0)
                    @foreach ($newsList as $news)
                        NewsCard::render($news, CardSize::SMALL)
                    @endforeach
                @else
                    <li class="flex justify-center items-center my-3">
                        <p class="text-gray-700 text-2xl">ニュースがありません！</p>
                    </li>
                @endif
            </ul>
        </div>
    </div>
</div>
