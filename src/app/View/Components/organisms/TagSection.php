<?php

namespace App\View\Components\organisms;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use Packages\Handlers\Tag\TagGetAllHandler;
use Packages\Infrastructure\Repositories\EloquentTagRepository;

class TagSection extends Component
{
    public readonly ?array $tags;
    public readonly ?array $checkboxTags;
    public readonly bool $isCheckbox;

    /**
     * Create a new component instance.
     */
    public function __construct(array $tags, bool $isCheckbox = false)
    {
        if ($isCheckbox) {
            $handler = new TagGetAllHandler(new EloquentTagRepository());
            $tagAll = $handler->handle();

            $checkboxTags = [];
            foreach($tagAll as $tag) {
                $checkboxTags[] = [
                    'checked' => !empty(array_filter($tags, fn($t) => $t->getId() === $tag->getId())),
                    'tag' => $tag
                ];
            }
            $this->checkboxTags = $checkboxTags;
            $this->tags = [];
        }
        else {
            $this->tags = $tags;
            $this->checkboxTags = [];
        }
        $this->isCheckbox = $isCheckbox;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.organisms.tag-section');
    }
}
