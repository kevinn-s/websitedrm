<?php

namespace App\View\Components\Events;

use App\Enums\EventType;
use App\Enums\EventAccessType;
use App\Models\EventAccess;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use App\Models\Event;

class Card extends Component
{
    public ?Event $event;
    public ?string $title;
    public ?string $description;
    public ?string $date;
    public ?string $location;
    public ?string $image;
    public ?EventType $type;
    public ?EventAccess $access;

    /**
     * Create a new component instance.
     */
    public function __construct(
        ?Event $event = null,
        ?string $title = null,
        ?string $description = null,
        ?string $date = null,
        ?string $location = null,
        ?string $image = null,
        ?string $type = null,
        ?EventAccess $access = null
    ) {
        $this->event = $event;
        $this->title = $title ?? $event?->title;
        $this->description = $description ?? $event?->description;
        $this->date = $date ?? $event?->event_date;
        $this->location = $location ?? $event?->location;
        $this->image = $image ?? $event?->image;
        $this->type = $type ?? $event?->type;
        $this->access = $access ?? $event?->access;
        
    }

    /**
     * Get formatted date
     */
    public function formattedDate(): ?string
    {
        if (!$this->date) {
            return null;
        }

        try {
            return \Carbon\Carbon::parse($this->date)->format('d M Y');
        } catch (\Exception $e) {
            return $this->date;
        }
    }

    /**
     * Get formatted date with day
     */
    public function formattedDateWithDay(): ?string
    {
        if (!$this->date) {
            return null;
        }

        try {
            return \Carbon\Carbon::parse($this->date)->format('l, d F Y');
        } catch (\Exception $e) {
            return $this->date;
        }
    }

    /**
     * Get short description
     */
    public function shortDescription(int $length = 150): ?string
    {
        if (!$this->description) {
            return null;
        }

        return strlen($this->description) > $length 
            ? substr($this->description, 0, $length) . '...' 
            : $this->description;
    }

    /**
     * Get image URL or placeholder
     */
    public function imageUrl(): string
    {
        if ($this->image) {
            // If it's a full URL
            if (filter_var($this->image, FILTER_VALIDATE_URL)) {
                return $this->image;
            }
            // If it's a storage path
            return asset('storage/' . $this->image);
        }

        // Return placeholder
        return asset('images/placeholder-event.jpg');
    }

    /**
     * Get type badge color
     */
    public function typeBadgeColor(): string
    {
        
    }

    /**
     * Get type label
     */
    public function typeLabel(): string
    {
     
    }

    /**
     * Check if event is past
     */
    public function isPast(): bool
    {
        if (!$this->date) {
            return false;
        }

        try {
            return \Carbon\Carbon::parse($this->date)->isPast();
        } catch (\Exception $e) {
            return false;
        }
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.events.card');
    }
}