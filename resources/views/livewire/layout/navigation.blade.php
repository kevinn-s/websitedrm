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

<div>
    <nav x-data="{ open: false }" class="hidden md:block bg-white border-b border-gray-100 font-inter relative">
        <!-- Primary Navigation Menu -->
        <div class="mx-24 px-5 pb-8 sm:px-6 lg:px-8">
            <div class="flex flex-col justify-center">
                <div class="flex justify-between">
                    <div class="shrink-0 flex items-end">
                        <a href="{{ route('dashboard') }}" wire:navigate class="flex gap-4">
                            <img class="h-12 w-auto" src="{{ asset("images/drm.jpg") }}" alt="" srcset="">
                            <div class="font-bold text-sm font-source leading-none text-gray-950">
                                ALUMNI ASSOCIATION<br>DOCTOR OF RESEARCH IN MANAGEMENT<br>BINUS UNIVERSITY
                            </div>
                        </a>
                    </div>
                    <div>
                        <div class="flex my-3 pb-5 justify-end text-[13px] ">

                            @guest
                                <button wire:click="login" class="">
                                    <x-dropdown-link>
                                        {{ __('Masuk') }}
                                    </x-dropdown-link>
                                </button>

                                <button wire:click="register" class="">
                                    <x-dropdown-link>
                                        {{ __('Daftar menjadi anggota') }}
                                    </x-dropdown-link>
                                </button>
                            @endguest
                            @auth
                                <button wire:click="profile"
                                    class="items-center px-2 border-r-[0.3px] border-gray-400 flex gap-2">
                                    <div>
                                        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14"
                                            viewBox="0 0 448 512">
                                            <path fill="#000000"
                                                d="M224 256a128 128 0 1 0 0-256a128 128 0 1 0 0 256zm-45.7 48C79.8 304 0 383.8 0 482.3C0 498.7 13.3 512 29.7 512h388.6c16.4 0 29.7-13.3 29.7-29.7c0-98.5-79.8-178.3-178.3-178.3h-91.4z" />
                                        </svg>
                                    </div>

                                    <div class="" x-data="{{ json_encode(['name' => auth()->user()->name]) }}" x-text="name"
                                        x-on:profile-updated.window="name = $event.detail.name"></div>
                                </button>
                                <button wire:click="logout" class="">
                                    <x-dropdown-link>
                                        {{ __('Keluar') }}
                                    </x-dropdown-link>
                                </button>
                            @endauth
                        </div>
                        <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">

                            <x-nav-link :href="route('kegiatan')" :active="request()->routeIs('kegiatan')"
                                wire:navigate>
                                {{ __('Kegiatan') }}
                            </x-nav-link>
                            @auth
                                <x-nav-link :href="route('alumni.directory')"
                                    :active="request()->routeIs('alumni.directory')" wire:navigate>
                                    {{ __('Alumni') }}
                            @endauth
                            </x-nav-link>
                            <x-header-dropdown align="right" width="48">
                                <x-slot name="trigger">
                                    <button
                                        class="inline-flex items-center border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none transition ease-in-out duration-150">
                                        <div
                                            class='inline-flex items-center px-1 pt-1 border-b-2 border-transparent text-[16px] font-[700] leading-5 text-black hover:text-gray-700 hover:border-gray-300 focus:outline-none focus:text-gray-700 focus:border-gray-300 transition duration-150 ease-in-out'>
                                            Tentang Kami
                                        </div>

                                        <div class="ms-1">
                                            <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg"
                                                viewBox="0 0 20 20">
                                                <path fill-rule="evenodd"
                                                    d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                                    clip-rule="evenodd" />
                                            </svg>
                                        </div>
                                    </button>
                                </x-slot>
                                <x-slot name="content">
                                    <div class="w-screen">
                                        <div class="bg-white ml-32 mr-32">
                                            <div
                                                class="flex pt-4 grid-cols-1 border-r-[1px] border-l-[1px] border-b-[1px] border-solid border-[#E5E7EB]">
                                                <div
                                                    class="w-[25%] text-sm pl-4 pb-4 border-r-[1px] border-t-slate-600 border-solid">
                                                    <div class="text-base font-semibold text-green-900 mb-2">Tentang
                                                        Kami</div>
                                                    <div class="flex flex-col gap-2 pl-[0.8rem]">
                                                        <li><a class="" href="{{ route('visi-misi')}}">Visi Misi</a>
                                                        </li>
                                                        <li><a class="" href="{{ route('tujuan') }}">Tujuan</a></li>
                                                    </div>
                                                </div>
                                                @auth
                                                    <div
                                                        class="w-[25%] text-sm pl-4 pb-4 border-r-[1px] border-t-slate-600 border-solid">
                                                        <div class="text-base font-semibold text-green-900 mb-2">Dokumen
                                                            Legalitas</div>
                                                        <div class="flex flex-col gap-2 pl-[0.8rem]">
                                                            <li>
                                                                <a class="" href="{{ route('dokumen.akta-asosiasi') }}">Akta Asosiasi Alumni</a>
                                                            </li>
                                                            <li>
                                                                <a class="" href="{{ route('dokumen.ad-art') }}">AD/ART Asosiasi Alumni</a>
                                                            </li>
                                                        </div>
                                                    </div>
                                                @endauth
                                                <div
                                                    class="w-[25%] text-sm pl-4 pb-4 border-r-[1px] border-t-slate-600 border-solid">
                                                    <div class="text-base font-semibold text-green-900 mb-2">Struktur
                                                        Organisasi</div>
                                                    <div class="flex flex-col gap-2 pl-[0.8rem]">
                                                        <li>
                                                            <a class="" href="{{ route('struktur-organisasi') }}">Struktur Asosiasi Alumni</a>
                                                        </li>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </x-slot>
                            </x-header-dropdown>
                            <x-nav-link :href="route('kontak')" :active="request()->routeIs('kontak')" wire:navigate>
                                {{ __('Kontak Kami') }}
                            </x-nav-link>
                            <x-nav-link :href="route('rekening')" :active="request()->routeIs('rekening')"
                                wire:navigate>
                                {{ __('Rekening') }}
                            </x-nav-link>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </nav>

    <nav x-data="{ open: false }"
        class="md:hidden fixed top-0 left-0 right-0 bg-white border-b border-gray-100 z-50 shadow-sm">
        <div class="px-4 sm:px-6">
            <div class="flex justify-between items-center h-16">
                <div class="flex items-center">
                    <a href="{{ route('dashboard') }}" wire:navigate class="flex gap-2 items-center">
                        <img class="h-12 w-auto" src="{{ asset("images/drm.jpg") }}" alt="">
                    </a>
                </div>
                <button @click="open = !open"
                    class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition duration-150 ease-in-out">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': !open }" class="inline-flex"
                            stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': !open, 'inline-flex': open }" class="hidden" stroke-linecap="round"
                            stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
        <div :class="{'block': open, 'hidden': !open}" class="hidden bg-white max-h-[calc(100dvh-4rem)] overflow-y-auto">
            <div class="pt-2 pb-3 space-y-1">
                <a href="{{ route('dashboard') }}" wire:navigate
                    class="block pl-3 pr-4 py-2 border-l-4 {{ request()->routeIs('dashboard') ? 'border-primary-green text-primary-green bg-green-50' : 'border-transparent text-gray-600 hover:text-gray-800 hover:bg-gray-50 hover:border-gray-300' }} text-base font-medium transition duration-150 ease-in-out">
                    Beranda
                </a>
                <a href="{{ route('kegiatan') }}" wire:navigate
                    class="block pl-3 pr-4 py-2 border-l-4 {{ request()->routeIs('kegiatan') ? 'border-primary-green text-primary-green bg-green-50' : 'border-transparent text-gray-600 hover:text-gray-800 hover:bg-gray-50 hover:border-gray-300' }} text-base font-medium transition duration-150 ease-in-out">
                    Kegiatan
                </a>
                @auth
                    <a href="{{ route('alumni.directory') }}" wire:navigate
                        class="block pl-3 pr-4 py-2 border-l-4 {{ request()->routeIs('alumni.directory') ? 'border-primary-green text-primary-green bg-green-50' : 'border-transparent text-gray-600 hover:text-gray-800 hover:bg-gray-50 hover:border-gray-300' }} text-base font-medium transition duration-150 ease-in-out">
                        Alumni
                    </a>
                @endauth
                <div x-data="{ openAbout: false }">
                    <button @click="openAbout = !openAbout"
                        class="w-full flex items-center justify-between pl-3 pr-4 py-2 border-l-4 border-transparent text-gray-600 hover:text-gray-800 hover:bg-gray-50 hover:border-gray-300 text-base font-medium transition duration-150 ease-in-out">
                        <span>Tentang Kami</span>
                        <svg :class="{'rotate-180': openAbout}"
                            class="h-5 w-5 transform transition-transform duration-200" fill="currentColor"
                            viewBox="0 0 20 20">
                            <path fill-rule="evenodd"
                                d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                clip-rule="evenodd" />
                        </svg>
                    </button>

                    <div x-show="openAbout" x-transition class="bg-gray-50 py-2">
                        <div class="pl-8 pr-4 py-2">
                            <div class="text-sm font-semibold text-primary-green mb-2">Tentang Kami</div>
                            <a href="{{ route('visi-misi') }}" wire:navigate class="block py-1.5 text-sm text-gray-600 hover:text-primary-green">• Visi Misi</a>
                            <a href="{{ route('tujuan') }}" wire:navigate class="block py-1.5 text-sm text-gray-600 hover:text-primary-green">• Tujuan</a>
                        </div>

                        @auth
                            <!-- Dokumen Legalitas -->
                            <div class="pl-8 pr-4 py-2">
                                <div class="text-sm font-semibold text-primary-green mb-2">Dokumen Legalitas</div>
                                <a href="{{ route('dokumen.akta-asosiasi') }}" wire:navigate
                                    class="block py-1.5 text-sm text-gray-600 hover:text-primary-green">• Akta Asosiasi
                                    Alumni</a>
                                <a href="{{ route('dokumen.ad-art') }}" wire:navigate
                                    class="block py-1.5 text-sm text-gray-600 hover:text-primary-green">• AD/ART Asosiasi
                                    Alumni</a>
                            </div>
                        @endauth

                        <!-- Struktur Organisasi -->
                        <div class="pl-8 pr-4 py-2">
                            <div class="text-sm font-semibold text-primary-green mb-2">Struktur Organisasi</div>
                            <a href="{{ route('struktur-organisasi') }}" wire:navigate
                                class="block py-1.5 text-sm text-gray-600 hover:text-primary-green">• Struktur Asosiasi
                                Alumni</a>
                        </div>
                    </div>
                </div>

                <!-- Kontak Kami -->
                <a href="{{ route('kontak') }}" wire:navigate
                    class="block pl-3 pr-4 py-2 border-l-4 {{ request()->routeIs('kontak') ? 'border-primary-green text-primary-green bg-green-50' : 'border-transparent text-gray-600 hover:text-gray-800 hover:bg-gray-50 hover:border-gray-300' }} text-base font-medium transition duration-150 ease-in-out">
                    Kontak Kami
                </a>

                <!-- Rekening -->
                <a href="{{ route('rekening') }}" wire:navigate
                    class="block pl-3 pr-4 py-2 border-l-4 {{ request()->routeIs('rekening') ? 'border-primary-green text-primary-green bg-green-50' : 'border-transparent text-gray-600 hover:text-gray-800 hover:bg-gray-50 hover:border-gray-300' }} text-base font-medium transition duration-150 ease-in-out">
                    Rekening
                </a>
            </div>

            <!-- User Section -->
            <div class="pt-4 pb-3 border-t border-gray-200">
                @guest
                    <div class="space-y-1">
                        <button wire:click="login"
                            class="block w-full text-left pl-3 pr-4 py-2 border-l-4 border-transparent text-gray-600 hover:text-gray-800 hover:bg-gray-50 hover:border-gray-300 text-base font-medium transition duration-150 ease-in-out">
                            Masuk
                        </button>
                        <button wire:click="register"
                            class="block w-full text-left pl-3 pr-4 py-2 border-l-4 border-transparent text-gray-600 hover:text-gray-800 hover:bg-gray-50 hover:border-gray-300 text-base font-medium transition duration-150 ease-in-out">
                            Daftar menjadi anggota
                        </button>
                    </div>
                @endguest

                @auth
                    <div class="px-4 mb-3">
                        <div class="flex items-center gap-2">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 448 512">
                                <path fill="#000000"
                                    d="M224 256a128 128 0 1 0 0-256a128 128 0 1 0 0 256zm-45.7 48C79.8 304 0 383.8 0 482.3C0 498.7 13.3 512 29.7 512h388.6c16.4 0 29.7-13.3 29.7-29.7c0-98.5-79.8-178.3-178.3-178.3h-91.4z" />
                            </svg>
                            <div class="font-medium text-base text-gray-800"
                                x-data="{{ json_encode(['name' => auth()->user()->name]) }}" x-text="name"
                                x-on:profile-updated.window="name = $event.detail.name"></div>
                        </div>
                    </div>
                    <div class="space-y-1">
                        <button wire:click="profile"
                            class="block w-full text-left pl-3 pr-4 py-2 border-l-4 border-transparent text-gray-600 hover:text-gray-800 hover:bg-gray-50 hover:border-gray-300 text-base font-medium transition duration-150 ease-in-out">
                            Profile
                        </button>
                        <button wire:click="logout"
                            class="block w-full text-left pl-3 pr-4 py-2 border-l-4 border-transparent text-gray-600 hover:text-gray-800 hover:bg-gray-50 hover:border-gray-300 text-base font-medium transition duration-150 ease-in-out">
                            Keluar
                        </button>
                    </div>
                @endauth
            </div>
        </div>
    </nav>
</div>