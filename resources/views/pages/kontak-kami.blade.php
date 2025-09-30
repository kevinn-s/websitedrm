<x-app-layout>
    @php
        // Dynamic Social Media Configuration
        $socialMediaPlatforms = [
            [
                'name' => 'Facebook',
                'url' => 'https://facebook.com/asosiasidrm',
                'sprite_position' => '-5px 0px', // Position in sprite sheet
                'active' => true
            ],
            [
                'name' => 'Instagram',
                'url' => 'https://instagram.com/asosiasidrm',
                'sprite_position' => '-84px 0px',
                'active' => true
            ],
            [
                'name' => 'Twitter',
                'url' => 'https://twitter.com/asosiasidrm',
                'sprite_position' => '-167px 0px',
                'active' => true
            ]
        ];

        // Filter only active social media platforms
        $activeSocialMedia = array_filter($socialMediaPlatforms, function($platform) {
            return $platform['active'] === true;
        });
    @endphp

            <x-breadcrumb :items="[
            ['label' => 'Beranda', 'url' => route('homepage')],
            ['label' => 'Kontak Kami', 'url' => null],
        ]" />

            <div class="flex md:flex-row flex-col gap-16 md:gap-16">
            {{-- Left Section --}}
           
            <div class="md:w-1/2">
                <div class="mb-4 tracking-tight font-bold font-sans text-4xl text-[#03563D]">Hubungi Kami</div>
                <div class="text-sm leading-7 font-medium">Hubungi kami melalui:</div>

                <div class="border-b border-gray-300">
                    <div class="my-6 flex flex-row gap-4 items-center">
                        <div class="w-12 h-12 bg-beige-100 rounded-full flex items-center justify-center">
                            {{-- Email Icon --}}
                            <div 
                                class="w-10 h-10 " 
                                style="
                                background-image: url('{{ url('/images/kontak_kami.webp') }}');
                                background-size: cover;
                                background-position: 0px 0px;
                                background-repeat: no-repeat;
                                "
                            >
                            </div>
                        </div>
                        <div class="leading-6">
                            <div class="font-semibold">Email</div>
                            <a href="mailto:asosiasidrm@gmail.com" class="font-semibold">asosiasidrm@gmail.com</a>

                        </div>
                    </div>

                    <div class="my-6 flex flex-row gap-4 items-center">
                        <div class="w-12 h-12 bg-beige-100 rounded-full flex items-center justify-center">
                            {{-- Phone Icon --}}
                            <div class="w-10 h-10 " 
                            style="
                                background-image: url('{{ url('/images/kontak_kami.webp') }}');
                                background-size: cover;
                                background-position: -80px 0px;
                                background-repeat: no-repeat;
                            ">
                            </div>
                        </div>
                        <div class="leading-6">
                            <div class="font-semibold">Nomor Telpon</div>
                            <p>+62 811 203 160</p>
                        </div>
                    </div>

                     <div class="my-6 flex flex-row gap-4">
                    <div class="w-12 h-12 rounded-full flex items-center justify-center bg-beige-100">
                        {{-- Icon --}}
                        <div class="w-10 h-10" 
                            style="
                                background-image: url('{{ url('/images/kontak_kami.webp') }}');
                                background-size: cover;
                                background-position: -40px 0px;
                                background-repeat: no-repeat;
                            ">
                            </div>
                    </div>
                    <div>
                        <div class="font-semibold">Alamat</div>
                        <p>Arcadia Daan Mogot Blok G18 No. 1-2-3</p>
                        <p>Jl. Daan Mogot KM 21,</p>
                        <p>Batuceper Tangerang 15122</p>
                    </div>
                </div>
                </div>

                <div class="my-4 tracking-tight font-bold font-sans text-xl text-black">Follow Our Social Media</div>

                <ul class="flex gap-4 items-center list-none p-0 m-0">
                    @forelse($activeSocialMedia as $platform)
                        <li>
                            <a 
                                href="{{ $platform['url'] }}" 
                                target="_blank"
                                rel="noopener noreferrer"
                                class="block transition transform hover:scale-105"
                                title="{{ $platform['name'] }}"
                            >
                                {{-- Dynamic Social Media Icon from Sprite Sheet --}}
                                <div 
                                    class="w-12 h-12 mb-2" 
                                    style="
                                        background-image: url('{{ url('/images/social_media.webp') }}');
                                        background-size: 834px 102px;
                                        background-position: {{ $platform['sprite_position'] }};
                                        background-repeat: no-repeat;
                                    "
                                    aria-label="{{ $platform['name'] }} Icon"
                                >
                                </div>
                            </a>
                        </li>
                    @empty
                        <li class="text-gray-500 text-sm"></li>
                    @endforelse
                </ul>
            </div>

             <div class="md:w-1/2">
              <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2871.8023769814763!2d106.6656630732005!3d-6.156710293830409!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e69f9cee62cceb7%3A0xba6a22f075f405fb!2sPT.%20Cipta%20Aneka%20Air!5e1!3m2!1sen!2sid!4v1758100908609!5m2!1sen!2sid" class="md:w-[600] md:h-[450px] w-full h-[200px]" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
            </div>
        </div>

</x-app-layout>