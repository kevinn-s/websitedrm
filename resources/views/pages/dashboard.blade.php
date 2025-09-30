<x-app-layout>
    <div class="
        -mx-32 
        bg-home-banner
        h-96  
    ">
        <div class="my-[-40px] md:my-0 md:w-7/12 px-32 py-8 text-white">
            <!-- <div class="w-24 h-24 mb-4 bg-black">
                    <img src="" alt="">
                </div> -->
            <div>
                <h1 class="text-4xl font-bold font-libre leading-[1.2]">
                    Asosiasi Alumni
                    <br>
                    DRM Binus University
                </h1>
            </div>

            <div class="md:text-lg my-3 font-semibold">

                <p>Tempat berbagi pengalaman, memperluas jaringan, dan menjaga ikatan kebersamaan alumni DRM Binus
                    University</p>
            </div>

            <div class="my-[24px] md:my-[24px] flex flex-row gap-4">
                @if(auth('sanctum')->check() && auth('sanctum')->user()->status === 'approved')
                    {{-- Alumni login & approved --}}
                    <button type="button" class="py-1.5 w-[8rem] md:w-auto md:px-8 md:py-2 leading-[-1px] text-sm md:text-base 
                                       font-semibold text-white focus:outline-none 
                                       bg-primary-green hover:bg-primary-green-dark"
                        onclick="window.location.href='{{ route('register') }}'">
                        Lihat Alumni
                    </button>
                @else
                   <button type="button" class="py-3 px-10 md:w-[8rem] md:w-auto md:px-8 md:py-2 leading-[-1px] text-base
                                       font-semibold text-white focus:outline-none
                                       bg-primary-green hover:bg-primary-green-dark
                                       transition-all duration-300 ease-in-out
                                       hover:scale-105 hover:border-2 hover:border-white
                                       active:scale-95 active:border-2 active:border-white
                                       border-2 border-transparent"
                        onclick="window.location.href='{{ route('register') }}'">
                        Bergabung
                    </button>
                @endif

            </div>
            <!-- <div class="hidden md:flex flex-row gap-6">
                    <div class="flex items-center gap-3">
                        <div class="w-12 h-12 bg-black">
                            <img src="" alt="">
                        </div>
                        <div>
                            <div class="text-2xl font-bold leading-[22.4px]">169</div>
                            <div class="text-[14.5px] font-[600]">Anggota Aktif</div>
                        </div>
                    </div>
                    <div class="flex items-center gap-3">
                        <div class="w-12 h-12 bg-black">
                            <img src="" alt="">
                        </div>
                        <div>
                            <div class="text-2xl font-bold leading-[22.4px]">15</div>
                            <div class="text-[14.5px] font-[600]">Angkatan Lulusan</div>
                        </div>
                    </div>
                </div> -->

        </div>
    </div>
    <div class="space-y-24 my-16">
        <div class="md:w-[54%] md:block ">
            <div class="w-32 text-sm font-[700] text-gray-700">
                PROGRAM</div>
            <h1 class="text-5xl tracking-[-2px] leading-10 font-bold font-sans my-4">
                <span class="text-primary-gold">Menyatukan Alumni</span>
                <br>
                <span class="text-primary-green">Menguatkan Persaudaraan</span>
            </h1>
            <div class="text-base leading-[25.6px]">
                Asosiasi Alumni menjadi wadah silaturahmi lintas angkatan, melalui program pengembangan diri, jejaring
                profesional, kegiatan sosial, serta kontribusi untuk almamater dan masyarakat.
            </div>
            <div class="mt-6 grid grid-cols-1 md:grid-cols-2 gap-x-8 gap-y-6">
                <div class="flex items-start gap-4 ">
                    <div class="w-12 h-12 mt-2" style="
                        background-image: url('{{ url('/images/missions.webp') }}');
                        background-size: cover;
                        background-position: -120px 0px;
                        background-repeat: no-repeat;
                    ">
                    </div>
                    <div class="flex-1">
                        <div class="text-lg font-bold">Development</div>
                        <div class="text-sm text-gray-600">Mendukung alumni dalam pengembangan diri dan karier.</div>
                    </div>
                </div>

                <div class="flex items-start gap-4">
                    <div class="w-12 h-12 mt-2" style="
                    background-image: url('{{ url('/images/missions.webp') }}');
                    background-size: cover;
                    background-position: -48px 0px;
                    background-repeat: no-repeat;
                ">
                    </div>
                    <div class="flex-1">
                        <div class="text-lg font-bold">Connecting</div>
                        <div class="text-sm text-gray-600">Menyatukan alumni lewat jejaring dan kolaborasi.</div>
                    </div>
                </div>

                <div class="flex items-start gap-4">
                    <div class="w-12 h-12 mt-2" style="
                    background-image: url('{{ url('/images/missions.webp') }}');
                    background-size: cover;
                    background-position: -96px 0px;
                    background-repeat: no-repeat;
                ">
                    </div>
                    <div class="flex-1">
                        <div class="text-lg font-bold">Social</div>
                        <div class="text-sm text-gray-600">Mewadahi jalinan persaudaraan antar alumni.</div>
                    </div>
                </div>

                <div class="flex items-start gap-4">
                    <div class="w-12 h-12 mt-2" style="
                    background-image: url('{{ url('/images/missions.webp') }}');
                    background-size: cover;
                    background-position: -0px 0px;
                    background-repeat: no-repeat;
                ">
                    </div>
                    <div class="flex-1">
                        <div class="text-lg font-bold">Support</div>
                        <div class="text-sm text-gray-600">Memperkuat ikatan dengan dan memajukan almamater.</div>
                    </div>
                </div>
            </div>
        </div>
        <div>
            <div class="md:w-[52%] w-full">
                <div class="text-sm font-[700] text-gray-700">
                    MEMBER BENEFITS
                </div>
                <h1 class="text-5xl tracking-[-3px] leading-13 font-bold font-sans my-4">
                    <span class="text-primary-green">Keuntungan Bergabung</span>
                    <br>
                    <span class="text-primary-gold">Di Asosiasi Alumni DRM</span>
                </h1>
                <div class="text-base leading-[25.6px] mb-12">
                    Asosiasi Alumni menjadi wadah silaturahmi lintas angkatan, melalui program pengembangan diri,
                    jejaring
                    profesional, kegiatan sosial, serta kontribusi untuk almamater dan masyarakat.
                </div>
            </div>
            <div class="md:flex">
                <div class="flex-1  p-4">
                    <div class="w-20 h-20 m-auto">
                        <div class="w-full h-full
             bg-no-repeat 
             bg-[url('../../public/images/benefit.webp')] 
             bg-[length:80px_auto]
             bg-[position:0px_-178px]">
                        </div>
                    </div>
                    <div class="text-center mt-2 mb-4 text-base font-bold uppercase">
                        Alumni<br>Directory
                    </div>
                    <div class="text-center">
                        Fasilitas pencarian dan pengelolaan data antar anggota.
                    </div>
                </div>
                <div class="flex-1
                            
                            p-4">
                    <div class="w-20 h-20 m-auto">
                        <div class="w-full h-full
             bg-no-repeat 
             bg-[url('../../public/images/benefit.webp')] 
             bg-[length:80px_auto]
             bg-[position:0px_-0px]">
                        </div>
                    </div>
                    <div class="text-center mt-2 mb-4 text-base font-bold uppercase">
                        Networking<br>yang luas
                    </div>
                    <div class="text-center">
                        Mendapatkan jaringan koneksi yang luas dengan para alumni lainnya yang tersebar di seluruh
                        daerah
                    </div>
                </div>
                <div class="flex-1
                             p-4">
                    <div class="w-20 h-20 m-auto">
                        <div class="w-full h-full
             bg-no-repeat 
             bg-[url('../../public/images/benefit.webp')] 
             bg-[length:80px_auto]
             bg-[position:0px_-88px]">
                        </div>
                    </div>
                    <div class="text-center mt-2 mb-4 text-base font-bold uppercase">
                        Engagement<br>sesama alumni
                    </div>
                    <div class="text-center">
                        Mendorong interaksi dan kolaborasi melalui macam aktifitas dan kegiatan.
                    </div>
                </div>
                <div class="flex-1  p-4">
                    <div class="w-20 h-20 m-auto">
                        <div class="w-full h-full
                                    bg-no-repeat 
                                    bg-[url('../../public/images/benefit.webp')] 
                                    bg-[length:80px_auto]
                                    bg-[position:0px_-266px]">
                        </div>
                    </div>
                    <div class="text-center mt-2 mb-4 text-base font-bold uppercase">
                        Kesempatan<br>Berkolaborasi
                    </div>
                    <div class="text-center">
                        Ruang bagi alumni untuk membangun kerja sama
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>