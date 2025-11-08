<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use App\Models\Pesanan;

class PesananStatusUpdated extends Notification implements ShouldQueue
{
    use Queueable;

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
        return ['database', 'mail'];
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

        return (new MailMessage)
            ->subject('Status Pesanan #' . $this->pesanan->id_pesanan . ' Telah Diperbarui')
            ->greeting('Halo ' . $notifiable->name . '!')
            ->line('Status pesanan Anda telah diperbarui.')
            ->line('ID Pesanan: #' . $this->pesanan->id_pesanan)
            ->line('Status Lama: ' . ($statusLabels[$this->oldStatus] ?? $this->oldStatus))
            ->line('Status Baru: ' . ($statusLabels[$this->newStatus] ?? $this->newStatus))
            ->line('Total: Rp ' . number_format($this->pesanan->total_harga, 0, ',', '.'))
            ->action('Lihat Detail Pesanan', route('pesanan.show', $this->pesanan->id_pesanan))
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

        return [
            'pesanan_id' => $this->pesanan->id_pesanan,
            'old_status' => $this->oldStatus,
            'new_status' => $this->newStatus,
            'old_status_label' => $statusLabels[$this->oldStatus] ?? $this->oldStatus,
            'new_status_label' => $statusLabels[$this->newStatus] ?? $this->newStatus,
            'total_harga' => $this->pesanan->total_harga,
            'message' => 'Status pesanan #' . $this->pesanan->id_pesanan . ' telah diperbarui dari "' . ($statusLabels[$this->oldStatus] ?? $this->oldStatus) . '" menjadi "' . ($statusLabels[$this->newStatus] ?? $this->newStatus) . '"',
            'url' => route('pesanan.show', $this->pesanan->id_pesanan),
        ];
    }
}
