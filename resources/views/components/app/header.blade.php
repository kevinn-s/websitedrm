<header class="text-gray-base sticky top-0 z-30 bg-white ">
    <div class="hidden md:block relative" x-data="{ tentangHover: false }">
        <div
            class="px-4 sm:px-6 lg:px-14 {{ $variant === 'v2' || $variant === 'v3' ? '' : 'lg:border-b border-gray-200 border-t-10 border-t-[var(--primary-green)]' }}">
            <div class="flex items-center justify-between ">

                <!-- Header: Left side -->
                <div class="flex h-full">
                    <div class="w-[64px] md:w-[80px] md:h-[80px] flex flex-col justify-center icon-drm">

                    </div>
                    <!-- Hamburger button -->
                    <!-- <button class="text-gray-500 hover:text-gray-600 lg:hidden"
                    @click.stop="sidebarOpen = !sidebarOpen" aria-controls="sidebar" :aria-expanded="sidebarOpen">
                    <span class="sr-only">Open sidebar</span>
                    <svg class="w-6 h-6 fill-current" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <rect x="4" y="5" width="16" height="2" />
                        <rect x="4" y="11" width="16" height="2" />
                        <rect x="4" y="17" width="16" height="2" />
                    </svg>
                </button> -->
                </div>

                <!-- Header: Right side -->
                <div class="pb-5">

                    <div class="flex items-center justify-end gap-6 py-2  text-sm">
                        @guest
                            <div class="hover:underline underline-offset-5 decoration-2">
                                <a href="{{ route("login") }}">Login</a>
                            </div>
                            <div>
                                <a href="{{ route("register") }}"
                                    class="w-24 h-8 flex justify-center items-center text-center text-white bg-primary-gold hover:bg-[#B18C2C] transition-colors duration-300 ">Bergabung</a>
                            </div>
                        @endguest
                        @auth
                            <form method="POST" action="{{ route('logout') }}" x-data>
                                @csrf
                                <div class="hover:underline underline-offset-5 decoration-2">
                                    <a href="{{ route('logout') }}" @click.prevent="$root.submit();">Logout</a>
                                </div>
                            </form>
                        @endauth
                    </div>

                    <ul
                        class="pt-3 pl-32 flex justify-end gap-6 font-merriweather font-[500] text-[15px] border-green-950 border-t">
                        <x-nav-link href="{{ route('homepage') }}">Beranda</x-nav-link>
                        <x-nav-link href="{{ route('kegiatan') }}">Kegiatan</x-nav-link>
                        @auth
                            @if(Auth::user()->hasVerifiedAlumniInfo())
                                <x-nav-link href="{{ route('alumni.directory') }}">Alumni</x-nav-link>
                            @endif
                        @endauth
                        <x-nav-link @mouseenter="tentangHover = true" style="user-select: none;">Tentang
                            Kami</x-nav-link>
                        <x-nav-link href="{{ route('kontak') }}">Kontak Kami</x-nav-link>
                        <x-nav-link href="{{ route('rekening') }}">Rekening</x-nav-link>

                    </ul>
                </div>
            </div>
        </div>
        <div class=" bg-white absolute w-full h-30 ml-14 pt-3 pb-2 [clip-path:inset(0_7.0rem_0_0)] flex"
            x-transition.opacity x-show="tentangHover" @mouseleave="tentangHover = false" x-cloak>
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
                    <li><a class="" href="{{ route('struktur-asosiasi') }}">Struktur Asosiasi Alumni</a></li>
                </div>
            </div>
        </div>
    </div>

    <div class="md:hidden flex justify-between items-center px-4 py-2">
       
            <div class="w-[64px] h-[64px] flex flex-col justify-center icon-drm">

            </div>
     
        <x-dropdown-header>
            <x-slot name="trigger">
                <button data-collapse-toggle="navbar-default" type="button"
                    class="inline-flex items-center p-3 w-12 h-12 justify-center text-gray-600 rounded-lg md:hidden hover:bg-gray-50 focus:outline-none transition-colors duration-200"
                    aria-controls="navbar-default" aria-expanded="false">
                    <span class="sr-only">Open main menu</span>
                    <svg class="w-6 h-6" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                        viewBox="0 0 17 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M1 1h15M1 7h15M1 13h15" />
                    </svg>
                </button>
            </x-slot>
            <x-slot name="content">
                <div class="w-screen bg-white shadow-lg border-t border-gray-200" x-data="{ aboutUsOpen: false }">
                    <div class="flex flex-col py-6 px-6 space-y-1">
                        <a href="/" class="block px-4 py-4 text-lg font-semibold text-gray-800 hover:bg-gray-50 hover:text-[#03563D] rounded-lg transition-all duration-200">
                            Beranda
                        </a>
                        <a href="/kegiatan" class="block px-4 py-4 text-lg font-semibold text-gray-800 hover:bg-gray-50 hover:text-[#03563D] rounded-lg transition-all duration-200">
                            Kegiatan
                        </a>
                        @auth
                        <a href="/alumni" class="block px-4 py-4 text-lg font-semibold text-gray-800 hover:bg-gray-50 hover:text-[#03563D] rounded-lg transition-all duration-200">
                            Alumni
                        </a>
                        @endauth
                        
                        <!-- Tentang Kami with Sub-dropdown -->
                        <div class="relative">
                            <button @click="aboutUsOpen = !aboutUsOpen" class="w-full flex items-center justify-between px-4 py-4 text-lg font-semibold text-gray-800 hover:bg-gray-50 hover:text-[#03563D] rounded-lg transition-all duration-200">
                                <span>Tentang Kami</span>
                                <svg :class="{'rotate-180': aboutUsOpen}" class="w-5 h-5 transition-transform duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                                </svg>
                            </button>
                            
                            <div x-show="aboutUsOpen" x-transition class="absolute left-4 right-4 top-full z-20 bg-white border border-gray-200 rounded-lg shadow-lg overflow-hidden">
                                <!-- Tentang Kami Section -->
                                <div class="border-b -gray-200">
                                    <a href="{{ url('/visi-misi') }}" class="block px-4 py-3 text-base text-gray-700 hover:bg-gray-50 hover:text-[#03563D] transition-all duration-200">
                                        Visi Misi
                                    </a>
                                    <a href="{{ url('/tujuan') }}" class="block px-4 py-3 text-base text-gray-700 hover:bg-gray-50 hover:text-[#03563D] transition-all duration-200">
                                        Tujuan
                                    </a>
                                </div>
                                
                                @auth
                                <!-- Dokumen Legalitas Section -->
                                <div class="border-b border-gray-200">
                                    <a href="{{ url('/akta-asosiasi') }}" class="block px-4 py-3 text-base text-gray-700 hover:bg-gray-50 hover:text-[#03563D] transition-all duration-200">
                                        Akta Asosiasi Alumni
                                    </a>
                                    <a href="{{ url('/ad-art-asosiasi') }}" class="block px-4 py-3 text-base text-gray-700 hover:bg-gray-50 hover:text-[#03563D] transition-all duration-200">
                                        AD/ART Asosiasi Alumni
                                    </a>
                                </div>
                                @endauth
                                
                                <!-- Struktur Organisasi Section -->
                                <div>
                                    <a href="{{ url('/struktur-asosiasi-alumni') }}" class="block px-4 py-3 text-base text-gray-700 hover:bg-gray-50 hover:text-[#03563D] transition-all duration-200">
                                        Struktur Asosiasi Alumni
                                    </a>
                                </div>
                            </div>
                        </div>
                        
                        <a href="/kontak-kami" class="block px-4 py-4 text-lg font-semibold text-gray-800 hover:bg-gray-50 hover:text-[#03563D] rounded-lg transition-all duration-200">
                            Kontak Kami
                        </a>
                        <a href="/rekening" class="block px-4 py-4 text-lg font-semibold text-gray-800 hover:bg-gray-50 hover:text-[#03563D] rounded-lg transition-all duration-200">
                            Rekening
                        </a>
                        
                        @guest
                        <div class="border-t border-gray-200 mt-4 pt-4 space-y-2">
                            <a href="{{ route('register') }}" class="ml-4 block w-[70%] px-3 py-2 text-base font-bold text-white bg-[#03563D] hover:bg-[#024a33] hover:text-gray-200 text-center transition-all duration-200">
                                Daftar Sekarang
                            </a>
                            <a href="{{ route('login') }}" class="ml-4 block w-[70%] px-3 py-2 text-base font-semibold text-[#03563D] border-2 border-[#03563D] hover:bg-[#03563D] hover:text-white text-center transition-all duration-200">
                                Login
                            </a>
                        </div>
                        @endguest
                        
                        @auth
                        @if (auth()->user()->status === 'approved')
                        <div class="border-t border-gray-200 mt-4 pt-4">
                            <form method="POST" action="{{ route('logout') }}" class="w-full">
                                @csrf
                                <button type="submit" class="w-full px-3 py-2 text-base font-semibold text-[#03563D] hover:bg-red-50 rounded-lg transition-all duration-200 text-left">
                                    Log Out
                                </button>
                            </form>
                        </div>
                        @endif
                        @endauth
                    </div>
                </div>
            </x-slot>
        </x-dropdown-header>
    </div>
</header>