<x-common.base>
    <x-templates.header :loginUser="$loginUser" />
    <section class="flex justify-center flex-wrap items-start">
        <x-templates.user-posts :user="$user" :newsList="$newsList" />
        <x-templates.user-aside :user="$user" :isAdmin="$isAdmin" />
    </section>
    <x-templates.footer />
</x-common.base>
