<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produk extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama',
        'kategori_id',
        'deskripsi',
        'harga',
        'gambar'
    ];

    public function kategoriProduk()
    {
        return $this->belongsTo(KategoriProduk::class, 'kategori_id');
    }

    public function keranjangs()
    {
        return $this->hasMany(Keranjang::class, 'produk_id');
    }
}
