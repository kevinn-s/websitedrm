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
    public string $image = '';

    public EventType $type;
    public string $category = '';
    public Carbon $publishedDate;
    public Carbon $date;
    public string $description = '';
    public ?string $time = null; // time as string (e.g., "14:00")
    public ?EventAccess $access;
    public string $hostUrl = '';
    public function mount(string $slug): void
    {
        $slug = Str::slug($slug);

        if (!$slug) {
            abort(404);
        }

        $event = Event::all()->firstWhere(fn($e) => Str::slug($e->title) === $slug);

        if (!$event) {
            abort(404);
        }

        $this->title = $event->title;
        $this->image = $event->image;
        $this->type = $event->type;
        $this->category = $event->category ?? '';
        $this->publishedDate = $event->published_at ? Carbon::make($event->published_at) : Carbon::now();
        $this->date = $event->type === EventType::Annual ? Carbon::make($event->annual_date) : Carbon::make($event->date);
        $this->description = $event->description ?? '';
        $this->time = $event->time;
        $this->access = $event->accesses;
    }
}; ?>

<div>
    <x-page-title 
        :title="$title" 
        :breadcrumbs="[
            ['label' => 'Kegiatan', 'url' => url('kegiatan')],
            ['label' => '', 'url' => ''],
        ]"
    />

    <div class="px-6 md:px-20 lg:px-36 pb-20 md:pb-32 py-6 md:py-10 bg-white">
        <div class="flex flex-col lg:flex-row gap-8 lg:gap-16">
            <!-- Image Section -->
            <div class="w-full lg:w-1/4 space-y-8">
                <div class="aspect-[225/350] bg-slate-600 overflow-hidden shadow-lg">
                    <img src="{{ asset('storage/' . $image) }}" alt="{{ $title }}" class="w-full h-full object-cover">
                </div>
                <div class="py-4">
                    <div class="text-lg font-semibold mb-4">Bagikan</div>
                    <div class="flex gap-4">
                        <!-- Copy Link -->
                        <button type="button" onclick="navigator.clipboard.writeText(window.location.href)" 
                                class="w-10 h-10 rounded-full border-[0.5px] border-gray-800 flex items-center justify-center hover:bg-gray-100 transition-colors">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 12h8a2 2 0 002-2v-8a2 2 0 00-2-2h-8a2 2 0 00-2 2v8a2 2 0 002 2z" />
                            </svg>
                        </button>
                        
                        <!-- Instagram -->
                        <a href="https://www.instagram.com/" target="_blank"
                           class="w-10 h-10 rounded-full border-[0.5px] border-gray-800 flex items-center justify-center hover:bg-gray-100 transition-colors">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/>
                            </svg>
                        </a>
                        
                        <!-- WhatsApp -->
                        <a href="https://wa.me/?text={{ urlencode($title . ' - ' . url()->current()) }}" target="_blank"
                           class="w-10 h-10 rounded-full border-[0.5px] border-gray-800 flex items-center justify-center hover:bg-gray-100 transition-colors">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946.003-6.556 5.338-11.891 11.893-11.891 3.181.001 6.167 1.24 8.413 3.488 2.245 2.248 3.481 5.236 3.48 8.414-.003 6.557-5.338 11.892-11.893 11.892-1.99-.001-3.951-.5-5.688-1.448l-6.305 1.654zm6.597-3.807c1.676.995 3.276 1.591 5.392 1.592 5.448 0 9.886-4.434 9.889-9.885.002-5.462-4.415-9.89-9.881-9.892-5.452 0-9.887 4.434-9.889 9.884-.001 2.225.651 3.891 1.746 5.634l-.999 3.648 3.742-.981zm11.387-5.464c-.074-.124-.272-.198-.57-.347-.297-.149-1.758-.868-2.031-.967-.272-.099-.47-.149-.669.149-.198.297-.768.967-.941 1.165-.173.198-.347.223-.644.074-.297-.149-1.255-.462-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.297-.347.446-.521.151-.172.2-.296.3-.495.099-.198.05-.372-.025-.521-.075-.148-.669-1.611-.916-2.206-.242-.579-.487-.501-.669-.51l-.57-.01c-.198 0-.52.074-.792.372s-1.04 1.016-1.04 2.479 1.065 2.876 1.213 3.074c.149.198 2.095 3.2 5.076 4.487.709.306 1.263.489 1.694.626.712.226 1.36.194 1.872.118.571-.085 1.758-.719 2.006-1.413.248-.695.248-1.29.173-1.414z"/>
                            </svg>
                        </a>
                        
                        <!-- LinkedIn -->
                        <a href="https://www.linkedin.com/sharing/share-offsite/?url={{ urlencode(url()->current()) }}" target="_blank"
                           class="w-10 h-10 rounded-full border-[0.5px] border-gray-800 flex items-center justify-center hover:bg-gray-100 transition-colors">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M19 0h-14c-2.761 0-5 2.239-5 5v14c0 2.761 2.239 5 5 5h14c2.762 0 5-2.239 5-5v-14c0-2.761-2.238-5-5-5zm-11 19h-3v-11h3v11zm-1.5-12.268c-.966 0-1.75-.79-1.75-1.764s.784-1.764 1.75-1.764 1.75.79 1.75 1.764-.783 1.764-1.75 1.764zm13.5 12.268h-3v-5.604c0-3.368-4-3.113-4 0v5.604h-3v-11h3v1.765c1.396-2.586 7-2.777 7 2.476v6.759z"/>
                            </svg>
                        </a>
                    </div>
                </div>
            </div>
        <div class="flex-1 space-y-8">
            <!-- When Section -->
            <div class="space-y-2">
                <h3 class="text-sm font-bold uppercase tracking-wide text-gray-900">TANGGAL</h3>
                <div class="text-base text-gray-700">
                    {{ $date->format('l, d F Y') }}
                    @if($time)
                        <br>{{ $time }}
                    @endif
                </div>
            </div>

            <!-- Where Section -->
            <div class="space-y-2">
                <h3 class="text-sm font-bold uppercase tracking-wide text-gray-900">LOKASI</h3>
                <div class="text-base text-gray-700">
                    @if($access)
                        {{ $access->location ?? 'Location TBA' }}
                        @if($access->type === EventAccessType::VIRTUAL || $access->type ===EventAccessType::HYBRID)
                            <br>(Livestream available)
                        @endif
                        @if($access->registration_link)
                            <br><a href="{{ $access->registration_link }}" target="_blank" class="text-blue-600 underline hover:text-blue-800">View on Google maps</a>
                        @endif
                    @else
                        Location TBA
                    @endif
                </div>
            </div>

         

            <!-- Event Type Section -->
            <div class="space-y-2">
                <h3 class="text-sm font-bold uppercase tracking-wide text-gray-900">TIPE KEGIATAN</h3>
                <div class="text-base text-gray-700">
                    <span class="underline">
                        @if($access)
                            {{ match($access->type) {
                                EventAccessType::PHYSICAL => 'Onsite',
                                EventAccessType::VIRTUAL => 'Online',
                                EventAccessType::HYBRID => 'Hybrid',
                                default => 'Conference'
                            } }}
                        @else
                            Conference
                        @endif
                    </span>
                </div>
            </div>

            <!-- Registration Button -->
            <div class="pt-4">
                <button type="button" class="bg-primary-green text-white font-semibold px-6 py-3 hover:opacity-90 transition-opacity">
                    Daftar 
                </button>
            </div>

            <!-- Description Section -->
            <div class="space-y-4 pt-6 border-t border-gray-200 w-9/12">
                <div class="prose prose-sm max-w-none text-gray-700 leading-relaxed">
                    {!! $description !!}
                </div>
            </div>
        </div>
    </div>
</div>