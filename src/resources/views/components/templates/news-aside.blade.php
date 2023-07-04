<aside class="w-full lg:w-80 m-3">
    <x-organisms.user-section title="投稿者" :user="$newsUser" :isAdmin="$isAdmin" />
    <x-organisms.tag-section :tags="$news->getTags()" />
    <x-organisms.image-section :images="$news->getImages()" />
</aside>
