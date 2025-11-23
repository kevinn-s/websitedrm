<?php

use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;
use Illuminate\Validation\Rules;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Locked;
use Livewire\Volt\Component;

new #[Layout('layouts.guest')] class extends Component
{
    #[Locked]
    public string $token = '';
    public string $email = '';
    public string $password = '';
    public string $password_confirmation = '';

    /**
     * Mount the component.
     */
    public function mount(string $token): void
    {
        $this->token = $token;

        $this->email = request()->string('email');
    }

    /**
     * Reset the password for the given user.
     */
    public function resetPassword(): void
    {
        $this->validate([
            'token' => ['required'],
            'email' => ['required', 'string', 'email'],
            'password' => ['required', 'string', 'confirmed', Rules\Password::defaults()],
        ]);

        // Here we will attempt to reset the user's password. If it is successful we
        // will update the password on an actual user model and persist it to the
        // database. Otherwise we will parse the error and return the response.
        $status = Password::reset(
            $this->only('email', 'password', 'password_confirmation', 'token'),
            function ($user) {
                $user->forceFill([
                    'password' => Hash::make($this->password),
                    'remember_token' => Str::random(60),
                ])->save();

                event(new PasswordReset($user));
            }
        );

        // If the password was successfully reset, we will redirect the user back to
        // the application's home authenticated view. If there is an error we can
        // redirect them back to where they came from with their error message.
        if ($status != Password::PASSWORD_RESET) {
            $this->addError('email', __($status));

            return;
        }

        Session::flash('status', __($status));

        $this->redirectRoute('login', navigate: true);
    }
}; ?>

<form wire:submit="resetPassword" class="max-w-md mt-12 w-full bg-white">
    <div class="border-b-gray-200 border-b-[0.3px] w-full flex justify-center p-6">
        <img src="{{ asset('images/drm.jpg') }}" alt="" class="w-20 h-auto">
    </div>

    <div class="w-full p-6 space-y-4">
        <div class="space-y-2">
            <h1 class="font-sora text-2xl font-semibold">Reset Password</h1>
            <p class="text-sm text-gray-600">Masukkan email dan password baru Anda untuk mengatur ulang password.</p>
        </div>

        <!-- Email Address -->
        <div>
            <x-input-label for="email" class="font-semibold">Email</x-input-label>
            <x-text-input wire:model="email" id="email" class="w-full rounded-none my-2" type="email" name="email" required autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-1" />
        </div>

        <!-- Password -->
        <div>
            <x-input-label for="password" class="font-semibold">Password Baru</x-input-label>
            <x-text-input wire:model="password" id="password" class="w-full rounded-none my-2" type="password" name="password" required autocomplete="new-password" />
            <x-input-error :messages="$errors->get('password')" class="mt-1" />
        </div>

        <!-- Confirm Password -->
        <div>
            <x-input-label for="password_confirmation" class="font-semibold">Konfirmasi Password</x-input-label>
            <x-text-input wire:model="password_confirmation" id="password_confirmation" class="w-full rounded-none my-2" type="password" name="password_confirmation" required autocomplete="new-password" />
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-1" />
        </div>

        @if (session('status'))
            <div class="p-4 text-[13px] text-gray-800 bg-primary-green-400 bg-opacity-50">
                {{ session('status') }}
            </div>
        @endif

        <x-button type="submit" class="w-full">
            <div class="flex items-center gap-2">
                <span class="text-base">Reset Password</span>
                <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 15 15"><path fill="#ffffff" d="M8.293 2.293a1 1 0 0 1 1.414 0l4.5 4.5a1 1 0 0 1 0 1.414l-4.5 4.5a1 1 0 0 1-1.414-1.414L11 8.5H1.5a1 1 0 0 1 0-2H11L8.293 3.707a1 1 0 0 1 0-1.414Z"/></svg>
            </div>
        </x-button>

        <div class="text-sm text-center">
           <p>Sudah ingat password? <a href="{{ route('login') }}" class="text-primary-green-800 tracking-tight hover:underline">Masuk</a></p>
        </div>
    </div>
</form>
