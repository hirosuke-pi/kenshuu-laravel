<x-common.base>
    <x-templates.header :loginUser="$loginUser" />
    <section class="flex justify-center flex-wrap items-start">
        <div class="flex justify-center items-center flex-wrap">
            <x-organisms.user-form />
            <aside class="mx-2">
                <image class="w-full max-w-xl" src="{{ asset('img/assets/auth.jpg') }}" />
            </aside>
        </div>
    </section>
    <x-templates.footer />
</x-common.base>
