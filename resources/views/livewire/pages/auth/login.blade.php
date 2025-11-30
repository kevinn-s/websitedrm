<?php

use App\Livewire\Forms\LoginForm;
use Illuminate\Support\Facades\Session;
use Livewire\Attributes\Layout;
use Livewire\Volt\Component;

new #[Layout('layouts.guest')] class extends Component
{
    public LoginForm $form;

    public function login(): void
    {
        $this->form->validate();

        $this->form->authenticate();

        Session::regenerate();

        $this->redirectIntended(default: route('dashboard', absolute: false), navigate: true);
    }
}; ?>

<form wire:submit.prevent="login" class="max-w-md w-full my-6 sm:my-12 bg-white mx-auto">
    <!-- Session Status -->
    <x-auth-session-status :status="session('status')" />
    <div class="border-b-gray-200 border-b-[0.3px] w-full flex justify-center p-4 sm:p-6">
        <img src="{{ asset('images/drm.jpg') }}" alt="" class="w-16 sm:w-20 h-auto">
    </div>
    <div class="w-full p-4 sm:p-6 space-y-4">
        <h1 class="font-sora text-2xl text-center font-semibold">Login</h1>
        <div>
            <x-input-label for="email" class="font-semibold">Email</x-input-label>
            <x-text-input id="email" type="email" name="email" wire:model.defer="form.email" class="w-full rounded-none my-2" autocomplete="username" />
            <x-input-error :messages="$errors->get('form.email')" class="mt-1" />
        </div>
        <div>
            <x-input-label for="password" class="font-semibold">Password</x-input-label>
            <x-text-input id="password" type="password" name="password" wire:model.defer="form.password" class="w-full rounded-none my-2" autocomplete="current-password" />
            <x-input-error :messages="$errors->get('form.password')" class="mt-1" />
        </div>
        <div class="flex items-center justify-between">
            <label for="remember" class="inline-flex items-center gap-2 text-sm text-gray-600">
                <input wire:model="form.remember" id="remember" type="checkbox" class="border-gray-300 text-primary-green-500 shadow-sm focus:ring-primary-green-500" name="remember">
                <span>{{ __('Remember me') }}</span>
            </label>
               <a href="{{ route('password.request') }}" class="text-sm underline">Lupa Password?</a>
        </div>
        @if (session('message'))
            <div class="p-4 text-[13px] text-gray-800 bg-primary-green-400 bg-opacity-50">
                {{ session('message') }}
            </div>
        @endif

        <x-button type="submit" class="w-full">
            <div class="flex items-center gap-2">
                <span class="text-base">Masuk</span>
                <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 15 15"><path fill="#ffffff" d="M8.293 2.293a1 1 0 0 1 1.414 0l4.5 4.5a1 1 0 0 1 0 1.414l-4.5 4.5a1 1 0 0 1-1.414-1.414L11 8.5H1.5a1 1 0 0 1 0-2H11L8.293 3.707a1 1 0 0 1 0-1.414Z"/></svg>
            </div>
        </x-button>
        <div class="text-sm text-center">
           <p>Belum punya akun? <a href="{{ route('register') }}" class="text-primary-green-800 tracking-tight hover:underline">Daftar</a></p>
        </div>
    </div>

</form>
