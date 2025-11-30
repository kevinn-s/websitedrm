<?php

use Livewire\Volt\Component;
use Livewire\Attributes\Layout;
use Livewire\WithPagination;
use App\Models\Alumni;
use App\Models\Education;
use App\Enums\Status;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Url;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

new #[Layout('layouts.app')] class extends Component {
    use WithPagination;

    #[Url(history: true, except: '')]
    public string $search = '';

    #[Url(history: true, except: '')]
    public string $graduationBatch = '';

    protected int $perPage = 9;
    public string $searchInput = '';
    public string $graduationBatchInput = '';

    public function mount(): void
    {
        $this->searchInput = $this->search;
        $this->graduationBatchInput = $this->graduationBatch;
    }

    public function updatingSearch(): void
    {
        // Any change to the search term should restart pagination so the first page always reflects the freshest results.
        $this->resetPage();
    }

    public function updatedSearch(string $value): void
    {
        $this->searchInput = $value;
    }

    public function updatingGraduationBatch(): void
    {
        // Changing batch filters should likewise return to the first page to avoid empty states on higher pages.
        $this->resetPage();
    }

    public function updatedGraduationBatch(?string $value): void
    {
        $this->graduationBatchInput = $value ?? '';
    }

    /**
     * Build the base query with every active filter so we reuse the same logic across computed properties.
     */
    protected function filteredQuery()
    {
        return Alumni::query()
            ->whereHas('user', function ($query) {
                $query->where('status', Status::Verified);
            })
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
            ->orderBy('name');
    }

    #[Computed]
    public function alumni()
    {
        return $this->filteredQuery()
            ->paginate($this->perPage)
            ->withQueryString();
    }

    #[Computed]
    public function availableBatches()
    {
        return Education::query()
            ->select('graduation_batch')
            ->whereNotNull('graduation_batch')
            ->distinct()
            ->orderByDesc('graduation_batch')
            ->pluck('graduation_batch');
    }

    public function clearFilters(): void
    {
        // Resetting to defaults ensures query-string + pagination all return to a clean state.
        $this->reset(['search', 'graduationBatch']);
        $this->searchInput = '';
        $this->graduationBatchInput = '';
        $this->resetPage();
    }

    public function applyFilters(): void
    {
        $this->search = $this->searchInput;
        $this->graduationBatch = $this->graduationBatchInput;
    }

    public function with(): array
    {
        return [
            'alumni' => $this->alumni,
            'batches' => $this->availableBatches,
        ];
    }
}; ?>

<div class="space-y-20">
    <x-page-title title="Alumni" :breadcrumbs="[
        ['label' => 'Beranda', 'url' => url('dashboard')],
        ['label' => 'Alumni', 'url' => ''],
    ]" background="bg-black" description="Bangun koneksi bersama komunitas Alumni DRM dan kembangkan jaringan profesional Anda." />

    <div class="max-w-5xl w-full mx-auto my-6 sm:my-10 px-4 sm:px-6 lg:px-0" x-data="{ toggle: false }">
        <div class="flex flex-col sm:flex-row sm:flex-wrap items-start justify-between gap-4 mb-6 sm:mb-8">
            <div class="max-w-xl space-y-2">
                <p class="text-sm sm:text-sm+ text-gray-600">Gunakan pencarian dan filter angkatan wisuda untuk menemukan rekan alumni sesuai kebutuhan anda.</p>
            </div>

            <div class="relative w-full sm:w-auto">
                <button type="button"
                    class="box-border h-11 w-full sm:w-auto px-4 inline-flex gap-2 items-center justify-center font-semibold font-noto tracking-tight text-white bg-primary-green-600 border-b-4 border-b-primary-green-800 transition-all duration-200 hover:bg-primary-green-700 hover:border-b-gray-800 active:translate-y-[2px] active:border-b-2"
                    @click="toggle = !toggle">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24">
                        <path fill="none" stroke="#ffffff" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4.5 7.25h15M7.385 12h9.23m-6.345 4.75h3.46" />
                    </svg>
                    <span class="tracking-wide">Filter</span>
                </button>

                <div class="absolute right-0 sm:right-0 left-0 sm:left-auto mt-4 w-full sm:w-[21rem] border-[0.5px] border-gray-300 border-b-primary-green-700 border-b-4 bg-white p-4 shadow-lg transition-all duration-200 z-20"
                    :class="toggle ? 'visible opacity-100 translate-y-0' : 'invisible opacity-0 -translate-y-2'"
                    x-show="toggle" x-transition>
                    <div class="flex items-center justify-between">
                        <h3 class="text-lg font-semibold text-primary-green-900">Filter dengan</h3>
                        <button type="button" @click="toggle = false">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 12 12">
                                <path fill="#000000" d="M2.22 2.22a.749.749 0 0 1 1.06 0L6 4.939L8.72 2.22a.749.749 0 1 1 1.06 1.06L7.061 6L9.78 8.72a.749.749 0 1 1-1.06 1.06L6 7.061L3.28 9.78a.749.749 0 1 1-1.06-1.06L4.939 6L2.22 3.28a.749.749 0 0 1 0-1.06Z" />
                            </svg>
                        </button>
                    </div>

                    <div class="mt-4 space-y-4">
                        <div class="space-y-2">
                            <label class="text-sm+ font-semibold text-gray-900">Cari alumni</label>
                            <div class="relative">
                                <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 20 20">
                                        <path fill="#c0c0c0" d="M12.9 14.32a8 8 0 1 1 1.41-1.41l5.35 5.33l-1.42 1.42l-5.33-5.34zM8 14A6 6 0 1 0 8 2a6 6 0 0 0 0 12z" />
                                    </svg>
                                </div>
                                <x-input class="w-full border-gray-300 pl-10" wire:model.defer="searchInput" placeholder="Nama, NIM, email, atau telepon"></x-input>
                            </div>
                        </div>

                        <div class="space-y-2">
                            <label class="text-sm+ font-semibold text-gray-900">Angkatan wisuda</label>
                            <div class="relative">
                                <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24">
                                        <path fill="#c0c0c0" d="M12 2L1 7l11 5l9-4.09V17h2V7L12 2Zm0 20l-6-3.27V13l6 2.73L18 13v5.73L12 22Z" />
                                    </svg>
                                </div>
                                <select wire:model.defer="graduationBatchInput" class="w-full appearance-none border border-gray-300 bg-white py-2 pl-10 pr-8 text-sm focus:outline-none focus:ring-2 focus:ring-primary-green-600">
                                    <option value="">Semua angkatan</option>
                                    @forelse ($batches as $batch)
                                        <option value="{{ $batch }}">Angkatan {{ $batch }}</option>
                                    @empty
                                        <option disabled>Tidak ada data angkatan</option>
                                    @endforelse
                                </select>
                                <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center pr-3">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24">
                                        <path fill="#6b7280" d="M7 10l5 5l5-5H7z" />
                                    </svg>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="mt-6 flex items-center justify-between">
                        <button type="button" class="underline text-sm+ underline-offset-4" @click="$wire.clearFilters(); toggle = false">
                            Reset
                        </button>
                        <x-button type="button" wire:click="applyFilters" @click="toggle = false">Terapkan</x-button>
                    </div>
                </div>
            </div>
        </div>

        <div class="border border-gray-100 bg-white p-4 text-sm text-gray-600">
            <span class="font-semibold text-primary-green-800">Filter aktif:</span>
            <div class="mt-1 flex flex-wrap items-center gap-2">
                <span class="inline-flex items-center gap-2 bg-primary-green-50 px-3 py-1 text-xs font-medium text-primary-green-700">
                    Kata kunci: <strong class="font-semibold text-primary-green-900">{{ $search !== '' ? $search : 'Semua' }}</strong>
                </span>
                <span class="inline-flex items-center gap-2 bg-primary-green-50 px-3 py-1 text-xs font-medium text-primary-green-700">
                    Angkatan: <strong class="font-semibold text-primary-green-900">{{ $graduationBatch !== '' ? 'Angkatan ' . $graduationBatch : 'Semua' }}</strong>
                </span>
            </div>
        </div>

        <div class="min-h-32">
            <div class="flex justify-center py-10" wire:loading.flex wire:target="search,graduationBatch,clearFilters,goToPage">
                <svg aria-hidden="true" class="h-10 w-10 animate-spin text-primary-green-500" viewBox="0 0 24 24" fill="none">
                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 0 1 8-8v4a4 4 0 0 0-4 4H4Z"></path>
                </svg>
                <span class="sr-only">Memuat data alumni...</span>
            </div>

            <div wire:loading.remove wire:target="search,graduationBatch,clearFilters,goToPage" class="space-y-8">
                @forelse ($alumni as $alumnus)
                    @php
                        $education = $alumnus->education;
                        $profession = $alumnus->profession;
                        $photo = $alumnus->profile_photo_path;

                        if ($photo) {
                            if (Str::startsWith($photo, ['http://', 'https://'])) {
                                $avatar = $photo;
                            } elseif (Storage::disk('public')->exists($photo)) {
                                $avatar = Storage::url($photo);
                            } else {
                                $avatar = asset(ltrim($photo, '/'));
                            }
                        } else {
                            $avatar = asset('images/avatar.jpg');
                        }

                        $competencyRaw = $alumnus->competency;
                        if (is_array($competencyRaw)) {
                            $competencies = collect($competencyRaw);
                        } elseif (is_string($competencyRaw) && $competencyRaw !== '') {
                            $competencies = collect(explode(',', $competencyRaw))->map(static fn ($item) => trim($item));
                        } else {
                            $competencies = collect();
                        }
                        $competencies = $competencies->filter()->take(3);
                        $bioSnippet = $alumnus->bio ? Str::limit(strip_tags($alumnus->bio), 140) : null;
                    @endphp

                    <div class="border border-slate-200 bg-white p-6 shadow-sm" wire:key="alumnus-{{ $alumnus->id ?? 'row-' . $loop->index }}">
                        <div class="flex flex-col gap-6 md:flex-row">
                            <div class="md:w-1/4">
                                <img src="{{ $avatar }}" alt="Foto {{ $alumnus->name ?? 'alumni' }}" class="aspect-[4/4] w-full object-cover" />
                            </div>
                            <div class="md:w-3/4 space-y-4">
                                <div class="flex flex-wrap items-start justify-between gap-3">
                                    <div>
                                        <h3 class="font-sora text-2xl font-semibold text-primary-green-950">
                                            {{ $alumnus->name ?? 'Nama belum tersedia' }}
                                        </h3>
                                        <div class="mt-1 flex flex-wrap items-center gap-3 text-sm text-gray-600">

                                            <span class="inline-flex items-center gap-1">

                                                {{ $education?->graduation_batch ? 'Angkatan ' . $education->graduation_batch : 'Angkatan belum tercatat' }}
                                            </span>
                                        </div>
                                    </div>
                                    <a href="{{ route('alumni.profile', ['alumni' => $alumnus->id]) }}" class="inline-flex items-center gap-2 bg-primary-green-500 px-4 py-2 text-sm font-semibold text-white transition hover:bg-primary-green-600">
                                        Lihat Profil
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
                                        </svg>
                                    </a>
                                </div>

                                @if ($bioSnippet)
                                    <p class="text-sm+ leading-relaxed text-gray-700">{{ $bioSnippet }}</p>
                                @endif

                                <div class="grid gap-3 text-sm text-gray-700 sm:grid-cols-2">
                                    <div class="flex items-start gap-2">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24">
                                            <path fill="currentColor" d="M4 4h16a1 1 0 0 1 1 1v14l-5-3l-5 3l-5-3l-5 3V5a1 1 0 0 1 1-1Z" />
                                        </svg>
                                        <div>
                                            <div class="font-semibold text-primary-green-900">Profesi</div>
                                            <div>{{ $profession?->job_title ?? 'Belum diisi' }}</div>
                                            <div class="text-xs text-gray-500">{{ $profession?->company ?? 'Perusahaan belum diisi' }}</div>
                                        </div>
                                    </div>
                                    <div class="flex items-start gap-2">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24">
                                            <path fill="currentColor" d="M21 16.5v3a1.5 1.5 0 0 1-1.64 1.5A19.88 19.88 0 0 1 2 5.64A1.5 1.5 0 0 1 3.5 4h3a1.5 1.5 0 0 1 1.5 1.28a12.72 12.72 0 0 0 .7 2.73a1.5 1.5 0 0 1-.34 1.58l-1.3 1.3a16 16 0 0 0 6.07 6.07l1.3-1.3a1.5 1.5 0 0 1 1.58-.34a12.72 12.72 0 0 0 2.73.7A1.5 1.5 0 0 1 21 16.5" />
                                        </svg>
                                        <div>
                                            <div class="font-semibold text-primary-green-900">Kontak</div>
                                            <div>{{ $alumnus->phone_number ?? 'Nomor belum tersedia' }}</div>
                                            <div class="break-words text-xs text-gray-500">{{ $alumnus->email ?? 'Email belum tersedia' }}</div>
                                        </div>
                                    </div>
                                </div>

                                @if ($competencies->isNotEmpty())
                                    <div class="flex flex-wrap gap-2 pt-1">
                                        @foreach ($competencies as $skill)
                                            <span class="bg-primary-green-100 px-3 py-1 text-xs font-medium text-primary-green-700">{{ $skill }}</span>
                                        @endforeach
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="border border-dashed border-gray-300 bg-white p-10 text-center text-gray-600">
                        Tidak ada data alumni yang cocok dengan filter saat ini.
                    </div>
                @endforelse

                @if (is_object($alumni) && method_exists($alumni, 'hasPages') && $alumni->hasPages())
                    <div class="border-t border-gray-200 pt-6">
                        {{ $alumni->links() }}
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
