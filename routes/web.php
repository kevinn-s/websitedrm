<?php



use App\Models\Alumni;
use Illuminate\Support\Facades\Route;


use Livewire\Volt\Volt;


Route::view('/', 'welcome');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Volt::route('/kegiatan', 'pages.events.index')
    ->name('kegiatan');

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
               
            });
        });
});

require __DIR__.'/auth.php';
