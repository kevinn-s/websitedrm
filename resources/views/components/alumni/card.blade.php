
@props([
    "alumni" => null
])

<div class="bg-white rounded-lg p-6 flex flex-col w-80">
    <!-- Profile Photo -->
    <div class="w-32 h-32 rounded-full overflow-hidden mb-4">
        <img src="{{ $alumni->profile_photo_path ?? url('/images/placeholder.png') }}"
        
            class="w-full h-full object-cover"
            onerror="this.src={{ url('images/placeholder.webp') }}">
    </div>

    <!-- Card body -->
    <div class="flex flex-col gap-2 w-full">
        <!-- Eyebrow -->
        <div class="text-[#03563D] font-bold">
            {{ $alumni->education?->graduation_batch ? 'B' . $alumni->education->graduation_batch : 'Alumni' }}
        </div>

        <!-- Title -->
        <h2 class="text-xl font-semibold mb-3 flex justify-between">
            <a href="{{ route('alumni.profile', ['alumni' => $alumni->id]) }}" class="">
                <span>{{ $alumni->name }}</span>
            </a>
            <a href="{{ route('alumni.profile', ['alumni' => $alumni->id]) }}" class="arrow-icon"></a>
        </h2>

        <!-- Content -->
        <div class="text-sm border-t border-[#e2e7e9] pt-2 leading-6 ">
            <!-- nama perusahaan -->
            <p class="{{ $alumni->profession?->company ? 'text-gray tracking-tight text-[15px] font-bold' : 'text-gray-400 italic' }}">
                {{ $alumni->profession?->company ?? 'Belum mencantumkan perusahaan' }}
            </p>
            <!-- posisi / jabatan -->
            <p class="{{ $alumni->profession?->profession ? 'text-gray-800 font-medium' : 'text-gray-400 italic' }}">
                {{ $alumni->profession?->profession ?? 'Belum mencantumkan posisi jabatan' }}
            </p>
        </div>

        <!-- Meta (contacts) -->
        <div class="text-sm text-gray-700 mt-4 space-y-2">
            <!-- Phone -->
            <div class="flex gap-2 items-center">
                <svg class="text-gray-500 w-4 h-4" xmlns="http://www.w3.org/2000/svg"
                    fill="currentColor" viewBox="0 0 16 16">
                    <path d="M4 1h1l1.5 5L5 7c0 2 2 4 4 4l1-1.5 5 1.5v1a3 3 0 0 1-3 3C5 15 1 10 1 4a3 3 0 0 1 3-3Z" />
                </svg>
                <p class="{{ $alumni->phone_number ? 'leading-normal' : 'pb-1' }}">
                    {{ $alumni->phone_number ?? '-' }}
                </p>
            </div>

            <!-- Email -->
            <div class="flex gap-2">
                <svg class="text-gray-500 w-4 h-4" xmlns="http://www.w3.org/2000/svg"
                    fill="currentColor" viewBox="0 0 16 16">
                    <path d="M0 2v12h16V2H0Zm2 2.023V4h12v.023L8 7.356 2 4.023ZM2 6.31l6 3.333 6-3.333V12H2V6.31Z" />
                </svg>
                <a href="mailto:{{ $alumni->email }}" class="text-blue-600 hover:underline">
                    <span>{{ $alumni->email }}</span>
                </a>
            </div>
        </div>
    </div>
</div>