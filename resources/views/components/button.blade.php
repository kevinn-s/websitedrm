@props([
    'href' => null,
    'type' => 'button',
    'variant' => 'primary', // primary, secondary, outline
    'size' => 'md', // sm, md, lg
    'icon' => null,
])

@php
    $baseClasses = 'inline-flex items-center justify-center gap-3 font-bold transition-all duration-300 ease-in-out';
    
    $sizeClasses = [
        'sm' => 'px-2 py-2 text-sm',
        'md' => 'px-3 py-3  text-base',
        'lg' => 'px-10 py-5 text-sm',
    ];
    
    $variantClasses = [
        'primary' => 'bg-white text-primary-green border-2 border-primary-green hover:bg-[#02743D] hover:text-white hover:border-primary-green',
        'primary-reverse' => 'bg-primary-green text-white border-2 border-primary-green hover:bg-white hover:text-[#02743D] hover:border-primary-green',
        'secondary' => 'bg-gray-600 text-white border-2 border-gray-600 hover:bg-gray-700 hover:border-gray-700',
        'outline' => 'bg-white text-primary-green border-2 border-primary-green hover:bg-primary-green hover:text-white hover:border-primary-green',
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