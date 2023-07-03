<x-common.base>
    <x-templates.header :loginUser="$loginUser" />
    <section class="flex justify-center flex-wrap items-start">
        <x-templates.user-posts :user="$user" :newsList="$newsList" />
    </section>
    <x-templates.footer />
</x-common.base>
