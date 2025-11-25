<?php



use App\Models\Alumni;
use App\Mail\RegisterEmail;
use App\Mail\AccountVerifiedEmail;
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

Volt::route('/struktur-asosiasi-alumni', 'pages.about.boardmembers')
    ->name('struktur-organisasi');

Volt::route('/kontak', 'pages.contact.index')
    ->name('kontak');

Volt::route('/test', 'pages.contributions.test')
    ->name('test');

Route::get('/test-email', function () {
    return new RegisterEmail(
        'John Doe',
        'john.doe@example.com',
        '12345678'
    );
})->name('test-email');

Route::get('/test-email-verified', function () {
    return new AccountVerifiedEmail('John Doe');
})->name('test-email-verified');

Route::prefix('/kegiatan')
    ->name('kegiatan.')
    ->group(function(){
          Volt::route('/{slug}', 'pages.events.show')
            ->name('show')
            ->where('slug', '[^ ]+');
    });

Route::prefix('/rekening')
    ->name('rekening')
    ->group(function(){
        Volt::route('/', 'pages.contributions.index')
        ->name('');
    });


Volt::route('profile', 'pages.alumni.edit')
    ->middleware(['auth'])
    ->name('profile');


Route::middleware(['auth'])->group(function () {
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

    Route::prefix('/dokumen')
    ->name('dokumen.')
    ->group(function() {
        Volt::route('/ad-art', 'pages.about.document.ad-art')
        ->name('ad-art');
        Volt::route('/akta-asosiasi', 'pages.about.document.akta')
        ->name('akta-asosiasi');
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
});

require __DIR__.'/auth.php';
