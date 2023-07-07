<div class="flex items-center text-gray-700">
    <a class="ml-1 mr-3 hover:underline " href="/" class="hover:underline">
        <i class="fa-solid fa-house"></i> ホーム
    </a>
    @foreach($paths as $path)
        <i class="fa-solid fa-greater-than"></i>
        <a class="mx-3 hover:underline" href="{{ $path['link'] }}" class="text-gray-700 hover:underline">
            <i class="fa-regular fa-file-lines"></i> {{ $path['name'] }}
        </a>
    @endforeach
</div>
