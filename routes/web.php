<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DataFeedController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\JobController;
use App\Http\Controllers\CampaignController;
use App\Models\Alumni;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::redirect('/', 'login');
Route::get('/', function () {
    return view('pages.dashboard');
})->name('homepage');

Route::view('/visi-misi', 'pages.visi-misi')->name('visi-misi');
Route::view('/akta-asosiasi', 'pages.akta-asosiasi')->name('akta-asosiasi');
Route::view('/ad-art-asosiasi', 'pages.ad-art-asosiasi')->name('ad-art-asosiasi');
Route::view('/struktur-asosiasi-alumni', 'pages.tentang.struktur-asosiasi')->name('struktur-asosiasi');
Route::view('/kegiatan', 'pages.kegiatan')->name('kegiatan');
Route::view('/kontak-kami', 'pages.kontak-kami')->name('kontak');
Route::view('/tujuan', 'pages.tujuan')->name('tujuan');

// Route::view('/tentang-kami', 'pages.tentang-kami')->name('tentang-kami');

Route::middleware(['web', 'auth:sanctum', 'verified'])->group(function () {
    // Fix: Use prefix() and name() separately, then define routes inside
    Route::prefix("/alumni")->name("alumni.")->group(function() {
        Route::view("/", 'pages.alumni.directory')->name("directory");
        Route::prefix("/profile")->group(function(){
            Route::view("/{alumni}", 'pages.alumni.profile')->name("profile");
            Route::get('/edit/{alumni}', function (Alumni $alumni) {
                return view('pages.alumni.edit-profile', compact('alumni'));
            })->middleware('can:update,alumni')->name('profile.edit');
        });
    });
    
    Route::view("/rekening", 'pages.rekening.rekening-asosiasi')->name("rekening");
    
     Route::prefix("download")->name("download.")->group(function () {
        Route::get('/akta', function () {
            $path = storage_path('app/public/akta_asosiasi.pdf');
            return response()->download($path, 'akta_asosiasi_doctor_research_of_management_binus_university.pdf', [
                'Content-Type' => 'application/pdf',
            ]);
        })->name('akta');

        Route::get('/ad-art', function () {
            $path = storage_path('app/public/ad-art.pdf');
            return response()->download($path, 'ad_art_asosiasi_alumni_drm_binus_university.pdf', [
                'Content-Type' => 'application/pdf',
            ]);
        })->name('ad-art');
    });
    Route::fallback(function() {
        return view('pages/utility/404');
    }); 
});