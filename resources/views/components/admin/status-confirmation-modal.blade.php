@props([
    'align' => 'right',
    'alumni' => null
])

<div class="" x-data="{
    open: false, 
    confirmOpen: false,
    approveConfirmOpen: false,
    resetModal() {
        this.confirmOpen = false;
    },
    resetApproveModal() {
        this.approveConfirmOpen = false;
    }
}" x-id="['confirm-modal']">
    <button
        class="px-1 py-1 rounded inline-flex justify-center align-center items-center group bg-gray-900"
        aria-haspopup="true"
        @click.prevent="open = !open"
        :aria-expanded="open"                        
    >
        <div class="flex items-center justify-center truncate text-white">
            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 32 32"><path fill="#ffffff" d="M22.318 3.318a4.5 4.5 0 0 1 6.364 6.364l-8.66 8.66a3 3 0 0 1-1.292.762l-6.453 1.857a1 1 0 0 1-1.238-1.237l1.857-6.454a3 3 0 0 1 .762-1.292zM16 6q.721 0 1.415.1l1.693-1.694A12 12 0 0 0 16 4C9.373 4 4 9.373 4 16s5.373 12 12 12s12-5.373 12-12c0-1.075-.141-2.117-.407-3.108l-1.692 1.693q.098.694.099 1.415c0 5.523-4.477 10-10 10S6 21.523 6 16S10.477 6 16 6"/></svg>
        </div>
    </button>
        <div
            class="origin-top-right z-10 absolute top-full min-w-44 bg-white border border-gray-200 py-1.5 rounded-lg shadow-lg overflow-hidden mt-1 {{$align === 'right' ? 'right-0' : 'left-0'}}"                
            @click.outside="open = false"
            @keydown.escape.window="open = false"
            x-show="open"
            x-transition:enter="transition ease-out duration-200 transform"
            x-transition:enter-start="opacity-0 -translate-y-2"
            x-transition:enter-end="opacity-100 translate-y-0"
            x-transition:leave="transition ease-out duration-200"
            x-transition:leave-start="opacity-100"
            x-transition:leave-end="opacity-0"
            x-cloak                    
        >

            <ul>
                <li>
    <button
        type="button"
        class="font-medium text-sm text-violet-500 hover:text-violet-600 flex items-center py-1 px-3 select-none cursor-pointer"
        @click="open = false; approveConfirmOpen = true"
        wire:loading.attr="disabled"
    >
        <span>Setujui</span>
    </button>
    </li>

    <li>
    <button
        type="button"
        class="font-medium text-sm text-violet-500 hover:text-violet-600 flex items-center py-1 px-3 select-none cursor-pointer"
        @click="open = false; confirmOpen = true"
        wire:loading.attr="disabled"
    >
        <span>Tolak</span>
    </button>
    </li>

            </ul>                
        </div>
    
    <!-- Modal for reject action -->
    <x-admin.modal-confirm :action="'reject'" :alumni="$alumni"></x-admin.modal-confirm>
    
    <!-- Modal for approve action -->
    <div x-show="approveConfirmOpen">
        <x-admin.modal-confirm-approve :alumni="$alumni"></x-admin.modal-confirm-approve>
    </div>
</div>