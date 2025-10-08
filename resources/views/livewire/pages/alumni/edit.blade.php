<?php

use Livewire\Volt\Component;
use Livewire\Attributes\Layout;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Models\User;
use App\Models\Alumni;
use App\Enums\UserRole;

new #[Layout('layouts.app')] class extends Component {
    use WithFileUploads;

    public Alumni $alumni;

    public string $name = '';

    public string $email = '';

    public string $phone = '';


    public array $competencies = [];

    public $avatar;

    public function mount()
    {
        $this->alumni = Auth::user()->alumni;

        $this->avatar = $this->alumni->profile_photo_path ?? null;

        $this->name = $this->alumni->name;
        $this->email = $this->alumni->email;
        $this->phone = $this->alumni->phone_number ?? '';

        $this->competencies = (function() {
            if($this->competencies === null || count($this->competencies) === 0)
            {
                return ['the weeknd'];
            } return $this->competencies;
        })();


    }

    public function rules()
    {
        return [
            'name' => 'required|string|max:255',
            'avatar' => 'nullable|image|max:2048', // 2MB max
        ];
    }

    public function update()
    {
        $this->validate();

        $data = [
            'name' => $this->name,
        ];

        if ($this->avatar) {
            if ($this->alumni->profile_photo_path) {
                Storage::disk('public')->delete($this->alumni->profile_photo_path);
            }

            $path = $this->avatar->store('profile-picture', 'public');
            $data['profile_photo_path'] = $path;
        }

        $this->alumni->update($data);

        session()->flash('message', 'Profile updated successfully.');

        return redirect()->route('profile');
    }

}; ?>
@php
    $config = [
        'modal' => true,
        'guides' => true,
        'aspectRatio' => 1 / 1.5
    ];
@endphp

<div>
    <h2 class="text-2xl font-bold mb-4">Edit Alumni Profile</h2>

    @if (session()->has('message'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
            {{ session('message') }}
        </div>
    @endif

    <form wire:submit.prevent="update" class="w-4/12">

        <fieldset class="space-y-4  ">
            <x-input class="w-full h-10 border-[0.4px] border-gray-300" label="Nama Lengkap" required wire:model="name"></x-input>

            <x-input class="w-full h-10 border-[0.4px] border-gray-300" label="Email" required wire:model="email"></x-input>

            <div class="w-full space-y-0.5">
                <label >Domisili Pekerjaan</label>
                <div class="flex gap-3">
                    <x-input class="border-[0.4px] border-gray-300" placeholder="Kota"></x-input>
                <x-input class="border-[0.4px] border-gray-300" placeholder="Provinsi"></x-input>
                </div>
            
            </div>

                   
            <div class="w-full space-y-0.5">
                <label for="competencies">Kompetensi</label>
                <x-tag-input 
                    name="competencies"
                    wire:model="competencies"
                    placeholder="Silahkan isi kompetensi anda"
                    input-class="border-gray-300 border-[0.4px]"
                    class="space-y-2"
                />
            </div>

         </fieldset>
        <div>
            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">
                Update Profile
            </button>
        </div>

    </form>

</div>