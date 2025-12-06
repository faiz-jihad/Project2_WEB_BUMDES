@extends('layouts.master')

@section('title', $berita->Judul ?? 'Detail Berita')

@section('content')
    <div class="container my-5 pt-5">

        @if (isset($berita))

            {{-- Breadcrumb --}}
            <nav aria-label="breadcrumb" class="mb-4">
                <ol class="breadcrumb bg-white p-3 rounded shadow-sm">
                    <li class="breadcrumb-item"><a href="{{ route('beranda') }}">Beranda</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('berita.index') }}">Berita</a></li>
                    <li class="breadcrumb-item active" aria-current="page">
                        {{ Str::limit($berita->Judul, 70) }}
                    </li>
                </ol>
            </nav>

            {{-- Artikel --}}
            <article class="card shadow-sm border-0 mb-5">
                @if ($berita->Thumbnail)
                    <figure class="position-relative m-0">
                        <img src="{{ asset('storage/' . $berita->Thumbnail) }}"
                            class="card-img-top img-fluid rounded-top article-img" alt="{{ $berita->Judul }}">
                    </figure>
                @endif

                <div class="card-body p-4 p-md-5">

                    {{-- Judul --}}
                    <h1 class="fw-bold mb-3 text-dark">{{ $berita->Judul }}</h1>

                    {{-- Meta Data --}}
                    <div class="d-flex flex-wrap text-muted small mb-4">
                        <span class="me-3">
                            <i class="fas fa-user text-success me-1"></i>
                            {{ $berita->penulis->nama_penulis ?? 'Administrator' }}
                        </span>
                        <span class="me-3">
                            <i class="fas fa-calendar text-success me-1"></i>
                            {{ $berita->created_at->format('d M Y') }}
                        </span>
                        <span class="me-3">
                            <i class="fas fa-clock text-success me-1"></i>
                            {{ $berita->created_at->format('H:i') }}
                        </span>
                        <span>
                            <i class="fas fa-tag text-success me-1"></i>
                            {{ $berita->kategoriBerita->Judul ?? 'Umum' }}
                        </span>
                    </div>

                    {{-- Isi Artikel --}}
                    <div class="article-content mb-4">
                        {!! nl2br(e($berita->Isi_Berita)) !!}
                    </div>

                    {{-- Share & Like --}}
                    <div class="border-top pt-3 d-flex justify-content-between align-items-center">

                        {{-- Social Share Icons --}}
                        <div class="d-flex gap-2">
                            <button class="btn btn-outline-primary btn-sm px-3 shadow-sm share-btn"
                                onclick="shareToFacebook('{{ url()->current() }}', '{{ $berita->Judul }}')"
                                title="Bagikan ke Facebook">
                                <i class="fab fa-facebook-f"></i>
                            </button>
                            <button class="btn btn-outline-info btn-sm px-3 shadow-sm share-btn"
                                onclick="shareToTwitter('{{ url()->current() }}', '{{ $berita->Judul }}')"
                                title="Bagikan ke Twitter">
                                <i class="fab fa-twitter"></i>
                            </button>
                            <button class="btn btn-outline-success btn-sm px-3 shadow-sm share-btn"
                                onclick="shareToWhatsApp('{{ url()->current() }}', '{{ $berita->Judul }}')"
                                title="Bagikan ke WhatsApp">
                                <i class="fab fa-whatsapp"></i>
                            </button>
                            <button class="btn btn-outline-secondary btn-sm px-3 shadow-sm share-btn"
                                onclick="copyLink('{{ url()->current() }}')" title="Salin Link">
                                <i class="fas fa-link"></i>
                            </button>
                        </div>

                        {{-- Like --}}
                        @auth
                            <button id="likeBtn" onclick="toggleLike('{{ $berita->slug }}')"
                                class="btn btn-sm px-3 text-white shadow-sm like-btn
                                        {{ $berita->isLikedBy(auth()->user()) ? 'btn-danger' : 'btn-outline-danger' }}">
                                <i class="fas {{ $berita->isLikedBy(auth()->user()) ? 'fa-heart' : 'fa-heart' }} me-2"></i>
                                <span id="likeCount">{{ $berita->likesCount() }}</span>
                            </button>
                        @else
                            <a href="{{ route('login') }}" class="btn btn-sm btn-outline-danger px-3 shadow-sm like-btn"
                                title="Login untuk like">
                                <i class="fas fa-heart me-2"></i>{{ $berita->likesCount() }}
                            </a>
                        @endauth

                    </div>

                </div>
            </article>

            {{-- Informasi Artikel --}}
            <section class="card border-0 shadow-sm mb-5">
                <div class="card-header bg-light fw-semibold">Informasi Artikel</div>
                <div class="card-body">

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <small class="text-muted">Kategori</small>
                            <div>{{ $berita->kategoriBerita->Judul ?? 'Umum' }}</div>
                        </div>

                        <div class="col-md-6 mb-3">
                            <small class="text-muted">Penulis</small>
                            <div>{{ $berita->penulis->nama_penulis ?? 'Administrator' }}</div>
                        </div>

                        <div class="col-md-6 mb-3">
                            <small class="text-muted">Diterbitkan</small>
                            <div>{{ $berita->created_at->format('d M Y H:i') }}</div>
                        </div>

                        @if ($berita->updated_at != $berita->created_at)
                            <div class="col-md-6 mb-3">
                                <small class="text-muted">Diperbarui</small>
                                <div>{{ $berita->updated_at->format('d M Y H:i') }}</div>
                            </div>
                        @endif
                    </div>

                </div>
            </section>

            {{-- Tombol Kembali --}}
            <div class="text-center mb-5">
                <a href="{{ route('berita.index') }}" class="btn btn-dark px-4 shadow-sm">
                    <i class="fas fa-arrow-left me-2"></i>Kembali ke Daftar Berita
                </a>
            </div>
        @else
            {{-- 404 --}}
            <div class="text-center py-5">
                <i class="fas fa-newspaper fa-4x text-muted mb-3"></i>
                <h2 class="fw-bold text-dark">Berita Tidak Ditemukan</h2>
                <p class="text-muted mb-4">Berita yang Anda cari tidak tersedia atau telah dihapus.</p>
                <a href="{{ route('berita.index') }}" class="btn btn-primary px-4">
                    <i class="fas fa-list me-2"></i>Lihat Semua Berita
                </a>
            </div>

        @endif

    </div>

    {{-- JS Like & Share --}}
    <script>
        function toggleLike(slug) {
            fetch(`/berita/${slug}/like`, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                    }
                })
                .then(res => res.json())
                .then(data => {
                    const likeBtn = document.getElementById('likeBtn');
                    const icon = likeBtn.querySelector('i');
                    const likeCount = document.getElementById('likeCount');

                    likeCount.textContent = data.likes_count;

                    if (data.liked) {
                        likeBtn.classList.remove('btn-outline-danger');
                        likeBtn.classList.add('btn-danger');
                        icon.classList.add('animate-pulse');
                        setTimeout(() => icon.classList.remove('animate-pulse'), 500);
                    } else {
                        likeBtn.classList.remove('btn-danger');
                        likeBtn.classList.add('btn-outline-danger');
                    }
                })
                .catch(() => alert('Terjadi kesalahan.'));
        }

        function shareToFacebook(url, title) {
            const shareUrl =
                `https://www.facebook.com/sharer/sharer.php?u=${encodeURIComponent(url)}&quote=${encodeURIComponent(title)}`;
            window.open(shareUrl, '_blank', 'width=600,height=400');
        }

        function shareToTwitter(url, title) {
            const shareUrl =
                `https://twitter.com/intent/tweet?url=${encodeURIComponent(url)}&text=${encodeURIComponent(title)}`;
            window.open(shareUrl, '_blank', 'width=600,height=400');
        }

        function shareToWhatsApp(url, title) {
            const shareUrl = `https://wa.me/?text=${encodeURIComponent(title + ' ' + url)}`;
            window.open(shareUrl, '_blank');
        }

        function copyLink(url) {
            navigator.clipboard.writeText(url).then(() => {
                const btn = event.target.closest('.share-btn');
                const originalIcon = btn.innerHTML;
                btn.innerHTML = '<i class="fas fa-check"></i>';
                btn.classList.add('btn-success');
                btn.classList.remove('btn-outline-secondary');

                setTimeout(() => {
                    btn.innerHTML = originalIcon;
                    btn.classList.remove('btn-success');
                    btn.classList.add('btn-outline-secondary');
                }, 2000);
            }).catch(() => {
                alert('Gagal menyalin link');
            });
        }

        // Add hover effects for share buttons
        document.addEventListener('DOMContentLoaded', function() {
            const shareBtns = document.querySelectorAll('.share-btn');
            shareBtns.forEach(btn => {
                btn.addEventListener('mouseenter', function() {
                    this.style.transform = 'scale(1.1)';
                });
                btn.addEventListener('mouseleave', function() {
                    this.style.transform = 'scale(1)';
                });
            });

            const likeBtn = document.querySelector('.like-btn');
            if (likeBtn) {
                likeBtn.addEventListener('mouseenter', function() {
                    this.style.transform = 'scale(1.05)';
                });
                likeBtn.addEventListener('mouseleave', function() {
                    this.style.transform = 'scale(1)';
                });
            }
        });
    </script>

    {{-- CSS --}}
    <style>
        .article-img {
            transition: transform .6s ease;
        }

        .article-img:hover {
            transform: scale(1.05);
        }

        .article-content {
            font-size: 1.05rem;
            line-height: 1.8;
            color: #333;
        }

        .article-content p {
            margin-bottom: 1rem;
        }

        .article-content h2,
        .article-content h3 {
            margin: 2rem 0 1rem;
            font-weight: 700;
        }

        .article-content blockquote {
            border-left: 4px solid #0b560b;
            background: #f8f9fa;
            padding: 1rem;
            margin: 1.5rem 0;
            font-style: italic;
        }

        .share-btn {
            transition: all 0.3s ease;
            border-radius: 50%;
            width: 40px;
            height: 40px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.1rem;
        }

        .share-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
        }

        .like-btn {
            transition: all 0.3s ease;
            border-radius: 25px;
            min-width: 80px;
        }

        .like-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
        }

        .animate-pulse {
            animation: pulse 0.5s ease-in-out;
        }

        @keyframes pulse {
            0% {
                transform: scale(1);
            }

            50% {
                transform: scale(1.2);
            }

            100% {
                transform: scale(1);
            }
        }

        /* Responsive  */
        @media (max-width: 768px) {
            .share-btn {
                width: 35px;
                height: 35px;
                font-size: 1rem;
            }

            .like-btn {
                min-width: 70px;
                font-size: 0.9rem;
            }
        }
    </style>

@endsection
