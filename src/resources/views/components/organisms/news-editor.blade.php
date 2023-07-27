<form id="newsForm" action="{{ $formLink }}" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="rounded-lg border border-gray-300 m-3 overflow-hidden">
        <x-molecules.input-image :image="$thumbnailImage" defaultPrefix="new-thumbnail" />
        <article class="p-5">
            <h2 class="text-4xl text-gray-800 font-bold mt-2 mb-2">
                <label for="default-input" class="block mb-2 mt-5 text-sm font-medium">タイトル</label>
                <input value="{{ $title }}" name="title" placeholder="タイトル" type="text" id="default-input" class="border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
            </h2>
            <section class="mt-2">
                <p class="text-gray-700 mt-5">
                    <label for="message" class="block mb-2 mt-5 text-sm font-medium">投稿内容</label>
                    <textarea name="body" id="message" rows="10" class="block p-2.5 w-full text-sm text-gray-900 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500" placeholder="投稿内容">{{ $body }}</textarea>
                </p>
            </section>
        </article>
    </div>
    <div class="p-3">
        <button class="w-full bg-blue-400 hover:bg-blue-500 text-white font-bold py-2 px-4 rounded ">
            @if($isNewNews)
                <i class="fa-solid fa-plus"></i> ニュースを作成
            @else
                <i class="fa-solid fa-rotate-right"></i> ニュースを更新
            @endif
        </button>
    </div>
</form>
<script>
    const easyMDE = new EasyMDE({
        spellChecker: false,
        hideIcons: ['guide', 'preview', 'side-by-side'],
    });
    document.getElementById('newsForm').addEventListener('formdata', (event) => {
        document.querySelectorAll('.image-input').forEach((element) => {
            if (!element?.files?.[0]) return;
            event.formData.append(element.name, element.files[0]);
        });
        document.querySelectorAll('.tag-input').forEach((element) => {
            if (!element.checked) return;
            event.formData.append(element.name, element.value);
        });
    });
</script>
