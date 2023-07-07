<aside class="w-full lg:w-80 m-3">
    <x-organisms.user-section title="投稿者" :user="$newsUser" :isAdmin="$isAdmin" />
    <x-organisms.tag-section :tags="$tags" :isCheckbox="$isNewMode" />
    <x-organisms.image-section :images="$images" :isEdit="$isEditorMode" />
</aside>
