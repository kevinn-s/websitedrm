<?php



use App\Models\Alumni;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;


use Livewire\Volt\Volt;


Volt::route('/', 'pages.home')
    ->name('dashboard');

Volt::route('/kegiatan', 'pages.events.index')
    ->name('kegiatan');

Volt::route('/visi-misi', 'pages.about.vision-mission')
    ->name('visi-misi');

Volt::route('/tujuan', 'pages.about.purpose')
    ->name('tujuan');

Volt::route('/struktur-organisasi', 'pages.about.boardmembers')
    ->name('struktur-organisasi');

Volt::route('/kontak', 'pages.contact.index')
    ->name('kontak');

Volt::route('/rekening', 'pages.contributions.index')
    ->name('rekening');

Route::prefix('/dokumen')
    ->name('dokumen.')
    ->group(function() {
        Volt::route('/ad-art', 'pages.about.document.ad-art')
        ->name('ad-art');
        Volt::route('/akta-asosiasi', 'pages.about.document.akta')
        ->name('akta-asosiasi');
    });

Route::prefix('/kegiatan')
    ->name('kegiatan.')
    ->group(function(){
          Volt::route('/{slug}', 'pages.events.show')
            ->name('show');
    });

Route::prefix('/rekening')
    ->name('rekening')
    ->group(function(){
        Volt::route('/', 'pages.contributions.index')
        ->name('');
    });

Route::prefix('download')->name('download.')->group(function () {
    // Route: /download/akta-asosiasi
    Route::get('/akta-asosiasi', function () {
        $path = 'documents/akta_asosiasi.pdf';
        if (! Storage::disk('public')->exists($path)) {
            abort(404);
        }
        return response()->download(
            Storage::disk('public')->path($path),
            'Akta-Asosiasi.pdf'
        );
    })->name('akta-asosiasi');

    // Route: /download/ad-art
    Route::get('/ad-art', function () {
        $path = 'documents/ad-art.pdf';
        if (! Storage::disk('public')->exists($path)) {
            abort(404);
        }
        return response()->download(
            Storage::disk('public')->path($path),
            'AD-ART.pdf'
        );
    })->name('ad-art');
});
Volt::route('profile', 'pages.alumni.edit')
    ->middleware(['auth'])
    ->name('profile');


Route::middleware(['auth'])->group(function () {
    // Fix: Use prefix() and name() separately, then define routes inside
    Route::prefix("/alumni")
        ->name("alumni.")
        ->group(function() {
            Route::prefix("/profile")
            ->group(function(){
               Volt::route('{alumni}', 'pages.alumni.profile')
               ->name('profile');
            });
            Volt::route('', 'pages.alumni.find')
            ->name('directory');
        });
});

require __DIR__.'/auth.php';
