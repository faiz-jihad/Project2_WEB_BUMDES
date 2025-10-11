<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Penulis extends Model
{
    protected $table = 'penulis'; 
    protected $primaryKey = 'id_penulis'; // ini penting!

    public $incrementing = true;  // true kalau kolom id_penulis auto increment
    protected $keyType = 'int';

    protected $fillable = [
        'nama_penulis',
        'Username',
        'Password',
        'Avatar',
        'Bio',
    ];

    public function berita()
    {
        return $this->hasMany(Berita::class, 'id_penulis', 'id_penulis');
    }
}
