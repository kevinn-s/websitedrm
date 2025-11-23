@props([
   'title' => '',
   'tags' => [],
   'image' => '',
   'description' => '',
   'date' => ''
])
<div class="w-full max-w-3xl mx-auto bg-white border-t-[0.3px] border-t-gray-200 py-8 h-64 flex gap-8">
    <div class="h-full w-1/4">
        <img src="{{ asset("images/avatar.jpg") }}" class="h-full w-full"   alt="">
    </div>
    <div class="w-9/12">
        <div class="text-xs font-semibold tracking-wide text-primary-green-950 uppercase space-x-1">
            @foreach($tags as $tag)
                <span>
                    {{ $tag }}
                </span>
            @endforeach
        </div>

        <div class="flex items-center gap-2 mt-2">
            <h2 class="text-2xl font-bold text-gray-900">
                {{ $title }}
            </h2>

            <button class="text-primary-green-600 hover:text-primary-green-800">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none"
                    viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M9 5l7 7-7 7" />
                </svg>
            </button>
        </div>

        <p class="mt-4 leading-relaxed text-gray-700">
            {{ $description }}
        </p>

        <div class="flex items-center gap-2 mt-5 text-gray-700">
            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24"><path fill="#02743D" d="M2 19c0 1.7 1.3 3 3 3h14c1.7 0 3-1.3 3-3v-8H2zM19 4h-2V3c0-.6-.4-1-1-1s-1 .4-1 1v1H9V3c0-.6-.4-1-1-1s-1 .4-1 1v1H5C3.3 4 2 5.3 2 7v2h20V7c0-1.7-1.3-3-3-3"/></svg>

            <span class="text-sm">
                {{ $date }}
            </span>
        </div>
        </div>
</div>
