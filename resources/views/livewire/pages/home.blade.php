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

<div class="space-y-20">
    <div class="banner h-[500px] sm:h-[500px] lg:h-[375.5px] w-screen text-white">
        <div class="max-w-5xl w-full h-full mx-auto">
            <div class="h-full max-w-2xl flex items-center ">
                <div class="max-w-lg">
                    <div class="max-w-lg">
                        <h1 class="font-sora text-4xl md:text-5xl font-bold tracking-tighter mb-5">
                            Alumni DRM <span class="block">Bergerak,Berdampak</span>
                        </h1>
                        <p class="font-noto text-lg leading-[22px] mb-8">
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

    <div class="max-w-5xl mx-auto">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-20">
            <aside class="lg:col-span-5 bg-yellow-100 h-[420px]">left</aside>

            <main class="lg:col-span-7">
                <h1
                    class="font-sora text-3xl md:text-3xl font-bold tracking-tighter underline decoration-4 text-primary-green-900">
                    Dari Alumni, Untuk Alumni,<br>Oleh Alumni
                </h1>
                <p class="text-[19px] tracking-tight font-medium my-5 w-11/12">
                    Komunitas Alumni DRM, yang lahir dari semangat kebersamaan para lulusan, terus tumbuh menjadi ruang
                    kolaborasi yang solid dan berdampak.
                </p>
                <div class="flex h-52">
                    <div class="bg-primary-green-600 flex-1 p-4">

                        <h1 class="text-xl font-bold text-white font-inter leading-none">Connecting Alumni</h1>
                    </div>
                    <div class="bg-primary-green-500 flex-1 p-4">
                        <h1 class="text-xl font-bold text-white font-inter leading-none">Connecting Alumni</h1>

                    </div>
                    <div class="bg-gray-200 flex-1 p-4">
                        <h1 class="text-xl font-bold text-primary-green-600 font-inter leading-none">Connecting Alumni
                        </h1>

                    </div>
                </div>
            </main>
        </div>
    </div>

    <div class="max-w-5xl mx-auto">
        <div class="text-2.5xl font-bold font-sora tracking-tighter text-primary-green-950">
            Kegiatan Mendatang
        </div>

        <div class="mt-6 mb-10 flex gap-8">
            @foreach ($events as $event)
                <div class="lg:w-1/4">
                    <div class="w-full aspect-[4/3]">
                        <img class="w-full h-full object-cover"
         src="{{ $event['image'] ? Storage::url($event['image']) : asset('images/placeholder-487-300x200.jpg') }}"
         alt=""
         onerror="this.src='{{ asset('images/placeholder-487-300x200.png') }}'">
                    </div>
                    <div class="flex my-3 space-x-2 items-start" x-data="{hovered: false}">
                        <a class="h-[3.5rem] select-none cursor-pointer block text-lg leading-tight font-bold text-gray-900 tracking-tight"
                            @mouseenter="hovered = true" @mouseleave="hovered = false">
                            <p class="line-clamp-2">{{ $event['title'] }}</p>
                        </a>

                        <button
                            class="select-none cursor-pointer group inline-flex items-center gap-2 rounded bg-transparent">
                            <svg class="w-6 h-6 transition-transform duration-300 ease-out transform group-hover:translate-x-2 motion-reduce:transition-none"
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
                            <span class="text-sm+ font-semibold">
                                {{ $event['date'] }}
                            </span>
                        </div>
                        <div class="flex items-center gap-1.5 text-gray-900">
                            <svg  xmlns="http://www.w3.org/2000/svg" width="10" height="10"
                                viewBox="0 0 48 48">
                                <path fill="#000000"
                                    d="M40.596 4.173c2.022-.778 4.008 1.209 3.23 3.23L30.369 42.397c-.871 2.264-4.134 2.085-4.751-.262l-3.93-14.932a1.25 1.25 0 0 0-.89-.89l-14.933-3.93c-2.347-.618-2.526-3.88-.261-4.752L40.596 4.173Z" />
                            </svg>
                            <span class="text-sm+ font-medium tracking-normal block">
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
