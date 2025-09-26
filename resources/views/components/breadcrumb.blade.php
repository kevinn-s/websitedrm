@props([
    'items' => [], // array: ['label' => '', 'url' => '']
])

<nav class="py-8 font-sans text-[16px] font-extrabold">
    <ol class="flex items-center flex-wrap">
        @foreach ($items as $index => $item)
            <li class="flex items-center">
                <a href="{{ $item['url'] ?? '#' }}" class="text-black font-medium mx-1 hover:underline">
                    {{ $item['label'] }}
                </a>
                @if ($index < count($items) - 1)
                    <span class="text-gray-500 mx-1">&gt;</span>
                @endif
            </li>
        @endforeach
    </ol>
</nav>
