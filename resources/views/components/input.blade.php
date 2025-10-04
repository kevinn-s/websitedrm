@props(
    ['disabled' => false,
     'placeholder' => ''
    ])

<input placeholder='{{ $placeholder }}' {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge(['class' => 'w-full rounded-none']) !!}>
