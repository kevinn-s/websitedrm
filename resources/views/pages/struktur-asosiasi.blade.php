<x-app-layout>
<div class="mx-[1rem] mt-[4rem] pb-16 mb-[8rem] md:mx-[8rem] md:mt-[4rem] md:mb-[12rem] pt-10 md:pt-20">
    <x-breadcrumb :items="[
        ['label' => 'Beranda', 'url' => route('homepage')],
        ['label' => 'Struktur Asosiasi Alumni DRM', 'url' => route('struktur-asosiasi')],
    ]" />

    <div>
        <div class="md:flex md:flex-col md:items-center mb-4 leading-tight md:leading-none">
                <div class="w-10 h-10 mb-2" 
                style="
                    background-image: url('{{ url('/images/icon_page.webp') }}');
                    background-size: cover;
                    background-position: -200px 0px;
                    background-repeat: no-repeat;
                ">
                </div>
            <!-- <div class="border-b"> -->
                <h2 class="mb-4 tracking-[-1px] font-bold flex gap-3 font-['Open_Sans'] text-[36px] text-[#03563D] md:text-center">
                    Struktur Asosiasi Alumni DRM
                </h2>
            <!-- </div> -->
            <p class="w-[100%] md:w-[720px] pb-8 text-[18px] md:text-[20px] md:leading-[30px] font-medium border-b  md:text-center">
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
        <div class="bg-white rounded-lg p-6 flex flex-col w-80">
            <div class="overflow-hidden mb-4">
                <img src="{{ !empty($member['foto']) ? url('images/' . $member['foto']) : url('images/profile_avatar_placeholder_large.png') }}" 
                     alt="{{ $member['nama'] }}"
                     class="w-80 h-full object-cover"
                     onerror="this.src='{{ url('images/profile_avatar_placeholder_large.png') }}'">
            </div>
            <div class="flex flex-col gap-2 w-full">
                <h2 class="text-xl font-semibold flex justify-between">
                    <a href="{{ $member['link_profil'] }}" class="">
                        {{ $member['nama'] }}
                    </a>
                     <div class="w-6 h-6 rounded flex-shrink-0 ml-2 cursor-pointer transition-all duration-200 hover:scale-110 hover:bg-gray-100 active:scale-95 active:bg-gray-200 p-1">
                        <img src="{{ url('images/arrow_redirect.webp') }}" alt="" class="w-full h-full object-contain">
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