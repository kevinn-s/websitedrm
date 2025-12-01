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
                'path' => 'documents/ad_art.pdf',
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
            ->map(function ($doc) {
                $fullUrl = Storage::url($doc['path']);
                $pathOnly = parse_url($fullUrl, PHP_URL_PATH) ?: $fullUrl;

                return [
                    'label' => $doc['label'],
                    'url' => '/'.ltrim($pathOnly, '/'),
                ];
            })
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
            $documentsCollection = collect($documents);
            $firstDocument = $documentsCollection->first();
            $defaultPdf = $firstDocument['url'] ?? null;
            $documentFrames = [
                'Anggaran Dasar (AD)' => $documentsCollection->firstWhere('label', 'Anggaran Dasar (AD)')['url'] ?? null,
            ];
        @endphp

        <h1 class="max-w-3xl px-4 text-base md:text-xl font-medium leading-relaxed text-primary-green-950">
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

        <div class="space-y-6 max-w-3xl px-4 ">
            @foreach ($documentFrames as $label => $url)
                <div class="space-y-3">
                    @if ($url)
                        <iframe
                            src="{{ $url }}"
                            title="{{ $label }}"
                            class="w-full border border-gray-300"
                            style="min-height: 700px"
                        ></iframe>
                    @else
                        <p class="text-sm text-gray-600">Dokumen {{ strtolower($label) }} belum tersedia.</p>
                    @endif
                </div>
            @endforeach
        </div>

    </div>
</div>
