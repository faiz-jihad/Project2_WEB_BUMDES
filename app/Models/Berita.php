<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Berita extends Model
{
    protected $table = 'berita';
    protected $primaryKey = 'id_berita';
    public $incrementing = true;
    protected $keyType = 'int';

    protected $fillable = [
        'id_penulis',
        'id_kategori',
        'Judul',
        'slug',
        'Thumbnail',
        'Isi_Berita',
        'status',
    ];

    /*
    |--------------------------------------------------------------------------
    | RELATIONSHIPS
    |--------------------------------------------------------------------------
    */
    public function user()
    {
        return $this->belongsTo(User::class, 'id_penulis');
    }

    public function penulis()
    {
        return $this->belongsTo(Penulis::class, 'id_penulis', 'id_penulis');
    }

    public function kategoriBerita()
    {
        return $this->belongsTo(KategoriBerita::class, 'id_kategori', 'id_kategori');
    }

    public function banner()
    {
        return $this->hasOne(Banner::class, 'berita_id', 'id_berita');
    }

    /*
    |--------------------------------------------------------------------------
    | ACCESSOR (opsional)
    |--------------------------------------------------------------------------
    | Supaya path relatif seperti `thumbnails/foo.jpg` otomatis
    | menjadi URL publik `/storage/thumbnails/foo.jpg`
    */
    public function getThumbnailUrlAttribute(): ?string
    {
        return $this->Thumbnail
            ? Storage::url($this->Thumbnail)
            : null;
    }

    /*
    |--------------------------------------------------------------------------
    | MODEL EVENTS
    |--------------------------------------------------------------------------
    | Hapus file fisik saat data dihapus, dan tangani kasus error dengan aman
    */
    protected static function booted()
    {
        static::deleting(function (Berita $berita) {
            if ($berita->Thumbnail && Storage::disk('public')->exists($berita->Thumbnail)) {
                Storage::disk('public')->delete($berita->Thumbnail);
            }
        });
    }
}
