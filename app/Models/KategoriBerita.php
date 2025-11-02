<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

class KategoriBerita extends Model
{
    protected $table = 'kategori__berita';
    protected $primaryKey = 'id_kategori';
    protected $fillable = [
        'Judul',
        'slug',
    ];

    // Relasi ke model Berita
    public function berita()
    {
        return $this->hasMany(Berita::class, 'id_kategori', 'id_kategori');
    }

    // Auto-clear cache setiap data kategori diubah atau dihapus
    protected static function booted()
    {
        static::saved(function () {
            Cache::forget('kategori_berita');
        });

        static::deleted(function () {
            Cache::forget('kategori_berita');
        });
    }
}
