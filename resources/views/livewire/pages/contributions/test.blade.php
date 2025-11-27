<?php

use Livewire\Volt\Component;
use Livewire\Attributes\Layout;
use Livewire\WithFileUploads;

use Illuminate\Validation\Rules\Enum;

use App\Models\Donation;
use App\Enums\Status;
use App\Enums\ContributionType;

new #[Layout('layouts.app')] class extends Component {


}; ?>
<div class="space-y-20">
      <x-page-title title="Rekening Asosiasi Alumni" :breadcrumbs="[
        ['label' => 'Beranda', 'url' => ''],
        ['label' => 'Kegiatan', 'url' => ''],
    ]" />
       <div class="max-w-3xl mx-auto">
              <div class="relative overflow-hidden border border-primary-green-200 bg-white shadow-md">
                     <div class="absolute inset-y-0 left-0 w-2 bg-primary-green-500"></div>
                     <div class="relative px-8 py-10 md:px-12 md:py-14">
                            <div class="flex flex-col gap-6 md:flex-row md:items-start">
                                   <div class="flex h-16 w-16 items-center justify-center rounded-full bg-primary-green-100 text-primary-green-700">
                                          <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
                                                 <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                          </svg>
                                   </div>
                                   <div class="flex-1 space-y-3 text-slate-700">
                                          <h1 class="font-sora text-2xl font-semibold text-primary-green-900 tracking-tight">Terima kasih telah berkontribusi</h1>
                                          <p class="text-base leading-relaxed md:text-base+">
                                                 Dukungan Anda membantu Asosiasi Alumni DRM menghadirkan program pengembangan, ruang kolaborasi, dan kegiatan yang bermanfaat bagi seluruh anggota. Tim kami akan memverifikasi bukti transfer Anda dalam waktu dekat.
                                          </p>
                                              <div class="mt-6 flex flex-wrap gap-3">
                            <x-button href="{{ route('dashboard') }}" variant="primary">Kembali ke beranda</x-button>
                     </div>
                                   </div>
                            </div>
                     </div>
              </div>
       </div>
</div>
