<?php

use Illuminate\Support\Facades\Password;
use Livewire\Attributes\Layout;
use Livewire\Volt\Component;

new #[Layout('layouts.guest')] class extends Component
{
    public string $email = '';

    /**
     * Send a password reset link to the provided email address.
     */
    public function sendPasswordResetLink(): void
    {
        $this->validate([
            'email' => ['required', 'string', 'email'],
        ]);

        // We will send the password reset link to this user. Once we have attempted
        // to send the link, we will examine the response then see the message we
        // need to show to the user. Finally, we'll send out a proper response.
        $status = Password::sendResetLink(
            $this->only('email')
        );

        if ($status != Password::RESET_LINK_SENT) {
            $this->addError('email', __($status));

            return;
        }

        $this->reset('email');

        session()->flash('status', __($status));
    }
}; ?>

<form wire:submit="sendPasswordResetLink" class="max-w-md mt-12 w-full bg-white">
    <div class="border-b-gray-200 border-b-[0.3px] w-full flex justify-center p-6">
        <img src="{{ asset('images/drm.jpg') }}" alt="" class="w-20 h-auto">
    </div>

    <div class="w-full p-6 space-y-4">
        <div class="space-y-2">
            <h1 class="font-sora text-2xl font-semibold">Lupa Password?</h1>
            <p class="text-sm text-gray-600">
                Masukkan email Anda dan kami akan mengirimkan link untuk mengatur ulang password Anda.
            </p>
        </div>

        <!-- Email Address -->
        <div>
            <x-input-label for="email" class="font-semibold">Email</x-input-label>
            <x-text-input wire:model="email" id="email" class="w-full rounded-none my-2" type="email" name="email" required autofocus autocomplete="email" />
            <x-input-error :messages="$errors->get('email')" class="mt-1" />
        </div>

        @if (session('status'))
            <div class="p-4 text-[13px] text-gray-800 bg-primary-green-400 bg-opacity-50">
                {{ session('status') }}
            </div>
        @endif

        <x-button type="submit" class="w-full">
            <div class="flex items-center gap-2">
                <span class="text-base">Kirim Link Reset Password</span>
                <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 15 15"><path fill="#ffffff" d="M8.293 2.293a1 1 0 0 1 1.414 0l4.5 4.5a1 1 0 0 1 0 1.414l-4.5 4.5a1 1 0 0 1-1.414-1.414L11 8.5H1.5a1 1 0 0 1 0-2H11L8.293 3.707a1 1 0 0 1 0-1.414Z"/></svg>
            </div>
        </x-button>

        <div class="text-sm text-center">
           <p>Sudah ingat password? <a href="{{ route('login') }}" class="text-primary-green-800 tracking-tight hover:underline">Masuk</a></p>
        </div>
    </div>
</form>
