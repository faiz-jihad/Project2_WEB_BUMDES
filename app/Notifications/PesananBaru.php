<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use App\Models\Pesanan;

class PesananBaru extends Notification implements ShouldQueue
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
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        $pesanan = $this->pesanan;
        $itemsText = '';

        foreach ($pesanan->items as $item) {
            $itemsText .= "- {$item['nama']} (x{$item['jumlah']}) - Rp " . number_format($item['subtotal'], 0, ',', '.') . "\n";
        }

        return (new MailMessage)
            ->subject('Pesanan Baru #' . $pesanan->id_pesanan)
            ->greeting('Halo Admin!')
            ->line('Ada pesanan baru yang perlu diproses.')
            ->line('**Detail Pesanan:**')
            ->line('ID Pesanan: #' . $pesanan->id_pesanan)
            ->line('Nama Pemesan: ' . $pesanan->nama_pemesan)
            ->line('Alamat: ' . $pesanan->alamat)
            ->line('No HP: ' . $pesanan->no_hp)
            ->line('Metode Pembayaran: ' . $pesanan->metode_pembayaran_label)
            ->line('Total: Rp ' . number_format($pesanan->total_harga, 0, ',', '.'))
            ->line('')
            ->line('**Item Pesanan:**')
            ->line($itemsText)
            ->action('Lihat Detail Pesanan', url('/admin/pesanan/' . $pesanan->id_pesanan))
            ->line('Silakan proses pesanan ini segera.')
            ->salutation('Salam, Sistem E-commerce');
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
            'nama_pemesan' => $this->pesanan->nama_pemesan,
            'total_harga' => $this->pesanan->total_harga,
            'status' => $this->pesanan->status,
        ];
    }
}
