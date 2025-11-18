<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Penulis extends Model
{
    use Notifiable;

    protected $table = 'penulis';
    protected $primaryKey = 'id_penulis'; // ini penting!

    public $incrementing = true;  // true kalau kolom id_penulis auto increment
    protected $keyType = 'int';

    protected $fillable = [
        'nama_penulis',
        'email',
        'Username',
        'Password',
        'Avatar',
        'Bio',
    ];

    public function berita()
    {
        return $this->hasMany(Berita::class, 'id_penulis', 'id_penulis');
    }

    /**
     * Route notifications for the mail channel.
     */
    public function routeNotificationForMail($notification)
    {
        // Return the email address from the penulis table
        return $this->email;
    }

    /**
     * Route notifications for the database channel.
     */
    public function routeNotificationForDatabase($notification)
    {
        return $this->getKey();
    }
}
