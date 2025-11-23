@props(['active' => false])

@php
$classes = ($active ?? false)
            ? 'inline-flex items-center border-b-4 px-6 pt-4 pb-5 border-b-2 border-b-primary-green-500 transition duration-150 ease-in-out box-border'
            : 'inline-flex items-center border-b-4 px-6 pt-4 pb-5 border-transparent leading-5 text-black hover:bg-primary-green-500 hover:text-white focus:outline-none transition duration-150 ease-in-out box-border';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
