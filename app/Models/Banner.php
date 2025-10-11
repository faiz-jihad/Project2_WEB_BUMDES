<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Banner extends Model
{
    protected $fillable = [
        'id_berita'
    ];

    public function berita()
    {
        return $this->belongsTo(Berita::class, 'id_berita', 'id_berita');
    }
}
