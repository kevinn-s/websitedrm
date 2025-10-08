<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class TagInput extends Component
{
    /**
     * Create a new component instance.
     */
    public string $uuid;

    public function __construct(
        public ?string $id = null,
        public ?int $tagWidth = null,
        public ?int $tagHeight = null,
        public ?int $tagGap = null,
        public ?int $gap = null,
        public ?string $inputClass = '',
    ) {
        $this->uuid = "drm" . md5(serialize($this)) . $id;
    }

    public function modelName(): ?string
    {
        return $this->attributes->whereStartsWith('wire:model')->first();
    }


    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.tag-input');
    }
}
