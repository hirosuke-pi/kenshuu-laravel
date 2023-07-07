<main class="w-full lg:w-3/6 ">
    <x-organisms.breadcrumb-section :paths="$paths" />
    <ul class="flex justify-center flex-wrap">
        @foreach ($newsList as $news)
            <x-organisms.news-card :news="$news" isWide="true" />
        @endforeach
    </ul>
</main>
