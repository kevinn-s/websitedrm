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


<div class="px-24 w-9/12  py-10 bg-white font-inter">
    <div class="flex items-start gap-8">

        <div class="w-1/2 overflow-hidden gap-8">
            <div class="aspect-[225/350] bg-slate-600 ">
                <img src="{{ asset('storage/' . $image) }}" alt="Event Image" class="w-full h-full object-cover">
            </div>
            <div class="my-8 py-8 w-full border-t-gray-300 border-t-2">
               <div class="text-2xl font-semibold">Share</div>
            </div>
        </div>

        <div class="w-full">
            <div class="text-2xl font-bold my-4" x-text="'{{ $title }}'"></div>
            <div class="text-lg font-semibold py-2 w-full border-b-gray-300 border-b-[0.5px]">Open Day Events</div>
            <div class="text-[15px] text-gray-500 py-2 w-ful">Published on:
                {{ Carbon::parse($publishedDate)->format('d M Y') }}
            </div>

            <div class="my-4 font-semibold space-y-3">
                @php
                    $labelWidth = $type === EventType::Annual->value ? 'w-[50%]' : 'w-[40%]';
                    $contentWidth = $type === EventType::Annual->value ? 'w-[50%]' : 'w-[60%]';
                @endphp
                <div class="flex">
                    <div class="{{ $labelWidth }} flex">
                        <span class="mr-3">
                            <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 24 24">
                                <g fill="none">
                                    <path fill="#304850"
                                        d="M2 9c0-1.886 0-2.828.586-3.414C3.172 5 4.114 5 6 5h12c1.886 0 2.828 0 3.414.586C22 6.172 22 7.114 22 9c0 .471 0 .707-.146.854C21.707 10 21.47 10 21 10H3c-.471 0-.707 0-.854-.146C2 9.707 2 9.47 2 9m0 9c0 1.886 0 2.828.586 3.414C3.172 22 4.114 22 6 22h12c1.886 0 2.828 0 3.414-.586C22 20.828 22 19.886 22 18v-5c0-.471 0-.707-.146-.854C21.707 12 21.47 12 21 12H3c-.471 0-.707 0-.854.146C2 12.293 2 12.53 2 13z" />
                                    <path stroke="#304850" stroke-linecap="round" stroke-width="2" d="M7 3v3m10-3v3" />
                                </g>
                            </svg>
                        </span>
                        <span>
                            @if($type === EventType::Annual->value)
                                Pelaksanaan Berikutnya:
                            @else
                                Date :
                            @endif
                        </span>
                    </div>
                    <div class="{{ $contentWidth }} ">
                        <span>
                            @if($type === EventType::Annual->value)
                                {{ $date ?? '' }}
                            @else
                                {{ $date ? $date->format('l j F Y') : '' }}
                            @endif
                        </span>
                    </div>
                </div>
                @if($type === EventType::Scheduled)
                    <div class="flex">
                        <div class="{{ $labelWidth }} flex">
                            <span class="mr-3">
                                <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 717 717">
                                    <path fill="#304850"
                                        d="M358 717C160 717 0 557 0 359S160 0 358 0s359 161 359 359s-161 358-359 358zm0-628C210 89 90 211 90 359s120 268 268 268s270-120 270-268S506 89 358 89zm97 407l-127-93c-9-7-18-22-18-34V166c0-11 10-20 22-20h42c11 0 20 9 20 20v160c0 12 9 27 18 34l93 67c9 7 11 21 4 30l-25 34c-7 9-20 11-29 5z" />
                                </svg>
                            </span>
                            <span>Time:</span>
                        </div>
                        <div class="{{ $contentWidth }}">
                            <span>{{ $time ?? '' }}</span>
                        </div>

                    </div>
                @endif
                <div class="flex">
                    <div class="{{ $labelWidth }} flex">
                        <span class="mr-3">
                            <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 20 20">
                                <path fill="#304850"
                                    d="M10 20S3 10.87 3 7a7 7 0 1 1 14 0c0 3.87-7 13-7 13zm0-11a2 2 0 1 0 0-4a2 2 0 0 0 0 4z" />
                            </svg>
                        </span>
                        <span>
                            Lokasi:
                        </span>
                    </div>

                    <div class="{{ $contentWidth }}">
                        {{ match ($access->type) {
                            EventAccessType::PHYSICAL => 'Onsite',
                            EventAccessType::VIRTUAL => 'Virtual',
                            EventAccessType::HYBRID => 'Hybrid',
                            default => 'Unknown',
                        } }}
                    </div>
                </div>

                <div class="flex">
                    <div class="{{ $labelWidth }} flex">
                        <span class="mr-3">
                            <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 20 20">
                                <path fill="#304850"
                                    d="M10 20S3 10.87 3 7a7 7 0 1 1 14 0c0 3.87-7 13-7 13zm0-11a2 2 0 1 0 0-4a2 2 0 0 0 0 4z" />
                            </svg>
                        </span>
                        <span>
                            Alamat:
                        </span>
                    </div>

                    <div class="{{ $contentWidth }}">
                        {!! match ($access->type) {
                        EventAccessType::PHYSICAL => e($access->address),
                        EventAccessType::VIRTUAL => '<a href="' . e($access->meeting_url) . '">Klik untuk join virtual meeting</a>',
                        EventAccessType::HYBRID => '<strong>Lokasi:</strong> ' . e($access->address) . '<br><strong>Virtual:</strong> <a href="' . e($access->meeting_url) . '">Klik untuk join virtual meeting</a>',
                        default => 'Unknown',
                    } !!}
                    </div>
                </div>

            </div>
            <div class="my-7">
                <button
                    class="border border-gray-400 font-semibold border-b-4 border-b-primary-green bg-white px-4 py-1 text-primary-green hover:bg-gray-100 hover:border-gray-500 transition-colors">
                    Bergabung dalam kegiatan
                </button>
            </div>
            <div class="prose max-w-none">
                 <!-- {!! $description !!} -->
                <div class=" font-bold pb-2 text-black">
                    PIONEERING THE NEXT ERA OF BEAUTY: WHERE INNOVATION AND TRANSFORMATION CONVERGE
                </div>
                <div class="text-[15px] font-semibold text-gray-900">
                    Cosmobeauté Indonesia elevates its legacy by expanding its platform to celebrate innovation and
                    transformation in the beauty industry. This highly anticipated trade exhibition will be held on 9 –
                    11
                    October 2025 at Hall 5,6,7,8 - Indonesia Convention Exhibition (ICE), BSD City, Indonesia.
                    Cosmobeauté
                    Indonesia showcases groundbreaking advancements, providing exhibitors and attendees with an
                    unparalleled
                    opportunity to engage with the next wave of industry-defining products and services. Designed as
                    both a
                    business hub and a collaborative space, the exhibition invites key players and professionals to
                    experience the convergence of creativity, technology, and transformation, shaping the future of
                    beauty
                    in a rapidly evolving global landscape.
                </div>
            </div>
        </div>


    </div>
</div>