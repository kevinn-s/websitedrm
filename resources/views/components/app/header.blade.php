<header
    class="text-gray-base sticky top-0 z-30 bg-white ">
    <div class="relative" x-data="{ tentangHover: false }">
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
                    <div >
                        <a href="{{ route("register") }}" class="w-24 h-8 flex justify-center items-center text-center text-white bg-primary-gold hover:bg-[#B18C2C] transition-colors duration-300 ">Bergabung</a>
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
          
                <ul class="pt-3 pl-32 flex justify-end gap-6 font-merriweather font-[500] text-[15px] border-green-950 border-t">
                    <x-nav-link href="{{ route('homepage') }}">Beranda</x-nav-link>
                    <x-nav-link href="{{ route('kegiatan') }}">Kegiatan</x-nav-link>
                    @auth
                        @if(Auth::user()->hasVerifiedAlumniInfo())
                            <x-nav-link href="{{ route('directory') }}">Alumni</x-nav-link>
                        @endif
                    @endauth
                    <x-nav-link @mouseenter="tentangHover = true" @mouseleave="tentangHover = false" style="user-select: none;">Tentang Kami</x-nav-link>
                    <x-nav-link href="{{ route('kontak') }}">Kontak Kami</x-nav-link>
                    <x-nav-link href="{{ route('rekening') }}">Rekening</x-nav-link>

                </ul>
            </div>
        </div>
    </div>
    <div 
        class="bg-white absolute w-full h-28 ml-14 [clip-path:inset(0_7.0rem_0_0)]"
        x-transition.opacity
        x-show="tentangHover"
    >
    </div>
    </div>
</header>