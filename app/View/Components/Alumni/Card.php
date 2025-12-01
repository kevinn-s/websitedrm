<?php

namespace App\View\Components\Alumni;

use App\Models\Alumni;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

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
        return $this->alumni?->profile_photo_url ?? asset('images/placeholder.png');
    }

    public function render(): View|Closure|string
    {
        return view('components.alumni.card', [
            'avatar' => $this->avatar(),
        ]);
    }
}
