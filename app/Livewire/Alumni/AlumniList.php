<?php

namespace App\Livewire\Alumni;

use App\Models\Status;
use Livewire\Component;
use App\Models\Alumni;
class AlumniList extends Component
{
    public $search = "";
    public $graduationBatch = "";

    public function render()
    {
        
        return view('livewire.alumni.alumni-list', [
            "alumni" => $this->query()
        ]);
    }

    public function query() {

        return Alumni::searchAlumniName($this->search)
                     ->get();
    }
}

