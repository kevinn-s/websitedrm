@props([
    'title' => '',
    'content' => ''
])

<li class="relative pl-8 before:content-['—'] before:absolute before:left-0 before:font-bold before:text-black text-xl font-bold">
    {{ $title }}
</li>
<div class="pl-8 md:text-lg">
    {{ $content }}
</div>