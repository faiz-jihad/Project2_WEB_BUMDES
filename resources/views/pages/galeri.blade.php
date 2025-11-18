@extends('layouts.master')

@section('title', 'Galeri Foto - BUMDes Madusari')

@section('content')
<section class="galeri-section">
    <div class="container">
        <h1 class="galeri-title">Galeri Foto</h1>

        {{-- Filter Kategori --}}
        <div class="galeri-filter text-center mb-4">
            <a href="{{ route('galeri.index', ['kategori' => 'all']) }}"
               class="filter-btn {{ $kategori == 'all' ? 'active' : '' }}">Semua</a>

            @foreach ($kategoriList as $kat)
                <a href="{{ route('galeri.index', ['kategori' => $kat]) }}"
                   class="filter-btn {{ $kategori == $kat ? 'active' : '' }}">{{ $kat }}</a>
            @endforeach
        </div>

        {{-- Grid --}}
        @if ($galeri->count() > 0)
            <div class="galeri-grid">
                @foreach ($galeri as $item)
                    <div class="galeri-item" data-aos="fade-up">
                        <img src="{{ asset('storage/' . $item->gambar) }}"
                             alt="{{ $item->judul }}"
                             class="galeri-img"
                             onclick="openModal('{{ asset('storage/' . $item->gambar) }}')">
                        <div class="galeri-caption">{{ $item->judul }}</div>
                    </div>
                @endforeach
            </div>

            {{-- Pagination --}}
            <div class="d-flex justify-content-center mt-5">
                {{ $galeri->withQueryString()->links() }}
            </div>

        @else
            <p class="text-center text-muted mt-5">Belum ada foto di galeri.</p>
        @endif
    </div>
</section>

{{-- Lightbox --}}
<div id="lightboxModal" class="lightbox-modal" onclick="closeModal()">
    <span class="close">&times;</span>
    <img id="lightboxImg" class="modal-content">
</div>

{{-- STYLE FINAL --}}
<style>
    :root {
        --green: #198754;
        --green-dark: #146c43;
        --gray-bg: #f8f9fa;
        --card-bg: #ffffff;
        --shadow: rgba(0,0,0,0.15);
    }

    .galeri-section {
        padding: 100px 20px;
        background: var(--gray-bg);
        min-height: 100vh;
    }

    .galeri-title {
        font-size: 2.2rem;
        font-weight: 700;
        text-align: center;
        color: var(--green-dark);
        margin-bottom: 40px;
    }

    /* ==================== FILTER ==================== */
    .filter-btn {
        display: inline-block;
        padding: 10px 20px;
        margin: 5px;
        border-radius: 25px;
        border: 1px solid var(--green);
        color: var(--green);
        font-weight: 600;
        text-decoration: none;
        transition: .3s ease;
    }

    .filter-btn.active,
    .filter-btn:hover {
        background: var(--green);
        color: #fff;
        transform: translateY(-2px);
    }

    /* ==================== PINTEREST MASONRY GRID ==================== */
    .galeri-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(260px, 1fr));
        grid-auto-flow: dense;
        gap: 20px;
        width: 100%;
    }

    .galeri-item {
        background: var(--card-bg);
        border-radius: 12px;
        overflow: hidden;
        box-shadow: 0 4px 12px var(--shadow);
        transition: .3s ease;
        cursor: pointer;
        display: flex;
        flex-direction: column;
    }

    .galeri-item:hover {
        transform: translateY(-5px) scale(1.02);
        box-shadow: 0 8px 25px var(--shadow);
    }

    .galeri-img {
        width: 100%;
        height: auto;
        display: block;
    }

    .galeri-caption {
        background: rgba(25, 135, 84, .85);
        color: #fff;
        padding: 8px;
        text-align: center;
        font-size: .9rem;
        font-weight: 600;
        letter-spacing: .5px;
    }

    /* ==================== LIGHTBOX ==================== */
    .lightbox-modal {
        display: none;
        position: fixed;
        inset: 0;
        background: rgba(0,0,0,0.9);
        z-index: 999;
        padding-top: 80px;
    }

    .lightbox-modal .modal-content {
        display: block;
        margin: auto;
        max-width: 90%;
        max-height: 80%;
        border-radius: 10px;
        animation: fadeIn .4s;
    }

    .lightbox-modal .close {
        position: absolute;
        top: 25px;
        right: 35px;
        font-size: 45px;
        color: #fff;
        cursor: pointer;
        font-weight: bold;
    }

    @keyframes fadeIn {
        from { opacity: 0; }
        to { opacity: 1; }
    }

    /* Responsive */
    @media (max-width: 600px) {
        .filter-btn { padding: 8px 15px; font-size: .9rem; }
        .galeri-grid { grid-template-columns: 1fr; }
    }
</style>

{{-- SCRIPT FINAL --}}
<script>
    function openModal(src) {
        document.getElementById("lightboxModal").style.display = "block";
        document.getElementById("lightboxImg").src = src;
    }

    function closeModal() {
        document.getElementById("lightboxModal").style.display = "none";
    }
</script>

@section('custom_js')
    <script>
        function toggleLike(beritaId) {
            const likeBtn = document.getElementById('likeBtn');
            const icon = likeBtn.querySelector('i');

            fetch(`/berita/${beritaId}/like`, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Content-Type': 'application/json'
                }
            })
                .then(response => response.json())
                .then(data => {
                    const likeCount = document.getElementById('likeCount');
                    likeCount.textContent = data.likes_count;
                    if (data.liked) {
                        likeBtn.classList.remove('btn-secondary');
                        likeBtn.classList.add('btn-danger');
                        icon.classList.remove('fa-heart-o');
                        icon.classList.add('fa-heart');
                    } else {
                        likeBtn.classList.remove('btn-danger');
                        likeBtn.classList.add('btn-secondary');
                        icon.classList.remove('fa-heart');
                        icon.classList.add('fa-heart-o');
                    }
                })
                .catch(() => alert('Terjadi kesalahan saat memproses like.'));
        }
    </script>
@endsection
