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
            "jabatan" => "Ketua Dewan Pengawas"
        ],
        [
            "nama" => "Sri  Bramantoro Abdinagoro",
            "jabatan" => "Anggota Dewan Pengawas"
        ]
        ];

    public $campusHighlights = [
        [
            "name" => "BINUS @Kemanggisan",
            "tagline" => "Heritage Campus",
            "description" => "Legacy academic hub that connects decades of BINUS excellence with modern laboratories, student hubs, and alumni mentoring lounges in West Jakarta.",
            "accent" => "Built on tradition, energized by industry collaboration."
        ],
        [
            "name" => "BINUS @Alam Sutera",
            "tagline" => "Innovation Campus",
            "description" => "Future-ready environment that mirrors global campuses such as WashU with light-filled studios, collaborative commons, and a growing research corridor.",
            "accent" => "Where design thinking meets entrepreneurial drive."
        ]
        ];

    public $governancePillars = [
        [
            "title" => "Inclusive Leadership",
            "description" => "Voices from faculties, alumni, and the BINUS Global network sit at the same table to co-create long-term priorities."
        ],
        [
            "title" => "Stewardship & Impact",
            "description" => "Data-informed decisions, transparent reporting, and community accountability keep every initiative grounded."
        ],
        [
            "title" => "Future-ready Culture",
            "description" => "Programs align with innovation tracks and global partnerships, echoing the momentum of BINUS Alumni communities."
        ]
        ];

    public $pageSections = [
        [
            "id" => "campuses",
            "label" => "Our Campuses"
        ],
        [
            "id" => "org-structure",
            "label" => "Bagan Organisasi"
        ],
        [
            "id" => "governance-pillars",
            "label" => "Governance Pillars"
        ],
        [
            "id" => "executive-board",
            "label" => "Dewan Pengurus"
        ],
        [
            "id" => "supervisory-board",
            "label" => "Dewan Pengawas"
        ]
        ];
}; ?>

<div class="space-y-10 sm:space-y-14">
    <x-page-title :breadcrumbs="[
        ['label' => 'Beranda', 'url' => ''],
        ['label' => 'Struktur Organisasi', 'url' => ''],
    ]" title="Struktur Organisasi" background="bg-amber-950"></x-page-title>

    <section id="org-structure" class="">
        <div class="max-w-5xl w-full mx-auto px-4 sm:px-6 lg:px-0">
                <h1 class="text-2xl sm:text-3xl font-semibold font-sora tracking-[-2px] text-primary-green-950">Bagan Organisasi</h1>
                <div class="mt-2 h-[3px] w-28 bg-amber-300"></div>
                <img src="{{ asset('images/Lorna Alvarado.png') }}" alt="" class="pt-8 sm:pt-12 w-full">
        </div>

    </section>



    <section id="executive-board" class="bg-white">
        <div class="max-w-5xl w-full mx-auto px-4 sm:px-6 lg:px-0">
            <div class="flex flex-col gap-3">
                <div class="flex flex-col sm:flex-row sm:items-center gap-2 sm:gap-4">
                    <h2 class="text-2xl sm:text-3xl font-semibold font-sora tracking-[-2px] text-primary-green-950">Dewan Pengurus</h2>
                    <div class="h-[2px] w-16 bg-primary-green-900 rounded-full hidden sm:block"></div>
                </div>
                <!-- <p class="text-gray-600 max-w-3xl">Mereka memastikan setiap program alumni selaras dengan strategi akademik dan kontribusi sosial BINUS. Komposisi ini meniru ritme kepemimpinan WashU—tajam, kolaboratif, dan penuh empati.</p> -->
            </div>
                   <div class="space-y-4 mt-4 ">
                @foreach ($dewanPengurus as $dewan)
                        <div class="bg-gray-50 text-base sm:text-lg border-b-[0.3px] p-3 sm:p-4">
                    <h1 class="text-base sm:text-[19px] font-semibold tracking-[0.010rem]">{{ $dewan["nama"] }}</h1>
                    <h3 class="text-sm sm:text-base">{{ $dewan["jabatan"] }}</h3>
                </div>
                @endforeach
            </div>
        </div>
    </section>

        <section id="supervisory-board" class="bg-white">
        <div class="max-w-5xl w-full mx-auto px-4 sm:px-6 lg:px-0">
            <div class="flex flex-col gap-3">
                <div class="flex flex-col sm:flex-row sm:items-center gap-2 sm:gap-4">
                    <h2 class="text-2xl sm:text-3xl font-semibold font-sora tracking-[-2px] text-primary-green-950">Dewan Pengawas</h2>
                    <div class="h-[2px] w-16 bg-primary-green-900 rounded-full hidden sm:block"></div>
                </div>
                <!-- <p class="text-gray-600 max-w-3xl">Mereka memastikan setiap program alumni selaras dengan strategi akademik dan kontribusi sosial BINUS. Komposisi ini meniru ritme kepemimpinan WashU—tajam, kolaboratif, dan penuh empati.</p> -->
            </div>
                   <div class="space-y-4 mt-4 ">
                @foreach ($dewanPengawas as $dewan)
                        <div class="bg-gray-50 text-base sm:text-lg border-b-[0.3px] p-3 sm:p-4">
                    <h1 class="text-base sm:text-[19px] font-semibold tracking-[0.010rem]">{{ $dewan["nama"] }}</h1>
                    <h3 class="text-sm sm:text-base">{{ $dewan["jabatan"] }}</h3>
                </div>
                @endforeach
            </div>
        </div>
    </section>


</div>
