<li class="m-3 {{ $cardSizeStyle }}">
    <div class="rounded overflow-hidden border border-gray-300">
        <a href="{{ $newsLink }}" class="">
            <img class="w-full" src="{{ $thumbnailImageUrl }}" alt="news image">
        </a>
        <div class="px-6 py-4">
            <a href="{{ $newsLink }}" class="hover:underline hover:text-gray-500">
                <h3 class="font-bold text-xl mb-2"><i class="fa-solid fa-newspaper"></i> {{ $news->getTitle() }}</h3>
            </a>
            <p class="text-gray-700 text-base ellipsis-line-3">
                {{ $news->getBody() }}
            </p>
            @if ($news->isUpdated())
                <p class="text-gray-700 text-base mt-4">
                    <i class="fa-solid fa-pen-to-square"></i> {{ $news->getUpdatedAt() }}
                </p>
            @else
                <p class="text-gray-700 text-base mt-4">
                    <i class="fa-regular fa-calendar"></i> {{ $news->getCreatedAt() }}
                </p>
            @endif
        </div>
        <hr class="ml-3 mr-3 mt-1 mb-1">
        <div class="px-6 pt-4 pb-2">
            TagCheckbox::render($tags, false)
        </div>
    </div>
</li>
