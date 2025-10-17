<?php

use Livewire\Volt\Component;
use Livewire\Attributes\Layout;
use Livewire\WithPagination;
use App\Models\Alumni;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Url;

new #[Layout('layouts.app')] class extends Component {
    use WithPagination;

    #[Url(history: true, except: '')]
    public string $search = '';

    #[Url(history: true, except: '')]
    public string $graduationBatch = '';

    public function updatingSearch(): void
    {
        $this->resetPage();
    }

    public function updatingGraduationBatch(): void
    {
        $this->resetPage();
    }

    #[Computed]
    public function alumni()
    {
        return Alumni::query()
            ->when($this->search !== '', function ($query) {
                $term = '%' . $this->search . '%';
                $query->where(function ($q) use ($term) {
                    $q->where('name', 'like', $term)
                        ->orWhere('student_id', 'like', $term)
                        ->orWhere('email', 'like', $term)
                        ->orWhere('phone_number', 'like', $term);
                });
            })
            ->when($this->graduationBatch !== '', function ($query) {
                $query->whereHas('education', function ($q) {
                    $q->where('graduation_batch', $this->graduationBatch);
                });
            })
            ->with(['profession', 'education'])
            ->orderBy('name')
            ->paginate(9);
    }

    #[Computed]
    public function availableBatches()
    {
        return Alumni::query()
            ->whereHas('education')
            ->with('education:id,alumni_id,graduation_batch')
            ->get()
            ->pluck('education.graduation_batch')
            ->filter()
            ->unique()
            ->sort()
            ->values()
            ->reverse();
    }

    public function clearFilters(): void
    {
        $this->reset(['search', 'graduationBatch']);
        $this->resetPage();
    }
}; ?>

<div>
    <x-page-title title="Alumni" :breadcrumbs="[
        ['label' => 'Beranda', 'url' => url('dashboard')],
        ['label' => 'Alumni', 'url' => ''],
    ]" background="bg-black" />

    <div class="px-6 md:px-20 lg:px-36 pb-32 bg-white">
        <div class="py-10 text-lg space-y-8 w-full lg:w-[70%]">
            <p class="text-gray-700">
                Halaman ini merupakan direktori alumni yang memudahkan Anda untuk menemukan rekan dari berbagai angkatan, dan membangun koneksi yang bermakna.
            </p>
        </div>

        <div class="bg-white shadow-sm md:py-2">
            <div class="flex flex-col gap-4 md:flex-row md:items-end">
                <div class="w-full md:w-[40%]">
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        Cari Alumni
                    </label>
                    <input 
                        type="text" 
                        wire:model.live.debounce.300ms="search"
                        class="w-full border-gray-300 px-4 py-2 focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-500"
                        placeholder="Cari nama, email, atau NIM" 
                    />
                </div>

                <div class="w-full md:w-[40%]">
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        Filter Berdasarkan Tahun Wisuda
                    </label>
                    <select 
                        wire:model.live="graduationBatch"
                        class="w-full border-gray-300 px-4 py-2 focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-500"
                    >
                        <option value="">Semua Tahun Wisuda</option>
                        @foreach($this->availableBatches as $batch)
                            <option value="{{ $batch }}">{{ $batch }}</option>
                        @endforeach
                    </select>
                </div>

                @if($search !== '' || $graduationBatch !== '')
                    <div class="w-full md:w-auto">
                        <button 
                            type="button"
                            wire:click="clearFilters"
                            class="w-full md:w-auto px-4 py-3 text-sm font-medium text-gray-700 bg-gray-100 rounded-md hover:bg-gray-200 focus:outline-none focus:ring-2 focus:ring-gray-500"
                        >
                            Reset Filter
                        </button>
                    </div>
                @endif
            </div>

            @if($search !== '' || $graduationBatch !== '')
                <div class="mt-4 text-sm text-gray-600">
                    <span class="font-medium">Filter aktif:</span>
                    @if($search !== '')
                        <span class="inline-flex items-center px-2 py-1 rounded-md bg-blue-50 text-blue-700 text-xs ml-2 mt-1">
                            Pencarian: "{{ $search }}"
                        </span>
                    @endif
                    @if($graduationBatch !== '')
                        <span class="inline-flex items-center px-2 py-1 rounded-md bg-blue-50 text-blue-700 text-xs ml-2 mt-1">
                            Tahun Wisuda: {{ $graduationBatch }}
                        </span>
                    @endif
                </div>
            @endif
        </div>

        <div wire:loading wire:target="search,graduationBatch" class="w-full flex justify-center items-center py-20">
            <div class="text-center">
                <svg class="animate-spin h-12 w-12 text-blue-600 mx-auto" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                </svg>
                <p class="mt-4 text-sm text-gray-600 font-medium">Memuat data alumni...</p>
            </div>
        </div>

        <div wire:loading.remove wire:target="search,graduationBatch" class="mt-8">
            <div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-3">
                @forelse ($this->alumni as $alumnus)
                    <x-alumni.card :alumni="$alumnus" />
                @empty
                    <div class="col-span-full border-2 border-dashed border-gray-300 py-16 text-center bg-gray-50">
                        <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                        </svg>
                        <h3 class="mt-4 text-lg font-semibold text-gray-700">Data alumni tidak ditemukan</h3>
                        <p class="mt-2 text-sm text-gray-500">
                            @if($search !== '' || $graduationBatch !== '')
                                Tidak ada alumni yang sesuai dengan filter Anda.
                            @else
                                Belum ada data alumni yang tersedia.
                            @endif
                        </p>
                        @if($search !== '' || $graduationBatch !== '')
                            <button 
                                wire:click="clearFilters"
                                class="mt-4 inline-flex items-center px-4 py-2 text-sm font-medium text-white bg-blue-600 rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500"
                            >
                                Reset Filter
                            </button>
                        @endif
                    </div>
                @endforelse
            </div>
        </div>

        @if($this->alumni->hasPages())
            <div class="mt-8">
                {{ $this->alumni->links() }}
            </div>
        @endif
    </div>
</div>