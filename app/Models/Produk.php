<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Produk extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama',
        'kategori_id',
        'deskripsi',
        'harga',
        'gambar',
        'slug',
        'stok',
        'views_count'
    ];

    protected $casts = [
        'harga' => 'decimal:2',
        'stok' => 'integer',
        'views_count' => 'integer',
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($produk) {
            if (empty($produk->slug)) {
                $produk->slug = Str::slug($produk->nama);
            }
        });

        static::updating(function ($produk) {
            if ($produk->isDirty('nama') && empty($produk->slug)) {
                $produk->slug = Str::slug($produk->nama);
            }
        });
    }

    public function kategoriProduk()
    {
        return $this->belongsTo(KategoriProduk::class, 'kategori_id');
    }

    public function keranjangs()
    {
        return $this->hasMany(Keranjang::class, 'produk_id');
    }

    /*
    |--------------------------------------------------------------------------
    | VIEW LOGS RELATIONSHIP
    |--------------------------------------------------------------------------
    */
    public function viewLogs()
    {
        return $this->morphMany(ViewLog::class, 'entity');
    }

    public function getKategoriAttribute()
    {
        return $this->kategoriProduk->nama_kategori ?? '';
    }

    /**
     * Increment views count
     */
    public function incrementViews()
    {
        $this->increment('views_count');
    }

    /**
     * Get formatted view count
     */
    public function getFormattedViewsAttribute()
    {
        return number_format($this->views_count ?? 0);
    }

    /**
     * Get formatted price
     */
    public function getFormattedPriceAttribute()
    {
        return 'Rp ' . number_format($this->harga, 0, ',', '.');
    }

    /**
     * Check if product is in stock
     */
    public function isInStock()
    {
        return $this->stok > 0;
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }
}
