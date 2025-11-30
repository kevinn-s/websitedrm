@props([
    'background' => 'bg-white',
    'breadcrumbs' => [],
    'title' => '',
    'description' => ''
])

<div class="relative min-h-[280px] sm:h-[340px] lg:h-[344px] w-full text-white"
 style="
        background-image: url('{{ asset('images/JWC-74-min-scaled.jpg') }}');
        background-blend-mode: multiply;
        background-color: rgba(0,0,0,0.7);
        background-position: center;
        background-repeat: no-repeat;
        background-size: cover;
     "
>
    <div class="max-w-5xl w-full h-full mx-auto px-4 sm:px-6 lg:px-0">
        <div class="h-full max-w-2xl flex flex-col justify-center py-16 md:py-20">
            <div class="max-w-xl">
                <h1 class="font-sora text-4xl md:text-5xl font-black md:font-bold tracking-tighter mb-3 sm:mb-5">
                    {!! $title !!}
                </h1>
            </div>
            <p class="font-noto text-sm+ sm:text-lg md:text-[19px] font-medium leading-snug sm:leading-[1.5rem]">
                {!! $description !!}
            </p>
        </div>
    </div>
</div>

    <!-- <div
    class="absolute bottom-0 w-full h-1/6"
    style="
        background-image: url('{{ asset('images/green-pattern.png') }}');
        background-repeat: repeat;
        background-size: auto;
    "
    >
    </div> -->
