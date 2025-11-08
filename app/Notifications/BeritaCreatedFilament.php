<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use App\Models\Berita;
use App\Models\Penulis;

class BeritaCreatedFilament extends Notification implements ShouldQueue
{
    use Queueable;

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
        return ['database', 'mail'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
            ->subject('Berita Baru Dibuat - Filament Admin')
            ->markdown('berita-created-filament', [
                'berita' => $this->berita,
                'penulis' => $this->penulis,
                'admin' => $notifiable,
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
            'url' => route('filament.admin.resources.beritas.edit', $this->berita->id_berita),
            'type' => 'berita_created',
        ];
    }
}
