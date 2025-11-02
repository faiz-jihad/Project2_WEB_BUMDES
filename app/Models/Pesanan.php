<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Pesanan extends Model
{
    protected $primaryKey = 'id_pesanan';

    protected $fillable = [
        'user_id',
        'nama_pemesan',
        'alamat',
        'no_hp',
        'metode_pembayaran',
        'status',
        'items',
        'total_harga',
        'catatan',
    ];

    protected $casts = [
        'items' => 'array',
        'total_harga' => 'decimal:2',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    // Accessor untuk status dalam bahasa Indonesia
    public function getStatusLabelAttribute()
    {
        return match ($this->status) {
            'pending' => 'Menunggu Pembayaran',
            'sudah_bayar' => 'Sudah Bayar',
            'diproses' => 'Diproses',
            'dikirim' => 'Dikirim',
            'selesai' => 'Selesai',
            'dibatalkan' => 'Dibatalkan',
            default => $this->status,
        };
    }

    // Accessor untuk metode pembayaran dalam bahasa Indonesia
    public function getMetodePembayaranLabelAttribute()
    {
        return match ($this->metode_pembayaran) {
            'transfer' => 'Transfer Bank',
            'cod' => 'Bayar di Tempat',
            default => $this->metode_pembayaran,
        };
    }
}
