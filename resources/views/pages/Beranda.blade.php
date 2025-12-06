@extends('layouts.master')

@section('title', 'BUMDes Madusari')

@section('content')
<div class="home-page">
    {{-- HERO --}}
    <section class="hero">
        <div class="hero-overlay"></div>
        <div class="hero-content">
            <h1 class="hero-title">
                BUMDes <span class="text-highlight">Madusari</span>
            </h1>
            <p class="hero-subtitle">Membangun Desa, Meningkatkan Kesejahteraan Bersama</p>
            <a href="#tentang" class="btn btn-lg btn-success rounded-pill hero-cta">
                Jelajahi Sekarang
            </a>
        </div>
    </section>

    {{-- TENTANG --}}
    <section id="tentang" class={{--  --}}        <div class="container">
            <div class="section-header">
                <h2 class="section-title">Tentang Kami</h2>
                <p class="section-subtitle">BUMDes Madusari adalah lembaga ekonomi desa yang berkomitmen pada pembangunan berkelanjutan berbasis potensi lokal.</p>
            </div>

            <div class="row align-items-center">
                <div class="col-md-6" data-aos="fade-right">
                    <img src="{{ asset('images/logo.jpg') }}"
                         loading="lazy"
                         class="about-image"
                         alt="BUMDes Madusari">
                </div>
                <div class="col-md-6" data-aos="fade-left">
                    <div class="about-content">
                        <h3 class="about-heading">Visi & Misi</h3>
                        <p class="about-text">Menjadi penggerak utama ekonomi desa melalui kolaborasi masyarakat dan inovasi lokal.</p>
                        <ul class="about-list">
                            <li>Pemberdayaan masyarakat melalui pelatihan dan usaha.</li>
                            <li>Mengelola potensi desa secara mandiri.</li>
                            <li>Meningkatkan kesejahteraan warga dengan semangat gotong royong.</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="about-bg-pattern"></div>
    </section>

    {{-- SEJARAH --}}
    <section class="history-section">
        <div class="container">
            <div class="section-header">
                <h2 class="section-title">Sejarah BUMDes Madusari</h2>
                <p class="section-subtitle">Perjalanan panjang pembentukan dan perkembangan BUMDes Madusari dari masa ke masa.</p>
            </div>

            <div class="row g-4 timeline-grid">
                @foreach ([
                    ['2021', 'Persetujuan Nama BUMDes', 'Nama BUM Desa Madusari Bayalangu Kidul resmi memperoleh persetujuan dari Kementerian Desa pada 4 Juli 2021 dengan nomor pendaftaran 3209282014-1-005205.'],
                    ['2021–2022', 'Pembentukan Struktur & Administrasi', 'Pemerintah desa mulai menyusun struktur organisasi, AD/ART, dan regulasi internal untuk mempersiapkan operasional BUMDes.'],
                    ['2022', 'Perintisan Unit Usaha', 'BUMDes mulai menjalankan beberapa unit usaha berbasis potensi desa seperti pertanian, perdagangan hasil bumi, dan pemberdayaan UMKM lokal.'],
                    ['2023–2024', 'Penguatan Operasional & Inovasi', 'BUMDes memperkuat sistem operasional, meningkatkan kapasitas sumber daya manusia, dan membuat rencana pengembangan lebih besar.'],
                    ['2025', 'Resmi Menjadi Badan Hukum', 'Pada 4 September 2025, BUM Desa Madusari Bayalangu Kidul resmi terdaftar sebagai badan hukum dengan nomor sertifikat AHU-11861.AH.01.33.TAHUN 2025.'],
                    ['Sekarang', 'Ekspansi & Masa Depan', 'Dengan legalitas penuh dan struktur kuat, BUMDes Madusari fokus pada pengembangan inovasi, digitalisasi layanan, dan perluasan jaringan usaha desa.']
                ] as $timeline)
                <div class="col-md-6" data-aos="{{ $loop->iteration % 2 == 0 ? 'fade-left' : 'fade-right' }}">
                    <div class="timeline-card {{ $loop->last ? 'active' : '' }}">
                        <div class="timeline-year">{{ $timeline[0] }}</div>
                        <h5 class="timeline-title">{{ $timeline[1] }}</h5>
                        <p class="timeline-description">{{ $timeline[2] }}</p>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
        <div class="history-bg-pattern"></div>
    </section>

    {{-- PRODUK --}}
    <section class="products-section">
        <div class="container">
            <div class="section-header" data-aos="zoom-in">
                <h2 class="section-title">Produk Unggulan Kami</h2>
                <p class="section-subtitle">Dikelola oleh masyarakat, untuk masyarakat.</p>
            </div>

            @if (isset($produk) && $produk->count() > 0)
            <div class="swiper products-swiper mt-4">
                <div class="swiper-wrapper">
                    @foreach ($produk as $item)
                    <div class="swiper-slide">
                        @include('partials.product-card', ['product' => $item])
                    </div>
                    @endforeach
                </div>

                <div class="swiper-button-next"></div>
                <div class="swiper-button-prev"></div>
                <div class="swiper-pagination"></div>
            </div>
            @else
            <div class="no-products">
                <i class="fas fa-box-open"></i>
                <p>Belum ada produk yang tersedia saat ini.</p>
            </div>
            @endif
        </div>
    </section>

    {{-- BERITA --}}
    <section class="news-section">
        <div class="container">
            <div class="section-header">
                <h2 class="section-title">Berita Unggulan</h2>
                <p class="section-subtitle">Kabar terbaru seputar kegiatan dan inovasi BUMDes Madusari.</p>
            </div>

            <div class="row g-4">
                @if (isset($banners) && $banners->count() > 0)
                    @foreach ($banners->take(3) as $banner)
                    <div class="col-md-4" data-aos="fade-up" data-aos-delay="{{ $loop->index * 100 }}">
                        <div class="news-card">
                            <img src="{{ $banner->berita && $banner->berita->Thumbnail ? asset('storage/' . $banner->berita->Thumbnail) : asset('images/berita1.jpg') }}"
                                 loading="lazy"
                                 class="news-image"
                                 alt="{{ $banner->berita ? $banner->berita->Judul : 'Berita BUMDes' }}">
                            <div class="news-content">
                                <h5 class="news-title">{{ $banner->berita ? $banner->berita->Judul : 'Judul Berita' }}</h5>
                                <p class="news-excerpt">
                                    {{ $banner->berita ? Str::limit($banner->berita->Isi_Berita, 100) : 'Deskripsi berita akan muncul di sini.' }}
                                </p>
                                <a href="{{ $banner->berita ? route('berita.show', $banner->berita->slug) : url('/berita') }}"
                                   class="btn btn-sm btn-outline-success rounded-pill">
                                    Baca Selengkapnya
                                </a>
                            </div>
                        </div>
                    </div>
                    @endforeach
                @else
                    @foreach ([
                        ['Panen Raya Berhasil Meningkatkan Produksi Desa', 'berita1.jpg', 'Panen padi tahun ini mencapai rekor tertinggi di wilayah Bayalangu Kidul.'],
                        ['Program UMKM Desa Resmi Diluncurkan', 'berita2.jpg', 'Program baru BUMDes yang mendukung pelaku UMKM dengan pendanaan dan pelatihan.'],
                        ['Kerjasama Baru dengan BUMN untuk Energi Hijau', 'berita3.jpg', 'BUMDes Madusari menandatangani MoU dengan BUMN untuk proyek energi terbarukan.']
                    ] as $news)
                    <div class="col-md-4" data-aos="fade-up" data-aos-delay="{{ $loop->index * 100 }}">
                        <div class="news-card">
                            <img src="{{ asset('images/' . $news[1]) }}"
                                 loading="lazy"
                                 class="news-image"
                                 alt="{{ $news[0] }}">
                            <div class="news-content">
                                <h5 class="news-title">{{ $news[0] }}</h5>
                                <p class="news-excerpt">{{ $news[2] }}</p>
                                <a href="{{ url('/berita') }}"
                                   class="btn btn-sm btn-outline-success rounded-pill">
                                    Baca Selengkapnya
                                </a>
                            </div>
                        </div>
                    </div>
                    @endforeach
                @endif
            </div>
        </div>
    </section>

    {{-- STATISTIK --}}
    <section class="stats-section">
        <div class="container">
            <h2 class="stats-title" data-aos="fade-down">Capaian Kami</h2>
            <div class="row g-4">
                <div class="col-md-3" data-aos="fade-up" data-aos-delay="100">
                    <div class="stat-item">
                        <h3 class="counter" data-target="{{ $anggotaAktif ?? 75 }}">0</h3>
                        <p>Anggota Aktif</p>
                    </div>
                </div>
                <div class="col-md-3" data-aos="fade-up" data-aos-delay="200">
                    <div class="stat-item">
                        <h3 class="counter" data-target="34">0</h3>
                        <p>Program Usaha</p>
                    </div>
                </div>
                <div class="col-md-3" data-aos="fade-up" data-aos-delay="300">
                    <div class="stat-item">
                        <h3 class="counter" data-target="8">0</h3>
                        <p>Mitra Strategis</p>
                    </div>
                </div>
                <div class="col-md-3" data-aos="fade-up" data-aos-delay="400">
                    <div class="stat-item">
                        <h3 class="counter" data-target="100">0%</h3>
                        <p>Dukungan Masyarakat</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <div class="gallery-carousel infinite-carousel" id="galleryCarousel">
    <div class="carousel-track" id="carouselTrack">
        @foreach ($galeriHome as $item)
        <div class="carousel-slide">
            <div class="gallery-item">
                <a href="{{ asset('storage/' . $item->gambar) }}" data-lightbox="gallery">
                    <img src="{{ asset('storage/' . $item->gambar) }}"
                         loading="lazy"
                         class="gallery-image"
                         alt="{{ $item->judul }}">
                    <div class="gallery-overlay">
                        <i class="fas fa-search-plus"></i>
                    </div>
                </a>
            </div>
        </div>
        @endforeach

        {{-- DUPLICATE untuk efek infinite loop --}}
        @foreach ($galeriHome as $item)
        <div class="carousel-slide">
            <div class="gallery-item">
                <a href="{{ asset('storage/' . $item->gambar) }}" data-lightbox="gallery">
                    <img src="{{ asset('storage/' . $item->gambar) }}"
                         loading="lazy"
                         class="gallery-image"
                         alt="{{ $item->judul }}">
                    <div class="gallery-overlay">
                        <i class="fas fa-search-plus"></i>
                    </div>
                </a>
            </div>
        </div>
        @endforeach
    </div>
</div>


    {{-- KONTAK --}}
    <section id="kontak" class="contact-section">
        <div class="contact-pattern"></div>

        <div class="container">
            <div class="section-header">
                <h2 class="section-title">Lokasi & Kontak</h2>
                <p class="section-subtitle">Bersinergi membangun desa yang lebih maju — hubungi kami untuk kolaborasi.</p>
            </div>

            <div class="row g-4 align-items-center">
                <div class="col-md-6" data-aos="fade-right">
                    <div class="map-card">
                        <button type="button" class="map-poster">
                            <i class="fas fa-map-marked-alt"></i>
                            <h5>Tampilkan Peta</h5>
                            <p>Klik untuk memuat Peta</p>
                        </button>

                        <div class="map-pin">
                            <div class="pin-outer"></div>
                            <div class="pin-inner"></div>
                        </div>

                        <div class="map-frame" data-src="https://www.google.com/maps?q=Bayalangu+Kidul,+Indramayu&output=embed">
                            <noscript>
                                <iframe src="https://www.google.com/maps?q=Bayalangu+Kidul,+Indramayu&output=embed"
                                        loading="lazy"
                                        allowfullscreen></iframe>
                            </noscript>
                        </div>
                    </div>
                </div>

                <div class="col-md-6" data-aos="fade-left">
                    <div class="contact-card">
                        <div class="contact-header">
                            <img src="{{ asset('images/logo.jpg') }}"
                                 alt="Logo BUMDes Madusari"
                                 class="contact-logo">
                            <div>
                                <h4 class="contact-name">BUMDes Madusari</h4>
                                <p class="contact-address">Bayalangu Kidul, Kabupaten Cirebon</p>
                            </div>
                        </div>

                        <div class="contact-actions">
                            <button class="btn btn-sm btn-outline-success copy-btn" data-copy="Bayalangu Kidul, Kabupaten Cirebon">
                                <i class="fas fa-map-marker-alt"></i> Salin Alamat
                            </button>
                            <button class="btn btn-sm btn-outline-success copy-btn" data-copy="bumdesmadusari2025@gmail.com">
                                <i class="fas fa-envelope"></i> Salin Email
                            </button>
                            <a href="https://wa.me/6281234567890" target="_blank" rel="noopener" class="btn btn-sm btn-success">
                                <i class="fab fa-whatsapp"></i> Hubungi via WA
                            </a>
                        </div>

                        <div class="contact-stats">
                            <div class="stat-box">
                                <h3 class="counter" data-target="120">0</h3>
                                <small>Kegiatan</small>
                            </div>
                            <div class="stat-box">
                                <h3 class="counter" data-target="75">0</h3>
                                <small>Anggota</small>
                            </div>
                            <div class="stat-box">
                                <h3 class="counter" data-target="98">0%</h3>
                                <small>Kepuasan</small>
                            </div>
                        </div>

                        <div class="contact-buttons">
                            <button class="btn btn-sm btn-outline-success" data-bs-toggle="modal" data-bs-target="#contactModal">
                                <i class="fas fa-comment"></i> Kirim Pesan
                            </button>
                            <a href="{{ route('galeri.index') }}" class="btn btn-sm btn-success">
                                <i class="fas fa-images"></i> Lihat Galeri
                            </a>
                        </div>

                        <svg class="contact-wave" viewBox="0 0 1200 120" preserveAspectRatio="none">
                            <path d="M0,0 C150,100 350,0 600,0 C850,0 1050,100 1200,0 L1200,120 L0,120 Z"></path>
                        </svg>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

{{-- MODALS --}}
@include('partials.contact-modal')
@include('partials.product-modal')

{{-- CSS --}}
<link href="https://unpkg.com/aos@next/dist/aos.css" rel="stylesheet">
<link href="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.3/css/lightbox.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
@endsection

@push('styles')
<style>
/* VARIABLES */
.infinite-carousel {
    position: relative;
    overflow: hidden;
    width: 100%;
}

.carousel-track {
    display: flex;
    width: max-content;
    animation: scrollInfinite 25s linear infinite;
}

.carousel-slide {
    flex: 0 0 auto;
    width: 300px;
    margin: 0 10px;
}

.gallery-image {
    width: 100%;
    height: 220px;
    object-fit: cover;
    border-radius: 12px;
}

@keyframes scrollInfinite {
    0% { transform: translateX(0); }
    100% { transform: translateX(-50%); }
}

/* Pause saat hover */
.infinite-carousel:hover .carousel-track {
    animation-play-state: paused;
}

:root {
    --primary: #198754;
    --primary-dark: #146c43;
    --secondary: #20c997;
    --light: #f8fafb;
    --dark: #212529;
    --gray: #6c757d;
    --gray-light: #adb5bd;
    --shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
    --radius: 12px;
    --transition: all 0.3s ease;
}

/* GENERAL STYLES */
.home-page {
    font-family: 'Poppins', sans-serif;
    overflow-x: hidden;
}

.section-header {
    text-align: center;
    margin-bottom: 3rem;
}

.section-title {
    font-weight: 700;
    color: var(--primary);
    margin-bottom: 1rem;
    position: relative;
    display: inline-block;
}

.section-title::after {
    content: '';
    position: absolute;
    bottom: -8px;
    left: 50%;
    transform: translateX(-50%);
    width: 60px;
    height: 3px;
    background: var(--primary);
    border-radius: 2px;
}

.section-subtitle {
    color: var(--gray);
    max-width: 600px;
    margin: 0 auto;
}

/* HERO SECTION */
.hero {
    position: relative;
    height: 100vh;
    background: linear-gradient(rgba(0, 0, 0, 0.7), rgba(0, 0, 0, 0.9)),
                url('{{ asset('images/bgutama.jpg') }}') center/cover fixed;
    display: flex;
    align-items: center;
    justify-content: center;
    text-align: center;
    overflow: hidden;
}

.hero-content {
    position: relative;
    z-index: 2;
    padding: 2rem;
}

.hero-title {
    font-size: 3.5rem;
    font-weight: 800;
    color: white;
    margin-bottom: 1rem;
    text-transform: uppercase;
    letter-spacing: 1px;
}

.text-highlight {
    color: var(--secondary);
}

.hero-subtitle {
    font-size: 1.25rem;
    color: rgba(255, 255, 255, 0.9);
    margin-bottom: 2rem;
    max-width: 600px;
    margin-left: auto;
    margin-right: auto;
}

.hero-cta {
    padding: 1rem 2.5rem;
    font-weight: 600;
    transition: var(--transition);
}

.hero-cta:hover {
    transform: translateY(-3px);
    box-shadow: 0 10px 25px rgba(25, 135, 84, 0.3);
}

/* ABOUT SECTION */
.about-section {
    position: relative;
    padding: 5rem 0;
    background: var(--light);
}

.about-image {
    width: 100%;
    border-radius: var(--radius);
    box-shadow: var(--shadow);
    transition: var(--transition);
}

.about-image:hover {
    transform: translateY(-5px);
}

.about-content {
    padding: 2rem;
}

.about-heading {
    font-weight: 700;
    color: var(--dark);
    margin-bottom: 1.5rem;
}

.about-text {
    color: var(--gray);
    margin-bottom: 1.5rem;
    line-height: 1.8;
}

.about-list {
    list-style: none;
    padding: 0;
}

.about-list li {
    padding: 0.5rem 0;
    padding-left: 2rem;
    position: relative;
    color: var(--gray);
}

.about-list li::before {
    content: '✓';
    position: absolute;
    left: 0;
    color: var(--primary);
    font-weight: bold;
}

.about-bg-pattern {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: url('{{ asset('images/padi.jpg') }}') center/cover fixed;
    opacity: 0.07;
    pointer-events: none;
}

/* HISTORY SECTION */
.history-section {
    position: relative;
    padding: 5rem 0;
    background: white;
}

.timeline-grid {
    margin-top: 3rem;
}

.timeline-card {
    background: var(--light);
    padding: 2rem;
    border-radius: var(--radius);
    box-shadow: var(--shadow);
    height: 100%;
    transition: var(--transition);
    border-left: 4px solid var(--primary);
}

.timeline-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 15px 35px rgba(0, 0, 0, 0.1);
}

.timeline-card.active {
    background: var(--primary);
    color: white;
    border-left-color: white;
}

.timeline-card.active .timeline-year {
    background: white;
    color: var(--primary);
}

.timeline-card.active .timeline-title {
    color: white;
}

.timeline-year {
    display: inline-block;
    background: var(--primary);
    color: white;
    padding: 0.5rem 1.5rem;
    border-radius: 50px;
    font-weight: 600;
    margin-bottom: 1rem;
}

.timeline-title {
    font-weight: 700;
    color: var(--dark);
    margin-bottom: 1rem;
    font-size: 1.25rem;
}

.timeline-description {
    color: var(--gray);
    line-height: 1.6;
    margin: 0;
}

.history-bg-pattern {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: url('{{ asset('images/pattern.png') }}') repeat;
    opacity: 0.03;
    pointer-events: none;
}

/* PRODUCTS SECTION */
.products-section {
    padding: 5rem 0;
    background: var(--light);
}

.products-swiper {
    width: 100%;
    padding-bottom: 50px;
}

.products-swiper .swiper-slide {
    display: flex;
    justify-content: center;
    align-items: stretch;
    height: auto;
}

.swiper-button-next,
.swiper-button-prev {
    color: var(--primary);
    background: rgba(255, 255, 255, 0.9);
    border-radius: 50%;
    width: 50px;
    height: 50px;
    box-shadow: var(--shadow);
    transition: var(--transition);
}

.swiper-button-next:hover,
.swiper-button-prev:hover {
    background: var(--primary);
    color: white;
    transform: scale(1.1);
}

.swiper-button-next::after,
.swiper-button-prev::after {
    font-size: 18px;
    font-weight: bold;
}

.swiper-pagination-bullet {
    background: var(--primary);
    opacity: 0.5;
}

.swiper-pagination-bullet-active {
    opacity: 1;
}

.no-products {
    text-align: center;
    padding: 4rem;
    color: var(--gray);
}

.no-products i {
    font-size: 4rem;
    margin-bottom: 1rem;
    opacity: 0.5;
}

/* NEWS SECTION */
.news-section {
    padding: 5rem 0;
    background: white;
}

.news-card {
    height: 100%;
    border-radius: var(--radius);
    overflow: hidden;
    box-shadow: var(--shadow);
    transition: var(--transition);
    background: white;
}

.news-card:hover {
    transform: translateY(-10px);
    box-shadow: 0 20px 40px rgba(0, 0, 0, 0.15);
}

.news-image {
    width: 100%;
    height: 200px;
    object-fit: cover;
}

.news-content {
    padding: 1.5rem;
}

.news-title {
    font-weight: 700;
    color: var(--dark);
    margin-bottom: 0.75rem;
    font-size: 1.1rem;
    line-height: 1.4;
}

.news-excerpt {
    color: var(--gray);
    font-size: 0.9rem;
    line-height: 1.6;
    margin-bottom: 1.5rem;
}

/* STATS SECTION */
.stats-section {
    padding: 5rem 0;
    background: linear-gradient(135deg, var(--primary), var(--primary-dark));
    color: white;
    position: relative;
    overflow: hidden;
}

.stats-title {
    font-weight: 700;
    margin-bottom: 3rem;
    text-align: center;
}

.stat-item {
    text-align: center;
    padding: 2rem;
}

.stat-item h3 {
    font-size: 3rem;
    font-weight: 800;
    margin-bottom: 0.5rem;
}

.stat-item p {
    font-size: 1.1rem;
    opacity: 0.9;
    margin: 0;
}

/* GALLERY SECTION */
.gallery-section {
    padding: 5rem 0;
    background: var(--light);
}

.gallery-swiper {
    width: 100%;
    height: 350px;
    margin-bottom: 2rem;
}

.gallery-item {
    position: relative;
    border-radius: var(--radius);
    overflow: hidden;
    height: 100%;
    box-shadow: var(--shadow);
}

.gallery-image {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform 0.5s ease;
}

.gallery-item:hover .gallery-image {
    transform: scale(1.1);
}

.gallery-overlay {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(25, 135, 84, 0.8);
    display: flex;
    align-items: center;
    justify-content: center;
    opacity: 0;
    transition: var(--transition);
}

.gallery-item:hover .gallery-overlay {
    opacity: 1;
}

.gallery-overlay i {
    color: white;
    font-size: 2.5rem;
}

/* CONTACT SECTION */
.contact-section {
    position: relative;
    padding: 5rem 0;
    background: white;
}

.contact-pattern {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: url('{{ asset('images/pattern.png') }}') repeat;
    opacity: 0.04;
    pointer-events: none;
}

.map-card {
    position: relative;
    border-radius: var(--radius);
    overflow: hidden;
    background: var(--light);
    box-shadow: var(--shadow);
    height: 100%;
}

.map-poster {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: linear-gradient(rgba(0, 0, 0, 0.3), rgba(0, 0, 0, 0.5));
    border: none;
    color: white;
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    z-index: 2;
    transition: var(--transition);
    cursor: pointer;
}

.map-poster:hover {
    background: linear-gradient(rgba(0, 0, 0, 0.4), rgba(0, 0, 0, 0.6));
}

.map-poster i {
    font-size: 3rem;
    margin-bottom: 1rem;
}

.map-poster h5 {
    font-size: 1.5rem;
    margin-bottom: 0.5rem;
}

.map-poster p {
    font-size: 0.9rem;
    opacity: 0.9;
}

.map-pin {
    position: absolute;
    left: 50%;
    top: 45%;
    transform: translate(-50%, -50%);
    width: 28px;
    height: 28px;
    z-index: 3;
    pointer-events: none;
}

.pin-outer {
    position: absolute;
    width: 100%;
    height: 100%;
    border-radius: 50%;
    background: rgba(25, 135, 84, 0.2);
    animation: pulse 2s infinite;
}

.pin-inner {
    position: absolute;
    width: 12px;
    height: 12px;
    background: var(--primary);
    border-radius: 50%;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    box-shadow: 0 0 20px rgba(25, 135, 84, 0.5);
}

@keyframes pulse {
    0% { transform: scale(0.8); opacity: 0.8; }
    70% { transform: scale(2); opacity: 0; }
    100% { transform: scale(2); opacity: 0; }
}

.map-frame {
    width: 100%;
    height: 360px;
    background: #f8fafb;
}

.map-frame iframe {
    width: 100%;
    height: 100%;
    border: none;
}

.contact-card {
    background: white;
    padding: 2rem;
    border-radius: var(--radius);
    box-shadow: var(--shadow);
    position: relative;
    overflow: hidden;
    transition: var(--transition);
}

.contact-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
}

.contact-header {
    display: flex;
    align-items: center;
    gap: 1rem;
    margin-bottom: 1.5rem;
}

.contact-logo {
    width: 70px;
    height: 70px;
    border-radius: var(--radius);
    object-fit: cover;
    border: 3px solid var(--light);
}

.contact-name {
    font-weight: 700;
    color: var(--dark);
    margin: 0;
}

.contact-address {
    color: var(--gray);
    margin: 0;
    font-size: 0.9rem;
}

.contact-actions {
    display: flex;
    flex-wrap: wrap;
    gap: 0.5rem;
    margin-bottom: 1.5rem;
}

.contact-stats {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 1rem;
    margin-bottom: 1.5rem;
}

.stat-box {
    text-align: center;
    padding: 1rem;
    background: var(--light);
    border-radius: var(--radius);
}

.stat-box h3 {
    font-size: 1.5rem;
    font-weight: 700;
    color: var(--primary);
    margin: 0;
}

.stat-box small {
    color: var(--gray);
    font-size: 0.8rem;
}

.contact-buttons {
    display: flex;
    gap: 0.5rem;
}

.contact-wave {
    position: absolute;
    bottom: 0;
    left: 0;
    width: 100%;
    height: 50px;
    transform: translateY(50%);
    opacity: 0.06;
}

.contact-wave path {
    fill: var(--primary);
}

/* MODALS */
.modal-content {
    border-radius: var(--radius);
    border: none;
    box-shadow: 0 20px 60px rgba(0, 0, 0, 0.2);
}

/* RESPONSIVE */
@media (max-width: 768px) {
    .hero-title {
        font-size: 2.5rem;
    }

    .hero-subtitle {
        font-size: 1rem;
    }

    .section-title {
        font-size: 1.75rem;
    }

    .stat-item h3 {
        font-size: 2.5rem;
    }

    .gallery-swiper {
        height: 250px;
    }

    .contact-actions,
    .contact-buttons {
        flex-direction: column;
    }

    .contact-actions .btn,
    .contact-buttons .btn {
        width: 100%;
    }
}

@media (max-width: 576px) {
    .hero {
        height: 80vh;
    }

    .hero-title {
        font-size: 2rem;
    }

    .section-header {
        margin-bottom: 2rem;
    }

    .timeline-card {
        padding: 1.5rem;
    }

    .news-card {
        margin-bottom: 1.5rem;
    }

    .contact-stats {
        grid-template-columns: 1fr;
    }
}
</style>
@endpush

@push('scripts')
<script src="https://unpkg.com/aos@next/dist/aos.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.3/js/lightbox.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Initialize AOS
    AOS.init({
        duration: 1000,
        once: true,
        offset: 100
    });

    // Initialize Lightbox
    lightbox.option({
        'resizeDuration': 200,
        'wrapAround': true,
        'albumLabel': 'Gambar %1 dari %2'
    });

    // Counter Animation
    const counters = document.querySelectorAll('.counter');
    const observerOptions = {
        threshold: 0.5
    };

    const counterObserver = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                const counter = entry.target;
                const target = +counter.getAttribute('data-target');
                const duration = 1500;
                const start = performance.now();
                const current = +counter.innerText.replace(/\D/g, '') || 0;

                const animate = (timestamp) => {
                    const elapsed = timestamp - start;
                    const progress = Math.min(elapsed / duration, 1);
                    const easeProgress = 1 - Math.pow(1 - progress, 3);
                    const value = Math.floor(current + (target - current) * easeProgress);

                    counter.innerText = counter.innerText.includes('%') ?
                        value + '%' : value.toLocaleString('id-ID');

                    if (progress < 1) {
                        requestAnimationFrame(animate);
                    }
                };

                requestAnimationFrame(animate);
                counterObserver.unobserve(counter);
            }
        });
    }, observerOptions);

    counters.forEach(counter => counterObserver.observe(counter));

    // Initialize Products Swiper
    const productsSwiper = new Swiper('.products-swiper', {
        slidesPerView: 1,
        spaceBetween: 20,
        loop: true,
        autoplay: {
            delay: 4000,
            disableOnInteraction: false,
        },
        pagination: {
            el: '.swiper-pagination',
            clickable: true,
        },
        navigation: {
            nextEl: '.swiper-button-next',
            prevEl: '.swiper-button-prev',
        },
        breakpoints: {
            576: {
                slidesPerView: 2,
                spaceBetween: 20,
            },
            768: {
                slidesPerView: 3,
                spaceBetween: 25,
            },
            992: {
                slidesPerView: 4,
                spaceBetween: 30,
            },
        },
    });

    // Initialize Gallery Swiper
    const gallerySwiper = new Swiper('.gallery-swiper', {
        slidesPerView: 1,
        spaceBetween: 20,
        loop: true,
        autoplay: {
            delay: 3000,
            disableOnInteraction: false,
        },
        pagination: {
            el: '.swiper-pagination',
            clickable: true,
        },
        navigation: {
            nextEl: '.swiper-button-next',
            prevEl: '.swiper-button-prev',
        },
        breakpoints: {
            576: {
                slidesPerView: 2,
                spaceBetween: 20,
            },
            768: {
                slidesPerView: 3,
                spaceBetween: 25,
            },
            992: {
                slidesPerView: 4,
                spaceBetween: 30,
            },
        },
    });

    // Lazy Load Map
    document.querySelectorAll('.map-poster').forEach(poster => {
        poster.addEventListener('click', function() {
            const mapFrame = this.parentElement.querySelector('.map-frame');
            if (!mapFrame.dataset.loaded) {
                const src = mapFrame.getAttribute('data-src');
                if (src) {
                    const iframe = document.createElement('iframe');
                    iframe.width = '100%';
                    iframe.height = '360';
                    iframe.loading = 'lazy';
                    iframe.style.border = '0';
                    iframe.allowFullscreen = true;
                    iframe.src = src;
                    mapFrame.innerHTML = '';
                    mapFrame.appendChild(iframe);
                    mapFrame.dataset.loaded = true;
                }
            }
            this.style.opacity = '0';
            this.style.pointerEvents = 'none';
        });
    });

    // Copy to Clipboard
    document.querySelectorAll('.copy-btn').forEach(btn => {
        btn.addEventListener('click', async function() {
            const text = this.getAttribute('data-copy');
            try {
                await navigator.clipboard.writeText(text);

                // Show success message
                const originalText = this.innerHTML;
                this.innerHTML = '<i class="fas fa-check"></i> Tersalin!';
                this.classList.add('btn-success');
                this.classList.remove('btn-outline-success');

                setTimeout(() => {
                    this.innerHTML = originalText;
                    this.classList.remove('btn-success');
                    this.classList.add('btn-outline-success');
                }, 2000);

            } catch (err) {
                console.error('Failed to copy:', err);
                alert('Gagal menyalin ke clipboard');
            }
        });
    });

    // Add to Cart Functionality
    document.querySelectorAll('.btn-keranjang-home').forEach(btn => {
        btn.addEventListener('click', function() {
            const productId = this.getAttribute('data-id');
            const productName = this.getAttribute('data-nama');

            // Show loading state
            const originalText = this.innerHTML;
            this.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Menambahkan...';
            this.disabled = true;

            // Simulate API call
            setTimeout(() => {
                // Reset button
                this.innerHTML = originalText;
                this.disabled = false;

                // Show success message
                if (typeof Swal !== 'undefined') {
                    Swal.fire({
                        icon: 'success',
                        title: 'Berhasil!',
                        text: `${productName} berhasil ditambahkan ke keranjang`,
                        toast: true,
                        position: 'top-end',
                        showConfirmButton: false,
                        timer: 2000
                    });
                }

                // Trigger cart update event
                document.dispatchEvent(new CustomEvent('cartUpdated'));
            }, 1000);
        });
    });

    // Smooth Scroll for Anchor Links
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function(e) {
            const href = this.getAttribute('href');
            if (href !== '#') {
                e.preventDefault();
                const target = document.querySelector(href);
                if (target) {
                    target.scrollIntoView({
                        behavior: 'smooth',
                        block: 'start'
                    });
                }
            }
        });
    });

    // Contact Form Validation
    const contactForm = document.getElementById('contactForm');
    if (contactForm) {
        contactForm.addEventListener('submit', function(e) {
            if (!this.checkValidity()) {
                e.preventDefault();
                e.stopPropagation();
            }
            this.classList.add('was-validated');
        });
    }

    // Navbar Scroll Effect
    window.addEventListener('scroll', function() {
        const navbar = document.querySelector('.navbar');
        if (window.scrollY > 50) {
            navbar.classList.add('navbar-scrolled');
        } else {
            navbar.classList.remove('navbar-scrolled');
        }
    });
});


    const carousel = document.getElementById('galleryCarousel');
    const track = document.getElementById('carouselTrack');

    carousel.addEventListener('mouseenter', () => {
        track.style.animationPlayState = 'paused';
    });

    carousel.addEventListener('mouseleave', () => {
        track.style.animationPlayState = 'running';
    });

</script>
@endpush
