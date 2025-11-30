<?php

use App\Enums\EventType;
use App\Enums\EventAccessType;

use App\Models\Event;
use App\Models\EventAccess;


use Livewire\Volt\Component;
use Livewire\Attributes\Layout;

use Illuminate\Support\Str;
use Carbon\Carbon;

new #[Layout('layouts.app')] class extends Component {
    public string $title = '';
    public string $imageUrl = '';

    public EventType $type;
    public string $typeLabel = '';
    public array $tags = [];
    public string $category = '';
    public Carbon $publishedDate;
    public Carbon $date;
    public string $description = '';
    public string $summary = '';
    public ?string $time = null;
    public ?string $timeRange = null;
    public ?EventAccess $access;
    public string $locationLabel = 'Lokasi belum ditentukan';
    public ?string $mapUrl = null;
    public ?string $meetingUrl = null;
    public ?string $meetingPasscode = null;
    public ?string $registrationLink = null;

    public function mount(string $slug): void
    {
        $slug = Str::slug($slug);

        if (! $slug) {
            abort(404);
        }

        $event = Event::query()
            ->with('accesses')
            ->get()
            ->firstWhere(fn ($e) => Str::slug($e->title) === $slug);

        if (! $event) {
            abort(404);
        }

        $this->title = $event->title;
        $this->tags = (array) ($event->tags ?? []);
        $this->type = $event->type;
        $this->typeLabel = match ($event->type) {
            EventType::Annual => 'Kegiatan Tahunan',
            EventType::Scheduled => 'Kegiatan Mendatang',
            default => 'Kegiatan',
        };
        $this->category = $event->category ?? '';
        $this->publishedDate = $event->published_at ? Carbon::make($event->published_at) : Carbon::now();
        $this->date = $event->type === EventType::Annual ? Carbon::make($event->annual_date) : Carbon::make($event->date);
        $this->description = $event->description ?? '';
        $this->summary = Str::limit(strip_tags($this->description), 200);
        $this->time = $event->time;
        $this->timeRange = $event->formattedTimeRange();
        $this->registrationLink = $event->registration_link;

        $imagePath = $event->image;
        if ($imagePath) {
            if (Str::startsWith($imagePath, ['http://', 'https://'])) {
                $this->imageUrl = $imagePath;
            } else {
                $this->imageUrl = asset('storage/' . ltrim($imagePath, '/'));
            }
        } else {
            $this->imageUrl = asset('images/avatar.jpg');
        }

        $this->access = $event->accesses;

        if ($this->access) {
            $this->locationLabel = $this->access->address
                ?: ($this->access->name ?? 'Lokasi menyusul');

            if ($this->access->type === EventAccessType::VIRTUAL) {
                $this->locationLabel = $this->access->name ?: 'Pertemuan daring';
            } elseif ($this->access->type === EventAccessType::HYBRID) {
                $physical = $this->access->address ?: 'Lokasi fisik menyusul';
                $this->locationLabel = $physical . ' + sesi daring';
            }

            $this->mapUrl = $this->access->map_url ?: null;
            $this->meetingUrl = $this->access->meeting_url ?: null;
            $this->meetingPasscode = $this->access->meeting_passcode ?: null;
        }
    }
}; ?>


<div class="bg-white">

    @php
        $currentUrl = url()->current();
        $accessTypeLabel = $access
            ? match ($access->type) {
                EventAccessType::PHYSICAL => 'Tatap muka',
                EventAccessType::VIRTUAL => 'Daring',
                EventAccessType::HYBRID => 'Hybrid',
                default => 'Format belum ditentukan'
            }
            : 'Format belum ditentukan';

        $calendarStart = $date->copy()->startOfDay();
        $calendarEnd = $date->copy()->addDay()->startOfDay();
        $calendarParams = array_filter([
            'action' => 'TEMPLATE',
            'text' => $title,
            'dates' => $calendarStart->format('Ymd') . '/' . $calendarEnd->format('Ymd'),
            'details' => $summary,
            'location' => $locationLabel,
        ], fn ($value) => $value !== null && $value !== '');
        $calendarUrl = 'https://calendar.google.com/calendar/render?' . http_build_query($calendarParams, '', '&', PHP_QUERY_RFC3986);
    @endphp
    <section class="relative overflow-hidden text-white">
        <img src="{{ asset('images/sl_022120_28320_29.webp') }}" alt="Ilustrasi latar acara"
    class="pointer-events-none absolute inset-0 h-full w-full object-cover opacity-30" loading="lazy" aria-hidden="true">
<div class="pointer-events-none absolute inset-0 bg-primary-green-500 bg-opacity-85" aria-hidden="true"></div>
        <div class="relative z-10 mx-auto flex max-w-5xl flex-col items-center gap-8 sm:gap-12 px-4 sm:px-6 lg:px-0 py-10 sm:py-16 lg:flex-row lg:items-center">
            <div class="w-full max-w-xs sm:max-w-sm flex-shrink-0">
                <div class="overflow-hidden border border-white/10">
                    <img src="{{ $imageUrl }}" alt="Poster {{ $title }}" class="h-full w-full object-cover" loading="lazy">
                </div>
            </div>

            <div class="flex w-full flex-col gap-4 sm:gap-6 text-center lg:text-left">
                <div class="flex flex-wrap items-center justify-center gap-2 text-[10px] sm:text-[11px] font-semibold uppercase tracking-[0.22em] text-primary-green-200 lg:justify-start">
                    <span class="border border-white/20 px-2 sm:px-3 py-1 text-white/80">{{ $typeLabel }}</span>
                    @if ($category)
                        <span class="border border-white/10 px-2 sm:px-3 py-1 text-white/60">{{ $category }}</span>
                    @endif
                </div>

                <h1 class="font-sora text-2xl sm:text-3xl md:text-4xl font-semibold leading-tight tracking-tight">{{ $title }}</h1>

                <div class="grid gap-4 text-left sm:grid-cols-2">
                    <div class="flex items-start gap-3">
                        <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 24 24" class="mt-1 text-primary-green-200">
                            <path fill="currentColor" d="M19 4h-1V2h-2v2H8V2H6v2H5a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6a2 2 0 0 0-2-2Zm0 14H5V10h14Zm0-10H5V6h14Z" />
                        </svg>
                        <div>
                            <p class="text-xs font-semibold tracking-wide text-white/60">Tanggal</p>
                            <p class="text-lg font-semibold text-white">{{ $date->translatedFormat('l, d F Y') }}</p>
                            @if ($timeRange)
                                <p class="text-sm font-medium text-white/60">{{ $timeRange }}</p>
                            @elseif ($time)
                                <p class="text-sm font-medium text-white/60">Mulai {{ $time }}</p>
                            @else
                                <p class="text-sm font-medium text-white/30">Waktu menyusul</p>
                            @endif
                        </div>
                    </div>

                    <div class="flex items-start gap-3">
                        <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 24 24" class="mt-1 text-primary-green-200">
                            <path fill="currentColor" d="M12 2A7 7 0 0 0 5 9c0 5.25 7 13 7 13s7-7.75 7-13a7 7 0 0 0-7-7Zm0 9.5A2.5 2.5 0 1 1 14.5 9A2.5 2.5 0 0 1 12 11.5Z" />
                        </svg>
                        <div>
                            <p class="text-xs font-semibold tracking-wide text-white/60">Lokasi</p>
                            <p class="text-lg font-semibold text-white">{{ $locationLabel }}</p>
                            @if ($mapUrl)
                                <a href="{{ $mapUrl }}" target="_blank" rel="noopener noreferrer" class="text-xs font-semibold text-primary-green-200 underline">
                                    Lihat lokasi
                                </a>
                            @endif
                        </div>
                    </div>
<!--
                    <div class="flex items-start gap-3">
                        <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 24 24" class="mt-1 text-primary-green-200">
                            <path fill="currentColor" d="M3 5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2v14l-5-3l-5 3l-5-3l-3 1.8V5Z" />
                        </svg>
                        <div>
                            <p class="text-xs font-semibold tracking-wide text-white/60">Format</p>
                            <p class="text-lg font-semibold text-white">{{ $accessTypeLabel }}</p>
                        </div>
                    </div>

                    <div class="flex items-start gap-3">
                        <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 24 24" class="mt-1 text-primary-green-200">
                            <path fill="currentColor" d="M12 3a9 9 0 1 0 9 9a9 9 0 0 0-9-9Zm0 4a1.25 1.25 0 1 1-1.25 1.25A1.25 1.25 0 0 1 12 7m1.75 10h-3.5v-1.5h1v-3h-1V11h2a1 1 0 0 1 1 1v3h.5Z" />
                        </svg>
                        <div>
                            <p class="text-xs font-semibold tracking-wide text-white/60">Dipublikasikan</p>
                            <p class="text-lg font-semibold text-white">{{ $publishedDate->translatedFormat('d F Y') }}</p>
                        </div>
                    </div> -->
                </div>

                <div class="flex flex-col sm:flex-row flex-wrap items-center justify-center gap-3 pt-2 lg:justify-start">
                    <a href="{{ $calendarUrl }}" target="_blank" rel="noopener noreferrer"
                        class="w-full sm:w-auto inline-flex items-center justify-center border border-white/30 px-4 sm:px-6 py-3 text-xs sm:text-sm font-semibold uppercase tracking-wide text-white transition hover:border-white/60 hover:bg-white/10">
                        + Tambah ke kalender
                    </a>
                    @if ($registrationLink)
                        <a href="{{ $registrationLink }}" target="_blank" rel="noopener noreferrer"
                            class="w-full sm:w-auto inline-flex items-center justify-center bg-primary-green-500 px-4 sm:px-6 py-3 text-xs sm:text-sm font-semibold uppercase tracking-wide text-white shadow-lg transition hover:bg-primary-green-800 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-white/60">
                            Daftar kegiatan
                        </a>
                    @endif
                </div>
            </div>
        </div>
    </section>
    <section class="bg-white py-8 sm:py-10">
        <div class="mx-auto max-w-5xl px-4 sm:px-6 lg:px-0">
            <h2 class="text-xl sm:text-2xl font-semibold text-primary-green-950">Tentang kegiatan</h2>
            <div class="mt-4 text-base sm:text-lg leading-relaxed text-gray-700">
                {!! $description !!}
            </div>
        </div>
    </section>



</div>
