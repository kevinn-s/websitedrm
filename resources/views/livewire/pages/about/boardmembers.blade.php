<?php

use Livewire\Volt\Component;
use Livewire\Attributes\Layout;

new #[Layout('layouts.app')] class extends Component {
    //
    public $dewanPengurus = [
        [
            "nama" => "Dr. Rano Kartono Rahim, B.IT., M.BUS.",
            "jabatan" => "Ketua"
        ],
        [
            "nama" => "Dr. Marindra Bawono",
            "jabatan" => "Sekretaris"
        ],
        [
            "nama" => "Dr. Adele Bl. Mailangkay",
            "jabatan" => "Bendahara"
        ],
        [
            "nama" => "Dr. Ervinawaty",
            "jabatan" => "Anggota"
        ],
        [
            "nama" => "Dr. Khristian Edi Nugroho",
            "jabatan" => "Anggota"
        ],
        [
            "nama" => "Dr. Dhiraj Kelly Sawlani, S.E.M.MSI.M.M.CIGS",
            "jabatan" => "Anggota"
        ],
        [
            "nama" => "Dr. Daniel Sanjaya",
            "jabatan" => "Anggota"
        ],
        [
            "nama" => "Dr. Prio Utomo",
            "jabatan" => "Anggota"
        ],
        [
            "nama" => "Dr. Dewi Tamara",
            "jabatan" => "Anggota"
        ],
        [
            "nama" => "Dr. Emardial Ulza",
            "jabatan" => "Anggota"
        ],
        [
            "nama" => "Dr. Desman Hidayat",
            "jabatan" => "Anggota"
        ],
        [
            "nama" => "Dr. Vicky Dhanis Wardhana",
            "jabatan" => "Anggota"
        ]
        ];

    public $dewanPengawas = [
        [
            "nama" => "DR. IR. Mohammad Hamsal",
            "jabatan" => "Ketua"
        ], 
        [
            "nama" => "Sri  Bramantoro Abdinagoro",
            "jabatan" => "Anggota"
        ]
        ];
}; ?>

<div>
    <x-page-title :breadcrumbs="[
        ['label' => 'Beranda', 'url' => ''],
        ['label' => 'Struktur Organisasi', 'url' => ''],
    ]"    title="Struktur Organisasi" background="bg-amber-950"></x-page-title>
    <div class="px-6 md:px-36 pb-32 bg-white">
        <div class="py-10 text-lg space-y-8 md:w-[70%]">
            <div>Berikut merupakan struktur organisasi Asosiasi Alumni  <br class="block md:hidden">Doktor
Riset Manajemen.</div>
        </div>
        <!-- <div>
            <img src="{{ asset('images/hierarchy.png') }}" alt="" class="w-1/2 h-1/2">
        </div> -->
        <div class="font-source space-y-12">
            <!-- Dewan Pengurus Section -->
            <div>
                <ul class="space-y-2 list-none md:w-[90%]">
            <x-list title="Dewan Pengurus"
                            class="text-normal"
                            /></ul>
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-3 gap-12 mt-8">
                    @foreach($dewanPengurus as $member)
                        <div class="relative w-full overflow-hidden shadow-xl hover:shadow-2xl transition-shadow duration-300">
                            <img class="w-full h-96 object-cover"
                                src="{{ asset('images/placeholder.png') }}"
                                alt="{{ $member['nama'] }}">
                            <div class="absolute bottom-0 left-0 right-0 bg-gradient-to-t from-black/80 via-black/40 to-transparent pt-10 pb-5 px-5">
                                <div class="text-white text-lg font-semibold drop-shadow-lg leading-tight">
                                    {{ $member['nama'] }}
                                </div>
                                <div class="text-gray-200 text-sm mt-1 drop-shadow-md">
                                    {{ $member['jabatan'] }}
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

            <!-- Dewan Pengawas Section -->
            <div>
                <ul class="space-y-2 list-none md:w-[90%]">
            <x-list title="Dewan Pengawas"
                            class="text-normal"
                            /></ul>
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-3 gap-12 mt-8">
                    @foreach($dewanPengawas as $member)
                        <div class="relative w-full overflow-hidden shadow-xl hover:shadow-2xl transition-shadow duration-300">
                            <img class="w-full h-96 object-cover"
                                src="{{ asset('images/placeholder.png') }}"
                                alt="{{ $member['nama'] }}">
                            <div class="absolute bottom-0 left-0 right-0 bg-gradient-to-t from-black/80 via-black/40 to-transparent pt-10 pb-5 px-5">
                                <div class="text-white text-lg font-semibold drop-shadow-lg leading-tight">
                                    {{ $member['nama'] }}
                                </div>
                                <div class="text-gray-200 text-sm mt-1 drop-shadow-md">
                                    {{ $member['jabatan'] }}
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

</div>