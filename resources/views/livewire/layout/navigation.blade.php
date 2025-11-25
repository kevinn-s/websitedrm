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

<div class="bg-white shadow-md shadow-gray-200 font-noto">
    <div class="bg-gray-200">
        <div class="w-full max-w-6xl mx-auto text-white flex justify-end gap-0.5">
            @guest
        <a href="{{ route('register') }}" class="text-xm px-4 pt-1.5 pb-1.5 font-semibold bg-primary-green-500 border-b-primary-green-700 border-b-4 hover:bg-primary-green-600 transition duration-200">
            Gabung sekarang
        </a>
        <a href="{{ route('login') }}" class="text-xm px-4 pt-1.5 pb-2 font-semibold text-primary-green-700 hover:underline hover:decoration-2">
            Login
        </a>
        @endguest
        @auth
        <div class="flex justify-center gap-2 items-center bg-white border-b-primary-green-700 border-b-4 px-4">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path fill="#000000" fill-rule="evenodd" d="M12 4a8 8 0 0 0-6.96 11.947A4.99 4.99 0 0 1 9 14h6a4.99 4.99 0 0 1 3.96 1.947A8 8 0 0 0 12 4Zm7.943 14.076A9.959 9.959 0 0 0 22 12c0-5.523-4.477-10-10-10S2 6.477 2 12a9.958 9.958 0 0 0 2.057 6.076l-.005.018l.355.413A9.98 9.98 0 0 0 12 22a9.947 9.947 0 0 0 5.675-1.765a10.055 10.055 0 0 0 1.918-1.728l.355-.413l-.005-.018ZM12 6a3 3 0 1 0 0 6a3 3 0 0 0 0-6Z" clip-rule="evenodd"/></svg>
            <span class="text-gray-900 text-sm font-medium">
                Haha
            </span>
        </div>
                <button wire:click="logout" type="submit" class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
            {{ __('Log Out') }}
        </button>
        @endauth
</div>
    </div>
    <div class=" text-[14px] font-medium flex items-end gap-8 w-full max-w-6xl mx-auto">
        <div>
            <img src="{{ asset("images/drm.jpg") }}" alt="" srcset="" class="w-[70px] h-auto py-2">
        </div>
        <div>
            <x-nav-link href="{{ route('dashboard') }}" :active="request()->routeIs('dashboard')">
                Beranda
            </x-nav-link>
            <x-nav-link href="{{ route('kegiatan') }}" :active="request()->routeIs('kegiatan')">
                Kegiatan
            </x-nav-link>
            <x-nav-link>
                Tentang kami
            </x-nav-link>
            <x-nav-link href="{{ route('kontak') }}" :active="request()->routeIs('kontak')">
                Kontak kami
            </x-nav-link>
            <x-nav-link href="{{ route('rekening') }}" :active="request()->routeIs('rekening')">
                Rekening
            </x-nav-link>
        </div>
    </div>
</div>

