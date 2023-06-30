<x-common.base>
    <x-templates.header :user="$user" />
    <section class="flex justify-center flex-wrap items-start">
        <x-templates.news-view :isGuest="$isGuest" :news="$news" :paths="$paths" />

    </section>
    <x-templates.footer />
</x-common.base>
