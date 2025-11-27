@props([
   'title' => '',
   'tags' => [],
   'image' => '',
   'description' => '',
   'location' => '',
   'date' => '',
])

 <div class="w-9/12">
                <div class="bg-white flex gap-8">
                    <div class="w-1/4 self-stretch">
                        <img src="{{ asset("images/avatar.jpg") }}" class="object-cover" alt="">
                    </div>
                    <div class="w-9/12 my-auto">
                        {{-- Category tags --}}
                        <div
                            class="text-xs font-semibold tracking-wide text-primary-green-950 uppercase space-x-1 flex gap-1">
                            @foreach ((array) $tags as $tag)
                                <span class="bg-primary-gold px-2">{{ $tag }}</span>
                            @endforeach
                        </div>
                        {{-- Title + Arrow --}}
                        <div class="flex items-center gap-2 mt-2" x-data="{hovered: false}">
                            <h2 class="block text-2xl font-bold text-gray-900" @mouseenter="hovered = true"
                                @mouseleave="hovered = false">
                                <a href="{{ route('kegiatan') }}">
                                    {{ $title }}
                                </a>
                            </h2>
                            <button class="text-primary-green-600 hover:text-primary-green-800 transition"
                                :class="hovered === true ? 'translate-x-1' : ''">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24"
                                    stroke="currentColor" stroke-width="3">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
                                </svg>
                            </button>
                        </div>
                        <p class="my-4 leading-relaxed text-gray-700 h-[3.25em] overflow-hidden line-clamp-2">
                            {{ $description ?? 'Detail kegiatan akan segera tersedia.' }}
                        </p>
                        {{-- Date & Time --}}
                        <div class="flex items-center gap-2 text-gray-700">
                            <span class="text-[15px] font-bold tracking-wide">
                               {{  $date }}
                            </span>
                        </div>
                        {{-- Location --}}
                        <div class="flex items-center gap-2 mt-2 text-gray-900">
                            <svg class="block" xmlns="http://www.w3.org/2000/svg" width="15" height="15"
                                viewBox="0 0 48 48">
                                <path fill="#000000"
                                    d="M40.596 4.173c2.022-.778 4.008 1.209 3.23 3.23L30.369 42.397c-.871 2.264-4.134 2.085-4.751-.262l-3.93-14.932a1.25 1.25 0 0 0-.89-.89l-14.933-3.93c-2.347-.618-2.526-3.88-.261-4.752L40.596 4.173Z" />
                            </svg>
                            <span class="text-sm+ font-medium tracking-normal block">
                               {{ $location }}
                            </span>
                        </div>
                    </div>
                </div>
