<x-app-layout>
<div class="">
    <x-breadcrumb :items="[
        ['label' => 'Beranda', 'url' => route('homepage')],
        ['label' => 'Struktur Asosiasi Alumni DRM', 'url' => route('struktur-asosiasi')],
    ]" />

    <div>
        <div class="md:flex md:flex-col items-center md:items-start mb-4 leading-tight md:leading-none">
                <div class="w-full flex justify-center md:justify-start">
                <div class="w-10 h-10 mb-2" 
                style="
                    background-image: url('{{ url('/images/page_icon.webp') }}');
                    background-size: cover;
                    background-position: -200px 0px;
                    background-repeat: no-repeat;
                ">
                </div>
                </div>
            <!-- <div class="border-b"> -->
                <h2 class="mb-4 tracking-[-1px] font-bold flex gap-3 font-['Open_Sans'] text-[36px] text-[#03563D] text-center">
                    Struktur Asosiasi Alumni DRM
                </h2>
            <!-- </div> -->
            <p class="w-[100%] md:w-[720px] pb-8 text-[18px] md:text-[20px] md:leading-[30px] font-medium border-b text-center md:text-left">
                Periode 2024 - Sekarang
            </p>
        </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-8 justify-center pl-7 md:pl-0">
        @php
        $strukturAsosiasi = [
            [
                'nama' => 'Norval Ashton',
                'foto' => 'avatar-1.webp',
                'link_profil' => '#0',
                'jabatan' => 'Legacy Integration Technician'
            ],
            [
                'nama' => 'Jane Smith',
                'foto' => 'avatar-2.webp', 
                'link_profil' => '#1',
                'jabatan' => 'Senior Development Manager'
            ],
            [
                'nama' => 'John Doe',
                'foto' => 'avatar-3.webp',
                'link_profil' => '#2', 
                'jabatan' => 'Technical Operations Lead'
            ],
            // Add more members as needed
        ];
        @endphp

        @foreach($strukturAsosiasi as $member)
        <div class="bg-white p-6 flex flex-col w-80">
            <div class="overflow-hidden mb-4">
                <img src="{{ !empty($member['foto']) ? url('images/' . $member['foto']) : url('images/placeholder.png') }}" 
                     alt="{{ $member['nama'] }}"
                     class="w-80 h-full object-cover"
                     onerror="this.src='{{ url('images/placeholder.png') }}'">
            </div>
            <div class="flex flex-col gap-2 w-full">
                <h2 class="text-xl font-semibold flex justify-between">
                    <a href="{{ $member['link_profil'] }}" class="">
                        {{ $member['nama'] }}
                    </a>
                     <div class="w-6 h-6 rounded flex-shrink-0 ml-2 cursor-pointer transition-all duration-200 hover:scale-110 hover:bg-gray-100 active:scale-95 active:bg-gray-200 p-1">
                        <img src="{{ url('images/arrow.webp') }}" alt="" class="w-full h-full object-contain">
                    </div>
                </h2>
                <div class="text-gray-600 border-t-[1px] border-solid border-[#e2e7e9] pt-2">
                    <p>{{ $member['jabatan'] }}</p>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
</x-app-layout>