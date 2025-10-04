<div>
    <section class="mt-10">

        <div class="max-w-screen-xl">
            <!-- annual events -->
            <div class="bg-white relative shadow-md sm:rounded-lg">
                <div class="flex items-center justify-between p-4">
                    <!-- Search Input -->
                    <div class="flex">
                        <div class="relative w-full">
                            <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                <svg aria-hidden="true" class="w-5 h-5 text-gray-500" fill="currentColor"
                                    viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd"
                                        d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z"
                                        clip-rule="evenodd" />
                                </svg>
                            </div>
                            <input wire:model.live.debounce.300="search" type="text"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full pl-10 p-2"
                                placeholder="Search annual events...">
                        </div>
                    </div>

                    <div class="grid grid-flow-col sm:auto-cols-max justify-start sm:justify-end gap-2">
                        <button wire:click="clearFilters" class="btn bg-gray-900 text-gray-100 hover:bg-gray-800">
                            <svg class="fill-current shrink-0 xs:hidden" width="16" height="16" viewBox="0 0 16 16">
                                <path
                                    d="M15 7H9V1c0-.6-.4-1-1-1S7 .4 7 1v6H1c-.6 0-1 .4-1 1s.4 1 1 1h6v6c0 .6.4 1 1 1s1-.4 1-1V9h6c.6 0 1-.4 1-1s-.4-1-1-1z" />
                            </svg>
                            <span class="max-xs:sr-only">Clear All Filters</span>
                        </button>

                        <!-- Optional: Add New Event Button -->
                        <a href="{{ route('admin.events.create', ['type' => 'ANNUAL']) }}"
                            class="btn bg-primary-600 text-white hover:bg-primary-700">
                            + Add Annual Event
                        </a>
                    </div>
                </div>

                <div class="overflow-x-auto">
                    <table class="w-full text-sm text-left text-gray-500">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                            <tr>
                                <th scope="col" class="px-4 py-3">Event Title</th>
                                <th scope="col" class="px-4 py-3">Month</th>
                                <th scope="col" class="px-4 py-3">Location</th>
                                <th scope="col" class="px-4 py-3">Speaker</th>
                                <th scope="col" class="px-4 py-3">Published</th>
                                <th scope="col" class="px-4 py-3">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr class="border-b" wire:loading>
                                <td colspan="6" class="text-center py-4">
                                    <div role="status">
                                        <svg aria-hidden="true"
                                            class="w-8 h-8 my-4 text-gray-200 animate-spin dark:text-gray-600 fill-blue-600"
                                            viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z"
                                                fill="currentColor" />
                                            <path
                                                d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z"
                                                fill="currentFill" />
                                        </svg>
                                        <span class="sr-only">Loading...</span>
                                    </div>
                                </td>
                            </tr>

                            @forelse($events as $event)
                                <tr class="border-b" wire:loading.remove>
                                    <td class="px-4 py-3 font-medium text-gray-900">
                                        {{ $event->title }}
                                    </td>
                                    <td class="px-4 py-3">
                                        {{ $event->annual_month ?? '—' }}
                                    </td>
                                    <td class="px-4 py-3">
                                        @if($event->inPersonAccess())
                                            {{ $event->inPersonAccess()->address ?? '—' }}
                                        @elseif($event->virtualAccess())
                                            <span class="text-blue-600">Virtual</span>
                                        @else
                                            —
                                        @endif
                                    </td>
                                    <td class="px-4 py-3">
                                        {{ $event->speaker_name ?? '—' }}
                                    </td>
                                    <td class="px-4 py-3">
                                        @if($event->published_at)
                                            <span class="text-green-600">Yes</span>
                                        @else
                                            <span class="text-gray-500">No</span>
                                        @endif
                                    </td>
                                    <td class="px-4 py-3">
                                        <a href="{{ route('admin.events.edit', $event) }}"
                                            class="text-blue-600 hover:underline mr-3">Edit</a>
                                        <button wire:click="delete({{ $event->id }})"
                                            class="text-red-600 hover:underline">Delete</button>
                                    </td>
                                </tr>
                            @empty
                                <tr wire:loading.remove>
                                    <td colspan="6" class="px-4 py-3 text-center text-gray-500">
                                        No annual events found.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>

                    <div class="mt-4">
                        {{ $events->links() }}
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>