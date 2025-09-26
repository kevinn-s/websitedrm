<?php
use App\Http\Controllers\AdminAuthenticationController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use Laravel\Fortify\Http\Controllers\AuthenticatedSessionController;

Route::middleware(['admin-web'])->prefix('admin')->name('admin.')->group(function () {
    Route::middleware('guest:admin')->group(function () {
        Route::redirect('/', '/admin/login');
        Route::view('/login', "auth.admin.login")->name('login.form');
        Route::post('/login', [AdminAuthenticationController::class, 'login'])->name('login');
    });
    Route::middleware('auth:admin')->group(function () {
        Route::redirect('/', '/admin/dashboard');
        Route::view('/dashboard', "admin.dashboard")->name('dashboard');
        Route::prefix('alumni')->group(function () {
            Route::view('/', 'admin.alumni')->name('alumni');
            Route::view('/official', 'admin.official-alumni')->name('alumni.official');
            Route::post('/import', [AdminController::class, 'importAlumni'])->name('alumni.import');
        });
        Route::post('/logout', [AdminAuthenticationController::class, 'logout'])->name('logout');
    });
});


Route::fallback(function () {
    return view('pages.utility.404');
});