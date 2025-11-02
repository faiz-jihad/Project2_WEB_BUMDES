@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h2>📝 Tambah Berita Baru</h2>
    <hr>

    {{-- Notifikasi sukses/error --}}
    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>Terjadi kesalahan!</strong>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('penulis.berita.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="mb-3">
            <label for="judul" class="form-label">Judul Berita</label>
            <input type="text" name="judul" id="judul" class="form-control" placeholder="Masukkan judul berita" required>
        </div>

        <div class="mb-3">
            <label for="kategori" class="form-label">Kategori</label>
            <select name="id_kategori" id="kategori" class="form-select" required>
                <option value="">-- Pilih Kategori --</option>
                @foreach ($kategori as $k)
                    <option value="{{ $k->id_kategori }}">{{ $k->judul }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="slug" class="form-label">Slug</label>
            <input type="text" name="slug" id="slug" class="form-control" placeholder="contoh: panen-padi">
            <small class="text-muted">Slug otomatis bisa diisi dari judul</small>
        </div>

        <div class="mb-3">
            <label for="isi_berita" class="form-label">Isi Berita</label>
            <textarea name="isi_berita" id="isi_berita" class="form-control" rows="8" placeholder="Tulis isi berita di sini..."></textarea>
        </div>

        <div class="mb-3">
            <label for="thumbnail" class="form-label">Thumbnail (opsional)</label>
            <input type="file" name="thumbnail" id="thumbnail" class="form-control">
        </div>

        <button type="submit" class="btn btn-primary">Simpan Berita</button>
        <a href="{{ route('penulis.berita.index') }}" class="btn btn-secondary">Kembali</a>
    </form>
</div>

{{-- Script kecil untuk generate slug otomatis --}}
<script>
document.getElementById('judul').addEventListener('input', function () {
    const judul = this.value.toLowerCase().replace(/ /g, '-').replace(/[^\w-]+/g, '');
    document.getElementById('slug').value = judul;
});
</script>
@endsection
