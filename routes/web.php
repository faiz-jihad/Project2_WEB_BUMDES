<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{
    ProfileController,
    Auth\AuthenticatedSessionController,
    HomeController,
    ProdukController,
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
use App\Http\Controllers\BeritaController;
use App\Http\Controllers\Penulis\BeritaController as PenulisBeritaController;
use App\Http\Controllers\PesananController;
use App\Http\Controllers\ContactController;


Route::get('/iot', [App\Http\Controllers\iotController::class, 'index'])->name('iot.index');

Route::get('/about', [BeritaController::class, 'index'])->name('about');



// Homepage
Route::get('/', [HomeController::class, 'index'])->name('beranda');
// Atau
Route::get('/beranda', [HomeController::class, 'index'])->name('home');


// Static pages
Route::view('/services', 'pages.services')->name('services');
Route::get('/contact', function () {
    return view('pages.contact');
})->name('contact');
Route::post('/kontak/kirim', [ContactController::class, 'kirim'])->name('contact.kirim');
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

    Route::get('/dashboard-choice', [DashboardController::class, 'choice'])->name('dashboard.choice');
    Route::post('/dashboard/admin', [DashboardController::class, 'goToAdmin'])->name('dashboard.admin');
    Route::post('/dashboard/home', [DashboardController::class, 'goToHome'])->name('dashboard.home');

    // Penulis routes
    Route::middleware('role:penulis')->group(function () {
        Route::get('/penulis/dashboard', [PenulisBeritaController::class, 'index'])->name('penulis.dashboard');
        Route::get('/penulis/berita', [PenulisBeritaController::class, 'index'])->name('penulis.berita.index');
        Route::get('/penulis/berita/{id_berita}', [PenulisBeritaController::class, 'show'])->name('penulis.berita.show');
        Route::post('/penulis/berita', [PenulisBeritaController::class, 'store'])->name('penulis.berita.store');
        Route::put('/penulis/berita/{id_berita}', [PenulisBeritaController::class, 'update'])->name('penulis.berita.update');
        Route::delete('/penulis/berita/{id_berita}', [PenulisBeritaController::class, 'destroy'])->name('penulis.berita.destroy');
    });

    // Pesanan routes - for authenticated users using UUID
    Route::get('/pesanan', [PesananController::class, 'index'])->name('pesanan.index');
    Route::get('/pesanan/{uuid}', [PesananController::class, 'show'])->name('pesanan.show');
    Route::get('/pesanan/{uuid}/edit', [PesananController::class, 'edit'])->name('pesanan.edit');
    Route::put('/pesanan/{uuid}', [PesananController::class, 'update'])->name('pesanan.update');
    Route::delete('/pesanan/{uuid}', [PesananController::class, 'destroy'])->name('pesanan.destroy');
    Route::post('/pesanan/{uuid}/mark-paid', [PesananController::class, 'markAsPaid'])->name('pesanan.mark-paid');
    Route::get('/pesanan/{uuid}/nota', [PesananController::class, 'nota'])->name('pesanan.nota');
});



// Produk routes
Route::get('/produk', [ProdukController::class, 'index'])->name('produk.index');
Route::get('/produk/{slug}', [ProdukController::class, 'show'])->name('produk.show');



// Berita
Route::get('/berita', [BeritaController::class, 'index'])->name('berita.index');
Route::get('/berita/kategori/{slug}', [BeritaController::class, 'kategori'])->name('berita.kategori');
Route::get('/berita/{slug}', [BeritaController::class, 'show'])->name('berita.show');
Route::post('/berita/{slug}/like', [BeritaController::class, 'like'])->name('berita.like')->middleware('auth');

// Keranjang
Route::get('/keranjang', [KeranjangController::class, 'index'])->name('keranjang.index');
Route::get('/keranjang/get', [KeranjangController::class, 'get'])->name('keranjang.get');
Route::post('/keranjang/tambah', [KeranjangController::class, 'tambah'])->name('keranjang.tambah');
Route::post('/keranjang/hapus', [KeranjangController::class, 'hapus'])->name('keranjang.hapus');
Route::post('/keranjang/update-jumlah', [KeranjangController::class, 'updateJumlah'])->name('keranjang.updateJumlah');

// Menampilkan halaman checkout
Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout.index');

// Proses pesanan setelah submit form
Route::post('/checkout/proses', [CheckoutController::class, 'proses'])->name('checkout.proses');

// galeri
Route::get('/galeri', [GaleriController::class, 'foto'])->name('galeri.index');

// Notif
Route::middleware(['auth'])->group(function () {
    Route::get('/notifikasi', [NotifikasiController::class, 'index'])->name('notifikasi.index');
    Route::post('/notifikasi/{id}/read', [NotifikasiController::class, 'markAsRead'])->name('notifikasi.read');
    Route::post('/notifikasi/read-all', [NotifikasiController::class, 'markAllAsRead'])->name('notifikasi.readAll');
    Route::post('/notifikasi/mark-read/{id}', [NotifikasiController::class, 'markRead'])->name('notifikasi.markRead');
});




// Auth scaffolding routes
require __DIR__ . '/auth.php';
