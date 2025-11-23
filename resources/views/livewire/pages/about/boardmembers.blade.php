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
    <div class="max-w-5xl w-full mx-auto my-10 space-y-12">
        <div>
            <div class="text-[26px] leading-[2.125rem] font-bold font-sora tracking-tighter text-primary-green-950">
                Bagan Organisasi
            </div>
            <div class="mt-4">
                <img src="https://library.washu.edu/wp-content/uploads/2025/07/OrgChart_WashULibraries_072025-1024x663.png" alt="" srcset="">
            </div>
        </div>
        <div class="space-y-6">
            <div class="text-2xl font-bold font-sora tracking-tighter text-primary-green-950">
                Dewan Pengurus
            </div>
            <div class="space-y-4">
                @foreach ($dewanPengurus as $dewan)
                        <div class="bg-gray-50 text-lg border-b-[0.3px] p-4">
                    <h1 class="text-[19px] font-semibold tracking-[0.010rem]">{{ $dewan["nama"] }}</h1>
                    <h3>{{ $dewan["jabatan"] }}</h3>
                </div>
                @endforeach
            </div>
        </div>
        <div class="space-y-6">
            <div class="text-2xl font-bold font-sora tracking-tighter text-primary-green-950">
                Dewan Pengawas
            </div>
            <div class="space-y-4">
                @foreach ($dewanPengawas as $dewan)
                        <div class="bg-gray-50 text-lg border-b-[0.3px] p-4">
                    <h1 class="text-[19px] font-semibold tracking-[0.010rem]">{{ $dewan["nama"] }}</h1>
                    <h3>{{ $dewan["jabatan"] }}</h3>
                </div>
                @endforeach
            </div>
        </div>
    </div>

</div>
