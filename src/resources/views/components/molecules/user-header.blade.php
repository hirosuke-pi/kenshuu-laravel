<form action="#" method="POST">
    <button class="hover:bg-gray-200 rounded-lg p-2 mr-4 mt-3 ">
        <i class="fa-solid fa-right-from-bracket"></i> ログアウト
    </button>
</form>
<a href="#" class="flex items-center py-2 px-4 hover:bg-gray-200 rounded-lg border border-gray-300 mt-3">
    <img class="w-7 h-7 rounded-full object-cover mr-1" src="{{ $user->getProfileImageUrl() }}" alt="user image">
    <p class="text-xl font-bold">{{ $user->getNameTag() }}</p>
</a>

