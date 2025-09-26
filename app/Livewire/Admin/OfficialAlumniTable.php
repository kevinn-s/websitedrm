<?php

namespace App\Livewire\Admin;

use App\Models\OfficialAlumni;
use Livewire\Component;

class OfficialAlumniTable extends Component
{

    public $search = "";
    public $filterDate = ['startDate' => "", 'endDate' => ""];

    protected $listeners = ['updateDate', 'callClearQuery'];
    public function render()
    {
        return view('livewire.admin.official-alumni-table', [
            'official_alumni' => $this->query()
        ]);
    }

    public function updateDate($date)
    {
        $dates = explode(' - ', $date);
        if(count($dates) === 1){
            $this->filterDate['startDate'] = $dates[0];
            return;
        }
        // dd([explode(' - ', $date), $date]);
        $this->filterDate['startDate'] = $dates[0];
        $this->filterDate['endDate'] = $dates[1];

    }
    public function query() {
        return OfficialAlumni::searchStudentName($this->search)->
                               filterLegitimationDate($this->filterDate['startDate'], $this->filterDate['endDate'])->get();
        
    }

    public function callClearQuery() {
        $this->filterDate['startDate'] = '';
        $this->filterDate['endDate'] = '';
        $this->search = '';
        $this->dispatch('clear-datepicker');
    }
}

