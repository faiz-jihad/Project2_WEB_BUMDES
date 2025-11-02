<?php

namespace App\Notifications;

use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use App\Models\Produk;
use App\Models\User;

class ProductUpdated extends Notification
{

    protected $produk;
    protected $user;
    protected $action;

    /**
     * Create a new notification instance.
     */
    public function __construct(Produk $produk, User $user, string $action = 'updated')
    {
        $this->produk = $produk;
        $this->user = $user;
        $this->action = $action;
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
        $actionText = $this->action === 'created' ? 'dibuat' : 'diperbarui';

        return (new MailMessage)
            ->subject('Produk Telah ' . ucfirst($actionText))
            ->greeting('Halo ' . $notifiable->name . '!')
            ->line('Produk "' . $this->produk->nama_produk . '" telah ' . $actionText . ' oleh ' . $this->user->name)
            ->line('Kategori: ' . ($this->produk->kategoriProduk->nama_kategori ?? 'Tidak ada kategori'))
            ->line('Harga: Rp ' . number_format($this->produk->harga, 0, ',', '.'))
            ->action('Lihat Produk', route('produk.show', $this->produk->slug))
            ->line('Silakan tinjau produk ini di panel admin.')
            ->salutation('Salam, Sistem Produk');
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        $actionText = $this->action === 'created' ? 'dibuat' : 'diperbarui';

        return [
            'produk_id' => $this->produk->id_produk,
            'nama_produk' => $this->produk->nama_produk,
            'slug' => $this->produk->slug,
            'user' => $this->user->name,
            'kategori' => $this->produk->kategoriProduk->nama_kategori ?? 'Tidak ada kategori',
            'harga' => $this->produk->harga,
            'action' => $this->action,
            'message' => 'Produk "' . $this->produk->nama_produk . '" telah ' . $actionText,
            'url' => route('produk.show', $this->produk->slug),
        ];
    }
}
