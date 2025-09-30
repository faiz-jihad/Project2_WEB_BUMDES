<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AuthenticatedSessionController;
use Illuminate\Support\Facades\Route;

// Redirect root ke /Beranda
Route::redirect('/', '/Beranda');

// Halaman Beranda (hanya bisa diakses setelah login & verifikasi email)
Route::get('/Beranda', function () {
    return view('pages.Beranda'); // Pastikan file: resources/views/pages/Beranda.blade.php
})->middleware(['auth', 'verified'])->name('Beranda');

Route::get('/about', function () {
    return view('pages.about'); // Pastikan file: resources/views/pages/about.blade.php
})->name('about');

Route::get('/contact', function () {
    return view('pages.contact'); // Pastikan file: resources/views/pages/contact.blade.php
})->name('contact');

Route::get('/services', function () {
    return view('pages.services'); // Pastikan file: resources/views/pages/services.blade.php
})->name('services');

// Grup route dengan middleware auth
Route::middleware('auth')->group(function () {
    // Profile
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Logout (harus POST)
    Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');
});

// Include default auth routes (login, register, dll)
require __DIR__.'/auth.php';
