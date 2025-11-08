<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use App\Models\Pesanan;

class PesananCreated extends Notification implements ShouldQueue
{
    use Queueable;

    protected $pesanan;

    /**
     * Create a new notification instance.
     */
    public function __construct(Pesanan $pesanan)
    {
        $this->pesanan = $pesanan;
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
        return (new MailMessage)
            ->subject('Pesanan Baru #' . $this->pesanan->id_pesanan . ' Telah Dibuat')
            ->greeting('Halo ' . $notifiable->name . '!')
            ->line('Pesanan Anda telah berhasil dibuat.')
            ->line('ID Pesanan: #' . $this->pesanan->id_pesanan)
            ->line('Total: Rp ' . number_format($this->pesanan->total_harga, 0, ',', '.'))
            ->line('Status: Menunggu Pembayaran')
            ->action('Lihat Detail Pesanan', route('pesanan.show', $this->pesanan->id_pesanan))
            ->line('Silakan lakukan pembayaran sesuai metode yang dipilih.')
            ->salutation('Terima kasih telah berbelanja di toko kami.');
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            'pesanan_id' => $this->pesanan->id_pesanan,
            'total_harga' => $this->pesanan->total_harga,
            'status' => 'pending',
            'message' => 'Pesanan baru #' . $this->pesanan->id_pesanan . ' telah dibuat. Total: Rp ' . number_format($this->pesanan->total_harga, 0, ',', '.'),
            'url' => route('pesanan.show', $this->pesanan->id_pesanan),
        ];
    }
}
