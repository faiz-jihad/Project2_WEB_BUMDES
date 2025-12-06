@extends('layouts.master')

@section('title', 'BUMDes Madusari')

@section('content')
    <div style="font-family: 'Poppins', sans-serif; overflow-x:hidden;">

        {{-- HERO --}}
        <section
            class="hero position-relative text-white text-center d-flex align-items-center justify-content-center overflow-hidden"
            style="height:100vh; background-image: url('{{ asset('images/bgutama.jpg') }}'); background-size: cover; background-position: center;">
            <div class="position-absolute top-0 start-0 w-100 h-100 hero-overlay"
                style="background: linear-gradient(to bottom, rgba(0,0,0,0.4), rgba(0,0,0,0.85)); z-index: 2;"></div>
            <div class="text-center px-3 hero-content" data-aos="fade-up" data-aos-duration="1200" style="z-index: 3;">
                <h1 class="fw-bold display-4 mb-2 text-uppercase" style="letter-spacing:1px;">
                    BUMDes <span class="text-success">Madusari</span>
                </h1>
                <p class="lead mb-4 text-light">Membangun Desa, Meningkatkan Kesejahteraan Bersama</p>
                <a href="#tentang" class="btn btn-success btn-lg rounded-pill shadow hero-btn">Jelajahi Sekarang</a>
            </div>
        </section>

        {{-- TENTANG --}}
        <section id="tentang" class="py-5 bg-light position-relative">
            <div class="container">
                <div class="text-center mb-5" data-aos="fade-down">
                    <h2 class="fw-bold text-success">Tentang Kami</h2>
                    <p class="text-muted">BUMDes Madusari adalah lembaga ekonomi desa yang berkomitmen pada pembangunan
                        berkelanjutan berbasis potensi lokal.</p>
                </div>
                <div class="row align-items-center">
                    <div class="col-md-6" data-aos="fade-right">
                        <img src="{{ asset('images/logo.jpg') }}" loading="lazy"
                            class="img-fluid rounded-4 shadow-lg hover-scale" alt="BUMDes Madusari">
                    </div>
                    <div class="col-md-6" data-aos="fade-left">
                        <h4 class="fw-bold mb-3">Visi & Misi</h4>
                        <p>Menjadi penggerak utama ekonomi desa melalui kolaborasi masyarakat dan inovasi lokal.</p>
                        <ul>
                            <li>Pemberdayaan masyarakat melalui pelatihan dan usaha.</li>
                            <li>Mengelola potensi desa secara mandiri.</li>
                            <li>Meningkatkan kesejahteraan warga dengan semangat gotong royong.</li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="position-absolute top-0 start-0 w-100 h-100"
                style="background: url('{{ asset('images/padi.jpg') }}') center/cover fixed; opacity:0.07;"></div>
        </section>

        {{-- SEJARAH --}}
        <section class="py-5 position-relative">
            <div class="container">
                <div class="text-center mb-5" data-aos="fade-down">
                    <h2 class="fw-bold text-success">Sejarah BUMDes Madusari</h2>
                    <p class="text-muted">Perjalanan panjang pembentukan dan perkembangan BUMDes Madusari dari masa ke masa.
                    </p>
                </div>

                <div class="row g-4">

                    <!-- Timeline 1: Persetujuan Nama 2021 -->
                    <div class="col-md-6" data-aos="fade-right">
                        <div class="timeline-item bg-light p-4 rounded-4 shadow-sm">
                            <div class="timeline-year bg-success text-white rounded-pill d-inline-block px-3 py-1 mb-3">
                                2021
                            </div>
                            <h5 class="fw-bold text-success mb-3">Persetujuan Nama BUMDes</h5>
                            <p class="text-muted mb-0">
                                Nama <strong>BUM Desa Madusari Bayalangu Kidul</strong> resmi memperoleh persetujuan dari
                                Kementerian Desa pada <strong>4 Juli 2021</strong> dengan nomor pendaftaran
                                <strong>3209282014-1-005205</strong>. Ini menjadi fondasi awal pembentukan BUMDes.
                            </p>
                        </div>
                    </div>

                    <!-- Timeline 2: Pembentukan Struktur & Administrasi -->
                    <div class="col-md-6" data-aos="fade-left">
                        <div class="timeline-item bg-light p-4 rounded-4 shadow-sm">
                            <div class="timeline-year bg-success text-white rounded-pill d-inline-block px-3 py-1 mb-3">
                                2021–2022
                            </div>
                            <h5 class="fw-bold text-success mb-3">Pembentukan Struktur & Administrasi</h5>
                            <p class="text-muted mb-0">
                                Pemerintah desa mulai menyusun struktur organisasi, AD/ART, dan regulasi internal untuk
                                mempersiapkan operasional BUMDes secara resmi dan terarah.
                            </p>
                        </div>
                    </div>

                    <!-- Timeline 3: Perintisan Unit Usaha -->
                    <div class="col-md-6" data-aos="fade-right">
                        <div class="timeline-item bg-light p-4 rounded-4 shadow-sm">
                            <div class="timeline-year bg-success text-white rounded-pill d-inline-block px-3 py-1 mb-3">
                                2022
                            </div>
                            <h5 class="fw-bold text-success mb-3">Perintisan Unit Usaha</h5>
                            <p class="text-muted mb-0">
                                BUMDes mulai menjalankan beberapa unit usaha berbasis potensi desa seperti pertanian,
                                perdagangan hasil bumi, dan pemberdayaan UMKM lokal.
                            </p>
                        </div>
                    </div>

                    <!-- Timeline 4: Penguatan Operasional -->
                    <div class="col-md-6" data-aos="fade-left">
                        <div class="timeline-item bg-light p-4 rounded-4 shadow-sm">
                            <div class="timeline-year bg-success text-white rounded-pill d-inline-block px-3 py-1 mb-3">
                                2023–2024
                            </div>
                            <h5 class="fw-bold text-success mb-3">Penguatan Operasional & Inovasi</h5>
                            <p class="text-muted mb-0">
                                BUMDes memperkuat sistem operasional, meningkatkan kapasitas sumber daya manusia, dan
                                membuat
                                rencana pengembangan lebih besar menuju legalitas badan hukum nasional.
                            </p>
                        </div>
                    </div>

                    <!-- Timeline 5: Badan Hukum Resmi 2025 -->
                    <div class="col-md-6" data-aos="fade-right">
                        <div class="timeline-item bg-light p-4 rounded-4 shadow-sm">
                            <div class="timeline-year bg-success text-white rounded-pill d-inline-block px-3 py-1 mb-3">
                                2025
                            </div>
                            <h5 class="fw-bold text-success mb-3">Resmi Menjadi Badan Hukum</h5>
                            <p class="text-muted mb-0">
                                Pada <strong>4 September 2025</strong>, BUM Desa Madusari Bayalangu Kidul resmi terdaftar
                                sebagai
                                badan hukum dengan nomor sertifikat <strong>AHU-11861.AH.01.33.TAHUN 2025</strong>,
                                memberikan
                                kewenangan penuh untuk mengembangkan usaha dan kemitraan secara legal.
                            </p>
                        </div>
                    </div>

                    <!-- Timeline 6: Masa Kini & Masa Depan -->
                    <div class="col-md-6" data-aos="fade-left">
                        <div class="timeline-item bg-success text-white p-4 rounded-4 shadow-sm">
                            <div class="timeline-year bg-white text-success rounded-pill d-inline-block px-3 py-1 mb-3">
                                Sekarang
                            </div>
                            <h5 class="fw-bold mb-3">Ekspansi & Masa Depan</h5>
                            <p class="mb-0">
                                Dengan legalitas penuh dan struktur kuat, BUMDes Madusari fokus pada pengembangan inovasi,
                                digitalisasi layanan, peningkatan ekonomi masyarakat, dan perluasan jaringan usaha desa.
                            </p>
                        </div>
                    </div>

                </div>


                <!-- Background Pattern -->
                <div class="position-absolute top-0 start-0 w-100 h-100"
                    style="background: url('{{ asset('images/pattern.png') }}') repeat; opacity: 0.03;"></div>
        </section>

        {{-- PRODUK --}}
        <section class="py-5 text-center">
            <div class="container">
                <div data-aos="zoom-in">
                    <h2 class="fw-bold text-success mb-3">Produk Unggulan Kami</h2>
                    <p class="text-muted">Dikelola oleh masyarakat, untuk masyarakat.</p>
                </div>
                @if (isset($produk) && $produk->count() > 0)
                    <!-- Swiper Container -->
                    <div class="swiper produk-swiper mt-4">
                        <div class="swiper-wrapper">
                            @foreach ($produk as $item)
                                <div class="swiper-slide">
                                    <div class="produk-card position-relative overflow-hidden" data-aos="fade-up">
                                        <!-- Badge Stok -->
                                        @if ($item->stok <= 0)
                                            <div class="badge-stok bg-danger position-absolute top-0 end-0 m-3 z-index-1">
                                                <i class="fas fa-times-circle me-1"></i>Habis
                                            </div>
                                        @elseif($item->stok <= 5)
                                            <div
                                                class="badge-stok bg-warning text-dark position-absolute top-0 end-0 m-3 z-index-1">
                                                <i class="fas fa-exclamation-triangle me-1"></i>Terbatas
                                            </div>
                                        @else
                                            <div class="badge-stok bg-success position-absolute top-0 end-0 m-3 z-index-1">
                                                <i class="fas fa-check-circle me-1"></i>Tersedia
                                            </div>
                                        @endif

                                        <!-- Gambar Produk -->
                                        <div class="produk-img position-relative overflow-hidden">
                                            <img src="{{ asset('storage/' . $item->gambar) }}" loading="lazy"
                                                alt="{{ $item->nama }}" class="w-100 h-100 object-fit-cover">
                                            <div
                                                class="produk-overlay position-absolute top-0 start-0 w-100 h-100 d-flex align-items-center justify-content-center opacity-0">
                                                <div class="text-center">
                                                    <i class="fas fa-eye text-white fs-3 mb-2"></i>
                                                    <p class="text-white fw-bold mb-0">Lihat Detail</p>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Info Produk -->
                                        <div class="produk-info p-3">
                                            <h3 class="produk-title fw-bold text-dark mb-2 fs-6">
                                                {{ Str::limit($item->nama, 40) }}</h3>
                                            <p class="produk-desc text-muted small mb-3">
                                                {{ Str::limit($item->deskripsi, 80) }}</p>

                                            <div class="produk-price-section mb-3">
                                                <div class="harga fw-bold text-success fs-5 mb-2">Rp
                                                    {{ number_format($item->harga, 0, ',', '.') }}</div>
                                                <div class="produk-rating d-flex align-items-center mb-2">
                                                    <div class="stars me-2">
                                                        <i class="fas fa-star text-warning"></i>
                                                        <i class="fas fa-star text-warning"></i>
                                                        <i class="fas fa-star text-warning"></i>
                                                        <i class="fas fa-star text-warning"></i>
                                                        <i class="fas fa-star-half-alt text-warning"></i>
                                                    </div>
                                                    <small class="text-muted">(4.5)</small>
                                                </div>
                                                <small class="stok-info text-muted d-block">
                                                    <i class="fas fa-boxes me-1"></i>{{ $item->stok }} tersedia
                                                </small>
                                            </div>

                                            <div class="produk-actions d-flex gap-2">
                                                <a href="{{ route('produk.show', $item->id) }}"
                                                    class="btn btn-outline-success flex-fill rounded-pill btn-sm">
                                                    <i class="fas fa-eye me-1"></i>Detail
                                                </a>
                                                @auth
                                                    <button
                                                        class="btn btn-success flex-fill rounded-pill btn-keranjang-home btn-sm"
                                                        data-id="{{ $item->id }}" data-nama="{{ $item->nama }}"
                                                        data-harga="{{ $item->harga }}" data-gambar="{{ $item->gambar }}">
                                                        <i class="fas fa-cart-plus me-1"></i>Keranjang
                                                    </button>
                                                @else
                                                    <a href="{{ route('login') }}"
                                                        class="btn btn-outline-secondary flex-fill rounded-pill btn-sm">
                                                        <i class="fas fa-sign-in-alt me-1"></i>Login
                                                    </a>
                                                @endauth
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        <!-- Navigation arrows -->
                        <div class="swiper-button-next"></div>
                        <div class="swiper-button-prev"></div>
                        <!-- Pagination -->
                        <div class="swiper-pagination"></div>
                    </div>
                @else
                    <p class="no-produk mt-4">Belum ada produk yang tersedia saat ini.</p>
                @endif
            </div>
        </section>

        {{-- MODAL PRODUK --}}
        <div class="modal fade" id="produkModal" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg">
                <div class="modal-content">

                    {{-- Header --}}
                    <div class="modal-header">
                        <h5 class="modal-title" id="produkNama"></h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>

                    {{-- Body --}}
                    <div class="modal-body d-flex flex-column flex-md-row align-items-start">
                        {{-- Gambar --}}
                        <img id="produkGambar" class="img-fluid rounded mb-3 mb-md-0 me-md-3" style="max-width: 300px;"
                            alt="Gambar Produk">

                        {{-- Info Produk --}}
                        <div class="produk-info flex-grow-1">
                            <p id="produkDeskripsi" class="mb-2"></p>
                            <h5 id="produkHarga" class="text-success fw-bold"></h5>
                            <div class="mt-3">
                                {{-- Tombol ke Blade detail produk --}}
                                <a href="#" id="produkLink" class="btn btn-success">Lihat Detail</a>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>



        {{-- BERITA --}}
        <section class="py-5 bg-light">
            <div class="container">
                <div class="text-center mb-5" data-aos="fade-down">
                    <h2 class="fw-bold text-success">Berita Unggulan</h2>
                    <p class="text-muted">Kabar terbaru seputar kegiatan dan inovasi BUMDes Madusari.</p>
                </div>
                <div class="row g-4">
                    @if (isset($banners) && $banners->count() > 0)
                        @foreach ($banners->take(3) as $banner)
                            <div class="col-md-4" data-aos="fade-up">
                                <div class="card border-0 shadow-lg rounded-4 overflow-hidden hover-float h-100">
                                    @if ($banner->berita && $banner->berita->Thumbnail)
                                        <img src="{{ asset('storage/' . $banner->berita->Thumbnail) }}" loading="lazy"
                                            class="card-img-top" alt="{{ $banner->berita->Judul }}">
                                    @else
                                        <img src="{{ asset('images/berita1.jpg') }}" loading="lazy" class="card-img-top"
                                            alt="Berita BUMDes">
                                    @endif
                                    <div class="card-body">
                                        <h5 class="fw-bold">
                                            {{ $banner->berita ? $banner->berita->Judul : 'Judul Berita' }}</h5>
                                        <p class="text-muted small">
                                            {{ $banner->berita ? Str::limit($banner->berita->Isi_Berita, 100) : 'Deskripsi berita akan muncul di sini.' }}
                                        </p>
                                        <a href="{{ $banner->berita ? route('berita.show', $banner->berita->slug) : url('/berita') }}"
                                            class="btn btn-outline-success rounded-pill btn-sm mt-2">Baca Selengkapnya</a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @else
                        @foreach ([['Panen Raya Berhasil Meningkatkan Produksi Desa', 'berita1.jpg', 'Panen padi tahun ini mencapai rekor tertinggi di wilayah Bayalangu Kidul.'], ['Program UMKM Desa Resmi Diluncurkan', 'berita2.jpg', 'Program baru BUMDes yang mendukung pelaku UMKM dengan pendanaan dan pelatihan.'], ['Kerjasama Baru dengan BUMN untuk Energi Hijau', 'berita3.jpg', 'BUMDes Madusari menandatangani MoU dengan BUMN untuk proyek energi terbarukan.']] as $berita)
                            <div class="col-md-4" data-aos="fade-up">
                                <div class="card border-0 shadow-lg rounded-4 overflow-hidden hover-float h-100">
                                    <img src="{{ asset('images/' . $berita[1]) }}" loading="lazy" class="card-img-top"
                                        alt="{{ $berita[0] }}">
                                    <div class="card-body">
                                        <h5 class="fw-bold">{{ $berita[0] }}</h5>
                                        <p class="text-muted small">{{ $berita[2] }}</p>
                                        <a href="{{ url('/berita') }}"
                                            class="btn btn-outline-success rounded-pill btn-sm mt-2">Baca
                                            Selengkapnya</a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @endif
                </div>
            </div>
        </section>

        {{-- STATISTIK --}}
        <section class="py-5 bg-success text-white text-center position-relative">
            <div class="container">
                <h2 class="fw-bold mb-5" data-aos="fade-down">Capaian Kami</h2>
                <div class="row g-4">
                    <div class="col-md-3" data-aos="fade-up" data-aos-delay="100">
                        <h2 class="counter fw-bold" data-target="{{ $anggotaAktif ?? 75 }}">0</h2>
                        <p>Anggota Aktif</p>
                    </div>
                    <div class="col-md-3" data-aos="fade-up" data-aos-delay="200">
                        <h2 class="counter fw-bold" data-target="34">0</h2>
                        <p>Program Usaha</p>
                    </div>
                    <div class="col-md-3" data-aos="fade-up" data-aos-delay="300">
                        <h2 class="counter fw-bold" data-target="8">0</h2>
                        <p>Mitra Strategis</p>
                    </div>
                    <div class="col-md-3" data-aos="fade-up" data-aos-delay="400">
                        <h2 class="counter fw-bold" data-target="100">0%</h2>
                        <p>Dukungan Masyarakat</p>
                    </div>
                </div>
            </div>
        </section>

        {{-- GALERI PREVIEW DI BERANDA --}}
        <section class="py-5 bg-light text-center">
            <div class="container">
                <h2 class="fw-bold text-success mb-4" data-aos="zoom-in">Galeri Kegiatan Terbaru</h2>

                <!-- Swiper Container -->
                <div class="swiper galeri-swiper">
                    <div class="swiper-wrapper">
                        @foreach ($galeriHome as $item)
                            <div class="swiper-slide">
                                <div class="galeri-item" data-aos="zoom-in">
                                    <a href="{{ asset('storage/' . $item->gambar) }}" data-lightbox="galeri">
                                        <img src="{{ asset('storage/' . $item->gambar) }}" loading="lazy"
                                            class="img-fluid rounded-3 shadow-sm hover-scale" alt="{{ $item->judul }}">
                                    </a>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <!-- Navigation arrows -->
                    <div class="swiper-button-next"></div>
                    <div class="swiper-button-prev"></div>
                    <!-- Pagination -->
                    <div class="swiper-pagination"></div>
                </div>

                <div class="mt-4">
                    <a href="{{ route('galeri.index') }}" class="btn btn-success btn-lg">Lihat Semua Galeri</a>
                </div>
            </div>
        </section>
        </section>

        {{-- MAP + KONTAK (Serasi & Profesional) --}}
        <section id="kontak" class="py-5 position-relative">
            <div class="position-absolute w-100 h-100 top-0 start-0"
                style="background: url('{{ asset('images/pattern.png') }}') repeat; opacity: 0.04;"></div>

            <div class="container position-relative">
                <div class="text-center mb-5">
                    <h2 class="fw-bold text-success mb-2" data-aos="fade-down">Lokasi & Kontak</h2>
                    <p class="text-muted mb-0" data-aos="fade-up">Bersinergi membangun desa yang lebih maju — hubungi kami
                        untuk kolaborasi.</p>
                </div>

                <div class="row g-4 align-items-center">
                    <div class="col-md-6" data-aos="fade-right">
                        <div class="map-card shadow-lg rounded-4 overflow-hidden position-relative">
                            {{-- Poster overlay to lazy-load iframe for performance + accessible --}}
                            <button type="button"
                                class="map-poster position-absolute w-100 h-100 top-0 start-0 d-flex align-items-center justify-content-center text-white border-0"
                                aria-label="Tampilkan peta interaktif" title="Klik untuk memuat peta interaktif">
                                <div class="text-center px-3">
                                    <i class="bi bi-map-fill fs-1 mb-2" aria-hidden="true"></i>
                                    <h5 class="mb-1 fw-semibold">Tampilkan Peta</h5>
                                    <p class="small mb-0">Klik untuk memuat Peta </p>
                                </div>
                            </button>

                            {{-- Pulsing marker --}}
                            <div class="map-pin position-absolute" aria-hidden="true">
                                <div class="pin-outer"></div>
                                <div class="pin-inner"></div>
                            </div>

                            {{-- Placeholder until clicked --}}
                            <div class="map-frame w-100" style="min-height:360px; background:#f8fafb;"
                                data-src="https://www.google.com/maps?q=Bayalangu+Kidul,+Indramayu&output=embed">
                                <noscript>
                                    <iframe src="https://www.google.com/maps?q=Bayalangu+Kidul,+Indramayu&output=embed"
                                        loading="lazy" width="100%" height="360" style="border:0;"
                                        allowfullscreen></iframe>
                                </noscript>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6" data-aos="fade-left">
                        <div class="contact-card bg-white p-4 rounded-4 shadow-lg position-relative overflow-hidden">
                            <div class="d-flex align-items-start gap-3">
                                <div class="me-2">
                                    <img src="{{ asset('images/logo.jpg') }}" alt="Logo BUMDes Madusari"
                                        class="rounded-3" style="width:84px; height:84px; object-fit:cover;">
                                </div>
                                <div class="flex-grow-1">
                                    <h4 class="fw-bold mb-1">BUMDes Madusari</h4>
                                    <p class="text-muted mb-2">Bayalangu Kidul, Kabupaten Cirebon</p>

                                    <div class="d-flex flex-wrap gap-2 mb-3">
                                        <button class="btn btn-outline-success btn-sm copy-btn"
                                            data-copy="Bayalangu Kidul, Kabupaten Cirebon" aria-label="Salin alamat">
                                            <i class="bi bi-geo-alt me-1" aria-hidden="true"></i> Salin Alamat
                                        </button>
                                        <button class="btn btn-outline-success btn-sm copy-btn"
                                            data-copy="bumdesmadusari2025@gmail.com" aria-label="Salin email">
                                            <i class="bi bi-envelope me-1" aria-hidden="true"></i> Salin Email
                                        </button>
                                        <a href="https://wa.me/6281234567890" target="_blank" rel="noopener"
                                            class="btn btn-success btn-sm" aria-label="Hubungi via WhatsApp">
                                            <i class="bi bi-whatsapp me-1" aria-hidden="true"></i> Hubungi via WA
                                        </a>
                                    </div>

                                    <div class="row g-2 mb-3 text-center">
                                        <div class="col-4">
                                            <h3 class="mb-0 counter-compact" data-target="120" aria-live="polite">0</h3>
                                            <small class="text-muted">Kegiatan</small>
                                        </div>
                                        <div class="col-4">
                                            <h3 class="mb-0 counter-compact" data-target="75" aria-live="polite">0</h3>
                                            <small class="text-muted">Anggota</small>
                                        </div>
                                        <div class="col-4">
                                            <h3 class="mb-0 counter-compact" data-target="98" aria-live="polite">0%</h3>
                                            <small class="text-muted">Kepuasan</small>
                                        </div>
                                    </div>

                                    <div class="d-flex gap-2">
                                        <button class="btn btn-outline-success btn-sm" data-bs-toggle="modal"
                                            data-bs-target="#contactModal" aria-haspopup="dialog"
                                            aria-controls="contactModal">
                                            <i class="bi bi-chat-left-text me-1" aria-hidden="true"></i> Kirim Pesan
                                        </button>
                                        <a href="{{ route('galeri.index') }}" class="btn btn-success btn-sm">
                                            <i class="bi bi-images me-1" aria-hidden="true"></i> Lihat Galeri
                                        </a>
                                    </div>
                                </div>
                            </div>

                            {{-- subtle decorative bottom wave --}}
                            <svg class="position-absolute bottom-0 start-0 w-100" height="50" viewBox="0 0 1200 120"
                                preserveAspectRatio="none" style="transform:translateY(50%); opacity:0.06;">
                                <path d="M0,0 C150,100 350,0 600,0 C850,0 1050,100 1200,0 L1200,120 L0,120 Z"
                                    fill="#198754"></path>
                            </svg>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        {{-- Modal Kirim Pesan --}}
        <div class="modal fade" id="contactModal" tabindex="-1" aria-hidden="true"
            aria-labelledby="contactModalTitle">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content rounded-4">
                    <div class="modal-header">
                        <h5 class="modal-title" id="contactModalTitle">Kirim Pesan ke BUMDes Madusari</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
                    </div>
                    <form id="contactForm" action="{{ url('/kontak/kirim') }}" method="POST" class="needs-validation"
                        novalidate>
                        @csrf
                        <div class="modal-body">
                            <div class="mb-2">
                                <label for="contactNama" class="form-label small">Nama</label>
                                <input id="contactNama" type="text" name="nama" class="form-control" required>
                                <div class="invalid-feedback">Nama wajib diisi.</div>
                            </div>
                            <div class="mb-2">
                                <label for="contactEmail" class="form-label small">Email</label>
                                <input id="contactEmail" type="email" name="email" class="form-control" required>
                                <div class="invalid-feedback">Email valid diperlukan.</div>
                            </div>
                            <div class="mb-2">
                                <label for="contactPesan" class="form-label small">Pesan</label>
                                <textarea id="contactPesan" name="pesan" rows="4" class="form-control" required></textarea>

                                <div class="invalid-feedback">Tolong isi pesan Anda.</div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-success">Kirim</button>
                            <button type="button" class="btn btn-outline-secondary"
                                data-bs-dismiss="modal">Batal</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>



        <style>
            :root {
                --accent: #198754;
                --accent-strong: #146c43;
                --muted-bg: #f8fafb;
            }

            /* Map + Pin */
            .map-card {
                border-radius: 14px;
                overflow: hidden;
                background: var(--muted-bg);
            }

            .map-poster {
                transition: opacity .25s ease, transform .25s ease;
                z-index: 5;
                background: linear-gradient(180deg, rgba(0, 0, 0, 0.22), rgba(0, 0, 0, 0.42));
                color: #fff;
            }

            .map-poster:hover {
                transform: scale(1.02);
            }

            .map-poster:focus {
                outline: none;
                box-shadow: 0 0 0 4px rgba(25, 135, 84, 0.12);
            }

            .map-pin {
                left: 50%;
                top: 45%;
                transform: translate(-50%, -50%);
                width: 28px;
                height: 28px;
                z-index: 6;
                pointer-events: none;
            }

            .pin-outer {
                position: absolute;
                width: 28px;
                height: 28px;
                border-radius: 50%;
                background: rgba(25, 135, 84, 0.18);
                animation: pulse 2s infinite;
                left: 0;
                top: 0;
            }

            .pin-inner {
                position: absolute;
                width: 12px;
                height: 12px;
                border-radius: 50%;
                background: var(--accent);
                left: 8px;
                top: 8px;
                box-shadow: 0 4px 12px rgba(25, 135, 84, 0.35);
                transform-origin: center;
            }

            @keyframes pulse {
                0% {
                    transform: scale(.85);
                    opacity: .9;
                }

                70% {
                    transform: scale(2.2);
                    opacity: 0;
                }

                100% {
                    transform: scale(2.2);
                    opacity: 0;
                }
            }

            .contact-card {
                transition: transform .25s ease, box-shadow .25s ease;
            }

            .contact-card:hover {
                transform: translateY(-6px);
            }

            .counter-compact {
                font-size: 1.25rem;
                color: var(--accent);
                font-weight: 700;
            }

            .copy-btn {
                min-width: 160px;
            }

            /* Accessibility: focus on interactive small buttons */
            .copy-btn:focus {
                box-shadow: 0 0 0 4px rgba(25, 135, 84, 0.08);
                outline: none;
            }

            /* Responsive */
            @media (max-width: 767px) {
                .map-pin {
                    top: 40%;
                }

                .copy-btn {
                    min-width: 120px;
                }
            }
        </style>

        <script>
            document.addEventListener('DOMContentLoaded', function() {
                // Lazy load map iframe on poster click / keyboard activation
                document.querySelectorAll('.map-card').forEach(card => {
                    const poster = card.querySelector('.map-poster');
                    const frameContainer = card.querySelector('.map-frame');
                    if (!poster || !frameContainer) return;

                    const loadMap = function() {
                        if (frameContainer.dataset.loaded) {
                            poster.style.opacity = 0;
                            poster.style.pointerEvents = 'none';
                            return;
                        }
                        const src = frameContainer.getAttribute('data-src') || frameContainer.dataset.src;
                        if (!src) return;
                        const iframe = document.createElement('iframe');
                        iframe.width = '100%';
                        iframe.height = '360';
                        iframe.loading = 'lazy';
                        iframe.style.border = '0';
                        iframe.allowFullscreen = true;
                        iframe.src = src;
                        frameContainer.appendChild(iframe);
                        frameContainer.dataset.loaded = '1';
                        poster.style.transition = 'opacity .4s';
                        poster.style.opacity = 0;
                        poster.style.pointerEvents = 'none';
                    };

                    poster.addEventListener('click', loadMap);
                    poster.addEventListener('keydown', function(e) {
                        if (e.key === 'Enter' || e.key === ' ') {
                            e.preventDefault();
                            loadMap();
                        }
                    });
                });

                // Copy to clipboard (address/email) with feedback
                document.querySelectorAll('.copy-btn').forEach(btn => {
                    btn.addEventListener('click', async function() {
                        const text = this.getAttribute('data-copy') || '';
                        try {
                            await navigator.clipboard.writeText(text);
                            if (typeof Swal !== 'undefined') {
                                Swal.fire({
                                    toast: true,
                                    position: 'top-end',
                                    icon: 'success',
                                    title: 'Berhasil disalin',
                                    text: text,
                                    showConfirmButton: false,
                                    timer: 1500
                                });
                            } else {
                                // graceful fallback
                                const tip = document.createElement('div');
                                tip.className = 'toast align-items-center text-bg-success border-0';
                                tip.style.position = 'fixed';
                                tip.style.top = '1rem';
                                tip.style.right = '1rem';
                                tip.style.zIndex = 9999;
                                tip.innerHTML =
                                    '<div class="d-flex"><div class="toast-body text-white">Disalin: ' +
                                    text + '</div></div>';
                                document.body.appendChild(tip);
                                setTimeout(() => tip.remove(), 1800);
                            }
                        } catch (err) {
                            console.error('Clipboard error', err);
                            if (typeof Swal !== 'undefined') {
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Gagal',
                                    text: 'Tidak dapat menyalin ke clipboard.'
                                });
                            }
                        }
                    });
                });

                // Compact counters when in view (avoid global name collision)
                const compactCounters = document.querySelectorAll('.counter-compact');
                const compactObserver = new IntersectionObserver(entries => {
                    entries.forEach(entry => {
                        if (!entry.isIntersecting) return;
                        const el = entry.target;
                        const target = +el.getAttribute('data-target') || 0;
                        const duration = 900;
                        const start = performance.now();
                        const init = +el.innerText.replace(/\D/g, '') || 0;
                        const animate = (now) => {
                            const progress = Math.min((now - start) / duration, 1);
                            const value = Math.floor(init + (target - init) * progress);
                            el.innerText = el.innerText.includes('%') ? (value + '%') : value;
                            if (progress < 1) requestAnimationFrame(animate);
                        };
                        requestAnimationFrame(animate);
                        compactObserver.unobserve(el);
                    });
                }, {
                    threshold: 0.5
                });
                compactCounters.forEach(c => compactObserver.observe(c));

                // Focus first input when contact modal shown
                const contactModalEl = document.getElementById('contactModal');
                if (contactModalEl) {
                    contactModalEl.addEventListener('shown.bs.modal', function() {
                        const firstInput = contactModalEl.querySelector('input, textarea, button');
                        if (firstInput) firstInput.focus();
                    });
                }

                // Client-side Bootstrap validation for contact form (keeps server fallback)
                (function() {
                    const forms = document.querySelectorAll('.needs-validation');
                    Array.prototype.slice.call(forms).forEach(function(form) {
                        form.addEventListener('submit', function(event) {
                            if (!form.checkValidity()) {
                                event.preventDefault();
                                event.stopPropagation();
                                form.classList.add('was-validated');
                                return;
                            }
                            const submitBtn = form.querySelector('button[type="submit"]');
                            if (submitBtn) {
                                submitBtn.disabled = true;
                                submitBtn.innerHTML =
                                    '<i class="bi bi-hourglass-split me-1"></i> Mengirim...';
                            }
                            // server handles actual submission
                        }, false);
                    });
                })();
            });
        </script>

    </div>

    {{-- CSS --}}
    <link href="https://unpkg.com/aos@next/dist/aos.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.3/css/lightbox.min.css" rel="stylesheet">
    <!-- Swiper CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />

    {{-- JS --}}
    <script src="https://unpkg.com/aos@next/dist/aos.js" defer></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.3/js/lightbox.min.js" defer></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" defer></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <!-- Swiper JS -->
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>

    <script defer>
        function showProdukModal(produk) {
            document.getElementById('produkNama').innerText = produk.nama;
            document.getElementById('produkGambar').src = produk.gambar;
            document.getElementById('produkDeskripsi').innerText = produk.deskripsi;
            document.getElementById('produkHarga').innerText = 'Rp ' + produk.harga.toLocaleString('id-ID');
            document.getElementById('produkLink').href = produk.link;

            const produkModal = new bootstrap.Modal(document.getElementById('produkModal'));
            produkModal.show();
        }


        document.addEventListener("DOMContentLoaded", () => {

            // Produk Modal
            const produkBtns = document.querySelectorAll('.lihat-detail');
            const modal = document.getElementById('produkModal');
            const modalNama = modal.querySelector('#produkNama');
            const modalDeskripsi = modal.querySelector('#produkDeskripsi');
            const modalHarga = modal.querySelector('#produkHarga');
            const modalGambar = modal.querySelector('#produkGambar');
            produkBtns.forEach(btn => {
                btn.addEventListener('click', () => {
                    modalNama.textContent = btn.dataset.nama;
                    modalDeskripsi.textContent = btn.dataset.deskripsi;
                    modalHarga.textContent = btn.dataset.harga;
                    modalGambar.src = btn.dataset.gambar;
                    modalGambar.alt = btn.dataset.nama;
                });
            });

            // Counters
            const counters = document.querySelectorAll('.counter');
            const observer = new IntersectionObserver(entries => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        const counter = entry.target;
                        const target = +counter.getAttribute('data-target');
                        let count = 0;
                        const updateCount = () => {
                            count += Math.ceil(target / 100);
                            if (count < target) {
                                counter.innerText = count + (counter.innerText.includes('%') ?
                                    '%' : '');
                                requestAnimationFrame(updateCount);
                            } else {
                                counter.innerText = target + (counter.innerText.includes('%') ?
                                    '%' : '');
                            }
                        };
                        updateCount();
                        observer.unobserve(counter);
                    }
                });
            }, {
                threshold: 0.5
            });
            counters.forEach(counter => observer.observe(counter));

            // AOS Init
            AOS.init({
                once: true,
                duration: 1000
            });

            // Initialize Swiper for Galeri
            const galeriSwiper = new Swiper('.galeri-swiper', {
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
                        spaceBetween: 30,
                    },
                    992: {
                        slidesPerView: 4,
                        spaceBetween: 30,
                    },
                },
            });

            // Initialize Swiper for Produk
            const produkSwiper = new Swiper('.produk-swiper', {
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
                        slidesPerView: 2,
                        spaceBetween: 30,
                    },
                    992: {
                        slidesPerView: 3,
                        spaceBetween: 30,
                    },
                },
            });

            // SweetAlert untuk success messages
            @if (session('success'))
                Swal.fire({
                    icon: 'success',
                    title: 'Berhasil!',
                    text: '{{ session('success') }}',
                    timer: 3000,
                    showConfirmButton: false
                });
            @endif

            // Add to cart functionality for homepage products
            document.querySelectorAll('.btn-keranjang-home').forEach(btn => {
                btn.addEventListener('click', function() {
                    const produkId = this.getAttribute('data-id');
                    const produkNama = this.getAttribute('data-nama');

                    // Show loading state
                    this.disabled = true;
                    this.innerHTML = '<i class="bi bi-hourglass-split"></i> Menambahkan...';

                    fetch("{{ route('keranjang.tambah') }}", {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': document.querySelector(
                                    'meta[name="csrf-token"]').content
                            },
                            body: JSON.stringify({
                                produk_id: produkId,
                                variasi: null
                            })
                        })
                        .then(res => res.json())
                        .then(data => {
                            // Reset button state
                            this.disabled = false;
                            this.innerHTML = '<i class="bi bi-cart-plus"></i> Keranjang';

                            if (data.success) {
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Berhasil!',
                                    text: `${produkNama} berhasil ditambahkan ke keranjang!`,
                                    timer: 2000,
                                    showConfirmButton: false
                                });

                                // Trigger cart update event for real-time navbar update
                                document.dispatchEvent(new CustomEvent('cartUpdated'));
                            } else {
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Gagal!',
                                    text: data.message ||
                                        'Gagal menambahkan produk ke keranjang.'
                                });
                            }
                        })
                        .catch(error => {
                            // Reset button state
                            this.disabled = false;
                            this.innerHTML = '<i class="bi bi-cart-plus"></i> Keranjang';

                            console.error('Error:', error);
                            Swal.fire({
                                icon: 'error',
                                title: 'Error!',
                                text: 'Terjadi kesalahan saat menambahkan produk ke keranjang.'
                            });
                        });
                });
            });
        });
    </script>

    <style>
        .hero-content {
            position: relative;
            z-index: 3;
            animation: fadeIn 1.5s ease forwards;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(25px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .hero-btn {
            transition: all 0.3s ease;
        }

        .hero-btn:hover {
            transform: scale(1.1);
            box-shadow: 0 0 25px rgba(0, 255, 128, 0.5);
        }

        .hover-scale:hover {
            transform: scale(1.05);
            transition: .3s ease;
        }

        .hover-float:hover {
            transform: translateY(-8px);
            transition: .3s ease;
        }

        /* Swiper Produk Styles */
        .produk-swiper {
            width: 100%;
            padding-bottom: 50px;
        }

        .produk-swiper .swiper-slide {
            display: flex;
            justify-content: center;
            align-items: stretch;
        }

        .produk-swiper .swiper-pagination {
            bottom: 0;
        }

        .produk-swiper .swiper-pagination-bullet {
            background: var(--green);
            opacity: 0.5;
        }

        .produk-swiper .swiper-pagination-bullet-active {
            opacity: 1;
        }

        /* Swiper Navigation Customization for Produk */
        .produk-swiper .swiper-button-next,
        .produk-swiper .swiper-button-prev {
            color: var(--green);
            background: rgba(255, 255, 255, 0.9);
            border-radius: 50%;
            width: 45px;
            height: 45px;
            margin-top: -22px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease;
        }

        .produk-swiper .swiper-button-next:hover,
        .produk-swiper .swiper-button-prev:hover {
            background: var(--green);
            color: white;
            transform: scale(1.1);
        }

        .produk-swiper .swiper-button-next:after,
        .produk-swiper .swiper-button-prev:after {
            font-size: 16px;
            font-weight: bold;
        }

        .produk-card {
            width: 100%;
            max-width: 280px;
            background: #ffffff;
            border-radius: 8px;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
            transition: all 0.2s ease;
            overflow: hidden;
            position: relative;
            border: 1px solid #e1e5e9;
            height: 70%;
            display: flex;
            flex-direction: column;
        }

        .produk-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
        }

        .produk-img {
            height: 180px;
            position: relative;
            overflow: hidden;
            background: #f8f9fa;
            flex-shrink: 0;
        }

        .produk-img img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.2s ease;
        }

        .produk-card:hover .produk-img img {
            transform: scale(1.03);
        }

        .produk-overlay {
            background: linear-gradient(45deg, rgba(25, 135, 84, 0.9), rgba(15, 112, 83, 0.9));
            transition: opacity 0.3s ease;
            backdrop-filter: blur(2px);
        }

        .produk-card:hover .produk-overlay {
            opacity: 1 !important;
        }

        .produk-info {
            background: white;
            padding: 10px;
            flex: 1;
            display: flex;
            flex-direction: column;
        }

        .produk-title {
            color: #1a202c;
            font-size: 0.85rem;
            line-height: 1.3;
            font-weight: 600;
            margin-bottom: 4px;
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }

        .produk-desc {
            color: #718096;
            font-size: 0.65rem;
            line-height: 1.2;
            margin-bottom: 4px;
            display: -webkit-box;
            -webkit-line-clamp: 1;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }

        .produk-price-section {
            margin-bottom: 8px;
        }

        .harga {
            color: #e53e3e;
            font-size: 0.95rem;
            font-weight: 700;
            margin-bottom: 2px;
        }

        .produk-rating {
            margin-bottom: 4px;
        }

        .stars {
            color: #fbbf24;
        }

        .stars i {
            font-size: 0.7rem;
            margin-right: 1px;
        }

        .produk-rating small {
            color: #a0aec0;
            font-size: 0.65rem;
        }

        .stok-info {
            color: #68d391;
            font-size: 0.65rem;
            font-weight: 500;
        }

        .badge-stok {
            font-size: 0.55rem;
            padding: 0.2rem 0.4rem;
            border-radius: 4px;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.025em;
            box-shadow: 0 1px 2px rgba(0, 0, 0, 0.1);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }

        .produk-actions {
            margin-top: auto;
            display: flex;
            gap: 6px;


            .hover-zoom:hover {
                transform: scale(1.1);
                transition: .4s ease;
            }

            .hover-float:hover {
                transform: translateY(-8px);
                transition: .3s ease;
            }

            /* Modal Produk */
            #produkModal .modal-content {
                border-radius: 12px;
                padding: 15px;
            }

            #produkModal .modal-body {
                gap: 20px;
            }

            #produkModal .produk-info p {
                font-size: 0.95rem;
                color: #555;
            }

            #produkModal .produk-info h5 {
                font-size: 1.2rem;
            }

            #produkModal .btn-success {
                background: #198754;
                border: none;
                padding: 8px 16px;
                border-radius: 8px;
                font-weight: 600;
            }

            #produkModal .btn-success:hover {
                background: #146c43;
            }

            /* Swiper Galeri Styles */
            .galeri-swiper {
                width: 100%;
                height: 300px;
                margin-bottom: 2rem;
            }

            .galeri-swiper .swiper-slide {
                display: flex;
                justify-content: center;
                align-items: center;
            }

            .galeri-item {
                width: 100%;
                height: 250px;
                overflow: hidden;
                border-radius: 0.5rem;
                box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
                transition: transform 0.3s ease, box-shadow 0.3s ease;
            }

            .galeri-item img {
                width: 100%;
                height: 100%;
                object-fit: cover;
                transition: transform 0.3s ease;
            }

            .galeri-item:hover {
                transform: translateY(-5px);
                box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15);
            }

            .galeri-item:hover img {
                transform: scale(1.1);
            }

            /* Swiper Navigation Customization */
            .galeri-swiper .swiper-button-next,
            .galeri-swiper .swiper-button-prev {
                color: var(--green);
                background: rgba(255, 255, 255, 0.8);
                border-radius: 50%;
                width: 40px;
                height: 40px;
                margin-top: -20px;
            }

            .galeri-swiper .swiper-button-next:after,
            .galeri-swiper .swiper-button-prev:after {
                font-size: 16px;
                font-weight: bold;
            }

            .galeri-swiper .swiper-pagination {
                bottom: -40px;
            }

            .galeri-swiper .swiper-pagination-bullet {
                background: var(--green);
                opacity: 0.5;
            }

            .galeri-swiper .swiper-pagination-bullet-active {
                opacity: 1;
            }

            @media (max-width: 768px) {
                .galeri-swiper {
                    height: 250px;
                }

                .galeri-item {
                    height: 200px;
                }

                .galeri-swiper .swiper-button-next,
                .galeri-swiper .swiper-button-prev {
                    width: 35px;
                    height: 35px;
                }
            }
    </style>
    </style>
@endsection
