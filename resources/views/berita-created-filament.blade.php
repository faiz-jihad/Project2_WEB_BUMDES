<x-mail::message>
    # Berita Baru Telah Dibuat

    Halo **{{ $admin->name }}**,

    Berita baru telah berhasil dibuat di panel admin Filament.

    ## Detail Berita:
    - **Judul**: {{ $berita->Judul }}
    - **Penulis**: {{ $penulis->nama_penulis }}
    - **Kategori**: {{ $berita->kategoriBerita->Judul ?? 'Tidak ada kategori' }}
    - **Dibuat pada**: {{ $berita->created_at->format('d M Y H:i') }}

    <x-mail::button :url="url('/admin/beritas/' . $berita->id_berita)">
        Lihat Berita di Admin Panel
    </x-mail::button>

    Silakan tinjau berita ini di panel admin untuk memastikan konten sesuai dengan kebijakan dan standar yang berlaku.

    Terima kasih atas perhatian Anda.

    Salam,<br>
    {{ config('app.name') }} - Sistem Admin
</x-mail::message>
