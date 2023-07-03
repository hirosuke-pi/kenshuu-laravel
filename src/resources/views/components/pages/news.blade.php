<x-common.base>
    <x-templates.header :loginUser="$loginUser" />
    <section class="flex justify-center flex-wrap items-start">
        <x-templates.news-view :news="$news" :isAdmin="$isAdmin" :paths="$paths" />
        <x-templates.news-detail :news="$news" :isAdmin="$isAdmin" title="投稿者" />
    </section>
    <x-templates.footer />
</x-common.base>
