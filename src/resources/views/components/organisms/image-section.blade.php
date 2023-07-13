<section class="border border-gray-300 rounded-lg p-5 mt-3">
    <h3 class="text-xl text-gray-800 font-bold border-b border-gray-400">
        <i class="fa-solid fa-images"></i> 画像一覧
    </h3>
    <div class="mt-5">
        @if ($isEdit)
            @foreach($images as $key => $image)
                <div class="overflow-hidden rounded mt-2">
                    <x-molecules.input-image :image="$image" :defaultPrefix="$key" />
                </div>
            @endforeach
        @else
            @foreach($images as $image)
                <x-molecules.view-image :image="$image" />
            @endforeach
        @endif
    </div>
</section>
