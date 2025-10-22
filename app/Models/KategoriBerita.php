<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class KategoriBerita extends Model
{
    protected $table = 'kategori__berita';
    protected $primaryKey = 'id_kategori';
    protected $fillable = [
        'Judul',
        'slug',
    ];

    public function berita()
    {
        return $this->hasMany(Berita::class, 'id_kategori', 'id_kategori');
    }
}
