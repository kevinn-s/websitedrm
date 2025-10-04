<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Event;

class Details extends Component
{
    public $event;
    public $eventType;
    public $slug;

    public function mount($slug, $type = 'scheduled')
    {
        $this->slug = $slug;
        $this->eventType = $type;
        
        $this->event = Event::where('slug', $this->slug)
            ->where('type', $this->eventType)
            ->firstOrFail();
    }

    public function render()
    {
        return view('livewire.kegiatan.details');
    }
}