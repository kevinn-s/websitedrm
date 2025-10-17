

<div class="bg-white rounded-lg p-6 flex flex-col w-80">
    <!-- Profile Photo -->
    <div class="w-32 h-32 rounded-full overflow-hidden mb-6">
    <img src="{{ $avatar ?? asset('images/placeholder.png') }}" class="w-full h-full object-cover" />
    </div>

    <!-- Card body -->
    <div class="flex flex-col gap-2 w-full">
        <div>
   <div class="text-[#03563D] text-[15px] font-bold leading-none">
            {{ $alumni->education?->graduation_batch ? 'W' . $alumni->education->graduation_batch : '-' }}
        </div>

        <!-- Title -->
        <div class="text-lg font-semibold mb-3 flex justify-between items-center">
            <span>{{ $alumni->name }}</span>
            <a href="{{ route('alumni.profile', $alumni) }}">

                            <svg xmlns="http://www.w3.org/2000/svg" class="mr-4" width="22" height="22" viewBox="0 0 15 15"><path fill="#0d731f" d="M8.293 2.293a1 1 0 0 1 1.414 0l4.5 4.5a1 1 0 0 1 0 1.414l-4.5 4.5a1 1 0 0 1-1.414-1.414L11 8.5H1.5a1 1 0 0 1 0-2H11L8.293 3.707a1 1 0 0 1 0-1.414Z"/></svg>

            </a>
</div>
        </div>
      

        <!-- Content -->
        <div class="text-sm border-t border-[#e2e7e9] pt-2 leading-6 ">
            <!-- nama perusahaan -->
            <p class="{{ $alumni->profession?->company ? 'text-gray-800 tracking-tight text-[15px] font-bold' : 'text-gray-400 italic' }}">
                {{ $alumni->profession?->company ?? 'Belum mencantumkan perusahaan' }}
            </p>
<p class="{{ $alumni->profession?->profession ? 'text-gray-500 font-medium' : 'text-gray-400 italic' }}">
               {{ $alumni->profession?->profession ?: 'Belum mencantumkan posisi jabatan' }}

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