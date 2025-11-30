@php
    $socialLinks = [
        ['label' => 'Twitter', 'href' => '#', 'icon' => 'twitter'],
        ['label' => 'Facebook', 'href' => '#', 'icon' => 'facebook'],
        ['label' => 'Instagram', 'href' => '#', 'icon' => 'instagram'],
        ['label' => 'YouTube', 'href' => '#', 'icon' => 'youtube'],
        ['label' => 'LINE', 'href' => '#', 'icon' => 'line'],
        ['label' => 'Email', 'href' => 'mailto:asosiasidrm@gmail.com', 'icon' => 'mail'],
    ];
@endphp

<footer class="bg-[#2F2F31] text-white font-noto mt-12 sm:mt-20">
    <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-0 py-10 sm:py-14 flex flex-col gap-8 sm:gap-10 lg:flex-row lg:items-start lg:justify-between">
        <div class="max-w-2xl space-y-4">
            <!-- <p class="text-xs tracking-[0.4em] uppercase ">BINUS Alumni Relations Office</p> -->
            <p class="text-[13px] sm:text-base font-semibold leading-tight tracking-wide uppercase font-noto">Asosiasi Alumni<br>Doktor Riset dan Manajemen<br>Binus University</p>
            <div class="space-y-1 text-sm text-white/80">
                <p>Arcadia Daan Mogot Blok G18 No. 1-2-3</p>
                <p>Jl. Daan Mogot KM 21, Batuceper Tangerang 15122 </p>
                <p>Telpon : (021) 811 203 160 </p>
            </div>
        </div>

        <div class="w-full lg:w-auto space-y-4 sm:space-y-6">
            <p class="text-xm md:text-sm+ tracking-wide uppercase text-[#9CE7C4]">Kontak kami dengan:</p>
            <div class="flex flex-wrap gap-3">
                @foreach ($socialLinks as $social)
                    <a href="{{ $social['href'] }}" aria-label="{{ $social['label'] }}" class="group inline-flex h-11 w-11 items-center justify-center rounded-full border border-white/30 bg-white/5 transition hover:bg-white hover:text-[#2F2F31]">
                        @switch($social['icon'])
                            @case('twitter')
                                <svg viewBox="0 0 24 24" class="h-5 w-5" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                                    <path d="M22 4.01c-.77.45-1.6.76-2.48.9a4.07 4.07 0 0 0 1.8-2.27 8.1 8.1 0 0 1-2.57.98A4.11 4.11 0 0 0 12 6.75a11.66 11.66 0 0 1-8.46-4.25 4.07 4.07 0 0 0 1.27 5.46 4.04 4.04 0 0 1-1.85-.5v.05a4.11 4.11 0 0 0 3.3 4.02 4.06 4.06 0 0 1-1.84.07 4.1 4.1 0 0 0 3.83 2.84A8.25 8.25 0 0 1 2 18.26a11.63 11.63 0 0 0 6.29 1.84c7.55 0 11.68-6.11 11.68-11.41 0-.17 0-.34-.01-.5A8.18 8.18 0 0 0 22 4z" />
                                </svg>
                                @break
                            @case('facebook')
                                <svg viewBox="0 0 24 24" class="h-5 w-5" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                                    <path d="M14.5 9H17V6.5h-2.5A2.5 2.5 0 0 0 12 9v2H9v2.5h3V21h3v-7.5h2.5L18 11h-3V9a.5.5 0 0 1 .5-.5Z" />
                                </svg>
                                @break
                            @case('instagram')
                                <svg viewBox="0 0 24 24" class="h-5 w-5" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                                    <rect x="3" y="3" width="18" height="18" rx="5" ry="5" />
                                    <circle cx="12" cy="12" r="3.5" />
                                    <circle cx="17" cy="7" r="1.1" fill="currentColor" stroke="none" />
                                </svg>
                                @break
                            @case('youtube')
                                <svg viewBox="0 0 24 24" class="h-5 w-5" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                                    <path d="M21.5 8.6a2.3 2.3 0 0 0-1.64-1.63C18.13 6.5 12 6.5 12 6.5s-6.13 0-7.86.47A2.3 2.3 0 0 0 2.5 8.6 24.5 24.5 0 0 0 2 12a24.5 24.5 0 0 0 .5 3.4 2.3 2.3 0 0 0 1.64 1.63C5.87 17.5 12 17.5 12 17.5s6.13 0 7.86-.47A2.3 2.3 0 0 0 21.5 15.4 24.5 24.5 0 0 0 22 12a24.5 24.5 0 0 0-.5-3.4Z" />
                                    <path d="m10 14.7 4-2.7-4-2.7Z" fill="currentColor" stroke="none" />
                                </svg>
                                @break
                            @case('line')
                                <svg viewBox="0 0 24 24" class="h-5 w-5" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                                    <path d="M12 4c-5.2 0-9.5 3.41-9.5 7.61 0 3.03 2.32 5.63 5.63 6.87l-.4 3.52a.6.6 0 0 0 .92.58L12 19.4c5.21 0 9.5-3.4 9.5-7.6S17.21 4 12 4Z" />
                                    <path d="M8 9.6v3.2" />
                                    <path d="M10.5 9.6v3.2" />
                                    <path d="M15.5 9.6v3.2" />
                                    <path d="M17.5 9.6v3.2" />
                                    <path d="M13 9.6v3.2" />
                                </svg>
                                @break
                            @case('mail')
                                <svg viewBox="0 0 24 24" class="h-5 w-5" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                                    <rect x="3" y="5" width="18" height="14" rx="2" />
                                    <path d="m3 7 9 6 9-6" />
                                </svg>
                                @break
                        @endswitch
                    </a>
                @endforeach
            </div>
        </div>
    </div>

    <div class="border-t border-white/10">
        <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-0 py-4 sm:py-6 flex flex-col gap-2 text-xs sm:text-sm text-white/70 text-center md:text-left md:flex-row md:items-center md:justify-end">
            <p>Copyright &copy; {{ now()->year }} BINUS Higher Education. All rights reserved.</p>
        </div>
    </div>
</footer>
