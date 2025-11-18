<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Cache;
use App\Models\KategoriBerita;
use App\Providers\Filament\CustomLogoutResponse;
use Filament\Panel;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(\Filament\Http\Responses\Auth\Contracts\LogoutResponse::class, \App\Providers\Filament\CustomLogoutResponse::class);
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
