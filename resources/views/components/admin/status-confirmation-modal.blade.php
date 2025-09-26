@props([
    'align' => 'right',
    'alumni' => null
])

<div class="absolute inline-flex" x-data="{
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
        class="px-3 py-1 rounded inline-flex justify-center align-center items-center group bg-gray-900"
        aria-haspopup="true"
        @click.prevent="open = !open"
        :aria-expanded="open"                        
    >
        <div class="flex items-center justify-center truncate text-white">
            Ubah Status
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