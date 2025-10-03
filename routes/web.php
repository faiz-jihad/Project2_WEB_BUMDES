<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\produkController;
use App\Http\Controllers\Auth\LoginController;

Route::get('/Beranda', [HomeController::class, 'index'])->name('beranda');


Route::get('/about', function () {
    return view('pages.about');
})->name('about');

Route::get('/contact', function () {
})->name('contact');

Route::get('/services', function () {
    return view('pages.services');
})->name('services');

// Add your routes here

Route::get('/akun', function () {
    // Your Akun logic
})->name('akun');

Route::get('/settings', function () {
    // Your Settings logic
})->name('settings');
Route::get('/login', [AuthenticatedSessionController::class, 'create'])->name('login');

Route::get('produk',[produkController::class,'index']);
Route::middleware('auth')->group(function () {
    // Profile
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

});

// Include default auth routes (login, register, dll)
require __DIR__.'/auth.php';
