<header class="flex justify-center mt-10 mb-3">
    <div class="flex justify-between w-9/12 flex-wrap">
        <a href="/" class="text-gray-800 group">
            <h1 class="text-6xl font-bold">
                <i class="fa-solid fa-bolt-lightning group-hover:text-yellow-400"></i> Flash News +
            </h1>
        </a>
        <div class="flex items-center text-gray-700 flex-wrap">
            @if ($user->isGuest())
                <x-molecules.guest-header />
            @else
                <x-molecules.user-header :user="$user" />
            @endif
        </div>
    </div>
</header>
<hr class="ml-3 mr-3 mb-5"/>
