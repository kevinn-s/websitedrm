<?php
namespace App\Livewire\Alumni;
use App\Models\Alumni;
use Livewire\Component;

class Profile extends Component
{
    public $id;
    public $alumni;
    
    // Laravel automatically passes route parameters to mount()
    public function mount($id)
    {
        $this->id = $id;
        $this->alumni = Alumni::find($id); // Remove ->get() since find() returns single model
    }
    
    public function render()
    {
        return view('livewire.alumni.profile');
    }
}