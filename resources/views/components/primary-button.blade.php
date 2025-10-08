@props([
    'href' => null,
    'type' => 'button',
    'size' => 'md', // sm, md, lg
    'icon' => null,
])

@php
    $baseClasses = 'inline-flex items-center py-1 justify-center gap-3 font-bold transition-all duration-300 ease-in-out';
    
    $sizeClasses = [
        'sm' => 'px-2 py-2 text-sm',
        'md' => 'px-3 py-3  text-base',
        'lg' => 'px-10 py-20 text-sm',
    ];
    
    $classes = $baseClasses . ' ' . $sizeClasses[$size];
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