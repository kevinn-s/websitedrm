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
            Route::view("/edit/{alumni}", 'pages.alumni.edit-profile')->middleware('can:update,alumni')->name("profile.edit");
        });
    });
    
    Route::view("/rekening", 'pages.rekening')->name("rekening");
    
    Route::fallback(function() {
        return view('pages/utility/404');
    }); 
});