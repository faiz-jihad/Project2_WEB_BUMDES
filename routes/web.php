<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{
    ProfileController,
    Auth\AuthenticatedSessionController,
    HomeController,
    ProdukController,
    BeritaController,
    Auth\RegisteredUserController,
    Auth\SocialiteController,

};
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\DashboardController;
 use App\Http\Controllers\keranjangController;



// Homepage
Route::get('/', [HomeController::class, 'index'])->name('beranda');
Route::get('/beranda', [HomeController::class, 'index']);

// Static pages
Route::view('/about', 'pages.about')->name('about');
Route::view('/services', 'pages.services')->name('services');
Route::view('/contact', 'pages.contact')->name('contact');
Route::view('/akun', 'pages.akun')->name('akun');
Route::view('/settings', 'pages.settings')->name('settings');

// Dynamic pages
Route::get('/berita', [BeritaController::class, 'index'])->name('berita');
Route::get('/produk', [ProdukController::class, 'index'])->name('produk');

// Authentication (Breeze)
Route::get('/login', [AuthenticatedSessionController::class, 'create'])->name('login');
Route::get('/register', [RegisteredUserController::class, 'create'])->name('register');
Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');

//
Route::middleware(['auth'])->group(function () {
    Route::get('/akun', [ProfileController::class, 'index'])->name('akun');
    Route::post('/akun/update', [ProfileController::class, 'update'])->name('akun.update');
});

// Google OAuth routes (Socialite)
Route::get('/auth/{provider}', [SocialiteController::class, 'redirect'])->name('socialite.redirect');
Route::get('/auth/{provider}/callback', [SocialiteController::class, 'callback'])->name('socialite.callback');

// Protected routes (requires login)
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Produk routes
Route::get('/produk', [ProdukController::class, 'index'])->name('produk.index');
Route::get('/produk/{id}', [ProdukController::class, 'show'])->name('produk.show');

// Sensor data
Route::get('/sensors/latest', function () {
    return \App\Models\SensorData::latest()->first();
});

// Berita
Route::get('/berita', [BeritaController::class, 'index'])->name('berita.index');
Route::get('/berita/{slug}', [BeritaController::class, 'show'])->name('berita.show');

Route::get('/keranjang', [keranjangController::class, 'index'])->name('keranjang.index');
Route::post('/keranjang/tambah', [keranjangController::class, 'tambah'])->name('keranjang.tambah');
Route::post('/keranjang/hapus', [keranjangController::class, 'hapus'])->name('keranjang.hapus');



Route::get('/dashboard', [DashboardController::class, 'index']);
Route::post('/pump', [DashboardController::class, 'controlPump'])->name('pump.control');

Route::get('/beranda', [HomeController::class, 'index'])->name('beranda');


// Auth scaffolding routes
require __DIR__ . '/auth.php';
