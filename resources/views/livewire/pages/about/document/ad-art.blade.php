<?php

use Livewire\Volt\Component;
use Livewire\Attributes\Layout;

new #[Layout('layouts.app')] class extends Component {
    //
}; ?>

<div>
     <x-page-title 
        title="Dokumen AD/ART" 
        :breadcrumbs="[
            ['label' => 'Beranda', 'url' => url('dashboard')],
            ['label' => 'Dokumen AD/ART', 'url' => ''],
        ]"
 
    />

    <div class="px-6 md:px-20 lg:px-36 pb-32 bg-white">
        <div class="">
            <div class="text-base md:text-lg w-full lg:w-[70%]">
                <div class="py-6 md:py-10">
                    Anggaran Dasar (AD) dan Anggaran Rumah Tangga (ART) merupakan dasar hukum dan pedoman organisasi dalam menjalankan seluruh kegiatan dan pengambilan keputusan.<br>
                </div>
                <div class="text-sm md:text-base">
                    Dokumen dapat diunduh dengan klik tombol dibawah ini : 
                </div>
            </div>
        </div>

        <div class="my-6 md:my-10 space-y-4">
             <button type="button" class="
    w-full md:w-auto inline-flex items-center justify-center gap-3 font-bold transition-all 
    duration-300 ease-in-out px-4 md:px-3 py-3 text-sm md:text-base bg-[#02743D] text-white
    border-2 border-primary-green hover:bg-white hover:text-primary-green 
    hover:border-primary-green">
    <svg width="20" height="20" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 8 8"><path fill="currentColor" d="M7 7v1H1V7m2-3V1h2v3h2L4 7L1 4"/></svg>
        Unduh Dokumen AD / ART
    </button>
    <h1 class="text-xs md:text-sm text-gray-800">Last updated
    17 May 2024</h1>
        </div>
    </div>  
   
</div>
