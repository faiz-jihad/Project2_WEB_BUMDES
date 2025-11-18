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
        'publish_at',
        'views_count',
    ];

    protected $casts = [
        'publish_at' => 'datetime',
        'views_count' => 'integer',
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
    | LIKES RELATIONSHIP
    |--------------------------------------------------------------------------
    */
    public function likedByUsers()
    {
        return $this->belongsToMany(User::class, 'berita_user', 'berita_id', 'user_id')
            ->withTimestamps();
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
    | HELPER METHODS
    |--------------------------------------------------------------------------
    */
    public function isLikedBy(User $user)
    {
        return $this->likedByUsers()->where('user_id', $user->id)->exists();
    }

    public function likesCount()
    {
        return $this->likedByUsers()->count();
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
