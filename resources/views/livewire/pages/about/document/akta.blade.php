<?php

use Livewire\Volt\Component;
use Livewire\Attributes\Layout;

new #[Layout('layouts.app')] class extends Component {
    public function download()
    {
        // Redirect the browser to the download route
        return redirect()->route('download.akta-asosiasi');
    }
}; ?>

<div>
     <x-page-title 
        title="Dokumen Akta Asosiasi" 
        :breadcrumbs="[
            ['label' => 'Beranda', 'url' => url('dashboard')],
            ['label' => 'Dokumen Akta Asosiasi', 'url' => ''],
        ]"
 
    />

    <div class="px-6 md:px-20 lg:px-36 pb-32 pt-6 md:pt-10 bg-white">
        <div class="">
            <div class="flex gap-4 items-center">
                        <div class="w-10 mt-1.5 md:mt-0 h-10 flex items-center justify-center bg-primary-green flex-shrink-0">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 8 8"><path fill="#ffffff" d="M0 0v8h7V4H3V0H0zm4 0v3h3L4 0zM1 2h1v1H1V2zm0 2h1v1H1V4zm0 2h4v1H1V6z"/></svg>
                        </div>
                        <div class="flex-1 space-y-1 md:space-y-0">
                            <div class="text-sm md:text-base">
                                Informasi mengenai Akta Pendirian<br> Asosiasi Alumni DRM 
                            </div>
                             
                        </div>
                    </div>
            <div class="text-base md:text-lg w-full lg:w-[70%] my-5">
                <div class="w-full lg:w-[70%] md:border-[0.3px] md:border-gray-300 md:p-4">
                        <div class="hidden md:grid grid-cols-[1fr_max-content] grid-rows-2 gap-x-6 gap-y-4 text-[15px]">
                        <div>
                            <div class="font-semibold text-gray-700 mb-1">Nomor Akta</div>
                            <p>AHU-0011584.AH.01.</p>
                            <p>07.TAHUN 2024</p>
                        </div>
                        <div>
                            <div class="font-semibold text-gray-700 mb-1">Nomor Pendaftaran</div>
                            <p>6024 1211 3610 0578</p>
                        </div>
                        <div>
                            <div class="font-semibold text-gray-700 mb-1">Tanggal Pengesahan</div>
                            <p>11 Desember 2024</p>
                        </div>
                        <div>
                            <div class="font-semibold text-gray-700 mb-1">Notaris</div>
                            <p>JHONNI MARIHOTUA SIANTURI, SH</p>
                        </div>
                    </div>

                    <div class="md:hidden grid grid-rows-4 mt-8 gap-4">
                        <div class="py-3 md:py-4 px-8 border border-gray-200">
                            <div class="font-semibold text-sm mb-2">Nomor Akta</div>
                            <div class="text-sm">AHU-0011584.AH.01.07.TAHUN 2024</div>
                        </div>
                        <div class="py-3 md:py-4 px-8 border border-gray-200">
                            <div class="font-semibold text-sm mb-2">Nomor Pendaftaran</div>
                            <div class="text-sm">6024 1211 3610 0578</div>
                        </div>
                        <div class="py-3 md:py-4 px-8 border border-gray-200">
                            <div class="font-semibold text-sm mb-2">Tanggal Pengesahan</div>
                            <div class="text-sm">11 Desember 2024</div>
                        </div>
                        <div class="py-3 md:py-4 px-8 border border-gray-200">
                            <div class="font-semibold text-sm mb-2">Notaris</div>
                            <div class="text-sm">JHONNI MARIHOTUA SIANTURI, SH</div>
                        </div>
                    </div>
                </div>
                <div class="mt-6 md:mt-10 text-sm md:text-base">
                    Dokumen dapat diunduh dengan klik tombol dibawah ini : 
                </div>
            </div>
        </div>

        <div class="space-y-4">
            <button 
        wire:click="download" 
        class="w-full md:w-auto inline-flex items-center justify-center gap-3 font-bold transition-all duration-300 ease-in-out px-4 md:px-3 py-3 text-sm md:text-base bg-[#02743D] text-white border-2 border-primary-green hover:bg-white hover:text-primary-green hover:border-primary-green">
        <svg width="20" height="20" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 8 8"><path fill="currentColor" d="M7 7v1H1V7m2-3V1h2v3h2L4 7L1 4"/></svg>
        Unduh Dokumen Akta Asosiasi
    </button>
    <h1 class="text-xs md:text-sm text-gray-800">Last updated: 14 Sep 2025</h1>
        </div>
    </div>  
   
</div>
