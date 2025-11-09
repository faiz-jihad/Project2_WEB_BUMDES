@extends('layouts.master')

@section('title', 'Tentang Kami')

@section('content')
    <div style="font-family: 'Poppins', sans-serif; overflow-x:hidden;">

        {{-- HERO ABOUT --}}
        <section
            class="hero-about position-relative text-white text-center d-flex align-items-center justify-content-center overflow-hidden"
            style="height:60vh;">
            <div class="hero-slideshow position-absolute w-100 h-100">
                <div class="slide active" style="background-image: url('{{ asset('images/bgutama.jpg') }}');"></div>
            </div>
            <div class="position-absolute top-0 start-0 w-100 h-100"
                style="background: linear-gradient(to bottom, rgba(0,0,0,0.4), rgba(0,0,0,0.85));"></div>
            <div class="text-center px-3 hero-content" data-aos="fade-up" data-aos-duration="1200">
                <h1 class="fw-bold display-4 mb-2 text-uppercase" style="letter-spacing:1px;">
                    Tentang <span class="text-success">BUMDes Madusari</span>
                </h1>
                <p class="lead mb-4 text-light">Mengenal lebih dalam tentang perjalanan dan visi kami</p>
            </div>
        </section>

        {{-- VISI MISI --}}
        <section class="py-5 bg-light">
            <div class="container">
                <div class="text-center mb-5" data-aos="fade-down">
                    <h2 class="fw-bold text-success">Visi & Misi</h2>
                    <p class="text-muted">BUMDes Madusari adalah lembaga ekonomi desa yang berkomitmen pada pembangunan
                        berkelanjutan berbasis potensi lokal.</p>
                </div>
                <div class="row align-items-center">
                    <div class="col-md-6" data-aos="fade-right">
                        <img src="{{ asset('images/logo.jpg') }}" loading="lazy"
                            class="img-fluid rounded-4 shadow-lg hover-scale" alt="BUMDes Madusari">
                    </div>
                    <div class="col-md-6" data-aos="fade-left">
                        <h4 class="fw-bold mb-3">Visi Kami</h4>
                        <p>Menjadi penggerak utama ekonomi desa melalui kolaborasi masyarakat dan inovasi lokal untuk
                            mencapai kesejahteraan bersama.</p>
                        <h4 class="fw-bold mb-3 mt-4">Misi Kami</h4>
                        <ul class="list-unstyled">
                            <li class="mb-2"><i class="bi bi-check-circle-fill text-success me-2"></i>Pemberdayaan
                                masyarakat melalui pelatihan dan usaha</li>
                            <li class="mb-2"><i class="bi bi-check-circle-fill text-success me-2"></i>Mengelola potensi
                                desa secara mandiri</li>
                            <li class="mb-2"><i class="bi bi-check-circle-fill text-success me-2"></i>Meningkatkan
                                kesejahteraan warga dengan semangat gotong royong</li>
                            <li class="mb-2"><i class="bi bi-check-circle-fill text-success me-2"></i>Mendorong inovasi
                                dan teknologi untuk kemajuan desa</li>
                        </ul>
                    </div>
                </div>
            </div>
        </section>

        {{-- TIM KAMI --}}
        <section class="py-5">
            <div class="container">
                <div class="text-center mb-5" data-aos="zoom-in">
                    <h2 class="fw-bold text-success">Tim Kami</h2>
                    <p class="text-muted">Orang-orang di balik kesuksesan BUMDes Madusari</p>
                </div>
                <div class="row g-4">
                    <div class="col-md-4" data-aos="fade-up" data-aos-delay="100">
                        <div class="card border-0 shadow-lg text-center h-100">
                            <div class="card-body">
                                <img src="{{ asset('images/pp.jpg') }}" class="rounded-circle mb-3"
                                    style="width: 120px; height: 120px; object-fit: cover;" alt="Ketua">
                                <h5 class="card-title fw-bold">Nama Ketua</h5>
                                <p class="card-text text-muted">Ketua BUMDes Madusari</p>
                                <p class="card-text">Memimpin dengan visi dan komitmen untuk kemajuan desa.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4" data-aos="fade-up" data-aos-delay="200">
                        <div class="card border-0 shadow-lg text-center h-100">
                            <div class="card-body">
                                <img src="{{ asset('images/pp.jpg') }}" class="rounded-circle mb-3"
                                    style="width: 120px; height: 120px; object-fit: cover;" alt="Sekretaris">
                                <h5 class="card-title fw-bold">Nama Sekretaris</h5>
                                <p class="card-text text-muted">Sekretaris BUMDes Madusari</p>
                                <p class="card-text">Bertanggung jawab atas administrasi dan koordinasi kegiatan.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4" data-aos="fade-up" data-aos-delay="300">
                        <div class="card border-0 shadow-lg text-center h-100">
                            <div class="card-body">
                                <img src="{{ asset('images/pp.jpg') }}" class="rounded-circle mb-3"
                                    style="width: 120px; height: 120px; object-fit: cover;" alt="Bendahara">
                                <h5 class="card-title fw-bold">Nama Bendahara</h5>
                                <p class="card-text text-muted">Bendahara BUMDes Madusari</p>
                                <p class="card-text">Mengelola keuangan dengan transparan dan akuntabel.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        {{-- PROGRAM KAMI --}}
        <section class="py-5 bg-light">
            <div class="container">
                <div class="text-center mb-5" data-aos="fade-down">
                    <h2 class="fw-bold text-success">Program Unggulan</h2>
                    <p class="text-muted">Inisiatif-inisiatif kami untuk membangun desa yang lebih baik</p>
                </div>
                <div class="row g-4">
                    <div class="col-md-4" data-aos="fade-up" data-aos-delay="100">
                        <div class="card border-0 shadow-lg h-100">
                            <div class="card-body text-center">
                                <div class="mb-3">
                                    <i class="bi bi-shop display-4 text-success"></i>
                                </div>
                                <h5 class="card-title fw-bold">UMKM Desa</h5>
                                <p class="card-text">Mendukung pengembangan usaha mikro kecil dan menengah di desa dengan
                                    pendanaan dan pelatihan.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4" data-aos="fade-up" data-aos-delay="200">
                        <div class="card border-0 shadow-lg h-100">
                            <div class="card-body text-center">
                                <div class="mb-3">
                                    <i class="bi bi-tree display-4 text-success"></i>
                                </div>
                                <h5 class="card-title fw-bold">Pertanian Modern</h5>
                                <p class="card-text">Menerapkan teknologi modern dalam pertanian untuk meningkatkan
                                    produktivitas dan kualitas hasil panen.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4" data-aos="fade-up" data-aos-delay="300">
                        <div class="card border-0 shadow-lg h-100">
                            <div class="card-body text-center">
                                <div class="mb-3">
                                    <i class="bi bi-lightbulb display-4 text-success"></i>
                                </div>
                                <h5 class="card-title fw-bold">Energi Terbarukan</h5>
                                <p class="card-text">Mengembangkan sumber energi alternatif ramah lingkungan untuk desa
                                    yang lebih hijau.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        {{-- PRESTASI --}}
        <section class="py-5 bg-success text-white">
            <div class="container">
                <div class="text-center mb-5" data-aos="zoom-in">
                    <h2 class="fw-bold">Prestasi Kami</h2>
                    <p class="mb-0">Pencapaian yang membanggakan dalam membangun desa</p>
                </div>
                <div class="row g-4">
                    <div class="col-md-3 text-center" data-aos="fade-up" data-aos-delay="100">
                        <h2 class="counter fw-bold display-4" data-target="75">0</h2>
                        <p class="mb-0">Anggota Aktif</p>
                    </div>
                    <div class="col-md-3 text-center" data-aos="fade-up" data-aos-delay="200">
                        <h2 class="counter fw-bold display-4" data-target="34">0</h2>
                        <p class="mb-0">Program Usaha</p>
                    </div>
                    <div class="col-md-3 text-center" data-aos="fade-up" data-aos-delay="300">
                        <h2 class="counter fw-bold display-4" data-target="8">0</h2>
                        <p class="mb-0">Mitra Strategis</p>
                    </div>
                    <div class="col-md-3 text-center" data-aos="fade-up" data-aos-delay="400">
                        <h2 class="counter fw-bold display-4" data-target="100">0%</h2>
                        <p class="mb-0">Kepuasan Masyarakat</p>
                    </div>
                </div>
            </div>
        </section>

        {{-- KONTAK --}}
        <section class="py-5">
            <div class="container">
                <div class="text-center mb-5" data-aos="fade-down">
                    <h2 class="fw-bold text-success">Hubungi Kami</h2>
                    <p class="text-muted">Mari berkolaborasi untuk kemajuan desa bersama</p>
                </div>
                <div class="row justify-content-center">
                    <div class="col-md-8" data-aos="zoom-in">
                        <div class="card border-0 shadow-lg">
                            <div class="card-body p-4">
                                <div class="row">
                                    <div class="col-md-6">
                                        <h5 class="fw-bold mb-3">Informasi Kontak</h5>
                                        <div class="mb-3">
                                            <i class="bi bi-geo-alt-fill text-success me-2"></i>
                                            <span>Bayalangu Kidul, Kabupaten Indramayu</span>
                                        </div>
                                        <div class="mb-3">
                                            <i class="bi bi-telephone-fill text-success me-2"></i>
                                            <span>+62 123 4567 890</span>
                                        </div>
                                        <div class="mb-3">
                                            <i class="bi bi-envelope-fill text-success me-2"></i>
                                            <span>info@bumdesmadusari.id</span>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <h5 class="fw-bold mb-3">Ikuti Kami</h5>
                                        <div class="d-flex gap-3">
                                            <a href="#" class="btn btn-outline-success btn-sm">
                                                <i class="bi bi-facebook"></i>
                                            </a>
                                            <a href="#" class="btn btn-outline-success btn-sm">
                                                <i class="bi bi-instagram"></i>
                                            </a>
                                            <a href="#" class="btn btn-outline-success btn-sm">
                                                <i class="bi bi-twitter"></i>
                                            </a>
                                            <a href="#" class="btn btn-outline-success btn-sm">
                                                <i class="bi bi-youtube"></i>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

    </div>

    {{-- CSS --}}
    <link href="https://unpkg.com/aos@next/dist/aos.css" rel="stylesheet">

    {{-- JS --}}
    <script src="https://unpkg.com/aos@next/dist/aos.js" defer></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" defer></script>

    <script defer>
        document.addEventListener("DOMContentLoaded", () => {
            // AOS Init
            AOS.init({
                once: true,
                duration: 1000
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
        });
    </script>

    <style>
        .hero-about {
            background: linear-gradient(135deg, #198754 0%, #146c43 100%);
        }

        .hero-slideshow {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            overflow: hidden;
        }

        .slide {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-size: cover;
            background-position: center;
            opacity: 0;
            transition: opacity 2.5s ease-in-out;
        }

        .slide.active {
            opacity: 1;
        }

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

        .hover-scale:hover {
            transform: scale(1.05);
            transition: .3s ease;
        }

        .card:hover {
            transform: translateY(-5px);
            transition: .3s ease;
        }

        .counter {
            font-size: 3rem;
            font-weight: 700;
        }
    </style>
@endsection
