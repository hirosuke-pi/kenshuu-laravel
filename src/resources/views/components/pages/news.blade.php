<x-common.base>
    <x-templates.header :user="$user" />
    <h1>{{ $news->getTitle() }}</h1>
    <x-templates.footer />
</x-common.base>
