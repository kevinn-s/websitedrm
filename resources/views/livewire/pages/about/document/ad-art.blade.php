<?php

use Livewire\Volt\Component;
use Livewire\Attributes\Layout;
use Illuminate\Support\Facades\Storage;

new #[Layout('layouts.app')] class extends Component {
    /**
     * @var array<int, array{label: string, url: string}>
     */
    public array $documents = [];

    public bool $hasDocuments = false;

    public function mount(): void
    {
        $sources = [
            [
                'label' => 'Anggaran Dasar (AD)',
                'path' => 'documents/ad.pdf',
            ],
            [
                'label' => 'Anggaran Rumah Tangga (ART)',
                'path' => 'documents/art.pdf',
            ],
            [
                'label' => 'Akta Asosiasi DRM',
                'path' => 'documents/akta_asosiasi.pdf',
            ],
        ];

        $this->documents = collect($sources)
            ->filter(fn ($doc) => Storage::disk('public')->exists($doc['path']))
            ->map(fn ($doc) => [
                'label' => $doc['label'],
                'url' => Storage::url($doc['path']),
            ])
            ->values()
            ->all();

        $this->hasDocuments = count($this->documents) > 0;
    }
}; ?>

<div class="space-y-14">
     <x-page-title
        title="Dokumen AD/ART"
        :breadcrumbs="[
            ['label' => 'Beranda', 'url' => url('dashboard')],
            ['label' => 'Dokumen AD/ART', 'url' => ''],
        ]"
        description="Anggaran Dasar (AD) dan Anggaran Rumah Tangga (ART) merupakan dasar hukum dan pedoman organisasi dalam menjalankan seluruh kegiatan dan pengambilan keputusan."
    />

    <div class="max-w-5xl mx-auto space-y-6">
        @php
            $defaultPdf = $documents[0]['url'] ?? null;
        @endphp

        <h1 class="max-w-3xl text-xl font-medium leading-relaxed text-primary-green-950">
            AD/ART ditampilkan di bawah ini. Salinan
            @if ($defaultPdf)
                <a href="{{ $defaultPdf }}"
                    class="font-bold text-primary-green-900 transition duration-150 ease-in-out hover:text-primary-green-700 inline-flex items-center"
                    target="_blank"
                    rel="noopener noreferrer">
                    versi PDF lengkap <span class="ml-1">↗</span>
                </a>
            @else
                <span class="font-semibold text-primary-green-700">versi PDF akan tersedia setelah dokumen diunggah.</span>
            @endif
            juga tersedia untuk diunduh.
        </h1>


                <div x-ref="pdfContainer" class="border border-gray-300" style="height: 650px;"></div>

    </div>
</div>
