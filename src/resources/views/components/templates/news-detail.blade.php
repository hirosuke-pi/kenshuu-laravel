<aside class="w-full lg:w-80 m-3">
    <x-organisms.user-section title="投稿者" :user="$newsUser" :isAdmin="$isAdmin" />
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
