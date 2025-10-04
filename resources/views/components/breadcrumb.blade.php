@props([
    'items' => [], // array: ['label' => '', 'url' => '']
])
<nav class="hidden md:block text-[18px] font-inter font-extrabold">
    <ol class="flex items-center flex-wrap">
        @foreach ($items as $index => $item)
            <li class="flex items-center">
                <a href="{{ $item['url'] ?? '#' }}" class="
                    text-primary-black font-medium hover:underline
                    {{ $index > 0 ? 'before:content-[\'\'] before:inline-block before:w-[0.4375em] before:h-[0.4375em] before:border-black before:border-r-[1.5px] before:border-t-[1.5px] before:mx-3 before:my-0.5' : '' }}
                    {{ $index === count($items) - 1 ? 'pointer-events-none' : '' }}
                ">
                    {{ $item['label'] }}
                </a>
            </li>
        @endforeach
    </ol>
</nav>