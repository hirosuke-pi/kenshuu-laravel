<div class="w-full lg:w-3/6 ">
    <div class="m-3 p-2">
        <x-molecules.breadcrumb :paths="$paths" />
    </div>
    <div class="m-3">
        <x-molecules.alert-status :status="session(config('define.session.status'), [])" />
    </div>
    <ul class="flex justify-center flex-wrap">
        @foreach ($newsList as $news)
            <x-organisms.news-card :news="$news" isWide="true" />
        @endforeach
    </ul>
</div>
