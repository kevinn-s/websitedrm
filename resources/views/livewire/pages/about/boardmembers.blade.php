<?php

use Livewire\Volt\Component;
use Livewire\Attributes\Layout;

new #[Layout('layouts.app')] class extends Component {
    //
}; ?>

<div>
    <x-page-title :breadcrumbs="[
        ['label' => 'Beranda', 'url' => ''],
        ['label' => 'Struktur Organisasi', 'url' => ''],
    ]"   title="Struktur Organisasi" background="bg-amber-950"></x-page-title>
    <div class="px-6 md:px-36 md:pb-32 bg-white">
        <div class="py-10 text-lg space-y-8 md:w-[70%]">
                <div>Berikut merupakan struktur organisasi Asosiasi Alumni Doktor Riset Manajemen.</div>
            </div>
        <div>
            <div>
                <div class="pt-4 pb-4 w-1/2 mb-6 border-b-[0.5px] border-b-gray-800">
                    <div class="text-2xl font-bold">
                        Dewan Pengurus
                    </div>
                  
                </div>
                <div class="flex gap-8">
                    <div class="">
                        <div class="w-32 h-32 bg-slate-400"></div>
                        <div class="mt-6">
                            <div class="font-semibold text-gray-900">Dr. Rano Kartono Rahim, B.IT., <br>M.BUS.</div>
                            <div class="font-bold mt-1">Ketua Organisasi</div>
                        </div>
                    </div>
                   
                </div>
            </div>
        </div>
    </div>

</div>