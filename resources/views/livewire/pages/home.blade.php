<?php

use Livewire\Volt\Component;
use Livewire\Attributes\Layout;
use Carbon\Carbon;
use App\Models\Event;
use App\Enums\EventType;

new #[Layout('layouts.app')] class extends Component {

    public $kegiatan;

    public $umur;

    public $angkatan;

    public function mount()
    {
        $this->umur = Carbon::now()->year - Carbon::parse("2024-01-01")->year;
        $this->angkatan = 15;
        $this->kegiatan = Event::where('type', EventType::Scheduled)
            ->orderBy('date', 'desc')
            ->take(2)
            ->get();
    }
}; ?>

<div>
    <div class="banner h-[500px] sm:h-[500px] lg:h-[375.5px] w-screen -mx-2 sm:-mx-8 lg:-mx-12 flex items-end">
        <div class="md:px-36 my-24 md:py-24">
            <div class="inline-block uppercase font-black text-white text-xl md:text-2xl py-2 md:py-4 px-8 bg-primary-green">
                SELAMAT DATANG
            </div>
            <br>
            <div class="inline-block font-semibold md:font-bold ml-8 px-2 py-0.5 text-sm md:text-[17px] bg-white">
                Di Website Asosiasi Alumni DRM Binus University.
            </div>
        </div>

    </div>

    <div class="-mx-4 sm:-mx-8 lg:-mx-12 pb-16 sm:pb-24 lg:pb-32 bg-white">
        <div class="px-6 sm:px-8 lg:px-36 pt-10 sm:pt-16 lg:pt-20 mb-10 sm:mb-16 lg:mb-20">
            <div class="flex flex-col lg:flex-row justify-between gap-8 lg:gap-12 mb-6">
                <div class="flex-1">
                    <div
                        class="font-source text-2xl sm:text-3xl lg:text-4xl font-extrabold text-gray-900 mb-4 sm:mb-6 ">
                        Alumni DRM<br> Bergerak, Berdampak
                    </div>
                    <div class="text-sm sm:text-base leading-relaxed">
                       Sebagai komunitas profesional dan akademisi yang Bergerak, Berdampak, kami menjadi wadah bagi para lulusan DRM untuk terus terhubung, berbagi pengetahuan dan keahlian, serta menciptakan kolaborasi yang inovatif.
                    </div>
                </div>
                <div class="w-full lg:w-[500px] flex items-center">
                    <div class="grid grid-cols-2 lg:grid-cols-4 gap-4 lg:gap-0">
                        <div class="lg:border-l border-gray-300 px-3 sm:px-5 pt-3">
                            <div>
                                <svg xmlns="http://www.w3.org/2000/svg" width="36" height="36" class="sm:w-12 sm:h-12"
                                    viewBox="0 0 48 48" fill="#222026">
                                    <g fill="none" stroke="#222026" stroke-linejoin="round" stroke-width="4">
                                        <path stroke-linecap="round" d="M5 24h38" />
                                        <path
                                            d="M28 4h-8a2 2 0 0 0-2 2v8a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2V6a2 2 0 0 0-2-2ZM16 32H8a2 2 0 0 0-2 2v8a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2v-8a2 2 0 0 0-2-2Zm24 0h-8a2 2 0 0 0-2 2v8a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2v-8a2 2 0 0 0-2-2Z" />
                                        <path stroke-linecap="round" d="M24 24v-8m12 16v-8m-24 8v-8" />
                                    </g>
                                </svg>
                            </div>
                            <div class="text-xs sm:text-sm font-semibold leading-tight my-2 sm:my-3">
                                Connecting alumni
                            </div>
                        </div>
                        <div class="lg:border-l border-gray-300 px-3 sm:px-5 pt-3">
                            <div>
                                <svg width="36" height="36" class="sm:w-12 sm:h-12" xmlns="http://www.w3.org/2000/svg"
                                    viewBox="0 0 14 14">
                                    <path fill="#000000" fill-rule="evenodd"
                                        d="M9.724.625a.625.625 0 1 0-1.25 0v.8a.625.625 0 1 0 1.25 0zm3.157 1.711a.625.625 0 1 0-.884-.883l-.565.565a.625.625 0 1 0 .883.884zm-7.52-.883a.625.625 0 0 1 .883 0l.566.565a.625.625 0 1 1-.884.884l-.566-.566a.625.625 0 0 1 0-.883m3.05 4.749a1.39 1.39 0 0 1-.754-1.198A1.38 1.38 0 0 1 9.07 3.642a1.38 1.38 0 0 1 1.388 1.362c-.007.495-.31.977-.754 1.198a.63.63 0 0 0-.346.56v.582h-.602v-.583a.63.63 0 0 0-.346-.56m-2.004-1.19a2.63 2.63 0 0 1 2.651-2.62a2.63 2.63 0 0 1 2.651 2.62v.005a2.65 2.65 0 0 1-1.1 2.095v.658a.85.85 0 0 1-.846.824h-1.41a.85.85 0 0 1-.845-.824v-.658a2.65 2.65 0 0 1-1.1-2.095zm5.544-.003c0-.345.28-.625.625-.625h.8a.625.625 0 1 1 0 1.25h-.8a.625.625 0 0 1-.625-.625m-7.126-.625a.625.625 0 0 0 0 1.25h.8a.625.625 0 0 0 0-1.25zM4.173 9.36h-.002A4.21 4.21 0 0 0 .54 11.48A4.2 4.2 0 0 0 0 13.495A.5.5 0 0 0 .5 14h7.344a.5.5 0 0 0 .5-.505a4.2 4.2 0 0 0-.542-2.014a4.21 4.21 0 0 0-3.629-2.122m1.378-2.613c.36 0 .693-.108.971-.294A2.36 2.36 0 1 1 3.233 4.09a1.75 1.75 0 0 0 1.498 2.655z"
                                        clip-rule="evenodd" />
                                </svg>
                            </div>
                            <div class="text-xs sm:text-sm font-semibold leading-tight my-2 sm:my-3">
                                Make collaboration
                            </div>
                        </div>

                        <div class="lg:border-l border-gray-300 px-3 sm:px-5 pt-3">
                            <div>
                                <svg xmlns="http://www.w3.org/2000/svg" width="36" height="36" class="sm:w-12 sm:h-12"
                                    viewBox="0 0 1024 1024">
                                    <path fill="#000000"
                                        d="M992 1024H32q-13 0-22.5-9.5T0 992t9.5-22.5T32 960h32q27 0 45.5-19t18.5-45V64q0-26 19-45t45-19h640q27 0 45.5 19T896 64v832q0 27 19 45.5t45 18.5h32q13 0 22.5 9.5t9.5 22.5t-9.5 22.5t-22.5 9.5zM384 160q0-13-9.5-22.5T352 128h-64q-13 0-22.5 9.5T256 160v64q0 13 9.5 22.5T288 256h64q13 0 22.5-9.5T384 224v-64zm0 192q0-13-9.5-22.5T352 320h-64q-13 0-22.5 9.5T256 352v64q0 13 9.5 22.5T288 448h64q13 0 22.5-9.5T384 416v-64zm0 192q0-13-9.5-22.5T352 512h-64q-13 0-22.5 9.5T256 544v64q0 13 9.5 22.5T288 640h64q13 0 22.5-9.5T384 608v-64zm192-384q0-13-9.5-22.5T544 128h-64q-13 0-22.5 9.5T448 160v64q0 13 9.5 22.5T480 256h64q13 0 22.5-9.5T576 224v-64zm0 192q0-13-9.5-22.5T544 320h-64q-13 0-22.5 9.5T448 352v64q0 13 9.5 22.5T480 448h64q13 0 22.5-9.5T576 416v-64zm0 192q0-13-9.5-22.5T544 512h-64q-13 0-22.5 9.5T448 544v64q0 13 9.5 22.5T480 640h64q13 0 22.5-9.5T576 608v-64zm32 224H416q-13 0-22.5 9.5T384 800v128q0 13 9.5 22.5T416 960h192q13 0 22.5-9.5T640 928V800q0-13-9.5-22.5T608 768zm160-608q0-13-9.5-22.5T736 128h-64q-13 0-22.5 9.5T640 160v64q0 13 9.5 22.5T672 256h64q13 0 22.5-9.5T768 224v-64zm0 192q0-13-9.5-22.5T736 320h-64q-13 0-22.5 9.5T640 352v64q0 13 9.5 22.5T672 448h64q13 0 22.5-9.5T768 416v-64zm0 192q0-13-9.5-22.5T736 512h-64q-13 0-22.5 9.5T640 544v64q0 13 9.5 22.5T672 640h64q13 0 22.5-9.5T768 608v-64z" />
                                </svg>
                            </div>
                            <div class="text-xs sm:text-sm font-semibold leading-tight my-2 sm:my-3">
                                Self<br>development
                            </div>
                        </div>
                        <div class="lg:border-x border-gray-300 px-3 sm:px-5 pt-3">
                            <div>
                                <svg xmlns="http://www.w3.org/2000/svg" width="36" height="36" class="sm:w-12 sm:h-12"
                                    viewBox="0 0 24 24">
                                    <path fill="#222026"
                                        d="m10.95 15.45l3.475-3.475q.3-.3.725-.3t.725.3q.3.3.3.725t-.3.725L11.65 17.65q-.3.3-.7.3t-.7-.3l-2.125-2.125q-.3-.3-.3-.725t.3-.725q.3-.3.725-.3t.725.3l1.375 1.375ZM5 22q-.825 0-1.413-.588T3 20V6q0-.825.588-1.413T5 4h1V3q0-.425.288-.713T7 2q.425 0 .713.288T8 3v1h8V3q0-.425.288-.713T17 2q.425 0 .713.288T18 3v1h1q.825 0 1.413.588T21 6v14q0 .825-.588 1.413T19 22H5Zm0-2h14V10H5v10ZM5 8h14V6H5v2Zm0 0V6v2Z" />
                                </svg>
                            </div>
                            <div class="text-xs sm:text-sm font-semibold leading-tight my-2 sm:my-3">
                                Events for alumni
                            </div>
                        </div>

                    </div>
                </div>
            </div>
            @guest
                <x-button variant="primary-reverse" href="{{ route('register') }}">Bergabung menjadi anggota</x-button>
            @endguest
        </div>

        <div class="block md:hidden">
            <img class="h-48 sm:h-64 lg:h-80 w-full object-cover" src="{{ asset("images/avatar.jpg") }}" alt="">

        </div>

        <div
            class="px-6 sm:px-8 lg:px-36 sm:my-16 lg:my-20 bg-primary-green w-full h-auto sm:h-64 lg:h-80 flex flex-col sm:flex-row items-center justify-between text-white py-8 sm:py-0">
            <div class="space-y-4 sm:space-y-6 lg:space-y-8 sm:mb-0">
                <div class="flex items-center">
                    <div class="px-2 font-moda text-3xl sm:text-4xl lg:text-5xl font-bold text-white bg-primary-gold">
                        150
                    </div>
                    <div class="font-sans text-2xl sm:text-3xl lg:text-4xl font-bold ml-2">
                        +
                    </div>
                    <div class="mx-4 text-base md:text-xl font-semibold tracking-wide font-sans">Anggota aktif</div>
                </div>

                <div class="flex items-center">
                    <div class="px-2 font-moda text-3xl sm:text-4xl lg:text-5xl font-bold text-white bg-primary-gold">
                        {{$umur}}
                    </div>
                    <div class="font-sans text-2xl sm:text-3xl lg:text-4xl font-bold ml-2">
                        +
                    </div>
                    <div class="mx-4 text-base md:text-xl font-semibold tracking-wide font-sans ">Tahun berdiri</div>
                </div>

                <div class="flex items-center">
                    <div class="px-2 font-moda text-3xl sm:text-4xl lg:text-5xl font-bold text-white bg-primary-gold">
                        {{ $angkatan }}
                    </div>
                    <div class="mx-4 text-base md:text-xl font-semibold tracking-wide font-sans">Angkatan</div>
                </div>

            </div>
            <div class="hidden md:block w-full sm:w-1/2">
                <img class="h-48 sm:h-64 lg:h-80 w-full object-cover" src="{{ asset("images/avatar.jpg") }}" alt="">
            </div>
        </div>

        <div class="px-6 sm:px-8 lg:px-36 my-8 sm:my-12 lg:my-16">
            <div class="mb-6 sm:mb-8 lg:mb-10">
                <h2 class="font-source text-2xl sm:text-3xl lg:text-4xl font-extrabold text-gray-900 mb-2">Kegiatan
                    Mendatang</h2>
            </div>

            <div class="flex flex-col lg:flex-row gap-4  sm:mx-0">
                @forelse($kegiatan as $event)
                    <a href="{{ route('kegiatan.show', $event) }}"
                        class="flex flex-col sm:flex-row bg-white border-0 sm:border border-gray-300 rounded-none sm:rounded w-full lg:w-1/2 shadow-sm overflow-hidden hover:shadow-md transition-shadow duration-300 cursor-pointer group">
                        <!-- Image Section -->
                        <img src="{{ $event->image ? asset('storage/' . $event->image) : asset('images/placeholder.png') }}"
                            alt="{{ $event->title }}" class="w-full sm:w-44 h-48 sm:h-52 object-cover">

                        <!-- Content Section -->
                        <div class="flex flex-col p-6 sm:p-5 flex-1">
                            <!-- Title -->
                            <h2
                                class="text-lg sm:text-xl font-semibold text-gray-900 leading-snug mb-2 sm:mb-3 group-hover:text-primary-green transition-colors">
                                {{ $event->title }}
                            </h2>

                            <!-- Date & Time -->
                            <div class="flex flex-wrap gap-2 sm:gap-4 mb-2 sm:mb-3">
                                @if($event->date)
                                    <div class="flex items-center gap-2 text-gray-600 text-xs sm:text-sm">
                                        <svg class="w-3 h-3 sm:w-3.5 sm:h-3.5 text-primary-green" viewBox="0 0 24 24"
                                            fill="currentColor">
                                            <rect x="3" y="4" width="18" height="18" rx="2" ry="2" stroke="currentColor"
                                                stroke-width="2" fill="none"></rect>
                                            <line x1="16" y1="2" x2="16" y2="6" stroke="currentColor" stroke-width="2"></line>
                                            <line x1="8" y1="2" x2="8" y2="6" stroke="currentColor" stroke-width="2"></line>
                                            <line x1="3" y1="10" x2="21" y2="10" stroke="currentColor" stroke-width="2"></line>
                                        </svg>
                                        <span>{{ \Carbon\Carbon::parse($event->date)->format('d M Y') }}</span>
                                    </div>
                                @endif

                                @if($event->time)
                                    <div class="flex items-center gap-2 text-gray-600 text-xs sm:text-sm">
                                        <svg class="w-3 h-3 sm:w-3.5 sm:h-3.5 text-primary-green" viewBox="0 0 24 24"
                                            fill="none" stroke="currentColor" stroke-width="2">
                                            <circle cx="12" cy="12" r="10"></circle>
                                            <polyline points="12 6 12 12 16 14"></polyline>
                                        </svg>
                                        <span>{{ $event->time }}</span>
                                    </div>
                                @endif
                            </div>

                            <!-- Description -->
                            <p class="text-gray-800 text-sm sm:text-base leading-relaxed line-clamp-3">
                                {{ strip_tags($event->description) }}
                            </p>
                        </div>
                    </a>
                @empty
                    <div class="w-full text-center py-10 px-6">
                        <p class="text-gray-500 text-base sm:text-lg">Belum ada kegiatan mendatang</p>
                    </div>
                @endforelse
            </div>

            <!-- View All Button -->
            <div class="mt-6 sm:mt-8 lg:mt-10">
                <a href="{{ route('kegiatan') }}"
                    class="inline-flex items-center gap-2 uppercase font-semibold underline hover:text-primary-green transition-colors text-sm sm:text-base">
                    <span>Lihat Semua Kegiatan</span>
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" viewBox="0 0 24 24" fill="none"
                        stroke="currentColor" stroke-width="2">
                        <path d="M5 12h14m-7-7l7 7-7 7" />
                    </svg>
                </a>
            </div>
        </div>
    </div>
</div>