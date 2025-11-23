<?php

use Livewire\Volt\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Computed;
use App\Models\Event;

new #[Layout('layouts.app')] class extends Component {
    public string $search = '';
    public ?string $type = null;
    public ?string $date = null;

    public function resetFilters(): void
    {
        $this->search = '';
        $this->type = null;
        $this->date = null;
    }

    #[Computed]
    public function scheduledEvents()
    {
        return Event::query()
            ->where('type', 'scheduled')
            ->when($this->search, function ($query) {
                $query->where('title', 'like', '%' . $this->search . '%');
            })
            ->when($this->date, function ($query) {
                $query->whereDate('date', $this->date);
            })
            ->when($this->type === 'scheduled', fn($query) => $query)
            ->when($this->type === null || $this->type === '', fn($query) => $query)
            ->orderBy('date', 'asc')
            ->get();
    }

    #[Computed]
    public function annualEvents()
    {
        return Event::query()
            ->where('type', 'annual')
            ->when($this->search, function ($query) {
                $query->where('title', 'like', '%' . $this->search . '%');
            })
            ->when($this->date, function ($query) {
                $query->whereDate('date', $this->date);
            })
            ->when($this->type === 'annual', fn($query) => $query)
            ->when($this->type === null || $this->type === '', fn($query) => $query)
            ->orderBy('date', 'asc')
            ->get();
    }

    #[Computed]
    public function filteredEvents()
    {
        $query = Event::query()
            ->when($this->search, function ($query) {
                $query->where('title', 'like', '%' . $this->search . '%');
            })
            ->when($this->date, function ($query) {
                $query->whereDate('date', $this->date);
            })
            ->when($this->type, function ($query) {
                $query->where('type', $this->type);
            })
            ->orderBy('date', 'asc');

        return $query->get();
    }

    public function with(): array
    {
        return [
            'scheduledEvents' => $this->scheduledEvents,
            'annualEvents' => $this->annualEvents,
        ];
    }
}
?>

<div>
    <x-page-title title="Kegiatan" :breadcrumbs="[
        ['label' => 'Beranda', 'url' => url('kegiatan')],
        ['label' => 'Kegiatan', 'url' => ''],
    ]" background="bg-black" />
    <div class="max-w-5xl w-full mx-auto my-12" x-data="{ activeTab: 'mendatang' }">
        <div class="flex justify-between mb-8">
            <div class="space-x-4">
                <button @click="activeTab = 'mendatang'"
                    :class="activeTab === 'mendatang' ? 'border-b-4 border-primary-green-600 bg-gray-100' : 'bg-primary-green-500 text-white'"
                    class="px-5 py-3 tracking-normal font-noto font-semibold text-sm+">
                    Kegiatan mendatang
                </button>
                <button @click="activeTab = 'tahunan'"
                    :class="activeTab === 'tahunan' ? 'border-b-4 border-primary-green-600 bg-gray-100' : 'bg-primary-green-500 text-white'"
                    class="px-5 py-3 tracking-normal font-noto font-semibold text-sm+">
                    Kegiatan tahunan
                </button>
            </div>
            <div class="relative" x-data="{toggle: false}">
                <button class="box-border h-11 px-4 inline-flex gap-2 items-center justify-center font-semibold font-noto
        tracking-tight text-white bg-primary-green-600 border-b-4 border-b-primary-green-800
        transition-all duration-200 hover:bg-primary-green-700 hover:border-b-gray-800 active:translate-y-[2px]
        active:border-b-2" @click="toggle = !toggle">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24">
                        <path fill="none" stroke="#ffffff" stroke-linecap="round" stroke-linejoin="round"
                            stroke-width="1.5" d="M4.5 7.25h15M7.385 12h9.23m-6.345 4.75h3.46" />
                    </svg>
                    <p class="block tracking-wide">Filter</p>
                </button>
                <div class="absolute right-0 border-[0.5px] mt-4 border-gray-300 border-b-primary-green-700 border-b-4 p-4 space-y-4 w-80 bg-white z-10 transition-all duration-200"
                    :class="toggle ? 'opacity-100 visible translate-y-0' : 'opacity-0 invisible -translate-y-2'"
                    x-show="toggle" x-transition>
                    <div class="flex justify-between items-center">
                        <div class="font-semibold text-lg">
                            Filter dengan
                        </div>
                        <button @click="toggle = !toggle">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 12 12">
                                <path fill="#000000"
                                    d="M2.22 2.22a.749.749 0 0 1 1.06 0L6 4.939L8.72 2.22a.749.749 0 1 1 1.06 1.06L7.061 6L9.78 8.72a.749.749 0 1 1-1.06 1.06L6 7.061L3.28 9.78a.749.749 0 1 1-1.06-1.06L4.939 6L2.22 3.28a.749.749 0 0 1 0-1.06Z" />
                            </svg>
                        </button>
                    </div>
                    <div class="space-y-2">
                        <div class="space-y-1">
                            <div class="text-sm+">
                                Cari kegiatan
                            </div>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 20 20">
                                        <path fill="#c0c0c0"
                                            d="M12.9 14.32a8 8 0 1 1 1.41-1.41l5.35 5.33l-1.42 1.42l-5.33-5.34zM8 14A6 6 0 1 0 8 2a6 6 0 0 0 0 12z" />
                                    </svg>
                                </div>
                                <x-input class="w-full border-gray-300 pl-10"></x-input>
                            </div>
                        </div>
                        <div class="space-y-1">
                            <div class="text-sm+">
                                Kalender
                            </div>
                            <div class="relative" x-data="{
                                showPicker: false,
                                selectedDate: @entangle('date'),
                                formattedDate: '',
                                init() {
                                    if (this.selectedDate) {
                                        const date = new Date(this.selectedDate);
                                        this.formattedDate = date.toLocaleDateString('id-ID', { day: '2-digit', month: '2-digit', year: 'numeric' });
                                    }
                                }
                            }">
                                <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none z-10">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24">
                                        <path fill="#c0c0c0"
                                            d="M6 4V1.5h2V4h8V1.5h2V4h4v18H2V4h4ZM4 6v3h16V6H4Zm16 5H4v9h16v-9Z" />
                                    </svg>
                                </div>
                                <input
                                    type="text"
                                    @click="showPicker = !showPicker"
                                    x-model="formattedDate"
                                    readonly
                                    placeholder="dd/mm/yyyy"
                                    class="appearance-none w-full border border-gray-300 pl-10 py-2 cursor-pointer focus:outline-none focus:ring-2 focus:ring-primary-green-600"
                                >
                                <div
                                    x-show="showPicker"
                                    @click.away="showPicker = false"
                                    x-transition
                                    class="absolute mt-1 bg-white border border-gray-300 shadow-lg z-20"
                                >
                                    <div
                                        x-init="
                                            const picker = new Datepicker($el, {
                                                autohide: true,
                                                format: 'yyyy-mm-dd',
                                                todayBtn: true,
                                                clearBtn: true,
                                                todayBtnMode: 1
                                            });
                                            $el.addEventListener('changeDate', (e) => {
                                                if (e.detail.date) {
                                                    const date = new Date(e.detail.date);
                                                    selectedDate = date.toISOString().split('T')[0];
                                                    formattedDate = date.toLocaleDateString('id-ID', { day: '2-digit', month: '2-digit', year: 'numeric' });
                                                } else {
                                                    selectedDate = null;
                                                    formattedDate = '';
                                                }
                                                showPicker = false;
                                            });
                                        "
                                    ></div>
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="flex justify-between items-center">
                        <button class="underline text-sm+ underline-offset-4">Cancel</button>
                        <x-button>Apply Filters</x-button>
                    </div>
                </div>
            </div>
        </div>
        <div class="space-y-10">
            <div class="w-9/12">
                <div class="bg-white flex gap-8">
                    <div class="w-1/4 self-stretch">
                        <img src="{{ asset("images/avatar.jpg") }}" class="object-cover" alt="">
                    </div>
                    <div class="w-9/12 my-auto">
                        {{-- Category tags --}}
                        <div
                            class="text-xs font-semibold tracking-wide text-primary-green-950 uppercase space-x-1 flex gap-1">
                            <span class="bg-primary-gold px-1">Arts and Culture</span>
                            <span class="bg-primary-gold px-1">Arts and Culture</span>

                        </div>
                        {{-- Title + Arrow --}}
                        <div class="flex items-center gap-2 mt-2" x-data="{hovered: false}">
                            <h2 class="block text-2xl font-bold text-gray-900" @mouseenter="hovered = true"
                                @mouseleave="hovered = false">
                                <a href="{{ route('kegiatan') }}">
                                    For the Love of Art
                                </a>
                            </h2>
                            <button class="text-primary-green-600 hover:text-primary-green-800 transition"
                                :class="hovered === true ? 'translate-x-1' : ''">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24"
                                    stroke="currentColor" stroke-width="3">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
                                </svg>
                            </button>
                        </div>
                        <p class="my-4 leading-relaxed text-gray-700 h-[3.25em] overflow-hidden">
                            Adelphi University's 10-week art intensive, For the Love of Art,
                        </p>
                        {{-- Date & Time --}}
                        <div class="flex items-center gap-2 text-gray-700">
                            <span class="text-[15px] font-bold tracking-wide">
                                Thursday, November 20, 2025
                            </span>
                        </div>
                        {{-- Location --}}
                        <div class="flex items-center gap-2 mt-2 text-gray-900">
                            <svg class="block" xmlns="http://www.w3.org/2000/svg" width="15" height="15"
                                viewBox="0 0 48 48">
                                <path fill="#000000"
                                    d="M40.596 4.173c2.022-.778 4.008 1.209 3.23 3.23L30.369 42.397c-.871 2.264-4.134 2.085-4.751-.262l-3.93-14.932a1.25 1.25 0 0 0-.89-.89l-14.933-3.93c-2.347-.618-2.526-3.88-.261-4.752L40.596 4.173Z" />
                            </svg>
                            <span class="text-sm+ font-medium tracking-normal block">
                                Garden City Campus
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
