@props(['href' => null, 'class' => ''])

@php
$classes = "relative inline-block text-gray-800 font-semibold after:content-[''] after:absolute after:inset-[-1px] after:ml-3 after:mt-1 after:bg-gray-300 after:opacity-0 after:transition-opacity after:duration-300 after:-z-10 hover:after:opacity-100";
@endphp

<a {{ $attributes->merge(['class' => $classes . ' ' . $class, 'href' => $href]) }}>
    {{ $slot }}
</a>
