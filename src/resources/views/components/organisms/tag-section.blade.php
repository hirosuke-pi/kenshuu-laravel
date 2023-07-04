<section class="border border-gray-300 rounded-lg p-5 mt-3">
    <h3 class="text-xl text-gray-800 font-bold border-b border-gray-400">
        <i class="fa-solid fa-tags"></i> タグ
    </h3>
    <div class="mt-3 flex flex-wrap">
        @if($isCheckbox)
            @foreach($tags as $tag)
                <x-atoms.category-checkbox :tag="$tag" />
            @endforeach
        @else
            @foreach($tags as $tag)
                <x-atoms.category-tag :name="$tag->getName()" />
            @endforeach
        @endif
    </div>
</section>
