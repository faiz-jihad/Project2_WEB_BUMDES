<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class Berita extends Model
{
    protected $table = 'berita';
    protected static ?string $model = Berita::class;
    protected static ?string $navigationLabel = 'Berita';
    protected static ?string $pluralModelLabel = 'Berita';
    protected static ?string $modelLabel = 'Berita';

    protected $fillable = [
        'id_penulis',
        'id_kategori',
        'Judul',
        'slug',
        'Thumbnail',
        'Isi_Berita',
    ];

    public function penulis()
    {
        return $this->belongsTo(Penulis::class, 'id_penulis', 'id_penulis');
    }

    public function kategori()
    {
        return $this->belongsTo(KategoriBerita::class, 'id_kategori', 'id_kategori');
    }

    public function banner()
    {
        return $this->hasOne(Banner::class, 'id_berita', 'id_berita');
    }
}
