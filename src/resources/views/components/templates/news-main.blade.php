<div class="w-full lg:w-3/6 ">
    <x-organisms.breadcrumb-section :paths="$paths" />
    @if ($isAdmin && !$isEditorMode)
        <x-molecules.news-action :news="$news" />
    @endif
    @if ($isEditorMode)
        <main>
            <x-organisms.news-editor :news="$news" />
        </main>
    @else
        <main class="rounded-lg border border-gray-300 m-3 overflow-hidden">
            <x-organisms.news-viewer :news="$news" />
        </main>
    @endif
    </main>
</div>
