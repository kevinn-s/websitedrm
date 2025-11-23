<?php

use Livewire\Volt\Component;
use Livewire\WithPagination;
use App\Models\Event;
use Livewire\Attributes\Layout;

new #[Layout('layouts.app')] class extends Component {
   public int $limit = 3;

    public function loadMore()
    {
        $this->limit += 3;
    }

    public function with()
    {
        return [
            'events' => Event::orderBy('created_at', 'desc')->take($this->limit)->get(),
            'total' => Event::count(),
        ];
    }
};
?>

<div class="space-y-4">
    @foreach ($events as $event)
        <div class="p-4 bg-white shadow rounded">
            {{ $event->title }}
        </div>
    @endforeach

    @if ($events->count() < $total)
        <button
            wire:click="loadMore"
            class="px-4 py-2 bg-blue-600 text-white rounded mt-4"
        >
            Load More
        </button>
    @endif
</div>
