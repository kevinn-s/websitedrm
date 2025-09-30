<x-authentication-layout>
             <div class="text-xl font-semibold text-gray-800 mb-4 ">
            Daftar Menjadi Anggota Asosiasi Alumni DRM Binus University
        </div>

        <div class="text-sm text-gray-600 mb-6">
            Lengkapi data Anda. Akun yang baru terdaftar akan diverifikasi terlebih dahulu oleh admin sebelum dapat digunakan.
        </div>
    <!-- Form -->
    <form method="POST" action="{{ route('register') }}">
        @csrf
        <div class="space-y-4">
            <div>
                <x-label for="name">{{ __('Nama Lengkap') }} <span class="text-red-500">*</span></x-label>
                <x-input id="name" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
            </div>

            <div>
                <x-label for="email">{{ __('Email') }} <span class="text-red-500">*</span></x-label>
                <x-input id="email" type="email" name="email" :value="old('email')" required />
            </div>

            <div>
                <x-label for="name">{{ __('NIM') }} <span class="text-red-500">*</span></x-label>
                <x-input id="nim" type="text" name="nim" :value="old('nim')" required autofocus autocomplete="nim" />
            </div>

            <div>
                <x-label for="password" value="{{ __('Password') }}" />
                <x-input id="password" type="password" name="password" required autocomplete="new-password" />
            </div>

            <div>
                <x-label for="password_confirmation" value="{{ __('Confirm Password') }}" />
                <x-input id="password_confirmation" type="password" name="password_confirmation" required autocomplete="new-password" />
            </div>
        </div>
        <div class="flex items-center justify-between mt-6">
            <div class="mr-1">
              
            </div>
            <x-button class="bg-primary-green rounded-none w-full">
                {{ __('Daftar') }}
            </x-button>                
        </div>
            <!-- @if (Laravel\Jetstream\Jetstream::hasTermsAndPrivacyPolicyFeature())
                <div class="mt-6">
                    <label class="flex items-start">
                        <input type="checkbox" class="form-checkbox mt-1" name="terms" id="terms" />
                        <span class="text-sm ml-2">
                            {!! __('I agree to the :terms_of_service and :privacy_policy', [
                                'terms_of_service' => '<a target="_blank" href="'.route('terms.show').'" class="text-sm underline hover:no-underline">'.__('Terms of Service').'</a>',
                                'privacy_policy' => '<a target="_blank" href="'.route('policy.show').'" class="text-sm underline hover:no-underline">'.__('Privacy Policy').'</a>',
                            ]) !!}                        
                        </span>
                    </label>
                </div>
            @endif         -->
    </form>
    <x-validation-errors class="mt-4" />  
    <!-- Footer -->
    <div class="pt-5 mt-6 border-t border-gray-100 dark:border-gray-700/60">
        <div class="text-sm">
            {{ __('Sudah memiliki akun?') }} <a class="font-medium text-violet-500 hover:text-violet-600 dark:hover:text-violet-400" href="{{ route('login') }}">{{ __('Masuk') }}</a>
        </div>
    </div>
</x-authentication-layout>
