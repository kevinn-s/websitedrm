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

<div class="space-y-20">
    <x-page-title title="Alumni" :breadcrumbs="[
        ['label' => 'Beranda', 'url' => url('dashboard')],
        ['label' => 'Alumni', 'url' => ''],
    ]" background="bg-black" />

    <div class="max-w-5xl mx-auto flex gap-1.5">
        <div class="lg:w-1/4 bg-gray-50 p-4">
            <img src="{{ asset('images/avatar.jpg') }}" alt="" class="w-full h-auto aspect-[4/4]" srcset="">
            <div class="my-2 space-y-2">
                <div class="px-2 font-extrabold bg-primary-gold text-white w-fit">
                    W66
                </div>
                <div class="flex justify-between">
                    <h2 class="text-lg leading-[1.25] tracking-[0.013rem] text-gray-900 font-medium">
                        <p class="line-clamp-2">
                            Norval Ashton
                        </p>
                    </h2>
                    <button class="select-none cursor-pointer group inline-flex items-center gap-2 rounded bg-transparent">
                        <svg class="w-6 h-6 transition-transform duration-300 ease-out transform group-hover:translate-x-2 motion-reduce:transition-none"
                            :class="hovered === true ? 'translate-x-2' : '' " xmlns="http://www.w3.org/2000/svg"
                            viewBox="0 0 512 512" aria-hidden="true" focusable="false">
                            <!-- rotate the shape -90deg around the center (256,256) so the arrow points right -->
                            <g transform="rotate(-90 256 256)">
                                <path fill="currentColor"
                                    d="m367.997 338.75l-95.998 95.997V17.503h-32v417.242l-95.996-95.995l-22.627 22.627L256 496l134.624-134.623l-22.627-22.627z" />
                            </g>
                        </svg>
                    </button>
                </div>
                <div class="mt-2 mb-2">
                    <p class="text-gray-600 text-sm">Customer Success</p>
                    <p class="text-gray-600 text-sm">Slack International</p>
                </div>
                <div>
            </div>
            <div>
                <button>
                    <a href="">

                    </a>
                </button>
            </div>

        </div>
        </div>
        <div class="lg:w-1/4 bg-gray-50 p-4">
            <img src="{{ asset('images/avatar.jpg') }}" alt="" class="w-full h-auto aspect-[4/4]" srcset="">
            <div class="my-2 space-y-2">
                <div class="px-2 font-extrabold bg-primary-gold text-white w-fit">
                    W66
                </div>
                <div class="flex justify-between">
                    <h2 class="text-lg leading-[1.25] tracking-[0.013rem] text-gray-900 font-medium">
                        <p class="line-clamp-2">
                            Norval Ashton
                        </p>
                    </h2>
                    <button class="select-none cursor-pointer group inline-flex items-center gap-2 rounded bg-transparent">
                        <svg class="w-6 h-6 transition-transform duration-300 ease-out transform group-hover:translate-x-2 motion-reduce:transition-none"
                            :class="hovered === true ? 'translate-x-2' : '' " xmlns="http://www.w3.org/2000/svg"
                            viewBox="0 0 512 512" aria-hidden="true" focusable="false">
                            <!-- rotate the shape -90deg around the center (256,256) so the arrow points right -->
                            <g transform="rotate(-90 256 256)">
                                <path fill="currentColor"
                                    d="m367.997 338.75l-95.998 95.997V17.503h-32v417.242l-95.996-95.995l-22.627 22.627L256 496l134.624-134.623l-22.627-22.627z" />
                            </g>
                        </svg>
                    </button>
                </div>
                <div class="mt-2 mb-2">
                    <p class="text-gray-600 text-sm">Customer Success</p>
                    <p class="text-gray-600 text-sm">Slack International</p>
                </div>
                <div>
            </div>
            <div>
                <button>
                    <a href="">

                    </a>
                </button>
            </div>

        </div>
        </div>
        <div class="lg:w-1/4 bg-gray-50 p-4">
            <img src="{{ asset('images/avatar.jpg') }}" alt="" class="w-full h-auto aspect-[4/4]" srcset="">
            <div class="my-2 space-y-2">
                <div class="px-2 font-extrabold bg-primary-gold text-white w-fit">
                    W66
                </div>
                <div class="flex justify-between">
                    <h2 class="text-lg leading-[1.25] tracking-[0.013rem] text-gray-900 font-medium">
                        <p class="line-clamp-2">
                            Norval Ashton
                        </p>
                    </h2>
                    <button class="select-none cursor-pointer group inline-flex items-center gap-2 rounded bg-transparent">
                        <svg class="w-6 h-6 transition-transform duration-300 ease-out transform group-hover:translate-x-2 motion-reduce:transition-none"
                            :class="hovered === true ? 'translate-x-2' : '' " xmlns="http://www.w3.org/2000/svg"
                            viewBox="0 0 512 512" aria-hidden="true" focusable="false">
                            <!-- rotate the shape -90deg around the center (256,256) so the arrow points right -->
                            <g transform="rotate(-90 256 256)">
                                <path fill="currentColor"
                                    d="m367.997 338.75l-95.998 95.997V17.503h-32v417.242l-95.996-95.995l-22.627 22.627L256 496l134.624-134.623l-22.627-22.627z" />
                            </g>
                        </svg>
                    </button>
                </div>
                <div class="mt-2 mb-2">
                    <p class="text-gray-600 text-sm">Customer Success</p>
                    <p class="text-gray-600 text-sm">Slack International</p>
                </div>
                <div>
            </div>
            <div>
                <button>
                    <a href="">

                    </a>
                </button>
            </div>

        </div>
        </div>
        <div class="lg:w-1/4 bg-gray-50 p-4">
            <img src="{{ asset('images/avatar.jpg') }}" alt="" class="w-full h-auto aspect-[4/4]" srcset="">
            <div class="my-2 space-y-2">
                <div class="px-2 font-extrabold bg-primary-gold text-white w-fit">
                    W66
                </div>
                <div class="flex justify-between">
                    <h2 class="text-lg leading-[1.25] tracking-[0.013rem] text-gray-900 font-medium">
                        <p class="line-clamp-2">
                            Norval Ashton
                        </p>
                    </h2>
                    <button class="select-none cursor-pointer group inline-flex items-center gap-2 rounded bg-transparent">
                        <svg class="w-6 h-6 transition-transform duration-300 ease-out transform group-hover:translate-x-2 motion-reduce:transition-none"
                            :class="hovered === true ? 'translate-x-2' : '' " xmlns="http://www.w3.org/2000/svg"
                            viewBox="0 0 512 512" aria-hidden="true" focusable="false">
                            <!-- rotate the shape -90deg around the center (256,256) so the arrow points right -->
                            <g transform="rotate(-90 256 256)">
                                <path fill="currentColor"
                                    d="m367.997 338.75l-95.998 95.997V17.503h-32v417.242l-95.996-95.995l-22.627 22.627L256 496l134.624-134.623l-22.627-22.627z" />
                            </g>
                        </svg>
                    </button>
                </div>
                <div class="mt-2 mb-2">
                    <p class="text-gray-600 text-sm">Customer Success</p>
                    <p class="text-gray-600 text-sm">Slack International</p>
                </div>
                <div>
            </div>
            <div>
                <button>
                    <a href="">

                    </a>
                </button>
            </div>

        </div>
        </div>

</div>
