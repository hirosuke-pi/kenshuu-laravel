<article class="p-5">
    <h2 class="text-4xl text-gray-800 font-bold mt-2 mb-2">
        {{ $news->getTitle() }}
    </h2>
    <hr/>
    <section class="mt-2">
        <div class="flex flex-wrap">
            <p class="mx-2 mt-2 text-gray-700">
                <i class="fa-regular fa-calendar"></i> {{ $news->getCreatedAtFormat() }}
            </p>
            @if($news->isUpdated())
                <p class="mx-2 mt-2 text-gray-700">
                    <i class="fa-solid fa-pen-to-square"></i> {{ $news->getUpdatedAtFormat() }} (更新)
                </p>
            @endif
        </div>
        <iframe class="w-full" id="message" srcdoc="" scrolling="no" sandbox="allow-same-origin allow-popups allow-popups-to-escape-sandbox"></iframe>
        <p id="message-raw" class="hidden">
{{ $news->getBody() }}
        </p>
    </section>
    <script>
        const rawMd = document.getElementById('message-raw').innerText
        const md = DOMPurify.sanitize(marked.parse(rawMd));

        const iframeElement = document.getElementById('message');
        iframeElement.srcdoc = md.replaceAll('<a', '<a target="_blank" ');
        iframeElement.addEventListener('load', () => {
            iframeElement.style.height = (iframeElement.contentWindow.document.body.scrollHeight + 50) + 'px';
        });
    </script>
</article>
