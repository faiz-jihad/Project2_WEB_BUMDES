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
use App\Http\Controllers\AkunController;
use App\Http\Controllers\GaleriController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\NotifikasiController;
use App\Http\Controllers\IotController;


Route::get('/iot', [App\Http\Controllers\iotController::class, 'index']);


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

Route::get('/akun', [AkunController::class, 'index'])->name('akun.index');
Route::post('/akun/update', [AkunController::class, 'update'])->name('akun.update');


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


Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/iot', [iotController::class, 'index']);
});



// Berita
Route::get('/berita', [BeritaController::class, 'index'])->name('berita.index');
Route::get('/berita/{slug}', [BeritaController::class, 'show'])->name('berita.show');

// Keranjang
Route::get('/keranjang', [KeranjangController::class, 'index'])->name('keranjang.index');
Route::post('/keranjang/tambah', [KeranjangController::class, 'tambah'])->name('keranjang.tambah');
Route::post('/keranjang/hapus', [KeranjangController::class, 'hapus'])->name('keranjang.hapus');
Route::post('/keranjang/update-jumlah', [KeranjangController::class, 'updateJumlah'])->name('keranjang.updateJumlah');

// Menampilkan halaman checkout
Route::get('/checkout', [checkoutController::class, 'index'])->name('checkout.index');

// Proses pesanan setelah submit form
Route::post('/checkout/proses', [checkoutController::class, 'proses'])->name('checkout.proses');

// galeri
Route::get('/galeri', [GaleriController::class, 'foto'])->name('galeri.index');

// Notif
Route::middleware(['auth'])->group(function () {
    Route::get('/notifikasi', [NotifikasiController::class, 'index'])->name('notifikasi.index');
    Route::get('/notifikasi/{id}/read', [NotifikasiController::class, 'markAsRead'])->name('notifikasi.read');
    Route::get('/notifikasi/read-all', [NotifikasiController::class, 'markAllAsRead'])->name('notifikasi.readAll');
});


Route::get('/dashboard', [DashboardController::class, 'index']);
Route::post('/pump', [DashboardController::class, 'controlPump'])->name('pump.control');

Route::get('/beranda', [HomeController::class, 'index'])->name('beranda');


// Auth scaffolding routes
require __DIR__ . '/auth.php';
