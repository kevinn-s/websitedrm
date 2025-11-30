<?php

use Livewire\Volt\Component;
use Livewire\Attributes\Layout;
use Illuminate\Support\Facades\Storage;

new #[Layout('layouts.app')] class extends Component {
    public function download()
    {
        // Redirect the browser to the download route
        return redirect()->route('download.akta-asosiasi');
    }
    public string $aktaPdfUrl = '';
    public bool $aktaFileAvailable = false;

    public function mount(): void
    {
        $path = 'documents/akta_asosiasi.pdf';

        if (Storage::disk('public')->exists($path)) {
            $this->aktaPdfUrl = Storage::url($path);
            $this->aktaFileAvailable = true;
        }
    }
}; ?>

<div class="bg-white">
    <x-page-title
        title="Dokumen<br> Akta Asosiasi"
        :breadcrumbs="[
            ['label' => 'Beranda', 'url' => url('dashboard')],
            ['label' => 'Dokumen Akta Asosiasi', 'url' => ''],
        ]"
    />

    <section class="py-12 bg-white">
        <div class="max-w-5xl mx-auto px-6 lg:px-0 space-y-6 text-primary-green-950">
            <div class="space-y-3 md:w-8/12">
                <p class="text-lg leading-relaxed">
                    Akta Asosiasi Alumni ditampilkan di bawah ini. Salinan
                    @if ($aktaFileAvailable && $aktaPdfUrl)
                        <a href="{{ $aktaPdfUrl }}"
                            class="font-bold text-primary-green-900 hover:text-primary-green-700 transition duration-150 ease-in-out cursor-pointer inline-flex items-center"
                            target="_blank"
                            rel="noopener noreferrer">
                            versi PDF lengkap <span class="ml-1">↗</span>
                        </a>
                    @else
                        <span class="font-semibold">versi PDF lengkap</span>
                    @endif
                    juga tersedia untuk diunduh.
                </p>
            </div>

        </div>
    </section>

    <section class="bg-primary-green-50 py-10">
        <div class="max-w-5xl mx-auto px-6 lg:px-0">
            @if ($aktaFileAvailable && $aktaPdfUrl)
                <div
                    x-data="pdfViewer(@js($aktaPdfUrl))"
                    class=" border border-primary-green-100 bg-white shadow-[0_30px_80px_rgba(15,118,80,0.08)] overflow-hidden"
                >
                    <div
                        x-ref="pdfContainer"
                        class="min-h-[640px] w-full"
                    ></div>
                    <div class="border-t border-primary-green-100 bg-primary-green-50/50 p-4 flex items-center gap-3">
                        <a href="{{ $aktaPdfUrl }}" class="text-sm font-semibold text-primary-green-700 underline" target="_blank" rel="noopener noreferrer">
                            Unduh Dokumen
                        </a>
                        <button type="button" class="text-sm text-gray-600 underline" @click="closePDF()">
                            Tutup Dokumen
                        </button>
                    </div>
                </div>
            @else
                <div class=" border border-primary-green-200 bg-white p-8 text-center text-primary-green-900">
                    <p class="text-lg font-semibold">Dokumen belum tersedia.</p>
                    <p class="mt-2 text-sm text-gray-600">Silakan coba lagi nanti atau unduh melalui tombol di atas ketika file sudah siap.</p>
                </div>
            @endif
        </div>
    </section>
</div>
