<aside class="w-full lg:w-80 m-3">
    <section class="bg-gray-100 border border-gray-300 rounded-lg p-5">
        <h3 class="text-xl text-gray-800 font-bold border-b border-gray-400">
            <i class="fa-solid fa-user"></i>  {{ $title }}
        </h3>
        <div class="mt-3 flex justify-center items-center flex-col">
            <a class="flex flex-col justify-center items-center hover:underline" href="{{ $newsUserLink }}">
                <img class="w-20 h-20 rounded-full object-cover mb-1" src="{{ $newsUser->getProfileImageUrl() }}" alt="user image">
                <p class="text-xl font-bold text-gray-700 text-center">{{ $newsUser->getNameTag() }}</p>
            </a>
            <p class="text-gray-600 mt-2">記事投稿数: <strong>{{ $newsUser->getPostsCount() }}件</strong></p>
            @if ($isAdmin)
                <a href="#" class="w-full border border-gray-400 hover:bg-gray-300 text-gray-600 font-bold py-2 px-4 rounded text-center mt-3">
                    <i class="fa-solid fa-user-gear"></i> ユーザー設定
                </a>
            @endif
        </div>
    </section>
    <section class="border border-gray-300 rounded-lg p-5 mt-3">
        <h3 class="text-xl text-gray-800 font-bold border-b border-gray-400">
            <i class="fa-solid fa-tags"></i> タグ
        </h3>
        <div class="mt-3 flex flex-wrap">
            @foreach($news->getTags() as $tag)
                <x-atoms.category-tag :name="$tag->getName()" />
            @endforeach
        </div>
    </section>
    <section class="border border-gray-300 rounded-lg p-5 mt-3">
        <h3 class="text-xl text-gray-800 font-bold border-b border-gray-400">
            <i class="fa-solid fa-images"></i> 画像一覧
        </h3>
        <div class="mt-5">
            @foreach($news->getImages() as $image)
                <div class="mt-2 rounded-md overflow-hidden">
                    <img class="w-full" src="{{ $image->getUrl() }}" alt="news image">
                </div>
            @endforeach
        </div>
    </section>
</aside>
