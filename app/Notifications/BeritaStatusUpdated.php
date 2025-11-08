<?php

namespace App\Notifications;

use App\Models\Berita;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class BeritaStatusUpdated extends Notification implements ShouldQueue
{
    use Queueable;

    protected Berita $berita;
    protected string $status;

    /**
     * Create a new notification instance.
     */
    public function __construct(Berita $berita, string $status)
    {
        $this->berita = $berita;
        $this->status = $status;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail', 'database'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        $statusText = match ($this->status) {
            'approved' => 'Disetujui',
            'rejected' => 'Ditolak',
            default => 'Menunggu Persetujuan'
        };

        $subject = "Berita Anda: {$statusText}";

        return (new MailMessage)
            ->subject($subject)
            ->greeting("Halo {$notifiable->nama_penulis},")
            ->line("Berita Anda **\"{$this->berita->Judul}\"** telah {$statusText} oleh admin.")
            ->when($this->status === 'approved', function ($mail) {
                return $mail->action('Lihat Berita', route('berita.show', $this->berita->slug));
            })
            ->when($this->status === 'rejected', function ($mail) {
                return $mail->line('Silakan periksa kembali konten berita Anda dan ajukan ulang jika diperlukan.');
            })
            ->line('Terima kasih atas kontribusi Anda!')
            ->salutation('Salam, Tim Admin');
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        $statusText = match ($this->status) {
            'approved' => 'Disetujui',
            'rejected' => 'Ditolak',
            default => 'Menunggu Persetujuan'
        };

        return [
            'berita_id' => $this->berita->id_berita,
            'judul' => $this->berita->Judul,
            'slug' => $this->berita->slug,
            'status' => $this->status,
            'status_text' => $statusText,
            'message' => "Berita \"{$this->berita->Judul}\" telah {$statusText}",
            'url' => $this->status === 'approved' ? route('berita.show', $this->berita->slug) : null,
            'type' => 'berita_status_updated',
        ];
    }
}
