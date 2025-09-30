    <div class="hidden md:flex w-[75%] h-[50%] gap-4 items-center select-none md:justify-end">
        <x-nav-link href="/">Beranda</x-nav-link>
        <x-nav-link href="/kegiatan">Kegiatan</x-nav-link>

        @auth('alumni')
            <x-nav-link href="/alumni">Alumni</x-nav-link>
        @endauth

        <div class="flex items-center">
            <x-nav-link class="" href="/visi-misi">Tentang Kami</x-nav-link>
            <x-dropdown align="right" width="48">
                <x-slot name="trigger" class="ml-2">
                    <div
                        class="w-0 h-0 mt-[4px] border-l-4 border-r-4 border-t-[6px] border-t-slate-600 border-solid border-transparent">
                    </div>
                </x-slot>
                <x-slot name="content">
                    <div class="w-screen">
                        <div class="bg-white ml-32 mr-32">
                            <div
                                class="flex pt-4 grid-cols-1 border-r-[1px] border-l-[1px] border-b-[1px] border-solid border-[#E5E7EB]">
                                <div class="w-[25%] text-sm pl-4 pb-4 border-r-[1px] border-t-slate-600 border-solid">
                                    <div class="text-base font-semibold text-green-900 mb-2">Tentang Kami</div>
                                    <div class="flex flex-col gap-2 pl-[0.8rem]"> 
                                    <li><a class="" href="{{ url('/visi-misi') }}">Visi Misi</a></li>
                                    <li><a class="" href="{{ url('/tujuan') }}">Tujuan</a></li>
                                    </div>
                                </div>
                             
                                <div class="w-[25%] text-sm pl-4 pb-4 border-r-[1px] border-t-slate-600 border-solid">
                                    <div class="text-base font-semibold text-green-900 mb-2">Dokumen Legalitas</div>
                                    <div class="flex flex-col gap-2 pl-[0.8rem]"> 
                                    <li><a class="" href="{{ url('/akta-asosiasi') }}">Akta Asosiasi Alumni</a></li>
                                    <li><a class="" href="{{ url('/ad-art-asosiasi') }}">AD/ART Asosiasi Alumni</a></li>
                                    </div>
                                </div>
                                    <div class="w-[25%] text-sm pl-4 pb-4 border-r-[1px] border-t-slate-600 border-solid">
                                        <div class="text-base font-semibold text-green-900 mb-2">Struktur Organisasi</div>
                                        <div class="flex flex-col gap-2 pl-[0.8rem]"> 
                                        <li><a class="" href="{{ url('/struktur-asosiasi-alumni') }}">Struktur Asosiasi Alumni</a></li>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </x-slot>
            </x-dropdown>
        </div>

        <x-nav-link href="/kontak-kami">Kontak Kami</x-nav-link>
        <x-nav-link href="/rekening">Rekening</x-nav-link>
       
    </div>