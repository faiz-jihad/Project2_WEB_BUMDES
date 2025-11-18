<?php

namespace App\Notifications;

use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\BroadcastMessage;
use Berkayk\OneSignal\OneSignalChannel;
use Berkayk\OneSignal\OneSignalMessage;
use App\Models\Berita;
use App\Models\Penulis;

class BeritaCreated extends Notification
{

    protected $berita;
    protected $penulis;

    /**
     * Create a new notification instance.
     */
    public function __construct(Berita $berita, Penulis $penulis)
    {
        $this->berita = $berita;
        $this->penulis = $penulis;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['database', 'broadcast'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
            ->subject('Berita Baru Telah Dibuat')
            ->greeting('Halo ' . $notifiable->name . '!')
            ->line('Berita baru telah dibuat oleh penulis ' . $this->penulis->nama_penulis)
            ->line('Judul: ' . $this->berita->Judul)
            ->line('Kategori: ' . $this->berita->kategoriBerita->Judul ?? 'Tidak ada kategori')
            ->action('Lihat Berita', route('berita.show', $this->berita->slug))
            ->line('Silakan tinjau berita ini di panel admin.')
            ->salutation('Salam, Sistem Berita');
    }

    /**
     * Get the broadcast representation of the notification.
     */
    public function toBroadcast(object $notifiable): BroadcastMessage
    {
        return new BroadcastMessage([
            'berita_id' => $this->berita->id_berita,
            'judul' => $this->berita->Judul,
            'slug' => $this->berita->slug,
            'penulis' => $this->penulis->nama_penulis,
            'kategori' => $this->berita->kategoriBerita->Judul ?? 'Tidak ada kategori',
            'message' => 'Berita baru "' . $this->berita->Judul . '" telah dibuat oleh ' . $this->penulis->nama_penulis,
            'url' => route('berita.show', $this->berita->slug),
        ]);
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            'berita_id' => $this->berita->id_berita,
            'judul' => $this->berita->Judul,
            'slug' => $this->berita->slug,
            'penulis' => $this->penulis->nama_penulis,
            'kategori' => $this->berita->kategoriBerita->Judul ?? 'Tidak ada kategori',
            'message' => 'Berita baru "' . $this->berita->Judul . '" telah dibuat oleh ' . $this->penulis->nama_penulis,
            'url' => route('berita.show', $this->berita->slug),
        ];
    }

    /**
     * Get the OneSignal representation of the notification.
     */
    public function toOneSignal(object $notifiable): OneSignalMessage
    {
        return OneSignalMessage::create()
            ->setSubject('Berita Baru')
            ->setBody('Berita baru "' . $this->berita->Judul . '" telah dibuat oleh ' . $this->penulis->nama_penulis)
            ->setUrl(route('berita.show', $this->berita->slug))
            ->setData('berita_id', $this->berita->id_berita)
            ->setData('type', 'berita')
            ->setData('url', route('berita.show', $this->berita->slug));
    }
}
