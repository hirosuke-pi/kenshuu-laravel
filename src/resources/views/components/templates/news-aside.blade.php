<aside class="w-full lg:w-80 m-3">
    <x-organisms.user-section title="投稿者" :user="$author" :isAdmin="$isAdmin" />
    <x-organisms.tag-section :tags="$tags" :isCheckbox="$isNewCreate" />
    <x-organisms.image-section :images="$images" :isEdit="$isEditorMode && $isNewCreate" />
</aside>
