<?php

namespace App\Livewire\Admin;

use App\Models\Status;
use Livewire\Component;
use App\Models\User;
class AlumniTable extends Component
{
    public $search = "";

    public ?Status $status = null;
    protected $listeners = ['callClearQuery'];
    public function render()
    {
        return view('livewire.admin.alumni-table', [
            'alumni' => $this->query()
        ]);
    }

    public function approve($id){
        $result = User::find($id)->approve();
        if (!$result) {
        // Dispatch an event to show the modal
        $this->dispatch('error-modal', message: 'Gagal untuk memvalidasi data alumni');
        }
        return $result;
    }

    public function reject($id){
        return User::find($id)->reject();
    }

        public function deleteAlumni($id)
        {
        $alumni = User::find($id);

        if (! $alumni) {
            return false;
        }
        try {
            $alumni->delete();
            return true;
        } catch (\Throwable $e) {
            \Log::error("Gagal menghapus alumni id {$id}: " . $e->getMessage());
            return false;
        }
    }

    public function query() {
        $alumni = User::searchUserName($this->search)->filterStatus($this->status)->get();
        $alumni->each(function ($a){
            $a->onOfficialAlumni = User::find($a->id)->onOfficialAlumniData();
        });
        return $alumni;                      
        
    }


    public function callClearQuery() {
        $this->search = '';
        $this->status = null;
    }
}
