<x-common.base>
    <x-templates.header :user="$user" />
    <section class="flex justify-center flex-wrap items-start">
        <x-templates.news-view :news="$news" :user="$user" :paths="$paths" />
        <x-templates.news-detail :news="$news" :user="$user" title="投稿者" />
    </section>
    <x-templates.footer />
</x-common.base>
