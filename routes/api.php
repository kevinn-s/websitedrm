<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProfileController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:api');

Route::group(['middleware' => 'api', 'prefix' => 'auth'], function ($router) {
    Route::post('login', [AuthController::class, 'login'])->name('login');
    Route::post('register', [AuthController::class, 'register'])->name('register');

    Route::post('logout', [AuthController::class, 'logout'])->name('logout');
    Route::post('forgot-password', [AuthController::class, 'forgotPassword'])->name('forgot-password');
    Route::post('refresh', [AuthController::class, 'refresh'])->name('refresh');
    Route::post('me', [AuthController::class, 'me'])->name('me');

    Route::get('/profile', [ProfileController::class, 'show']);
    Route::post('/profile', [ProfileController::class, 'update']);

});
