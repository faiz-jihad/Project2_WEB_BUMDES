<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\Produk;
use Illuminate\Support\Str;

class Pesanan extends Model
{
    // 👇 Tambahkan ini agar Laravel tahu nama tabel sebenarnya
    protected $table = 'pesanans';

    protected $primaryKey = 'id_pesanan';
    public $incrementing = true; // karena id_pesanan masih integer
    protected $keyType = 'int';

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
        'uuid', // 👈 pastikan ini ada di fillable
    ];

    protected $casts = [
        'items' => 'array',
        'total_harga' => 'decimal:2',
    ];

    // 🧠 Properti sementara (tidak disimpan ke database)
    protected $oldStatus = null;

    // Relasi
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    // =======================
    // LABELS
    // =======================
    public function getStatusLabelAttribute(): string
    {
        return match ($this->status) {
            'pending'     => 'Menunggu Pembayaran',
            'sudah_bayar' => 'Sudah Bayar',
            'diproses'    => 'Diproses',
            'dikirim'     => 'Dikirim',
            'selesai'     => 'Selesai',
            'dibatalkan'  => 'Dibatalkan',
            default       => ucfirst($this->status ?? '-'),
        };
    }

    public function getMetodePembayaranLabelAttribute(): string
    {
        return match ($this->metode_pembayaran) {
            'transfer' => 'Transfer Bank',
            'cod'      => 'Bayar di Tempat',
            default    => ucfirst($this->metode_pembayaran ?? '-'),
        };
    }

    // =======================
    // EVENT HOOKS
    // =======================
    protected static function booted()
    {
        // 🆔 Tambahkan UUID otomatis setiap pesanan baru dibuat
        static::creating(function ($pesanan) {
            $pesanan->uuid = (string) Str::uuid();
        });

        // 🔸 Kurangi stok setelah pesanan dibuat (hanya untuk COD)
        static::created(function ($pesanan) {
            // Hanya kurangi stok untuk COD, transfer menunggu konfirmasi pembayaran
            if ($pesanan->metode_pembayaran === 'cod') {
                $items = self::normalizeItems($pesanan->items);

                foreach ($items as $item) {
                    $produkId = $item['produk_id'] ?? null;
                    $jumlah   = $item['jumlah'] ?? 0;

                    if ($produkId && $jumlah > 0) {
                        Produk::where('id', $produkId)->decrement('stok', $jumlah);
                    }
                }
            }
        });

        // 🔹 Simpan status lama sebelum update
        static::saving(function ($pesanan) {
            $pesanan->oldStatus = $pesanan->exists ? $pesanan->getOriginal('status') : null;
        });

        // 🔹 Setelah disimpan, tangani perubahan status
        static::saved(function ($pesanan) {
            // Jika status berubah ke 'sudah_bayar' untuk transfer, kurangi stok
            if ($pesanan->oldStatus === 'pending' && $pesanan->status === 'sudah_bayar' && $pesanan->metode_pembayaran === 'transfer') {
                $items = self::normalizeItems($pesanan->items);

                foreach ($items as $item) {
                    $produkId = $item['produk_id'] ?? null;
                    $jumlah   = $item['jumlah'] ?? 0;

                    if ($produkId && $jumlah > 0) {
                        Produk::where('id', $produkId)->decrement('stok', $jumlah);
                    }
                }
            }

            // Jika status berubah ke 'dibatalkan', kembalikan stok
            if ($pesanan->oldStatus !== 'dibatalkan' && $pesanan->status === 'dibatalkan') {
                $items = self::normalizeItems($pesanan->items);

                foreach ($items as $item) {
                    $produkId = $item['produk_id'] ?? null;
                    $jumlah   = $item['jumlah'] ?? 0;

                    if ($produkId && $jumlah > 0) {
                        Produk::where('id', $produkId)->increment('stok', $jumlah);
                    }
                }
            }
        });
    }

    /**
     * Helper: ubah items jadi array of item (tangani string JSON / object tunggal)
     */
    protected static function normalizeItems($items): array
    {
        if (blank($items)) {
            return [];
        }

        if (is_string($items)) {
            $decoded = json_decode($items, true);
        } else {
            $decoded = $items;
        }

        if (isset($decoded['produk_id'])) {
            $decoded = [$decoded];
        }

        return is_array($decoded) ? $decoded : [];
    }
}
