@props([
    'background' => 'bg-white',
    'breadcrumbs' => [],
    'title' => '',
    'description' => ''
])

<div class="relative banner h-[384px] sm:h-[384px] lg:h-[284px] w-screen text-white">
    <div class="max-w-5xl w-full h-full mx-auto">
        <div class="h-full max-w-2xl md:py-20">
            <div class="max-w-lg">
                <div class="max-w-lg">
                    <h1 class="font-sora text-4xl md:text-5xl font-bold tracking-tighter mb-5">
                        {!! $title !!}
                    </h1>
                    <p class="font-noto text-lg leading-[22px] mb-8">
                        {!! $description !!}
                    </p>
                </div>
            </div>
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
