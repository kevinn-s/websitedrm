@props([
    'title' => '',
    'tags' => [],
    'image' => '',
    'description' => '',
    'location' => '',
    'date' => '',
    'url' => null,
    'showMeta' => false,
])

@php
    $imageSource = $image;
    $isLink = filled($url);
    $wrapperClasses = 'group block border border-gray-200 bg-white p-4 sm:p-6 shadow-sm transition hover:-translate-y-1 hover:shadow-lg';

    if (empty($imageSource)) {
        $imageSource = asset('images/avatar.jpg');
    } elseif (! \Illuminate\Support\Str::startsWith($imageSource, ['http://', 'https://'])) {
        $imageSource = asset('storage/' . ltrim($imageSource, '/'));
    }
@endphp


<{{ $isLink ? 'a' : 'div' }} @if($isLink) href="{{ $url }}" @endif class="{{ $wrapperClasses }}">
    <div class="flex flex-col gap-4 sm:gap-6 md:flex-row min-h-36 h-full">
        <div class="w-full md:w-1/3 overflow-hidden bg-gray-100">
            <img src="{{ $imageSource }}" alt="Poster {{ $title }}" class="h-48 sm:h-full w-full object-cover transition duration-500 group-hover:scale-105" loading="lazy">
        </div>
        <div class="w-full md:w-2/3 space-y-3 sm:space-y-4">
            <div class="flex flex-wrap items-center gap-2 text-xs font-semibold uppercase tracking-wide text-primary-green-900">
                @forelse ((array) $tags as $tag)
                    <span class="bg-primary-gold px-2 py-1 text-[11px] text-primary-green-900">{{ $tag }}</span>
                @empty
                    <span class="bg-gray-100 px-2 py-1 text-[11px] text-gray-600">Kategori belum ditentukan</span>
                @endforelse
            </div>

            <div class="flex items-start justify-between gap-3">
                <h2 class="text-lg sm:text-2xl font-semibold text-gray-900 transition-colors group-hover:text-primary-green-700">
                    {{ $title }}
                </h2>
                @if($isLink)
                    <span class="mt-1 inline-flex h-8 w-8 sm:h-9 sm:w-9 items-center justify-center border border-primary-green-200 text-primary-green-600 transition group-hover:translate-x-1 flex-shrink-0">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 sm:h-5 sm:w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
                        </svg>
                    </span>
                @endif
            </div>

            <p class="text-xs sm:text-sm leading-relaxed text-gray-600 line-clamp-3">
                {{ $description ?? 'Detail kegiatan akan segera tersedia.' }}
            </p>

            @if ($showMeta)
                <div class="space-y-2 sm:space-y-3 text-xs sm:text-sm text-gray-700">
                    <div class="flex items-center gap-2 font-medium text-primary-green-900">
                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24">
                            <path fill="currentColor" d="M19 4h-1V2h-2v2H8V2H6v2H5a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6a2 2 0 0 0-2-2Zm0 14H5V10h14Zm0-10H5V6h14Z" />
                        </svg>
                        {{ $date }}
                    </div>
                    <div class="flex items-center gap-2 text-gray-600">
                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24">
                            <path fill="currentColor" d="M12 2A7 7 0 0 0 5 9c0 5.25 7 13 7 13s7-7.75 7-13a7 7 0 0 0-7-7Zm0 9.5A2.5 2.5 0 1 1 14.5 9A2.5 2.5 0 0 1 12 11.5Z" />
                        </svg>
                        <span class="font-medium text-gray-700">{{ $location }}</span>
                    </div>
                </div>
            @endif
        </div>
    </div>
</{{ $isLink ? 'a' : 'div' }}>
