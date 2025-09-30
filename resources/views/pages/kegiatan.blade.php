<x-app-layout>
    <div class="flex flex-col">
        <x-breadcrumb :items="[
            ['label' => 'Beranda', 'url' => route('homepage')],
            ['label' => 'Kegiatan', 'url' => route('kegiatan')],
        ]" />
          <div>
            <div class="flex flex-col mb-4">
        
                <div class="w-10 h-10 mb-2" style="
                background-image: url('{{ url('/images/page_icon.webp') }}');
                background-size: cover;
                background-position: left;
                background-repeat: no-repeat;
                ">
                </div>

                <h2 class="mb-4 tracking-[-1px] font-bold flex gap-3 font-['Open_Sans'] text-[36px] text-[#03563D]">
                    Kegiatan
                </h2>
        
                <p class="w-[100%] md:w-[720px] pb-8 text-[18px] md:text-[20px] md:leading-[30px] font-medium border-b">
                    Rangkaian aktivitas dan program yang memperkuat jaringan alumni
                </p>
            </div>

        </div>

        <div class="flex flex-col gap-[4rem]">
            <div>
                <div>
                    <div class="text-2xl tracking-[-1px] font-bold pl-2 border-l-[0.15rem] border-black">
                        Kegiatan Mendatang
                    </div>
                    <div class="text-gray-700 md:w-[60%] leading-[1.3rem] mb-5 mt-4 font-[600]">
                        Daftar agenda dan acara yang akan diselenggarakan oleh asosiasi alumni dalam waktu dekat.
                    </div>
                </div>
             
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    @php
                        $kegiatanMendatang = [
                            [
                                'month' => 'September',
                                'year' => '2024',
                                'title' => 'DRM Berbagi',
                                'time' => '17:00 - 18:00',
                                'location' => 'Hotel Ciputra',
                                'color' => '#544BAB',
                                'image' => url('/images/kegiatan1.jpg')
                            ],
                            [
                                'month' => 'October',
                                'year' => '2024',
                                'title' => 'Workshop Pengembangan Karir Alumni',
                                'time' => '09:00 - 15:00',
                                'location' => 'Auditorium Kampus',
                                'color' => '#02743D',
                                'image' => url('/images/kegiatan2.jpg')
                            ],
                            [
                                'month' => 'November',
                                'year' => '2024',
                                'title' => 'Seminar Entrepreneurship & Innovation',
                                'time' => '13:00 - 17:00',
                                'location' => 'Jakarta Convention Center',
                                'color' => '#C09831',
                                'image' => url('/images/kegiatan3.jpg')
                            ]
                        ];
                    @endphp

                    @foreach($kegiatanMendatang as $kegiatan)
                        <div class="h-[380px] md:h-[420px] text-white font-['Open_Sans'] py-8 flex flex-col justify-between relative"
                             style="background-image: url('{{ $kegiatan['image'] }}'); background-size: cover; background-position: center; background-repeat: no-repeat;">
                            <div class="absolute inset-0 bg-black bg-opacity-40"></div>
                            
                            <div class="relative z-10 flex justify-end px-8">
                                <div class="w-24 flex flex-col font-bold">
                                    <div class="text-[18px] text-center">{{ $kegiatan['month'] }}</div>
                                    <div class="text-[30px] leading-8 text-center">{{ $kegiatan['year'] }}</div>
                                </div>
                            </div>

                            <div class="relative z-10 flex flex-col justify-end">
                     
                                <div class="px-8 py-6 font-bold text-[18px] tracking-[-0.5px] leading-7">
                                    {{ $kegiatan['title'] }}
                                </div>

                                <div class="px-8 text-[14px] font-semibold tracking-[0.5px]">
                                    <div class="leading-4">{{ $kegiatan['time'] }}</div>
                                    <div>{{ $kegiatan['location'] }}</div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

            <div>
                <div>
                    <div class="text-2xl tracking-[-1px] font-bold pl-2 border-l-[0.15rem] border-black">
                        Kegiatan tahunan
                    </div>
                    <div class="text-gray-700 md:w-[60%] leading-[1.3rem] mb-5 mt-4 font-[600]">
                        Kegiatan tahunan yang rutin diselenggarakan sebagai ajang temu alumni asosiasi.
                    </div>
                </div>
  
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    @php
                        $kegiatanTahunan = [
                            [
                                'month' => 'December',
                                'year' => '2024',
                                'title' => 'Reuni Akbar Alumni DRM 2024',
                                'time' => '18:00 - 22:00',
                                'location' => 'Grand Ballroom Hotel Shangri-La',
                                'color' => '#8B4513',
                                'image' => url('/images/kegiatan4.jpg')
                            ],
                            [
                                'month' => 'January',
                                'year' => '2025',
                                'title' => 'Alumni Awards & Gala Dinner',
                                'time' => '19:00 - 23:00',
                                'location' => 'Ritz Carlton Jakarta',
                                'color' => '#4A5568',
                                'image' => url('/images/kegiatan5.jpg')
                            ],
                            [
                                'month' => 'March',
                                'year' => '2025',
                                'title' => 'Seminar Nasional & Temu Alumni',
                                'time' => '08:00 - 17:00',
                                'location' => 'Balai Kartini Jakarta',
                                'color' => '#E53E3E',
                                'image' => url('/images/kegiatan6.jpg')
                            ]
                        ];
                    @endphp

                    @foreach($kegiatanTahunan as $kegiatan)
            
                        <div class="h-[380px] md:h-[420px] text-white font-['Open_Sans'] py-8 flex flex-col justify-between relative"
                             style="background-image: url('{{ $kegiatan['image'] }}'); background-size: cover; background-position: center; background-repeat: no-repeat;">
                            <div class="absolute inset-0 bg-black bg-opacity-40"></div>
                            
                            <div class="relative z-10 flex justify-end px-8">
                                <div class="w-24 flex flex-col font-bold">
                                    <div class="text-[18px] text-center">{{ $kegiatan['month'] }}</div>
                                    <div class="text-[30px] leading-8 text-center">{{ $kegiatan['year'] }}</div>
                                </div>
                            </div>

                            <div class="relative z-10 flex flex-col justify-end">
                            
                                <div class="px-8 py-6 font-bold text-[18px] tracking-[-0.5px] leading-7">
                                    {{ $kegiatan['title'] }}
                                </div>

                                <div class="px-8 text-[14px] font-semibold tracking-[0.5px]">
                                    <div class="leading-4">{{ $kegiatan['time'] }}</div>
                                    <div>{{ $kegiatan['location'] }}</div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
        </div>
</x-app-layout>