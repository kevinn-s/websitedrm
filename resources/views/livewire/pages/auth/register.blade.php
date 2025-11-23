<?php

use App\Models\User;
use App\Mail\RegisterEmail;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Validation\Rules;
use Livewire\Attributes\Layout;
use Livewire\Volt\Component;

new #[Layout('layouts.guest')] class extends Component
{
    public string $name = '';
    public string $email = '';
    public string $nim = '';
    public string $password = '';
    public string $password_confirmation = '';
    public bool $registered = false;

    /**
     * Handle an incoming registration request.
     */
    public function register(): void
    {
        $validated = $this->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:' . User::class],
            'password' => ['required', 'string', 'confirmed', Rules\Password::defaults()],
            'nim' => ['required', 'string', 'max:255', 'unique:alumni,student_id'],
        ]);

        $user = DB::transaction(function () use ($validated) {
            $user = User::create([
                'name' => $validated['name'],
                'email' => $validated['email'],
                'password' => Hash::make($validated['password']),
            ]);

            event(new Registered($user));

            $user->alumni()->create([
                'student_id' => $validated['nim'],
                'name' => $validated['name'],
                'email' => $validated['email'],
            ]);

            return $user;
        });

        Mail::to($user->email)->send(new RegisterEmail(
            $validated['name'],
            $validated['email'],
            $validated['nim']
        ));

        $this->registered = true;
    }
}; ?>

<form wire:submit.prevent="register" class="max-w-md mt-12 w-full bg-white">
    <!-- Session Status -->
    <x-auth-session-status :status="session('status')" />
    <div class="border-b-gray-200 border-b-[0.3px] w-full flex justify-center p-6">
        <img src="{{ asset('images/drm.jpg') }}" alt="" class="w-20 h-auto">
    </div>
    <div class="w-full p-6 space-y-4">
        @if($registered)
             <div class="space-y-4">
                <div class="space-y-2 text-center">
                    <h1 class="font-sora text-2xl font-semibold">Terima Kasih!</h1>
                    <p class="text-sm text-gray-600">
                        Pendaftaran Anda telah berhasil.
                    </p>
                </div>

                <div class="p-4 text-[13px] text-gray-800 bg-primary-green-400 bg-opacity-50">
                    Akun Anda akan divalidasi terlebih dahulu sebelum dapat digunakan. Proses validasi biasanya memakan waktu 1-3 hari kerja.
                    <p class="pt-1">Silakan cek email Anda untuk informasi lebih lanjut.</p>
                </div>

                <div class="space-y-3">
                    <a href="{{ route('login') }}" wire:navigate class="block">
                        <x-button type="button" class="w-full">
                            <div class="flex items-center justify-center gap-2">
                                <span class="text-base">Ke Halaman Login</span>
                                <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 15 15"><path fill="#ffffff" d="M8.293 2.293a1 1 0 0 1 1.414 0l4.5 4.5a1 1 0 0 1 0 1.414l-4.5 4.5a1 1 0 0 1-1.414-1.414L11 8.5H1.5a1 1 0 0 1 0-2H11L8.293 3.707a1 1 0 0 1 0-1.414Z"/></svg>
                            </div>
                        </x-button>
                    </a>
                    <a href="{{ url('/') }}" wire:navigate class="block">
                        <button type="button" class="w-full border border-primary-green-600 text-primary-green-600 px-4 py-3 font-semibold hover:bg-primary-green-50 transition">
                            Kembali ke Beranda
                        </button>
                    </a>
                </div>
            </div>
        @else
        <div class="space-y-2">
            <h1 class="font-sora text-2xl font-semibold">Daftar</h1>
           <p class="text-sm text-gray-600">
    Lengkapi formulir ini untuk mendaftar. Akun Anda akan divalidasi terlebih dahulu sebelum dapat digunakan.
</p>

        </div>

        <div>
            <x-input-label for="name" class="font-semibold">Nama Lengkap</x-input-label>
            <x-text-input id="name" type="text" name="name" wire:model.defer="name" class="w-full rounded-none my-2" autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" class="mt-1" />
        </div>

        <div>
            <x-input-label for="email" class="font-semibold">Email</x-input-label>
            <x-text-input id="email" type="email" name="email" wire:model.defer="email" class="w-full rounded-none my-2" autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-1" />
        </div>

        <div>
            <x-input-label for="nim" class="font-semibold">NIM</x-input-label>
            <x-text-input id="nim" type="text" name="nim" wire:model.defer="nim" class="w-full rounded-none my-2" autocomplete="off" />
            <x-input-error :messages="$errors->get('nim')" class="mt-1" />
        </div>

        <div>
            <x-input-label for="password" class="font-semibold">Password</x-input-label>
            <x-text-input id="password" type="password" name="password" wire:model.defer="password" class="w-full rounded-none my-2" autocomplete="new-password" />
            <x-input-error :messages="$errors->get('password')" class="mt-1" />
        </div>

        <div>
            <x-input-label for="password_confirmation" class="font-semibold">Konfirmasi Password</x-input-label>
            <x-text-input id="password_confirmation" type="password" name="password_confirmation" wire:model.defer="password_confirmation" class="w-full rounded-none my-2" autocomplete="new-password" />
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-1" />
        </div>

        @if (session('message'))
            <div class="p-4 text-[13px] text-gray-800 bg-primary-green-400 bg-opacity-50">
                {{ session('message') }}
            </div>
        @endif

        <x-button type="submit" class="w-full">
            <div class="flex items-center gap-2">
                <span class="text-base">Daftar</span>
                <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 15 15"><path fill="#ffffff" d="M8.293 2.293a1 1 0 0 1 1.414 0l4.5 4.5a1 1 0 0 1 0 1.414l-4.5 4.5a1 1 0 0 1-1.414-1.414L11 8.5H1.5a1 1 0 0 1 0-2H11L8.293 3.707a1 1 0 0 1 0-1.414Z"/></svg>
            </div>
        </x-button>
        <div class="text-sm text-center">
           <p>Sudah punya akun? <a href="{{ route('login') }}" class="text-primary-green-800 tracking-tight hover:underline">Masuk</a></p>
        </div>
        @endif
    </div>

</form>
