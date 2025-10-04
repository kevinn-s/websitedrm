<x-app-layout>
    <x-page-title :breadcrumbs="[
        ['label' => 'Beranda', 'url' => route('homepage')],
        ['label' => 'Kegiatan', 'url' => route('kegiatan')],
    ]" title="Kegiatan" background="bg-black"></x-page-title>
    <div class="px-36 pb-32 bg-white">
        <div class="">
            <div class="py-10 text-lg space-y-8 w-[70%]">
                <div>Events are an avenue for you to connect with your global alumni community and follow your ongoing
                    passion for learning <br>
                    See what's on in person or online.</div>
            </div>
            <div class="space-y-12 flex justify-between">
                <div class=" w-[65%]">
                    <div class="">
                        <div class="text-xl font-bold pb-2 border-b-[0.5px] border-b-gray-300">
                            Kegiatan Mendatang
                        </div>
                        <div class="my-4 space-y-8">
                            <x-list-kegiatan></x-list-kegiatan>
                            <x-list-kegiatan></x-list-kegiatan>
                        </div>
                    </div>
                    <div>
                        <div class="text-xl font-bold pb-2 border-b-[0.5px] border-b-gray-300">
                            Kegiatan Tahunan
                        </div>
                        <div class="my-4 space-y-8">
                            <x-list-kegiatan></x-list-kegiatan>
                            <x-list-kegiatan></x-list-kegiatan>
                        </div>
                    </div>
                </div>

                <div class="font-bold py-8 w-[30%]" 
                     x-data="{ 
                         searchQuery: '',
                         dropdownOpen: false, 
                         selectedFilter: 'Tipe Kegiatan',
                         selectedValue: '',
                         placeholder: 'Tipe Kegiatan',
                         options: [
                             { label: 'Kegiatan mendatang', value: 'upcoming' },
                             { label: 'Kegiatan tahunan', value: 'annual' }
                         ],
                         selectOption(option) {
                             this.selectedFilter = option.label;
                             this.selectedValue = option.value;
                             this.dropdownOpen = false;
                             console.log('Selected:', option);
                         },
                         resetFilters() {
                             this.searchQuery = '';
                             this.selectedFilter = this.placeholder;
                             this.selectedValue = '';
                             this.dropdownOpen = false;
                             console.log('Filters reset');
                         }
                     }">
                    <div class="text-xl">Filter by</div>
                    <div class="space-y-4 my-6">
                        <x-input x-model="searchQuery" placeholder="Search" class="text-[15px] font-semibold px-4 py-2 border-gray-300 "></x-input>

                        <!-- Alpine.js Dropdown -->
                        <div class="relative inline-block w-full" 
                             @click.outside="dropdownOpen = false">
                             
                            <!-- Dropdown Button -->
                            <button @click="dropdownOpen = !dropdownOpen"
                                class="w-full text-[15px] font-semibold flex items-center justify-between bg-white border border-gray-300 px-4 py-2 text-left outline-0 focus:outline-none"
                                :class="{ 'text-gray-500': selectedValue === '', 'text-gray-900': selectedValue !== '' }">
                                <span x-text="selectedFilter"></span>
                                <svg class="inline ml-2 w-4 h-4 transition-transform duration-200" 
                                     :class="{ 'rotate-180': dropdownOpen }"
                                     fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M19 9l-7 7-7-7"></path>
                                </svg>
                            </button>

                            <!-- Dropdown Menu -->
                            <div x-show="dropdownOpen" 
                                 x-transition:enter="transition ease-out duration-100"
                                 x-transition:enter-start="transform opacity-0 scale-95"
                                 x-transition:enter-end="transform opacity-100 scale-100"
                                 x-transition:leave="transition ease-in duration-75"
                                 x-transition:leave-start="transform opacity-100 scale-100"
                                 x-transition:leave-end="transform opacity-0 scale-95"
                                 class="z-30 text-[15px] font-normal absolute top-full left-0 w-full bg-white border border-gray-300 shadow-lg">
                                
                                <template x-for="(option, index) in options" :key="index">
                                    <div @click="selectOption(option)"
                                         class="px-4 py-2 cursor-pointer transition-colors duration-150"
                                         :class="{ 
                                             'bg-gray-100 border-l-4 border-primary-gold': selectedValue === option.value,
                                             'hover:bg-gray-50': selectedValue !== option.value 
                                         }"
                                         x-text="option.label">
                                    </div>
                                </template>
                            </div>
                        </div>
                        
                        <x-button @click="resetFilters()" class="relative z-20 mt-4 px-6" variant="primary-reverse">Reset Filter</x-button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
<!-- 
                <div>
                    <div class="text-2xl font-bold w-8/12 pb-2">
                        Featured Events
                    </div>
                    <div class="my-4 flex gap-16">
                        <div class="w-[30%] h-80">
                            <img class="h-8/12 w-fullobject-fill" src="https://arb.umn.edu/sites/arb.umn.edu/files/styles/folwell_full/public/2024-07/scarecrows_770x450.jpg?itok=x0zFPMim" alt="">
                            <div class="font-bold text-lg my-3">
                                Cultural Commons
                            </div>
                            <div class="text-sm">
                                This year marks a major milestone: the 500th graduate of the Master
                            </div>
                        </div>

                         <div class="w-[30%] h-80">
                            <img class=" h-8/12 w-full object-fill" src="https://arb.umn.edu/sites/arb.umn.edu/files/styles/folwell_full/public/2024-07/scarecrows_770x450.jpg?itok=x0zFPMim" alt="">
                            <div class="font-bold text-lg my-3">
                                Cultural Commons
                            </div>
                            <div class="text-sm">
                                This year marks a major milestone: the 500th graduate of the Master
                            </div>
                        </div>

                      
             
                    </div>
                </div> -->