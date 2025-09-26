@props([
    'alumni' => null
])

<div class="fixed inset-0 bg-gray-900/50 z-50 transition-opacity" x-show="approveConfirmOpen"
    x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0"
    x-transition:enter-end="opacity-100" x-transition:leave="transition ease-out duration-100"
    x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0" aria-hidden="true" x-cloak></div>

<!-- Dark overlay backdrop -->
<div class="fixed inset-0 z-50 overflow-hidden flex items-center justify-center px-4 sm:px-6" 
     x-show="approveConfirmOpen" 
     x-transition:enter="transition ease-out duration-200"
     x-transition:enter-start="opacity-0" 
     x-transition:enter-end="opacity-100"
     x-transition:leave="transition ease-in duration-150" 
     x-transition:leave-start="opacity-100" 
     x-transition:leave-end="opacity-0"
     x-cloak>
</div>

<div id="approve-confirm-modal" class="fixed inset-0 z-50 overflow-hidden flex items-center justify-center px-4 sm:px-6"
    role="dialog" aria-modal="true" x-show="approveConfirmOpen" x-transition:enter="transition ease-in-out duration-200"
    x-transition:enter-start="opacity-0 translate-y-4" x-transition:enter-end="opacity-100 translate-y-0"
    x-transition:leave="transition ease-in-out duration-200" x-transition:leave-start="opacity-100 translate-y-0"
    x-transition:leave-end="opacity-0 translate-y-4" x-cloak>
    <div class="bg-white border border-transparent overflow-hidden max-w-lg w-full rounded-xl shadow-2xl relative z-10"
        @click.outside="resetApproveModal()" @keydown.escape.window="resetApproveModal()">
        <!-- Header -->
        <div class="px-6 py-4 border-b border-gray-200">
            <div class="flex items-center justify-between">
                <h3 class="text-lg font-semibold text-gray-900">Konfirmasi Persetujuan</h3>
                <button @click="resetApproveModal()"
                    class="text-gray-400 hover:text-gray-600 transition-colors">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>

        <!-- Content -->
        <div class="px-6 py-6">
            <p class="text-lg font-medium text-gray-900">Apakah anda yakin ingin menyetujui alumni ini?</p>
        </div>

        <!-- Footer -->
        <div class="px-6 py-4 bg-gray-50 border-t border-gray-200 flex justify-end gap-3">
            <button @click="resetApproveModal()"
                class="px-4 py-2 text-gray-700 bg-white border border-gray-300 rounded-lg hover:bg-gray-50 transition-colors">
                Batal
            </button>
            
            <button @click="resetApproveModal()"
                wire:click="approve({{ $alumni->id }})"
                wire:target="approve({{ $alumni->id }})"
                class="px-4 py-2 bg-green-600 hover:bg-green-700 text-white rounded-lg transition-colors"
                wire:loading.attr="disabled">
                
                <span wire:loading.remove wire:target="approve({{ $alumni->id }})">
                    Setujui
                </span>
                
                <span wire:loading wire:target="approve({{ $alumni->id }})">
                    Menyimpan...
                </span>
            </button>
        </div>
    </div>
</div>