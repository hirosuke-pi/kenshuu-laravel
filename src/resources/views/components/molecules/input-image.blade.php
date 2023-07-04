<div class="w-full relative">
    <img id="{{ $imageId }}" class="w-full" src="{{ $image->getUrl() }}" alt="news image">
    <input id="{{ $inputId }}" class="hidden image-input" type="file" name="{{ $inputId }}" accept="image/*">
    <div class="absolute top-0 right-0">
        <button id="{{ $buttonId }}" type="button" class="m-2 px-3 py-2 text-xl border border-gray-400 bg-gray-100 rounded-full opacity-80 hover:opacity-100" >
            <i class="fa-solid fa-upload"></i>
        </button>
    </div>
</div>
<script>
    document.getElementById('{{ $buttonId }}')?.addEventListener('click', (event) => {
        document.getElementById('{{ $inputId }}')?.click();
    });
    document.getElementById('{{ $inputId }}')?.addEventListener('change', (event) => {
        const file = event.target.files[0];
        const reader = new FileReader();
        reader.readAsDataURL(file);
        reader.onload = () => {
            document.getElementById('{{ $imageId }}')?.setAttribute('src', reader.result);
        };
    });
</script>
