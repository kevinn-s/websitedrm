@props([
    'href' => null,
    'type' => 'button',
    'variant' => 'primary', // primary, primary-reverse, secondary, outline
    'size' => 'md', // sm, md, lg
    'icon' => null,
])

@php
    $baseClasses = 'box-border border-b-primary-green-700 border-b-4 inline-flex items-center justify-center gap-3 font-semibold font-noto tracking-tight transition-all duration-300 ease-in-out';

    $sizeClasses = [
        'sm' => 'px-2 py-2 text-[14px]',
        'md' => 'px-5 py-2.5 text-[14px]',
        'lg' => 'px-10 py-5 text-sm',
    ];

    $variantClasses = [
        'primary' => 'bg-primary-green-500 text-white hover:bg-primary-green-600 hover:border-b-grey-800 ',
        'primary-reverse' => 'bg-white text-[#02743D] border-2 border-primary-green hover:bg-[#02743D] hover:text-white hover:border-primary-green',
        'secondary' => 'bg-gray-600 text-white border-2 border-gray-600 hover:bg-gray-700 hover:border-gray-700',
        'outline' => 'bg-white text-[#02743D] border-2 border-primary-green hover:bg-[#02743D] hover:text-white hover:border-primary-green',
    ];

    $classes = $baseClasses . ' ' . $sizeClasses[$size] . ' ' . $variantClasses[$variant];
@endphp

@if($href)
    <a href="{{ $href }}" {{ $attributes->merge(['class' => $classes]) }}>
        @if($icon)
            {!! $icon !!}
        @endif
        {{ $slot }}
    </a>
@else
    <button type="{{ $type }}" {{ $attributes->merge(['class' => $classes]) }}>
        @if($icon)
            {!! $icon !!}
        @endif
        {{ $slot }}
    </button>
@endif
