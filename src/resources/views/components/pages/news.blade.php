<x-common.base>
    <x-templates.header :loginUser="$loginUser" />
    <section class="flex justify-center flex-wrap items-start">
        <x-templates.news-main :news="$news" :isAdmin="$isAdmin" :paths="$paths" :isEditorMode="$isEditorMode" />
        <x-templates.news-aside :news="$news" :isAdmin="$isAdmin" title="投稿者" :isNewMode="$isNewMode" :isEditorMode="$isEditorMode" />
    </section>
    <x-templates.footer />
</x-common.base>
