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
use App\Http\Controllers\{
    DashboardController,
    KeranjangController,
    AkunController,
    GaleriController,
    CheckoutController,
    NotifikasiController,
    IotController,
    BeritaController,
    PesananController,
    ContactController,
};
use App\Http\Controllers\Penulis\BeritaController as PenulisBeritaController;

/* =============================================================
|  GLOBAL SECURITY MIDDLEWARE (RATE LIMIT)
|  throttle:global
*/
Route::middleware('throttle:global')->group(function () {

    /* ----------------------- PUBLIC STATIC PAGES ----------------------- */
    Route::get('/', [HomeController::class, 'index'])->name('beranda');
    Route::get('/beranda', [HomeController::class, 'index'])->name('home');

    Route::view('/services', 'pages.services')->name('services');
    Route::get('/contact', fn() => view('pages.contact'))->name('contact');
    Route::post('/kontak/kirim', [ContactController::class, 'kirim'])
        ->middleware('throttle:10,1')  // anti spam
        ->name('contact.kirim');
    Route::view('/akun', 'pages.akun')->name('akun');
    Route::view('/settings', 'pages.settings')->name('settings');

    /* ----------------------- BERITA ----------------------- */
    Route::get('/about', [BeritaController::class, 'index'])->name('about');
    Route::get('/berita', [BeritaController::class, 'index'])->name('berita.index');
    Route::get('/berita/kategori/{slug}', [BeritaController::class, 'kategori'])->name('berita.kategori');
    Route::get('/berita/{slug}', [BeritaController::class, 'show'])->name('berita.show');
    Route::post('/berita/{slug}/like', [BeritaController::class, 'like'])
        ->middleware(['auth', 'throttle:20,1'])
        ->name('berita.like');

    /* ----------------------- PRODUK ----------------------- */
    Route::get('/produk', [ProdukController::class, 'index'])->name('produk.index');
    Route::get('/produk/{slug}', [ProdukController::class, 'show'])->name('produk.show');

    /* ----------------------- GALERI ----------------------- */
    Route::get('/galeri', [GaleriController::class, 'foto'])->name('galeri.index');

    /* ----------------------- KERANJANG ----------------------- */
    Route::get('/keranjang', [KeranjangController::class, 'index'])->name('keranjang.index');
    Route::get('/keranjang/get', [KeranjangController::class, 'get'])
        ->middleware('throttle:30,1')
        ->name('keranjang.get');
    Route::post('/keranjang/tambah', [KeranjangController::class, 'tambah'])
        ->middleware('throttle:20,1')
        ->name('keranjang.tambah');
    Route::post('/keranjang/hapus', [KeranjangController::class, 'hapus'])
        ->middleware('throttle:20,1')
        ->name('keranjang.hapus');
    Route::post('/keranjang/update-jumlah', [KeranjangController::class, 'updateJumlah'])
        ->middleware('throttle:15,1')
        ->name('keranjang.updateJumlah');

    /* ----------------------- CHECKOUT ----------------------- */
    Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout.index');
    Route::post('/checkout/proses', [CheckoutController::class, 'proses'])
        ->middleware('auth', 'throttle:10,1')
        ->name('checkout.proses');
});

/* =============================================================
|  AUTHENTICATION ROUTES (rate-limited)
*/
Route::middleware('throttle:10,1')->group(function () {
    Route::get('/login', [AuthenticatedSessionController::class, 'create'])->name('login');
    Route::get('/register', [RegisteredUserController::class, 'create'])->name('register');
});

Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');

/* =============================================================
|  SOCIAL AUTH
*/
Route::middleware('throttle:20,1')->group(function () {
    Route::get('/auth/{provider}', [SocialiteController::class, 'redirect'])->name('socialite.redirect');
    Route::get('/auth/{provider}/callback', [SocialiteController::class, 'callback'])->name('socialite.callback');
});

/* =============================================================
|  AUTHENTICATED ROUTES
*/
Route::middleware(['auth', 'throttle:global'])->group(function () {

    /* PROFILE */
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    /* DASHBOARD CHOICE */
    Route::get('/dashboard-choice', [DashboardController::class, 'choice'])->name('dashboard.choice');
    Route::post('/dashboard/admin', [DashboardController::class, 'goToAdmin'])->name('dashboard.admin');
    Route::post('/dashboard/home', [DashboardController::class, 'goToHome'])->name('dashboard.home');

    /* AKUN */
    Route::get('/akun', [AkunController::class, 'index'])->name('akun.index');
    Route::post('/akun/update', [AkunController::class, 'update'])->name('akun.update');

    /* NOTIFIKASI */
    Route::get('/notifikasi', [NotifikasiController::class, 'index'])->name('notifikasi.index');
    Route::post('/notifikasi/{id}/read', [NotifikasiController::class, 'markAsRead'])->name('notifikasi.read');
    Route::post('/notifikasi/read-all', [NotifikasiController::class, 'markAllAsRead'])->name('notifikasi.readAll');
    Route::post('/notifikasi/mark-read/{id}', [NotifikasiController::class, 'markRead'])->name('notifikasi.markRead');

    /* PESANAN (UUID) */
    Route::get('/pesanan', [PesananController::class, 'index'])->name('pesanan.index');
    Route::get('/pesanan/{uuid}', [PesananController::class, 'show'])->name('pesanan.show');
    Route::get('/pesanan/{uuid}/edit', [PesananController::class, 'edit'])->name('pesanan.edit');
    Route::put('/pesanan/{uuid}', [PesananController::class, 'update'])->name('pesanan.update');
    Route::delete('/pesanan/{uuid}', [PesananController::class, 'destroy'])->name('pesanan.destroy');
    Route::post('/pesanan/{uuid}/mark-paid', [PesananController::class, 'markAsPaid'])->name('pesanan.mark-paid');
    Route::get('/pesanan/{uuid}/nota', [PesananController::class, 'nota'])->name('pesanan.nota');

    /* PENULIS ROUTES */
    Route::middleware('role:penulis')->group(function () {
        Route::get('/penulis/dashboard', [PenulisBeritaController::class, 'index'])->name('penulis.dashboard');
        Route::get('/penulis/berita', [PenulisBeritaController::class, 'index'])->name('penulis.berita.index');
        Route::get('/penulis/berita/{id_berita}', [PenulisBeritaController::class, 'show'])->name('penulis.berita.show');
        Route::post('/penulis/berita', [PenulisBeritaController::class, 'store'])->name('penulis.berita.store');
        Route::put('/penulis/berita/{id_berita}', [PenulisBeritaController::class, 'update'])->name('penulis.berita.update');
        Route::delete('/penulis/berita/{id_berita}', [PenulisBeritaController::class, 'destroy'])->name('penulis.berita.destroy');
    });
});
Route::post('/save-subscription', [WebPushController::class, 'saveSubscription']);
Route::get('/send-push/{id}', [WebPushController::class, 'sendPush']);

/* =============================================================
|  ADMIN ROUTES (IP + ROLE PROTECTION)
*/
Route::middleware(['auth', 'role:admin', 'throttle:global'])->group(function () {
    Route::get('/iot', [IotController::class, 'index'])->name('iot.index');
});

/* ============================================================= */
require __DIR__ . '/auth.php';
