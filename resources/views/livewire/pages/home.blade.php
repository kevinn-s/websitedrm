<?php

use Livewire\Volt\Component;
use Livewire\Attributes\Layout;
use Carbon\Carbon;
use App\Models\Event;
use App\Enums\EventType;
use App\Enums\EventAccessType;

new #[Layout('layouts.app')] class extends Component {

    public $events = [];

    public function mount()
    {
        Event::where('type', EventType::Scheduled)
            ->orderBy('date', 'desc')
            ->take(4)
            ->get()
            ->map(function ($event) {
                array_push($this->events, [
                    'title' => Str::title($event['title']),
                    'date' => Carbon::parse($event['date'])
                        ->locale('id')
                        ->translatedFormat('l, d F Y'),
                    'type' => $event['accesses']->type->value,
                    'image' => $event['image'] ?? 'images/placeholder-487-300x200.png',
                    'location' =>
                        $event['accesses']->type->value === EventAccessType::PHYSICAL->value
                        ? $event['accesses']->address
                        : ($event['accesses']->type->value === EventAccessType::VIRTUAL->value
                            ? 'Meeting Online'
                            : $event['accesses']->address . ' | Meeting Online'),
                ]);
            });
    }
}; ?>

<div class="space-y-12 md:space-y-20">
<div class="banner h-[450px] sm:h-[500px] lg:h-[375.5px] w-full text-white"
     style="
        background-image: url('{{ asset('images/JWC-74-min-scaled.jpg') }}');
        background-blend-mode: multiply;
        background-color: rgba(0,0,0,0.5);
        background-position: center;
        background-repeat: no-repeat;
        background-size: cover;
     ">

        <div class="max-w-5xl w-full h-full mx-auto px-4 sm:px-6 lg:px-0">
            <div class="h-full max-w-2xl flex items-end pb-10 md:pb-0 md:items-center">
                <div class="max-w-lg">
                    <div class="max-w-lg">
                        <h1 class="font-sora text-3xl sm:text-4xl md:text-5xl font-bold tracking-tighter mb-4 sm:mb-5">
                            Alumni DRM <span class="block">Bergerak,Berdampak</span>
                        </h1>
                        <p class="font-noto text-base sm:text-lg leading-relaxed sm:leading-[22px] mb-6 sm:mb-8">
                            Sebagai komunitas profesional dan akademisi yang
                            Bergerak, Berdampak, kami menjadi wadah bagi
                            para lulusan DRM untuk terus terhubung.
                        </p>
                        <x-button variant="primary" href="{{ route('register') }}">Bergabung menjadi anggota</x-button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-0">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-10 lg:gap-20">
            <aside class="hidden md:block lg:col-span-5 bg-yellow-100 h-[280px] sm:h-[350px] lg:h-[420px] order-2 lg:order-1"></aside>

            <main class="lg:col-span-7 order-1 lg:order-2">
                <h1
                    class="font-sora text-2xl sm:text-3xl md:text-3xl font-bold tracking-tighter underline decoration-4 text-primary-green-900">
                    Dari Alumni, Untuk Alumni,<br>Oleh Alumni
                </h1>
                <p class="text-base sm:text-[19px] tracking-tight font-medium my-4 sm:my-5 w-full lg:w-11/12">
                    Komunitas Alumni DRM, yang lahir dari semangat kebersamaan para lulusan, terus tumbuh menjadi ruang
                    kolaborasi yang solid dan berdampak.
                </p>
                <div class="flex flex-wrap sm:flex-nowrap h-auto sm:h-52">
                    <div class="bg-primary-green-600 flex flex-col p-4 justify-center space-y-3 sm:space-y-4 w-full sm:w-1/3 lg:w-48 h-40 sm:h-full">
                         <svg xmlns="http://www.w3.org/2000/svg" width="36" height="36" class="sm:w-12 sm:h-12"
                                    viewBox="0 0 48 48" fill="#222026">
                                    <g fill="none" stroke="white" stroke-linejoin="round" stroke-width="4">
                                        <path stroke-linecap="round" d="M5 24h38" />
                                        <path
                                            d="M28 4h-8a2 2 0 0 0-2 2v8a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2V6a2 2 0 0 0-2-2ZM16 32H8a2 2 0 0 0-2 2v8a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2v-8a2 2 0 0 0-2-2Zm24 0h-8a2 2 0 0 0-2 2v8a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2v-8a2 2 0 0 0-2-2Z" />
                                        <path stroke-linecap="round" d="M24 24v-8m12 16v-8m-24 8v-8" />
                                    </g>
                                </svg>
                        <h1 class="text-lg sm:text-xl font-bold text-white font-inter leading-none">Connecting<br>Alumni</h1>
                    </div>
                    <div class="bg-primary-green-600 flex flex-col p-4 justify-center space-y-3 sm:space-y-4 w-full sm:w-1/3 lg:w-48 h-40 sm:h-full">
                          <svg width="36" height="36" class="sm:w-12 sm:h-12" xmlns="http://www.w3.org/2000/svg"
                                    viewBox="0 0 14 14">
                                    <path fill="white" fill-rule="evenodd"
                                        d="M9.724.625a.625.625 0 1 0-1.25 0v.8a.625.625 0 1 0 1.25 0zm3.157 1.711a.625.625 0 1 0-.884-.883l-.565.565a.625.625 0 1 0 .883.884zm-7.52-.883a.625.625 0 0 1 .883 0l.566.565a.625.625 0 1 1-.884.884l-.566-.566a.625.625 0 0 1 0-.883m3.05 4.749a1.39 1.39 0 0 1-.754-1.198A1.38 1.38 0 0 1 9.07 3.642a1.38 1.38 0 0 1 1.388 1.362c-.007.495-.31.977-.754 1.198a.63.63 0 0 0-.346.56v.582h-.602v-.583a.63.63 0 0 0-.346-.56m-2.004-1.19a2.63 2.63 0 0 1 2.651-2.62a2.63 2.63 0 0 1 2.651 2.62v.005a2.65 2.65 0 0 1-1.1 2.095v.658a.85.85 0 0 1-.846.824h-1.41a.85.85 0 0 1-.845-.824v-.658a2.65 2.65 0 0 1-1.1-2.095zm5.544-.003c0-.345.28-.625.625-.625h.8a.625.625 0 1 1 0 1.25h-.8a.625.625 0 0 1-.625-.625m-7.126-.625a.625.625 0 0 0 0 1.25h.8a.625.625 0 0 0 0-1.25zM4.173 9.36h-.002A4.21 4.21 0 0 0 .54 11.48A4.2 4.2 0 0 0 0 13.495A.5.5 0 0 0 .5 14h7.344a.5.5 0 0 0 .5-.505a4.2 4.2 0 0 0-.542-2.014a4.21 4.21 0 0 0-3.629-2.122m1.378-2.613c.36 0 .693-.108.971-.294A2.36 2.36 0 1 1 3.233 4.09a1.75 1.75 0 0 0 1.498 2.655z"
                                        clip-rule="evenodd" />
                                </svg>
                        <h1 class="text-lg sm:text-xl font-bold text-white font-inter leading-none">Make<br>Collaboration</h1>

                    </div>
                    <div class="bg-gray-200 flex flex-col p-4 justify-center space-y-3 sm:space-y-4 w-full sm:w-1/3 lg:w-48 h-40 sm:h-full">
                         <svg xmlns="http://www.w3.org/2000/svg" width="36" height="36" class="sm:w-12 sm:h-12"
                                    viewBox="0 0 1024 1024">
                                    <path fill="#016233"
                                        d="M992 1024H32q-13 0-22.5-9.5T0 992t9.5-22.5T32 960h32q27 0 45.5-19t18.5-45V64q0-26 19-45t45-19h640q27 0 45.5 19T896 64v832q0 27 19 45.5t45 18.5h32q13 0 22.5 9.5t9.5 22.5t-9.5 22.5t-22.5 9.5zM384 160q0-13-9.5-22.5T352 128h-64q-13 0-22.5 9.5T256 160v64q0 13 9.5 22.5T288 256h64q13 0 22.5-9.5T384 224v-64zm0 192q0-13-9.5-22.5T352 320h-64q-13 0-22.5 9.5T256 352v64q0 13 9.5 22.5T288 448h64q13 0 22.5-9.5T384 416v-64zm0 192q0-13-9.5-22.5T352 512h-64q-13 0-22.5 9.5T256 544v64q0 13 9.5 22.5T288 640h64q13 0 22.5-9.5T384 608v-64zm192-384q0-13-9.5-22.5T544 128h-64q-13 0-22.5 9.5T448 160v64q0 13 9.5 22.5T480 256h64q13 0 22.5-9.5T576 224v-64zm0 192q0-13-9.5-22.5T544 320h-64q-13 0-22.5 9.5T448 352v64q0 13 9.5 22.5T480 448h64q13 0 22.5-9.5T576 416v-64zm0 192q0-13-9.5-22.5T544 512h-64q-13 0-22.5 9.5T448 544v64q0 13 9.5 22.5T480 640h64q13 0 22.5-9.5T576 608v-64zm32 224H416q-13 0-22.5 9.5T384 800v128q0 13 9.5 22.5T416 960h192q13 0 22.5-9.5T640 928V800q0-13-9.5-22.5T608 768zm160-608q0-13-9.5-22.5T736 128h-64q-13 0-22.5 9.5T640 160v64q0 13 9.5 22.5T672 256h64q13 0 22.5-9.5T768 224v-64zm0 192q0-13-9.5-22.5T736 320h-64q-13 0-22.5 9.5T640 352v64q0 13 9.5 22.5T672 448h64q13 0 22.5-9.5T768 416v-64zm0 192q0-13-9.5-22.5T736 512h-64q-13 0-22.5 9.5T640 544v64q0 13 9.5 22.5T672 640h64q13 0 22.5-9.5T768 608v-64z" />
                                </svg>
                        <h1 class="text-lg sm:text-xl font-bold text-primary-green-600 font-inter leading-none">Self<br>Development
                        </h1>

                    </div>
                </div>
            </main>
        </div>
    </div>

    <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-0">
        <div class="text-xl sm:text-2xl md:text-2.5xl font-bold font-sora tracking-tighter text-primary-green-950">
            Kegiatan Mendatang
        </div>

        <div class="mt-6 mb-10 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 sm:gap-8">
            @foreach ($events as $event)
                <div class="w-full">
                    <div class="w-full aspect-[4/3]">
                        <img class="w-full h-full object-cover"
         src="{{ $event['image'] ? Storage::url($event['image']) : asset('images/placeholder-487-300x200.jpg') }}"
         alt=""
         onerror="this.src='{{ asset('images/placeholder-487-300x200.png') }}'">
                    </div>
                    <div class="flex my-3 space-x-2 items-start" x-data="{hovered: false}">
                        <a class="h-[3.5rem] select-none cursor-pointer block text-base sm:text-lg leading-tight font-bold text-gray-900 tracking-tight"
                            @mouseenter="hovered = true" @mouseleave="hovered = false">
                            <p class="line-clamp-2">{{ $event['title'] }}</p>
                        </a>

                        <button
                            class="select-none cursor-pointer group inline-flex items-center gap-2 rounded bg-transparent flex-shrink-0">
                            <svg class="w-5 h-5 sm:w-6 sm:h-6 transition-transform duration-300 ease-out transform group-hover:translate-x-2 motion-reduce:transition-none"
                                :class="hovered === true ? 'translate-x-2' : '' " xmlns="http://www.w3.org/2000/svg"
                                viewBox="0 0 512 512" aria-hidden="true" focusable="false">
                                <!-- rotate the shape -90deg around the center (256,256) so the arrow points right -->
                                <g transform="rotate(-90 256 256)">
                                    <path fill="currentColor"
                                        d="m367.997 338.75l-95.998 95.997V17.503h-32v417.242l-95.996-95.995l-22.627 22.627L256 496l134.624-134.623l-22.627-22.627z" />
                                </g>
                            </svg>
                        </button>
                    </div>
                    <div>
                        <div class="flex items-center gap-2 text-gray-700">
                            <span class="text-sm sm:text-sm+ font-semibold">
                                {{ $event['date'] }}
                            </span>
                        </div>
                        <div class="flex items-center gap-1.5 text-gray-900">
                            <svg  xmlns="http://www.w3.org/2000/svg" width="10" height="10"
                                viewBox="0 0 48 48">
                                <path fill="#000000"
                                    d="M40.596 4.173c2.022-.778 4.008 1.209 3.23 3.23L30.369 42.397c-.871 2.264-4.134 2.085-4.751-.262l-3.93-14.932a1.25 1.25 0 0 0-.89-.89l-14.933-3.93c-2.347-.618-2.526-3.88-.261-4.752L40.596 4.173Z" />
                            </svg>
                            <span class="text-sm sm:text-sm+ font-medium tracking-normal block">
                                <p class="line-clamp-1">{{ $event["location"] }}</p>
                            </span>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <x-button href="{{ route('kegiatan') }}">Lihat kegiatan lainnya</x-button>
    </div>
</div>
