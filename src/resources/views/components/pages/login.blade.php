<x-common.base>
    <x-templates.header :loginUser="$loginUser" />
    <section class="flex justify-center items-center flex-wrap">
        <aside class="mx-2">
            <image class="w-full max-w-xl" src="{{asset('img/assets/auth.jpg')}}" />
        </aside>
        <x-organisms.login-form />
    </section>
    <x-templates.footer />
</x-common.base>
