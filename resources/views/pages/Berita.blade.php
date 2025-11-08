@extends('layouts.master')


@section('content')
    <!-- Beranda Berita  -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">


    <div class="container-fluid bg-light">
        <!-- Hero Section -->
        <section class="hero-section position-relative text-center text-white py-5 mb-5" data-aos="fade-down">
            <div class="hero-overlay position-absolute w-100 h-100"></div>
            <div class="container position-relative z-2 py-5">
                <h1 class="fw-bold display-4 mb-3" data-aos="fade-up" data-aos-delay="200">BUMdes Madusari News</h1>
                <p class="lead mb-4" data-aos="fade-up" data-aos-delay="400">Berita terkini dan artikel eksklusif
                    untuk Anda</p>
                <a href="#berita-terbaru" class="btn btn-lg btn-green px-4 py-2 shadow-lg" data-aos="zoom-in"
                    data-aos-delay="600">Lihat Berita</a>
            </div>
        </section>

        <!-- Main Content -->
        <div class="container">
            <div class="row g-4">
                <!-- Daftar Berita -->
                <div class="col-lg-8" id="berita-terbaru">
                    <div class="d-flex justify-content-between align-items-center mb-4" data-aos="fade-right">
                        <h2 class="fw-bold text-gradient">Berita Terbaru</h2>
                        <div class="d-flex align-items-center gap-2">
                            @if (request('search'))
                                <a href="{{ url()->current() }}" class="btn btn-outline-secondary btn-sm rounded-pill">
                                    <i class="bi bi-x-circle"></i> Hapus Filter
                                </a>
                            @endif
                            <div class="search-box">
                                <input type="text" id="beritaSearch" placeholder="Cari berita..."
                                    value="{{ request('search') }}" />
                            </div>
                        </div>
                    </div>

                    <!-- Desktop View -->
                    <div class="row g-4 d-none d-md-flex" id="beritaDesktopGrid">
                        @if (isset($berita) && $berita)
                            @forelse($berita as $b)
                                @if (is_object($b))
                                    <div class="col-md-6 col-lg-4 berita-item" style="color:#fff" data-aos="fade-up"
                                        data-aos-delay="{{ $loop->index * 100 }}" data-judul="{{ strtolower($b->Judul ?? '') }}"
                                        data-kategori="{{ strtolower($b->kategoriBerita?->Judul ?? 'umum') }}">
                                        <div class="card border-0 shadow-sm h-100 berita-card overflow-hidden">
                                            <div class="position-relative">
                                                <img src="{{ $b->Thumbnail ? asset('storage/' . $b->Thumbnail) : asset('images/no-image.webp') }}"
                                                    class="card-img-top zoom-img" alt="{{ $b->Judul }}">
                                                <span
                                                    class="badge bg-green position-absolute top-0 start-0 m-2">{{ $b->kategoriBerita->Judul ?? 'Umum' }}</span>
                                            </div>
                                            <div class="card-body d-flex flex-column">
                                                <small class="text-muted">{{ $b->created_at->format('d M Y') }}</small>
                                                <h5 class="fw-bold mt-2 text-dark hover-text-green">
                                                    {{ Str::limit($b->Judul, 70) }}
                                                </h5>
                                                <p class="text-secondary flex-grow-1">
                                                    {{ Str::limit(strip_tags($b->Isi_Berita), 100) }}</p>
                                                <a href="{{ route('berita.show', $b->slug) }}"
                                                    class="btn btn-outline-green mt-auto rounded-pill">Baca Selengkapnya</a>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            @empty
                                <div class="col-12 text-center py-5" data-aos="zoom-in" id="noResultsDesktop">
                                    @if (request('search'))
                                        <h4 class="text-muted">Tidak ada berita yang cocok dengan
                                            "<strong>{{ request('search') }}</strong>"</h4>
                                        <p class="text-secondary">Coba kata kunci lain atau <a
                                                href="{{ url()->current() }}" class="text-green">hapus filter pencarian</a>
                                        </p>
                                    @else
                                        <h4 class="text-muted">Belum ada berita yang tersedia.</h4>
                                    @endif
                                </div>
                            @endforelse
                        @else
                            <div class="col-12 text-center py-5" data-aos="zoom-in" id="noResultsDesktop">
                                <h4 class="text-muted">Belum ada berita yang tersedia.</h4>
                            </div>
                        @endif
                    </div>

                    <!-- Mobile View with 2-column Grid -->
                    <div class="d-md-none" id="beritaMobileGrid">
                        <div class="row g-3">
                            @if (isset($berita) && $berita)
                                @forelse($berita as $b)
                                    @if (is_object($b))
                                        <div class="col-6 berita-item" data-aos="fade-up"
                                            data-aos-delay="{{ $loop->index * 50 }}"
                                            data-judul="{{ strtolower($b->Judul) }}"
                                            data-kategori="{{ strtolower($b->kategoriBerita->Judul ?? 'umum') }}">
                                            <div class="card border-0 shadow-sm h-100 berita-card overflow-hidden">
                                                <div class="position-relative">
                                                    <img src="{{ $b->Thumbnail ? asset('storage/' . $b->Thumbnail) : asset('images/no-image.webp') }}"
                                                        class="card-img-top zoom-img" alt="{{ $b->Judul }}">
                                                    <span
                                                        class="badge bg-green position-absolute top-0 start-0 m-1">{{ $b->kategoriBerita->Judul ?? 'Umum' }}</span>
                                                </div>
                                                <div class="card-body d-flex flex-column">
                                                    <small class="text-muted">{{ $b->created_at->format('d M Y') }}</small>
                                                    <h6 class="fw-bold mt-2 text-dark hover-text-green">
                                                        {{ Str::limit($b->Judul, 50) }}
                                                    </h6>
                                                    <p class="text-secondary flex-grow-1 small">
                                                        {{ Str::limit(strip_tags($b->Isi_Berita), 60) }}</p>
                                                    <a href="{{ route('berita.show', $b->slug) }}"
                                                        class="btn btn-outline-green mt-auto rounded-pill btn-sm">Baca</a>
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                @empty
                                    <div class="col-12 text-center py-5" id="noResultsMobile">
                                        @if (request('search'))
                                            <h4 class="text-muted">Tidak ada berita yang cocok dengan
                                                "<strong>{{ request('search') }}</strong>"</h4>
                                            <p class="text-secondary">Coba kata kunci lain atau <a
                                                    href="{{ url()->current() }}" class="text-green">hapus filter
                                                    pencarian</a></p>
                                        @else
                                            <h4 class="text-muted">Belum ada berita yang tersedia.</h4>
                                        @endif
                                    </div>
                                @endforelse
                            @else
                                <div class="col-12 text-center py-5" id="noResultsMobile">
                                    <h4 class="text-muted">Belum ada berita yang tersedia.</h4>
                                </div>
                            @endif
                        </div>
                    </div>

                    @if (isset($berita) && $berita)
                        <div class="d-flex justify-content-center mt-5" data-aos="fade-up">{{ $berita->links() }}</div>
                    @endif
                </div>

                <!-- Sidebar -->
                <div class="col-lg-4" data-aos="fade-left">
                    <div class="sticky-top" style="top: 90px;">
                        <div class="card border-0 shadow-sm mb-4">
                            <div class="card-body">
                                <h5 class="fw-bold text-gradient mb-3"><i class="bi bi-list"></i> Kategori</h5>
                                <ul class="list-unstyled">
                                    @if (isset($kategori) && $kategori)
                                        @foreach ($kategori as $k)
                                            <li class="mb-2" data-aos="fade-up"
                                                data-aos-delay="{{ $loop->index * 100 }}">
                                                <a href="?kategori={{ $k->id }}"
                                                    class="text-dark text-decoration-none d-flex align-items-center">
                                                    <i class="bi bi-tag-fill text-green me-2"></i>{{ $k->Judul }}
                                                </a>
                                            </li>
                                        @endforeach
                                    @else
                                        <li class="text-muted">Tidak ada kategori</li>
                                    @endif
                                </ul>
                            </div>
                        </div>

                        <div class="card border-0 shadow-sm" data-aos="fade-up">
                            <div class="card-body">
                                <h5 class="fw-bold text-gradient mb-3"><i class="bi bi-fire"></i> Berita Populer</h5>
                                @if (isset($populer) && $populer)
                                    @foreach ($populer as $p)
                                        @if (is_object($p))
                                            <div class="d-flex mb-3 align-items-center" data-aos="fade-up"
                                                data-aos-delay="{{ $loop->index * 100 }}">
                                                <div class="overflow-hidden rounded me-3"
                                                    style="width:70px; height:70px;">
                                                    <img src="{{ $p->Thumbnail ? asset('storage/' . $p->Thumbnail) : asset('images/no-image.webp') }}"
                                                        class="zoom-img"
                                                        style="width:100%; height:100%; object-fit:cover;">
                                                </div>
                                                <div>
                                                    <a href="{{ route('berita.show', $p->slug) }}"
                                                        class="text-dark fw-semibold text-decoration-none hover-text-green">{{ Str::limit($p->Judul, 60) }}</a>
                                                    <small
                                                        class="d-block text-muted">{{ $p->created_at->format('d M Y') }}</small>
                                                </div>
                                            </div>
                                        @endif
                                    @endforeach
                                @else
                                    <p class="text-muted small">Belum ada berita populer</p>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <style>
        :root {
            --green: #16a34a;
            --green-dark: #0f7035;
            --green-light: #bbf7d0;
            --bg-light: #f0fdf4;
        }

        body {
            font-family: 'Poppins', sans-serif;
            background-color: var(--bg-light);
        }

        .text-gradient {
            background: linear-gradient(90deg, var(--green-dark), var(--green));
            -webkit-background-clip: text;
            color: transparent;
        }

        .text-green {
            color: var(--green-dark);
        }

        .hover-text-green:hover {
            color: var(--green) !important;
        }

        .btn-green {
            background: linear-gradient(90deg, var(--green-dark), var(--green));
            color: #fff;
            border: none;
            transition: all .3s ease;
        }

        .btn-green:hover {
            transform: translateY(-2px);
            opacity: 0.95;
        }

        .btn-outline-green {
            border: 2px solid var(--green-dark);
            color: var(--green-dark);
            transition: all .3s ease;
        }

        .btn-outline-green:hover {
            background: var(--green-dark);
            color: #fff;
        }

        .hero-section {
            background: linear-gradient(135deg, var(--green-dark), var(--green));
            position: relative;
            overflow: hidden;
            border-radius: 0 0 50px 50px;
        }

        .hero-overlay {
            background: url('/images/hero-bg.jpg') center/cover no-repeat;
            opacity: 0.15;
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            filter: brightness(0.8);
        }

        .zoom-img {
            transition: transform 0.4s ease;
        }

        .zoom-img:hover {
            transform: scale(1.08);
        }

        .berita-card {
            border-radius: 16px;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .berita-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.15);
        }

        .bg-green {
            background-color: var(--green-dark) !important;
        }

        /* Search */
        .search-box {
            text-align: center;
        }

        .search-box input {
            width: 100%;
            max-width: 300px;
            padding: 10px 14px;
            border-radius: 8px;
            border: 1px solid #ccc;
            font-size: 1rem;
        }

        /* Mobile image sizing */
        @media (max-width: 767.98px) {
            .berita-card .card-img-top {
                height: 120px;
                object-fit: cover;
            }
        }
    </style>

    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        AOS.init({
            duration: 800,
            once: true,
            offset: 120,
        });

        // Search functionality like product page
        document.addEventListener('DOMContentLoaded', () => {
            const beritaItems = document.querySelectorAll('.berita-item');
            const searchInput = document.getElementById('beritaSearch');

            // Search
            searchInput.addEventListener('input', () => {
                const query = searchInput.value.toLowerCase();
                beritaItems.forEach(card => {
                    const judul = card.dataset.judul.toLowerCase();
                    const kategori = card.dataset.kategori.toLowerCase();
                    card.style.display = (judul.includes(query) || kategori.includes(query)) ?
                        'flex' : 'none';
                });
            });
        });
    </script>
@endsection
