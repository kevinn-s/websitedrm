<?php

use App\Livewire\Actions\Logout;

use Livewire\Volt\Component;

new class extends Component {
    public function profile(): void
    {
        $this->redirect(route('profile'), navigate: true);
    }

    public function login(): void
    {
        $this->redirect('login', navigate: true);
    }

    public function register(): void
    {
        $this->redirect('register', navigate: true);
    }
    /**
     * Log the current user out of the application.
     */
    public function logout(Logout $logout): void
    {
        $logout();

        $this->redirect('/', navigate: true);
    }
}; ?>

<div class="font-noto border-b border-slate-200 sticky top-0 z-50 w-full">
    <div class="bg-primary-green-500 text-white">
        <div class="mx-auto flex max-w-5xl flex-col gap-3 px-4 py-2 text-xs md:flex-row md:items-center md:justify-between md:text-sm">
            <div class="flex flex-wrap items-center gap-2">
                <!-- <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 24 24">
                    <path fill="currentColor" d="M12 2a7 7 0 0 1 7 7c0 4.78-5.33 11.32-6.86 13a1.83 1.83 0 0 1-2.28 0C10.33 20.32 5 13.78 5 9a7 7 0 0 1 7-7Zm0 2a5 5 0 0 0-5 5c0 3.08 3.42 7.94 5 9.9c1.58-1.96 5-6.82 5-9.9a5 5 0 0 0-5-5Zm0 3a2 2 0 1 1-2 2a2 2 0 0 1 2-2Z" />
                </svg> -->
                <!-- <span class="font-medium tracking-tight">asosiasidrm@gmail.com</span>
                <span class="hidden text-white/40 md:inline">•</span> -->

            </div>
            <div class="hidden sm:flex flex-wrap items-center gap-3">
                @guest

                    <a href="{{ route('login') }}" class=" border border-white/40 px-4 py-1 font-semibold tracking-tight hover:bg-white hover:text-primary-green-700 transition">Masuk</a>
                    <a href="{{ route('register') }}" class=" bg-primary-gold px-4 py-1 font-semibold tracking-tight text-primary-green-900 hover:bg-amber-300 transition">Daftar sekarang</a>
                @endguest
                @auth
                    <button type="button" wire:click="profile" class="inline-flex items-center gap-1 bg-white/10 px-3 py-1 text-sm font-semibold tracking-tight hover:bg-white/20 transition">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 24 24">
                            <path fill="currentColor" d="M12 2a5 5 0 1 1-5 5a5 5 0 0 1 5-5Zm0 12c3.69 0 7 1.38 7 3.75V20a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2v-2.25C5 15.38 8.31 14 12 14Z" />
                        </svg>
                        Profil
                    </button>
                    <button wire:click="logout" type="button" class="inline-flex items-center gap-1 border border-white/40 px-3 py-1 text-sm font-semibold tracking-tight hover:bg-white hover:text-primary-green-700 transition">
                        Keluar
                    </button>
                @endauth
            </div>
        </div>
    </div>

    <div class="bg-white" x-data="{ mobileMenuOpen: false }">
        <div class="relative mx-auto flex max-w-5xl items-center justify-between py-4 md:py-0 px-4 lg:px-0">
            <a href="{{ route('dashboard') }}" class="flex items-center gap-4 sm:gap-6">
                <img src="{{ asset('images/drm.jpg') }}" alt="Logo DRM" class="h-12 sm:h-14 w-auto" />
                <div class="leading-tight font-medium text-primary-green-900 flex flex-col">
                    <h1 class="text-xs uppercase lg:tracking-[0.13em] text-primary-green-700">ASOSIASI ALUMNI DRM</h1>
                    <h1 class="text-xs uppercase lg:tracking-[0.13em] text-primary-green-700">BINUS UNIVERSITY</h1>

                </div>
            </a>

            <!-- Mobile menu button -->
            <button @click="mobileMenuOpen = !mobileMenuOpen" class="lg:hidden p-2 text-primary-green-900 hover:bg-gray-100 rounded-md" type="button" aria-label="Toggle menu">
                <svg x-show="!mobileMenuOpen" xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                </svg>
                <svg x-show="mobileMenuOpen" x-cloak xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>

            <nav class="hidden justify-between pt-4 items-center text-sm+ font-semibold tracking-tight text-primary-green-900 lg:flex">
                <x-nav-link href="{{ route('dashboard') }}" :active="request()->routeIs('dashboard')">
                    Beranda
                </x-nav-link>
                <x-nav-link href="{{ route('kegiatan') }}" :active="request()->routeIs('kegiatan')">
                    Kegiatan
                </x-nav-link>
                 @auth
                <x-nav-link href="{{ route('alumni.directory') }}" :active="request()->routeIs('alumni.directory')">
                    Alumni
                </x-nav-link>
                @endauth
                <div class="" x-data="{ openMega: false }" @keydown.escape.window="openMega = false">
                    <button type="button" @click="openMega = !openMega" @click.outside="openMega = false" class="inline-flex items-center gap-1 border-b-2 border-transparent px-6 pt-4 pb-5" :class="openMega ? 'border-primary-green-600 text-primary-green-700' : ''">
                        Tentang Kami
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M5.23 7.21a.75.75 0 0 1 1.06.02L10 11.104l3.71-3.874a.75.75 0 0 1 1.08 1.04l-4.24 4.43a.75.75 0 0 1-1.08 0l-4.24-4.43a.75.75 0 0 1 .02-1.06Z" clip-rule="evenodd" />
                        </svg>
                    </button>
                    <div x-cloak x-show="openMega" x-transition.opacity.duration.150ms x-transition.scale.origin.top class="absolute left-0 top-full z-40 w-screen max-w-5xl">
                        <div class="mx-4 overflow-hidden border border-slate-200 bg-white shadow-2xl">
                            <div class="flex flex-col divide-y divide-slate-200 sm:flex-row sm:divide-y-0 sm:divide-x">
                                <div class="w-[25%] flex-1 p-6">
                                    <h3 class="text-base font-semibold text-primary-green-900">Tentang Kami</h3>
                                    <ul class="list-disc mt-3 ml-3 space-y-2 text-sm text-gray-700">
                                        <li>
                                            <a href="{{ route('visi-misi') }}" class="hover:text-primary-green-700 hover:underline">Visi &amp; Misi</a>
                                        </li>
                                        <li>
                                            <a href="{{ route('tujuan') }}" class="hover:text-primary-green-700 hover:underline">Tujuan</a>
                                        </li>
                                    </ul>
                                </div>
                                @auth
                                <div class="w-[25%] flex-1 p-6">

                                        <h3 class="text-base font-semibold text-primary-green-900">Dokumen Legalitas</h3>
                                        <ul class="list-disc mt-3 ml-3 space-y-2 text-sm text-gray-700">
                                            <li>
                                                <a href="{{ route('dokumen.akta-asosiasi') }}" class="hover:text-primary-green-700 hover:underline">Akta Asosiasi Alumni</a>
                                            </li>
                                            <li>
                                                <a href="{{ route('dokumen.ad-art') }}" class="hover:text-primary-green-700 hover:underline">AD/ART Asosiasi Alumni</a>
                                            </li>
                                        </ul>


                                </div>
                                @endauth
                                <div class="w-[25%] flex-1 p-6">
                                    <h3 class="text-base font-semibold text-primary-green-900">Struktur Organisasi</h3>
                                    <ul class="list-disc ml-3 flex flex-col mt-3 space-y-2 text-sm text-gray-700">
                                        <li class="">
                                            <a href="{{ route('struktur-organisasi') }}" class="hover:text-primary-green-700 hover:underline">Struktur Asosiasi Alumni</a>
                                        </li>
                                    </ul>
                                </div>
                                <div class="w-[25%] flex-1 p-6">

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <x-nav-link href="{{ route('kontak') }}" :active="request()->routeIs('kontak')">
                    Kontak Kami
                </x-nav-link>
                <x-nav-link href="{{ route('rekening') }}" :active="request()->routeIs('rekening')">
                    Rekening
                </x-nav-link>
            </nav>
        </div>

        <!-- Mobile Navigation Menu -->
        <div x-show="mobileMenuOpen" x-cloak x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0 -translate-y-2" x-transition:enter-end="opacity-100 translate-y-0" x-transition:leave="transition ease-in duration-150" x-transition:leave-start="opacity-100 translate-y-0" x-transition:leave-end="opacity-0 -translate-y-2" class="lg:hidden border-t border-gray-200 bg-white">
            <div class="px-4 py-3 space-y-1">
                <a href="{{ route('dashboard') }}" class="block px-3 py-2 text-base font-medium text-primary-green-900 hover:bg-primary-green-50 {{ request()->routeIs('dashboard') ? 'bg-primary-green-50 border-l-4 border-primary-green-500' : '' }}">Beranda</a>
                <a href="{{ route('kegiatan') }}" class="block px-3 py-2 text-base font-medium text-primary-green-900 hover:bg-primary-green-50 {{ request()->routeIs('kegiatan') ? 'bg-primary-green-50 border-l-4 border-primary-green-500' : '' }}">Kegiatan</a>
                @auth
                <a href="{{ route('alumni.directory') }}" class="block px-3 py-2 text-base font-medium text-primary-green-900 hover:bg-primary-green-50 {{ request()->routeIs('alumni.directory') ? 'bg-primary-green-50 border-l-4 border-primary-green-500' : '' }}">Alumni</a>
                @endauth

                <!-- Tentang Kami Section -->
                <div x-data="{ subMenuOpen: false }" class="border-t border-gray-100 pt-2 mt-2">
                    <button @click="subMenuOpen = !subMenuOpen" class="w-full flex items-center justify-between px-3 py-2 text-base font-medium text-primary-green-900 hover:bg-primary-green-50">
                        <span>Tentang Kami</span>
                        <svg :class="subMenuOpen ? 'rotate-180' : ''" class="h-4 w-4 transition-transform" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M5.23 7.21a.75.75 0 0 1 1.06.02L10 11.104l3.71-3.874a.75.75 0 0 1 1.08 1.04l-4.24 4.43a.75.75 0 0 1-1.08 0l-4.24-4.43a.75.75 0 0 1 .02-1.06Z" clip-rule="evenodd" />
                        </svg>
                    </button>
                    <div x-show="subMenuOpen" x-collapse class="pl-4 space-y-1">
                        <a href="{{ route('visi-misi') }}" class="block px-3 py-2 text-sm text-gray-700 hover:bg-primary-green-50">Visi & Misi</a>
                        <a href="{{ route('tujuan') }}" class="block px-3 py-2 text-sm text-gray-700 hover:bg-primary-green-50">Tujuan</a>
                        @auth
                        <a href="{{ route('dokumen.akta-asosiasi') }}" class="block px-3 py-2 text-sm text-gray-700 hover:bg-primary-green-50">Akta Asosiasi Alumni</a>
                        <a href="{{ route('dokumen.ad-art') }}" class="block px-3 py-2 text-sm text-gray-700 hover:bg-primary-green-50">AD/ART Asosiasi Alumni</a>
                        @endauth
                        <a href="{{ route('struktur-organisasi') }}" class="block px-3 py-2 text-sm text-gray-700 hover:bg-primary-green-50">Struktur Asosiasi Alumni</a>
                    </div>
                </div>

                <a href="{{ route('kontak') }}" class="block px-3 py-2 text-base font-medium text-primary-green-900 hover:bg-primary-green-50 {{ request()->routeIs('kontak') ? 'bg-primary-green-50 border-l-4 border-primary-green-500' : '' }}">Kontak Kami</a>
                <a href="{{ route('rekening') }}" class="block px-3 py-2 text-base font-medium text-primary-green-900 hover:bg-primary-green-50 {{ request()->routeIs('rekening') ? 'bg-primary-green-50 border-l-4 border-primary-green-500' : '' }}">Rekening</a>

                <!-- Mobile Auth Buttons -->
                <div class="border-t border-gray-200 mt-3 pt-3 space-y-2">
                    @guest
                        <a href="{{ route('login') }}" class="block w-full text-center px-4 py-2.5 text-base font-semibold text-primary-green-700 border border-primary-green-500 hover:bg-primary-green-50 transition">Masuk</a>
                        <a href="{{ route('register') }}" class="block w-full text-center px-4 py-2.5 text-base font-semibold text-primary-green-900 bg-primary-gold hover:bg-amber-300 transition">Daftar sekarang</a>
                    @endguest
                    @auth
                        <button type="button" wire:click="profile" class="w-full flex items-center justify-center gap-2 px-4 py-2.5 text-base font-semibold text-primary-green-700 border border-primary-green-500 hover:bg-primary-green-50 transition">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 24 24">
                                <path fill="currentColor" d="M12 2a5 5 0 1 1-5 5a5 5 0 0 1 5-5Zm0 12c3.69 0 7 1.38 7 3.75V20a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2v-2.25C5 15.38 8.31 14 12 14Z" />
                            </svg>
                            Profil Saya
                        </button>
                        <button wire:click="logout" type="button" class="w-full flex items-center justify-center gap-2 px-4 py-2.5 text-base font-semibold text-red-600 border border-red-300 hover:bg-red-50 transition">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 24 24">
                                <path fill="currentColor" d="M5 21q-.825 0-1.412-.587T3 19V5q0-.825.588-1.412T5 3h7v2H5v14h7v2zm11-4l-1.375-1.45l2.55-2.55H9v-2h8.175l-2.55-2.55L16 7l5 5z" />
                            </svg>
                            Keluar
                        </button>
                    @endauth
                </div>
            </div>
        </div>
    </div>
</div>

