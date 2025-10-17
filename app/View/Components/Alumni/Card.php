<?php

namespace App\View\Components\Alumni;

use App\Models\Alumni;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use Illuminate\Support\Facades\Storage as StorageFacade;

class Card extends Component
{
    public ?Alumni $alumni;

    public function __construct(
        ?Alumni $alumni = null
    ) {
        $this->alumni = $alumni;
    }

    public function avatar(): string
    {
        if (! $this->alumni || ! $this->alumni->profile_photo_path) {
            return asset('images/placeholder.png');
        }

        $image = $this->alumni->profile_photo_path;

        if (filter_var($image, FILTER_VALIDATE_URL)) {
            return $image;
        }

        if (StorageFacade::disk('public')->exists($image)) {
            return StorageFacade::url($image);
        }

        return asset('storage/' . ltrim($image, '/'));
    }

    public function render(): View|Closure|string
    {
        return view('components.alumni.card', [
            'avatar' => $this->avatar(),
        ]);
    }
}