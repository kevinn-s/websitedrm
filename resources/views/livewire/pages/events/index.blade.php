<?php

use Livewire\Volt\Component;
use Livewire\Attributes\Layout;

new #[Layout('layouts.app')] class extends Component
{
    public string $search = '';
    public ?string $type = null; // Use string to match frontend values

    public function resetFilters(): void
    {
        $this->search = '';
        $this->type = null;
    }
}
?>

<div x-data="{
    dropdownOpen: false,
    selectedFilter: 'All Events',
    selectedValue: '',
    options: [
        { label: 'Kegiatan Tahunan', value: 'annual' },
        { label: 'Kegiatan Mendatang', value: 'scheduled' }
    ],
    selectOption(value, label) {
        this.selectedValue = value;
        this.selectedFilter = label;
        this.dropdownOpen = false;
        // Dispatch to Livewire
        $wire.set('type', value);
    },
    resetFilters() {
        this.selectedValue = '';
        this.selectedFilter = 'All Events';
        $wire.resetFilters();
    }
}">
    <x-page-title 
        title="Kegiatan" 
        :breadcrumbs="[
            ['label' => 'Beranda', 'url' => url('kegiatan')],
            ['label' => 'Kegiatan', 'url' => ''],
        ]"
        background="bg-black"
    />

    <div class="px-36 pb-32 bg-white">
        <div class="">
            <div class="py-10 text-lg space-y-8 w-[70%]">
                <div>Events are an avenue for you to connect with your global alumni community and follow your ongoing
                    passion for learning <br>
                    See what's on in person or online.</div>
            </div>

            <div class="space-y-12 flex justify-between">
                <div class="w-[65%]">
                    <div>
                        <div class="text-xl font-bold pb-2 border-b-[0.5px] border-b-gray-300">
                            Kegiatan Mendatang
                        </div>
                        <div class="my-4 space-y-8">
                            <x-events.card />
                            <x-events.card />
                        </div>
                    </div>
                    <div>
                        <div class="text-xl font-bold pb-2 border-b-[0.5px] border-b-gray-300">
                            Kegiatan Tahunan
                        </div>
                        <div class="my-4 space-y-8">
                            <x-events.card />
                            <x-events.card />
                        </div>
                    </div>
                </div>

                <div class="font-bold py-8 w-[30%]">
                    <div class="text-xl">Filter by</div>
                    <div class="space-y-4 my-6">
                        <!-- Search Input -->
                        <x-input 
                            x-model="searchQuery" 
                            @input="$wire.set('search', $event.target.value)"
                            placeholder="Search" 
                            class="text-[15px] w-full font-semibold px-4 py-2 border-gray-300"
                        />

                        <!-- Dropdown -->
                        <div class="relative inline-block w-full" @click.outside="dropdownOpen = false">
                            <button 
                                @click="dropdownOpen = !dropdownOpen"
                                class="w-full text-[15px] font-semibold flex items-center justify-between bg-white border border-gray-300 px-4 py-2 text-left outline-0 focus:outline-none"
                                :class="{ 'text-gray-500': selectedValue === '', 'text-gray-900': selectedValue !== '' }"
                            >
                                <span x-text="selectedFilter"></span>
                                <svg 
                                    class="inline ml-2 w-4 h-4 transition-transform duration-200" 
                                    :class="{ 'rotate-180': dropdownOpen }"
                                    fill="none" 
                                    stroke="currentColor" 
                                    viewBox="0 0 24 24"
                                >
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                                </svg>
                            </button>

                            <div 
                                x-show="dropdownOpen" 
                                x-transition:enter="transition ease-out duration-100"
                                x-transition:enter-start="transform opacity-0 scale-95"
                                x-transition:enter-end="transform opacity-100 scale-100"
                                x-transition:leave="transition ease-in duration-75"
                                x-transition:leave-start="transform opacity-100 scale-100"
                                x-transition:leave-end="transform opacity-0 scale-95"
                                class="z-30 text-[15px] font-normal absolute top-full left-0 w-full bg-white border border-gray-300 shadow-lg"
                            >
                                <div 
                                    @click="selectOption('', 'Semua Kegiatan')"
                                    class="px-4 py-2 cursor-pointer hover:bg-gray-50 transition-colors duration-150"
                                    :class="{ 'bg-gray-100 border-l-4 border-primary-gold': selectedValue === '' }"
                                >
                                    Semua
                                </div>
                                <template x-for="option in options" :key="option.value">
                                    <div 
                                        @click="selectOption(option.value, option.label)"
                                        class="px-4 py-2 cursor-pointer hover:bg-gray-50 transition-colors duration-150"
                                        :class="{ 'bg-gray-100 border-l-4 border-primary-gold': selectedValue === option.value }"
                                        x-text="option.label"
                                    ></div>
                                </template>
                            </div>
                        </div>

                        <x-primary-button 
                            @click="resetFilters()" 
                            class="relative z-20 mt-4 px-6 bg-primary-green text-white border-2 border-primary-green hover:bg-white hover:text-[#02743D] hover:border-primary-green"
                        >
                            Reset Filter
                        </x-primary-button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

