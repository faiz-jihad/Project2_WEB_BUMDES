<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Cache;
use App\Models\KategoriBerita;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Membagikan data kategori ke semua view
        View::composer('*', function ($view) {
            // Simpan hasil query ke cache selama 1 jam (3600 detik)
            $kategoriBerita = Cache::remember('kategori_berita', 3600, function () {
                return KategoriBerita::all();
            });

            // Kirim ke semua view
            $view->with('kategoriBerita', $kategoriBerita);
        });
    }
}
