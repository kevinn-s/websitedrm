<div class="antialiased font-inter">
    <div class="w-full h-[120px]"></div>
        <div class="mx-4 md:mx-32 my-4 md:my-6 pb-4 md:pb-6">
            <div class="pb-4 border-b border-gray-200 w-full">
                <div class="flex flex-col items-center text-primary-grey">
                    <img class="rounded-full w-28 h-28 mb-4" src="{{ $alumni->profile_photo_path }}"
                         onerror="this.src='{{ url('images/profile_avatar_placeholder_large.png') }}'">
                    </img>
                    <div class="font-bold text-xl text-black">{{ $alumni->name }}</div>
                        <div>
                            @if ($alumni->education->legitimation_date)
                                Lulusan {{ \Carbon\Carbon::parse($alumni->education->legitimation_date)->format('Y') }}
                            @else
                                -
                            @endif
                        </div>
                    </div>
                    <div class="grid grid-rows-2 justify-center gap-4 md:gap-0 md:grid-cols-3 items-center">
                        <div class="hidden md:block"></div>
                        <div class="md:text-center">
                            @if ($alumni->education->graduation_batch)
                                W{{ $alumni->education->graduation_batch }}
                            @else
                                <span class="hidden md:inline">Belum mencantumkan angkatan</span>
                                <span class="md:hidden">-</span>
                            @endif
                        </div>
                           <div class="justify-self-end  flex md:flex-none w-full md:w-auto justify-center ">
                            @can('update', $alumni)
                                <button
                                    class="inline-flex items-center px-4 py-2 bg-[#03563D] text-white text-sm font-medium hover:bg-[#024a33] transition-colors duration-200">
                                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z">
                                        </path>
                                    </svg>
                                    <a href="{{ route('alumni.edit', $alumni->id) }}">Edit Profile</a>
                                </button>
                            @endcan
                        </div>
                    </div>
                 
                    </div>

                    <div class="my-8 flex flex-col gap-4">
                        <div class="text-lg font-bold">Tentang</div>
                        <div class="grid grid-cols-1 text-primary-grey text-sm md:text-[14.5px]">
                            <div class="py-4 px-4 md:px-8 flex border border-gray-300">
                                <div class="w-[40%] font-semibold">Email</div>
                                <div class="{{ !$alumni->private_email ? 'italic text-gray-500' : 'w-[60%]' }}">
                                    @if ($alumni->private_email)
                                        {{ $alumni->private_email }}
                                    @else
                                        <span class="hidden md:inline">Belum mencantumkan email</span>
                                            <span class="md:hidden">-</span>
                                    @endif
                                </div>
                            </div>
                            <div class="py-4 px-4 md:px-8 flex border border-gray-300 border-t-0">
                                <div class="w-[40%] font-semibold">Nomor Telepon</div>
                                <div class="{{ !$alumni->phone ? 'italic text-gray-500' : 'w-[60%]' }}">
                                    @if ($alumni->phone)
                                        {{ $alumni->phone }}
                                    @else
                                       <span class="hidden md:inline">Belum mencantumkan nomor telepon</span>
                                        <span class="md:hidden">-</span>
                                    @endif
                                </div>
                            </div>
                            <div class="py-4 px-4 md:px-8 flex border border-gray-300 border-t-0">
                                <div class="w-[40%] font-semibold">Pekerjaan</div>
                                <div class="{{ !$alumni->profession->profession ? 'italic text-gray-500' : 'w-[60%]' }}">
                                    @if ($alumni->profession->profession)
                                        {{ $alumni->profession->profession }}
                                    @else
                                         <span class="hidden md:inline">Belum mencantumkan pekerjaan</span>
                                        <span class="md:hidden">-</span>
                                    @endif
                                </div>
                            </div>
                            <div class="py-4 px-4 md:px-8 flex border border-gray-300 border-t-0">
                                <div class="w-[40%] font-semibold">Nama Perusahaan</div>
                                <div class="{{ !$alumni->profession->company ? 'italic text-gray-500' : 'w-[60%]' }}">
                                    @if ($alumni->profession->company)
                                        {{ $alumni->profession->company }}
                                    @else
                                         <span class="hidden md:inline">Belum mencantumkan nama perusahaan</span>
                                        <span class="md:hidden">-</span>
                                    @endif
                                </div>
                            </div>
                            <div class="py-4 px-4 md:px-8 flex border border-gray-300 border-t-0">
                                <div class="w-[40%] font-semibold">Domisili Kerja</div>
                                <!-- <div class="{{ !$alumni->profession->city && !$alumni->profession->province ? 'italic text-gray-500' : 'w-[60%]' }}">
                                    @if ($alumni->profession->city && $alumni->profession->province)
                                        {{ 
                                            $alumni->profession->city. ','.$alumni->profession->province
                                        }}
                                    @else
                                         <span class="hidden md:inline">Belum mencantumkan domisili kerja</span>
                                        <span class="md:hidden">-</span>
                                    @endif
                                </div> -->
                                <div class="{{ !$alumni->profession->province ? 'italic text-gray-500' : 'w-[60%]' }}">
                                    @if ($alumni->profession->province)
                                        {{ 
                                            $alumni->profession->province. ','.'Indonesia'
                                        }}
                                    @else
                                         <span class="hidden md:inline">Belum mencantumkan domisili kerja</span>
                                        <span class="md:hidden">-</span>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="my-8 flex flex-col gap-4">
                        <div class="text-lg font-bold">Karya Ilmiah</div>
                        <div class="grid grid-cols-1 gap-4 text-primary-grey text-xs md:text-[14.5px]">
                            @forelse ($alumni->research as $research)
                                <div class="py-3 md:py-4 px-8 border border-gray-200">
                                    <div class="font-semibold text-sm md:text-base mb-2 md:mb-0">
                                        {{ $research->title ?? 'Judul tidak tersedia' }}
                                    </div>
                                    <div>
                                        {{ $research->type ? $research->type . ' - ' : '' }}Dipublikasikan di {{ $research->publisher ?? 'Penerbit tidak diketahui' }},
                                        {{ $research->publication_year ?? 'Tahun tidak diketahui' }}
                                    </div>
                                    @if($research->publication_link)
                                        <div class="mt-2">
                                            <a href="{{ $research->publication_link }}" target="_blank" 
                                            class="text-blue-600 hover:text-blue-800 underline">
                                                Lihat Publikasi
                                            </a>
                                        </div>
                                    @endif
                                </div>
                            @empty
                                <div class="italic text-gray-500 text-base">
                                    Belum mencantumkan karya ilmiah
                                </div>
                            @endforelse
                        </div>
                    </div>

                    <div class="my-8 flex flex-col gap-4">
                        <div class="text-lg font-bold">Kompetensi</div>
                        <div class="flex flex-wrap gap-2">
                            @if($alumni->competency && count($alumni->competency) > 0)
                                @foreach ($alumni->competency as $competency)
                                    <span
                                        class="inline-flex items-center px-2 md:px-3 py-1 md:py-1.5 rounded-full text-xs md:text-sm font-medium bg-blue-100 text-blue-800 border border-blue-200 hover:bg-blue-200 transition-colors duration-200">
                                        {{ $competency }}
                                    </span>
                                @endforeach
                            @else
                                <div class="italic text-gray-500">
                                    Belum mencantumkan kompetensi
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
@endsection