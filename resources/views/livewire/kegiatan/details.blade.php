<x-app-layout>
    <div class="px-36 font-source bg-white">
        <div class="w-9/12">
            <!-- Title Section -->
            <div class="py-4">
                <div class="text-3xl font-bold text-primary-black">
                    {{ $event->title }}
                </div>
            </div>

            <!-- Header Section with Conditional Content -->
            <div class="space-y-2 w-8/12">
                <div class="text-xl font-bold border-b-[0.5px] border-gray-400 pb-2">
                    {{ $event->category ?? 'Open day events' }}
                </div>
                
                @if($eventType === 'scheduled')
                    <div>Published on: {{ $event->published_date ? $event->published_date->format('d F Y') : '' }}</div>
                @endif
            </div>

            <!-- Event Details Section -->
            <div class="my-6 space-y-4 w-10/12 text-lg font-semibold">
                @php
                    $labelWidth = $eventType === 'annual' ? 'w-[40%]' : 'w-[30%]';
                    $contentWidth = $eventType === 'annual' ? 'w-[60%]' : 'w-[70%]';
                @endphp

                <!-- Date Row -->
                <div class="flex items-center w-full">
                    <div class="{{ $labelWidth }} flex items-center">
                        <span class="mr-2">
                            <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 24 24">
                                <g fill="none">
                                    <path fill="#304850"
                                        d="M2 9c0-1.886 0-2.828.586-3.414C3.172 5 4.114 5 6 5h12c1.886 0 2.828 0 3.414.586C22 6.172 22 7.114 22 9c0 .471 0 .707-.146.854C21.707 10 21.47 10 21 10H3c-.471 0-.707 0-.854-.146C2 9.707 2 9.47 2 9m0 9c0 1.886 0 2.828.586 3.414C3.172 22 4.114 22 6 22h12c1.886 0 2.828 0 3.414-.586C22 20.828 22 19.886 22 18v-5c0-.471 0-.707-.146-.854C21.707 12 21.47 12 21 12H3c-.471 0-.707 0-.854.146C2 12.293 2 12.53 2 13z" />
                                    <path stroke="#304850" stroke-linecap="round" stroke-width="2" d="M7 3v3m10-3v3" />
                                </g>
                            </svg>
                        </span>
                        <span>
                            @if($eventType === 'annual')
                                Pelaksanaan Berikutnya:
                            @else
                                Date:
                            @endif
                        </span>
                    </div>
                    <div class="{{ $contentWidth }}">
                        <span>
                            @if($eventType === 'annual')
                                {{ $event->annual_date ?? 'October 2025' }}
                            @else
                                {{ $event->event_date ? $event->event_date->format('l j F Y') : '' }}
                            @endif
                        </span>
                    </div>
                </div>

                <!-- Time Row (Only for Scheduled Events) -->
                @if($eventType === 'scheduled')
                    <div class="flex items-center w-full">
                        <div class="{{ $labelWidth }} flex items-center">
                            <span class="mr-2">
                                <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 717 717">
                                    <path fill="#304850"
                                        d="M358 717C160 717 0 557 0 359S160 0 358 0s359 161 359 359s-161 358-359 358zm0-628C210 89 90 211 90 359s120 268 268 268s270-120 270-268S506 89 358 89zm97 407l-127-93c-9-7-18-22-18-34V166c0-11 10-20 22-20h42c11 0 20 9 20 20v160c0 12 9 27 18 34l93 67c9 7 11 21 4 30l-25 34c-7 9-20 11-29 5z" />
                                </svg>
                            </span>
                            <span>Time:</span>
                        </div>
                        <div class="{{ $contentWidth }}">
                            <span>{{ $event->event_time ?? '' }}</span>
                        </div>
                    </div>
                @endif

                <!-- Host Row (Only for Scheduled Events) -->
                @if($eventType === 'scheduled')
                    <div class="flex items-center w-full">
                        <div class="{{ $labelWidth }} flex items-center">
                            <span class="mr-2">
                                <svg xmlns="http://www.w3.org/2000/svg" width="22" height="24" viewBox="0 0 512 512">
                                    <path fill="#304850" fill-rule="evenodd"
                                        d="m128 183.466l21.334-2.133L362.667 128Q384 192 384 256t-21.333 128L244.81 354.536c-3.844 28.68-28.41 50.797-58.143 50.797c-31.2 0-56.713-24.356-58.56-55.093l-.107-3.573zm273.931 123.732l62.36 14.397l-9.598 41.573l-62.36-14.397zM170.667 336v10.667c0 8.836 7.163 16 16 16c8.1 0 14.794-6.02 15.854-13.83l.146-2.17V344zm-64-150.4v140.8l-64-6.4V192zm362.667 49.067v42.666h-64v-42.666zm-14.641-85.835l9.598 41.573l-62.36 14.397l-9.598-41.573z" />
                                </svg>
                            </span>
                            <span>Host:</span>
                        </div>
                        <div class="{{ $contentWidth }}">
                            @if($event->host_url)
                                <a href="{{ $event->host_url }}" class="underline">
                                    {{ $event->host_name ?? 'Centre for Digital Transformation of Health' }}
                                </a>
                            @else
                                <span>{{ $event->host_name ?? '' }}</span>
                            @endif
                        </div>
                    </div>
                @endif

                <!-- Location Row -->
                <div class="flex items-center w-full">
                    <div class="{{ $labelWidth }} flex items-center">
                        <span class="mr-2">
                            <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 20 20">
                                <path fill="#304850"
                                    d="M10 20S3 10.87 3 7a7 7 0 1 1 14 0c0 3.87-7 13-7 13zm0-11a2 2 0 1 0 0-4a2 2 0 0 0 0 4z" />
                            </svg>
                        </span>
                        <span>
                            @if($eventType === 'annual')
                                Tempat Pelaksanaan:
                            @else
                                Location:
                            @endif
                        </span>
                    </div>
                    <div class="{{ $contentWidth }}">
                        <span>{{ $event->location ?? ($eventType === 'annual' ? 'Online' : 'Webinar') }}</span>
                    </div>
                </div>
            </div>

            <!-- Event Description -->
            <div class="my-12">
                {!! $event->description ?? 'idcjicudnc' !!}
            </div>
        </div>
    </div>
</x-app-layout>