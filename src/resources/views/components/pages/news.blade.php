<x-common.base>
    <x-templates.header :user="$user" />
    <section class="flex justify-center flex-wrap items-start">
        <x-templates.news-view :isGuest="$isGuest" :news="$news" :paths="$paths" />
        <x-templates.news-detail :news="$news" :user="$user" :isGuest="$isGuest" title="投稿者" />
    </section>
    <x-templates.footer />
</x-common.base>
