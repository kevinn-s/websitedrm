@props([
    'align' => 'right',
    'buttons' => [],
])

<div class="relative inline-flex">


    <!-- Dropdown Menu -->
    <div
        x-show="open"
        x-cloak
        @click.outside="open = false"
        @keydown.escape.window="open = false"
        x-transition:enter="transition ease-out duration-200 transform"
        x-transition:enter-start="opacity-0 -translate-y-2"
        x-transition:enter-end="opacity-100 translate-y-0"
        x-transition:leave="transition ease-out duration-200"
        x-transition:leave-start="opacity-100"
        x-transition:leave-end="opacity-0"
        class="origin-top-right z-10 absolute top-full min-w-56 bg-white dark:bg-gray-800 
               border border-gray-200 dark:border-gray-700/60 pt-1.5 rounded-lg shadow-lg overflow-hidden mt-1
               {{ $align === 'right' ? 'md:left-auto md:right-0' : 'md:left-0 md:right-auto' }}"
    >
        <div class="text-xs font-semibold text-gray-400 dark:text-gray-500 uppercase pt-1.5 pb-2 px-3">
            Filters
        </div>

        <ul class="mb-4">
            @foreach ($buttons as $button)
                <li class="py-1">
                    <button
                        wire:click="{{ $button['action'] }}"
                        class="w-full font-medium { selected === $button['label'] ? bg-gray-300 : bg-none  } text-sm text-violet-500 hover:text-violet-600 flex items-center py-1 px-3 select-none cursor-pointer"
                        @click="close(); selected = '{{ $button['label'] }}'"
                        :class="{ 'bg-gray-300': selected === '{{ addslashes($button['label']) }}' }"
                    >
                        <span class="text-sm font-medium">{{ $button['label'] }}</span>
                    </button>
                </li>
            @endforeach
        </ul>
    </div>
</div>
