<?php

namespace App\Http\Livewire\Admin;

use App\Models\EventType;
use App\Models\Event;
use Livewire\Component;
use Livewire\WithPagination;

class EventTable extends Component
{
    use WithPagination;

    public string $annualEventsSearch = '';

    public string $scheduledEventsSearch = '';

    public function createAnnualEvent()
    {
        
    }
    public function clearAnnualFilters()
    {
        $this->reset('annualSearch');
    }

    public function clearScheduledFilters()
    {
        $this->reset('scheduledSearch');
    }
    public function annualEventsQuery()
    {
        return Event::where('type', EventType::ANNUAL)
        ->when($this->annualSearch, fn ($query) => $query->where('title', 'like', "%{$this->annualSearch}%"))
        ->get();
    }

    public function scheduledEventsQuery()
    {
        return Event::where('type', EventType::SCHEDULED)
        ->when($this->scheduledSearch, fn ($query) => $query->where('title', 'like', "%{$this->scheduledSearch}%"))
        ->get();
    }
    public function render()
    {
        return view('livewire.admin.event-table', [
            'annualEvents' => $this->annualEventsQuery(),
            'scheduledEvents' => $this->scheduledEventsSearch()
        ]);
    }
}