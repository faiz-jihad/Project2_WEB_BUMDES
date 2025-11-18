<?php

namespace App\Notifications;

use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use App\Models\Pesanan;

class PesananStatusUpdated extends Notification
{
    protected $pesanan;
    protected $oldStatus;
    protected $newStatus;

    /**
     * Create a new notification instance.
     */
    public function __construct(Pesanan $pesanan, string $oldStatus, string $newStatus)
    {
        $this->pesanan = $pesanan;
        $this->oldStatus = $oldStatus;
        $this->newStatus = $newStatus;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['database'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        $statusLabels = [
            'pending' => 'Menunggu Pembayaran',
            'sudah_bayar' => 'Sudah Bayar',
            'diproses' => 'Diproses',
            'dikirim' => 'Dikirim',
            'selesai' => 'Selesai',
            'dibatalkan' => 'Dibatalkan',
        ];

        $produkNames = $this->getProdukNames();

        return (new MailMessage)
            ->subject('Status Pesanan ' . $this->pesanan->nama_pemesan . ' Telah Diperbarui')
            ->greeting('Halo ' . $notifiable->name . '!')
            ->line('Status pesanan atas nama ' . $this->pesanan->nama_pemesan . ' telah diperbarui.')
            ->line('Produk: ' . $produkNames)
            ->line('Status Lama: ' . ($statusLabels[$this->oldStatus] ?? $this->oldStatus))
            ->line('Status Baru: ' . ($statusLabels[$this->newStatus] ?? $this->newStatus))
            ->line('Total: Rp ' . number_format($this->pesanan->total_harga, 0, ',', '.'))
            ->action('Lihat Detail Pesanan', route('pesanan.show', $this->pesanan->uuid))
            ->line('Terima kasih telah berbelanja di toko kami.')
            ->salutation('Salam, Sistem E-commerce');
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        $statusLabels = [
            'pending' => 'Menunggu Pembayaran',
            'sudah_bayar' => 'Sudah Bayar',
            'diproses' => 'Diproses',
            'dikirim' => 'Dikirim',
            'selesai' => 'Selesai',
            'dibatalkan' => 'Dibatalkan',
        ];

        $produkNames = $this->getProdukNames();

        return [
            'pesanan_id' => $this->pesanan->id_pesanan,
            'old_status' => $this->oldStatus,
            'new_status' => $this->newStatus,
            'old_status_label' => $statusLabels[$this->oldStatus] ?? $this->oldStatus,
            'new_status_label' => $statusLabels[$this->newStatus] ?? $this->newStatus,
            'total_harga' => $this->pesanan->total_harga,
            'message' => 'Status pesanan atas nama ' . $this->pesanan->nama_pemesan . ' (' . $produkNames . ') telah diperbarui dari "' . ($statusLabels[$this->oldStatus] ?? $this->oldStatus) . '" menjadi "' . ($statusLabels[$this->newStatus] ?? $this->newStatus) . '"',
            'url' => route('pesanan.show', $this->pesanan->uuid),
        ];
    }

    /**
     * Get produk names from the order items
     */
    private function getProdukNames(): string
    {
        $items = $this->pesanan->items ?? [];
        if (is_string($items)) {
            $items = json_decode($items, true) ?? [];
        }

        if (isset($items['produk_id'])) {
            $items = [$items];
        }

        $names = [];
        foreach ($items as $item) {
            if (isset($item['nama'])) {
                $names[] = $item['nama'];
            } elseif (isset($item['nama_produk'])) {
                $names[] = $item['nama_produk'];
            }
        }

        return implode(', ', $names) ?: 'Produk tidak ditemukan';
    }
}
