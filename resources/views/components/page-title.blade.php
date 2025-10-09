@props([
    'background' => 'bg-white',
    'breadcrumbs' => [],
    'title' => ''
])

<div class="md:px-24 {{ $background === '' || $background === 'bg-white' ? 'pt-16' : 'pt-28' }} {{ $background }}">
    <div class="md:w-10/12 bg-white">
        <div class="px-6 md:px-12 pt-6">
            @if(!empty($breadcrumbs))
                <x-breadcrumb :items="$breadcrumbs"></x-breadcrumb>
            @endif
            
            @if($title)
                <div class="mt-4 md:mt-8 font-inter font-bold text-4xl tracking-[0.010rem]">
                    {{ $title }}
                </div>
            @endif
        </div>
    </div>
</div>