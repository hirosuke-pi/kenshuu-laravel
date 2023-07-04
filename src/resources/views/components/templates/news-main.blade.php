<div class="w-full lg:w-3/6 ">
    <x-organisms.breadcrumb-section :paths="$paths" />
    @if ($isAdmin && !$isEditorMode)
        <x-molecules.news-action />
    @endif
    <main class="rounded-lg border border-gray-300 m-3 overflow-hidden">
        <img class="w-full" src="{{ $news->getThumbnailImageUrl() }}" alt="news image">
        @if ($isEditorMode)
            <x-organisms.news-editor :news="$news" />
        @else
            <x-organisms.news-viewer :news="$news" />
        @endif
    </main>
</div>
