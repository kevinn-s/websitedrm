@props([
    'title' => '',
    'content' => '',
    'direction' => 'vertical',
    'size' => 'sm'
])
@php
    $classes = $attributes->get('class', '');

    // Define size mappings
    $sizeClasses = [
        'xs' => [
            'title' => 'text-sm pl-6',
            'content' => 'text-xs pl-6'
        ],
        'sm' => [
            'title' => 'text-base pl-6',
            'content' => 'text-sm pl-6'
        ],
        'md' => [
            'title' => 'text-lg pl-8',
            'content' => 'text-base'
        ],
        'lg' => [
            'title' => 'text-xl pl-8',
            'content' => 'text-lg pl-8'
        ],
        'xl' => [
            'title' => 'text-2xl pl-10',
            'content' => 'text-xl pl-10'
        ]
    ];

    $titleClasses = $sizeClasses[$size]['title'] ?? $sizeClasses['sm']['title'];
    $contentClasses = $sizeClasses[$size]['content'] ?? $sizeClasses['sm']['content'];
@endphp
@if($direction === 'horizontal')
    <div class="flex items-center">
        <li class="relative before:content-['—'] before:absolute before:left-0 before:font-bold before:text-black font-bold flex-shrink-0 {{ $titleClasses }} {{ $classes }}">
            {{ $title }}
        </li>
        <div class="{{ $contentClasses }} {{ $classes }}">
            {{ $content }}
        </div>
    </div>
@else
    <li class="relative before:content-['—'] before:absolute before:left-0 before:font-bold before:text-black font-bold {{ $titleClasses }} {{ $classes }}">
        {{ $title }}
    </li>
    <div class="{{ $contentClasses }} {{ $classes }}">
        {{ $content }}
    </div>
@endif
