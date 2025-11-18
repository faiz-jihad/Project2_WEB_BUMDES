<?php

namespace App\Notifications;

use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\BroadcastMessage;
use Berkayk\OneSignal\OneSignalChannel;
use Berkayk\OneSignal\OneSignalMessage;
use App\Models\Pesanan;

class PesananCreated extends Notification
{
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
        return ['database', 'broadcast', OneSignalChannel::class];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        $produkNames = $this->getProdukNames();

        return (new MailMessage)
            ->subject('Pesanan Baru - ' . $this->pesanan->nama_pemesan)
            ->greeting('Halo ' . $notifiable->name . '!')
            ->line('Pesanan atas nama ' . $this->pesanan->nama_pemesan . ' telah berhasil dibuat.')
            ->line('Produk yang dibeli: ' . $produkNames)
            ->line('Total: Rp ' . number_format($this->pesanan->total_harga, 0, ',', '.'))
            ->line('Status: Menunggu Pembayaran')
            ->action('Lihat Detail Pesanan', route('pesanan.show', $this->pesanan->uuid))
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
        $produkNames = $this->getProdukNames();

        return [
            'pesanan_id' => $this->pesanan->id_pesanan,
            'total_harga' => $this->pesanan->total_harga,
            'status' => 'pending',
            'message' => 'Pesanan baru atas nama ' . $this->pesanan->nama_pemesan . ' telah dibuat. Produk: ' . $produkNames . '. Total: Rp ' . number_format($this->pesanan->total_harga, 0, ',', '.'),
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

    /**
     * Get the broadcast representation of the notification.
     */
    public function toBroadcast(object $notifiable): BroadcastMessage
    {
        $produkNames = $this->getProdukNames();

        return new BroadcastMessage([
            'pesanan_id' => $this->pesanan->id_pesanan,
            'nama_pemesan' => $this->pesanan->nama_pemesan,
            'total_harga' => $this->pesanan->total_harga,
            'produk' => $produkNames,
            'message' => 'Pesanan baru atas nama ' . $this->pesanan->nama_pemesan . ' telah dibuat. Produk: ' . $produkNames . '. Total: Rp ' . number_format($this->pesanan->total_harga, 0, ',', '.'),
            'url' => route('pesanan.show', $this->pesanan->uuid),
        ]);
    }

    /**
     * Get the OneSignal representation of the notification.
     */
    public function toOneSignal(object $notifiable): OneSignalMessage
    {
        $produkNames = $this->getProdukNames();

        return OneSignalMessage::create()
            ->setSubject('Pesanan Baru')
            ->setBody('Pesanan baru atas nama ' . $this->pesanan->nama_pemesan . ' telah dibuat. Produk: ' . $produkNames)
            ->setUrl(route('pesanan.show', $this->pesanan->uuid))
            ->setData('pesanan_id', $this->pesanan->id_pesanan)
            ->setData('type', 'pesanan')
            ->setData('url', route('pesanan.show', $this->pesanan->uuid));
    }
}
