<?php $__env->startSection('title', 'BUMDes Madusari'); ?>

<?php $__env->startSection('content'); ?>
    <div style="font-family: 'Poppins', sans-serif; overflow-x:hidden;">

        
        <section
            class="hero position-relative text-white text-center d-flex align-items-center justify-content-center overflow-hidden"
            style="height:100vh;">
            <div class="hero-slideshow position-absolute w-100 h-100">
                <div class="slide active" style="background-image: url('<?php echo e(asset('images/bgutama.jpg')); ?>');"></div>
                <div class="slide" style="background-image: url('<?php echo e(asset('images/bg.jpg')); ?>');"></div>
                <div class="slide" style="background-image: url('<?php echo e(asset('images/bg3.jpg')); ?>');"></div>
            </div>
            <div class="position-absolute top-0 start-0 w-100 h-100"
                style="background: linear-gradient(to bottom, rgba(0,0,0,0.4), rgba(0,0,0,0.85));"></div>
            <div class="text-center px-3 hero-content" data-aos="fade-up" data-aos-duration="1200">
                <h1 class="fw-bold display-4 mb-2 text-uppercase" style="letter-spacing:1px;">
                    BUMDes <span class="text-success">Madusari</span>
                </h1>
                <p class="lead mb-4 text-light">Membangun Desa, Meningkatkan Kesejahteraan Bersama</p>
                <a href="#tentang" class="btn btn-success btn-lg rounded-pill shadow hero-btn">Jelajahi Sekarang</a>
            </div>
        </section>

        
        <section id="tentang" class="py-5 bg-light position-relative">
            <div class="container">
                <div class="text-center mb-5" data-aos="fade-down">
                    <h2 class="fw-bold text-success">Tentang Kami</h2>
                    <p class="text-muted">BUMDes Madusari adalah lembaga ekonomi desa yang berkomitmen pada pembangunan
                        berkelanjutan berbasis potensi lokal.</p>
                </div>
                <div class="row align-items-center">
                    <div class="col-md-6" data-aos="fade-right">
                        <img src="<?php echo e(asset('images/logo.jpg')); ?>" loading="lazy"
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
                style="background: url('<?php echo e(asset('images/padi.jpg')); ?>') center/cover fixed; opacity:0.07;"></div>
        </section>

        
        <section class="py-5 text-center">
            <div class="container">
                <div data-aos="zoom-in">
                    <h2 class="fw-bold text-success mb-3">Produk Unggulan Kami</h2>
                    <p class="text-muted">Dikelola oleh masyarakat, untuk masyarakat.</p>
                </div>
                <div class="produk-carousel mt-4">
                    <?php if(isset($produk) && $produk->count() > 0): ?>
                        <?php $__currentLoopData = $produk; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="produk-card" data-aos="fade-up">
                                <div class="produk-img">
                                    <img src="<?php echo e(asset('storage/' . $item->gambar)); ?>" loading="lazy"
                                        alt="<?php echo e($item->nama); ?>">
                                </div>
                                <div class="produk-info">
                                    <h3><?php echo e($item->nama); ?></h3>
                                    <p><?php echo e(Str::limit($item->deskripsi, 90)); ?></p>
                                    <span class="harga">Rp <?php echo e(number_format($item->harga, 0, ',', '.')); ?></span>
                                    <div class="produk-actions">
                                        <a href="<?php echo e(route('produk.show', $item->id)); ?>" class="produk-btn lihat-detail">
                                            Lihat Detail
                                        </a>
                                        <?php if(auth()->guard()->check()): ?>
                                            <button class="produk-btn btn-keranjang-home" data-id="<?php echo e($item->id); ?>"
                                                data-nama="<?php echo e($item->nama); ?>" data-harga="<?php echo e($item->harga); ?>"
                                                data-gambar="<?php echo e($item->gambar); ?>">
                                                <i class="bi bi-cart-plus"></i> Keranjang
                                            </button>
                                        <?php else: ?>
                                            <a href="<?php echo e(route('login')); ?>" class="produk-btn btn-login">
                                                <i class="bi bi-person"></i> Login untuk Tambah Keranjang
                                            </a>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <?php else: ?>
                        <p class="no-produk">Belum ada produk yang tersedia saat ini.</p>
                    <?php endif; ?>
                </div>
            </div>
        </section>

        
        <div class="modal fade" id="produkModal" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg">
                <div class="modal-content">

                    
                    <div class="modal-header">
                        <h5 class="modal-title" id="produkNama"></h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>

                    
                    <div class="modal-body d-flex flex-column flex-md-row align-items-start">
                        
                        <img id="produkGambar" class="img-fluid rounded mb-3 mb-md-0 me-md-3" style="max-width: 300px;"
                            alt="Gambar Produk">

                        
                        <div class="produk-info flex-grow-1">
                            <p id="produkDeskripsi" class="mb-2"></p>
                            <h5 id="produkHarga" class="text-success fw-bold"></h5>
                            <div class="mt-3">
                                
                                <a href="#" id="produkLink" class="btn btn-success">Lihat Detail</a>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>

        
        <section class="py-5 bg-light">
            <div class="container">
                <div class="text-center mb-5" data-aos="fade-down">
                    <h2 class="fw-bold text-success">Berita Unggulan</h2>
                    <p class="text-muted">Kabar terbaru seputar kegiatan dan inovasi BUMDes Madusari.</p>
                </div>
                <div class="row g-4">
                    <?php if(isset($banners) && $banners->count() > 0): ?>
                        <?php $__currentLoopData = $banners->take(3); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $banner): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="col-md-4" data-aos="fade-up">
                                <div class="card border-0 shadow-lg rounded-4 overflow-hidden hover-float h-100">
                                    <?php if($banner->berita && $banner->berita->Thumbnail): ?>
                                        <img src="<?php echo e(asset('storage/' . $banner->berita->Thumbnail)); ?>" loading="lazy"
                                            class="card-img-top" alt="<?php echo e($banner->berita->Judul); ?>">
                                    <?php else: ?>
                                        <img src="<?php echo e(asset('images/berita1.jpg')); ?>" loading="lazy" class="card-img-top"
                                            alt="Berita BUMDes">
                                    <?php endif; ?>
                                    <div class="card-body">
                                        <h5 class="fw-bold">
                                            <?php echo e($banner->berita ? $banner->berita->Judul : 'Judul Berita'); ?></h5>
                                        <p class="text-muted small">
                                            <?php echo e($banner->berita ? Str::limit($banner->berita->Isi_Berita, 100) : 'Deskripsi berita akan muncul di sini.'); ?>

                                        </p>
                                        <a href="<?php echo e($banner->berita ? route('berita.show', $banner->berita->slug) : url('/berita')); ?>"
                                            class="btn btn-outline-success rounded-pill btn-sm mt-2">Baca Selengkapnya</a>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <?php else: ?>
                        <?php $__currentLoopData = [['Panen Raya Berhasil Meningkatkan Produksi Desa', 'berita1.jpg', 'Panen padi tahun ini mencapai rekor tertinggi di wilayah Bayalangu Kidul.'], ['Program UMKM Desa Resmi Diluncurkan', 'berita2.jpg', 'Program baru BUMDes yang mendukung pelaku UMKM dengan pendanaan dan pelatihan.'], ['Kerjasama Baru dengan BUMN untuk Energi Hijau', 'berita3.jpg', 'BUMDes Madusari menandatangani MoU dengan BUMN untuk proyek energi terbarukan.']]; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $berita): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="col-md-4" data-aos="fade-up">
                                <div class="card border-0 shadow-lg rounded-4 overflow-hidden hover-float h-100">
                                    <img src="<?php echo e(asset('images/' . $berita[1])); ?>" loading="lazy" class="card-img-top"
                                        alt="<?php echo e($berita[0]); ?>">
                                    <div class="card-body">
                                        <h5 class="fw-bold"><?php echo e($berita[0]); ?></h5>
                                        <p class="text-muted small"><?php echo e($berita[2]); ?></p>
                                        <a href="<?php echo e(url('/berita')); ?>"
                                            class="btn btn-outline-success rounded-pill btn-sm mt-2">Baca
                                            Selengkapnya</a>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <?php endif; ?>
                </div>
            </div>
        </section>

        
        <section class="py-5 bg-success text-white text-center position-relative">
            <div class="container">
                <h2 class="fw-bold mb-5" data-aos="fade-down">Capaian Kami</h2>
                <div class="row g-4">
                    <div class="col-md-3" data-aos="fade-up" data-aos-delay="100">
                        <h2 class="counter fw-bold" data-target="75">0</h2>
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

        
        <section class="py-5 bg-light text-center">
            <div class="container">
                <h2 class="fw-bold text-success mb-4" data-aos="zoom-in">Galeri Kegiatan Terbaru</h2>

                <!-- Swiper Container -->
                <div class="swiper galeri-swiper">
                    <div class="swiper-wrapper">
                        <?php $__currentLoopData = $galeriHome; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="swiper-slide">
                                <div class="galeri-item" data-aos="zoom-in">
                                    <a href="<?php echo e(asset('storage/' . $item->gambar)); ?>" data-lightbox="galeri">
                                        <img src="<?php echo e(asset('storage/' . $item->gambar)); ?>" loading="lazy"
                                            class="img-fluid rounded-3 shadow-sm hover-scale" alt="<?php echo e($item->judul); ?>">
                                    </a>
                                </div>
                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                    <!-- Navigation arrows -->
                    <div class="swiper-button-next"></div>
                    <div class="swiper-button-prev"></div>
                    <!-- Pagination -->
                    <div class="swiper-pagination"></div>
                </div>

                <div class="mt-4">
                    <a href="<?php echo e(route('galeri.index')); ?>" class="btn btn-success btn-lg">Lihat Semua Galeri</a>
                </div>
            </div>
        </section>
        </section>

        
        <section id="kontak" class="py-5 position-relative">
            <div class="position-absolute w-100 h-100 top-0 start-0"
            style="background: url('<?php echo e(asset('images/pattern.png')); ?>') repeat; opacity: 0.04;"></div>

            <div class="container position-relative">
            <div class="text-center mb-5">
                <h2 class="fw-bold text-success mb-2" data-aos="fade-down">Lokasi & Kontak</h2>
                <p class="text-muted mb-0" data-aos="fade-up">Bersinergi membangun desa yang lebih maju — hubungi kami
                untuk kolaborasi.</p>
            </div>

            <div class="row g-4 align-items-center">
                <div class="col-md-6" data-aos="fade-right">
                <div class="map-card shadow-lg rounded-4 overflow-hidden position-relative">
                    
                    <button type="button" class="map-poster position-absolute w-100 h-100 top-0 start-0 d-flex align-items-center justify-content-center text-white border-0"
                    aria-label="Tampilkan peta interaktif" title="Klik untuk memuat peta interaktif">
                    <div class="text-center px-3">
                        <i class="bi bi-map-fill fs-1 mb-2" aria-hidden="true"></i>
                        <h5 class="mb-1 fw-semibold">Tampilkan Peta</h5>
                        <p class="small mb-0">Klik untuk memuat Peta </p>
                    </div>
                    </button>

                    
                    <div class="map-pin position-absolute" aria-hidden="true">
                    <div class="pin-outer"></div>
                    <div class="pin-inner"></div>
                    </div>

                    
                    <div class="map-frame w-100" style="min-height:360px; background:#f8fafb;" data-src="https://www.google.com/maps?q=Bayalangu+Kidul,+Indramayu&output=embed">
                    <noscript>
                        <iframe src="https://www.google.com/maps?q=Bayalangu+Kidul,+Indramayu&output=embed"
                        loading="lazy" width="100%" height="360" style="border:0;" allowfullscreen></iframe>
                    </noscript>
                    </div>
                </div>
                </div>

                <div class="col-md-6" data-aos="fade-left">
                <div class="contact-card bg-white p-4 rounded-4 shadow-lg position-relative overflow-hidden">
                    <div class="d-flex align-items-start gap-3">
                    <div class="me-2">
                        <img src="<?php echo e(asset('images/logo.jpg')); ?>" alt="Logo BUMDes Madusari" class="rounded-3"
                        style="width:84px; height:84px; object-fit:cover;">
                    </div>
                    <div class="flex-grow-1">
                        <h4 class="fw-bold mb-1">BUMDes Madusari</h4>
                        <p class="text-muted mb-2">Bayalangu Kidul, Kabupaten Indramayu</p>

                        <div class="d-flex flex-wrap gap-2 mb-3">
                        <button class="btn btn-outline-success btn-sm copy-btn" data-copy="Bayalangu Kidul, Kabupaten Indramayu" aria-label="Salin alamat">
                            <i class="bi bi-geo-alt me-1" aria-hidden="true"></i> Salin Alamat
                        </button>
                        <button class="btn btn-outline-success btn-sm copy-btn" data-copy="info@bumdesmadusari.id" aria-label="Salin email">
                            <i class="bi bi-envelope me-1" aria-hidden="true"></i> Salin Email
                        </button>
                        <a href="https://wa.me/6281234567890" target="_blank" rel="noopener" class="btn btn-success btn-sm"
                            aria-label="Hubungi via WhatsApp">
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
                        <button class="btn btn-outline-success btn-sm" data-bs-toggle="modal" data-bs-target="#contactModal"
                            aria-haspopup="dialog" aria-controls="contactModal">
                            <i class="bi bi-chat-left-text me-1" aria-hidden="true"></i> Kirim Pesan
                        </button>
                        <a href="<?php echo e(route('galeri.index')); ?>" class="btn btn-success btn-sm">
                            <i class="bi bi-images me-1" aria-hidden="true"></i> Lihat Galeri
                        </a>
                        </div>
                    </div>
                    </div>

                    
                    <svg class="position-absolute bottom-0 start-0 w-100" height="50" viewBox="0 0 1200 120"
                    preserveAspectRatio="none" style="transform:translateY(50%); opacity:0.06;">
                    <path d="M0,0 C150,100 350,0 600,0 C850,0 1050,100 1200,0 L1200,120 L0,120 Z" fill="#198754"></path>
                    </svg>
                </div>
                </div>
            </div>
            </div>
        </section>

        
        <div class="modal fade" id="contactModal" tabindex="-1" aria-hidden="true" aria-labelledby="contactModalTitle">
            <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content rounded-4">
                <div class="modal-header">
                <h5 class="modal-title" id="contactModalTitle">Kirim Pesan ke BUMDes Madusari</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
                </div>
                <form id="contactForm" action="<?php echo e(url('/kontak/kirim')); ?>" method="POST" class="needs-validation" novalidate>
                <?php echo csrf_field(); ?>
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
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Batal</button>
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
            .map-card { border-radius: 14px; overflow: hidden; background: var(--muted-bg); }
            .map-poster {
            transition: opacity .25s ease, transform .25s ease;
            z-index: 5;
            background: linear-gradient(180deg, rgba(0,0,0,0.22), rgba(0,0,0,0.42));
            color: #fff;
            }
            .map-poster:hover { transform: scale(1.02); }
            .map-poster:focus { outline: none; box-shadow: 0 0 0 4px rgba(25,135,84,0.12); }

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
            background: rgba(25,135,84,0.18);
            animation: pulse 2s infinite;
            left: 0; top: 0;
            }
            .pin-inner {
            position: absolute;
            width: 12px;
            height: 12px;
            border-radius: 50%;
            background: var(--accent);
            left: 8px; top: 8px;
            box-shadow: 0 4px 12px rgba(25,135,84,0.35);
            transform-origin: center;
            }
            @keyframes pulse {
            0% { transform: scale(.85); opacity: .9; }
            70% { transform: scale(2.2); opacity: 0; }
            100% { transform: scale(2.2); opacity: 0; }
            }

            .contact-card { transition: transform .25s ease, box-shadow .25s ease; }
            .contact-card:hover { transform: translateY(-6px); }

            .counter-compact { font-size:1.25rem; color: var(--accent); font-weight:700; }
            .copy-btn { min-width:160px; }

            /* Accessibility: focus on interactive small buttons */
            .copy-btn:focus { box-shadow: 0 0 0 4px rgba(25,135,84,0.08); outline: none; }

            /* Responsive */
            @media (max-width: 767px) {
            .map-pin { top: 40%; }
            .copy-btn { min-width:120px; }
            }
        </style>

        <script>
            document.addEventListener('DOMContentLoaded', function () {
            // Lazy load map iframe on poster click / keyboard activation
            document.querySelectorAll('.map-card').forEach(card => {
                const poster = card.querySelector('.map-poster');
                const frameContainer = card.querySelector('.map-frame');
                if (!poster || !frameContainer) return;

                const loadMap = function () {
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
                poster.addEventListener('keydown', function (e) {
                if (e.key === 'Enter' || e.key === ' ') {
                    e.preventDefault();
                    loadMap();
                }
                });
            });

            // Copy to clipboard (address/email) with feedback
            document.querySelectorAll('.copy-btn').forEach(btn => {
                btn.addEventListener('click', async function () {
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
                    tip.innerHTML = '<div class="d-flex"><div class="toast-body text-white">Disalin: ' + text + '</div></div>';
                    document.body.appendChild(tip);
                    setTimeout(() => tip.remove(), 1800);
                    }
                } catch (err) {
                    console.error('Clipboard error', err);
                    if (typeof Swal !== 'undefined') {
                    Swal.fire({ icon: 'error', title: 'Gagal', text: 'Tidak dapat menyalin ke clipboard.' });
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
            }, { threshold: 0.5 });
            compactCounters.forEach(c => compactObserver.observe(c));

            // Focus first input when contact modal shown
            const contactModalEl = document.getElementById('contactModal');
            if (contactModalEl) {
                contactModalEl.addEventListener('shown.bs.modal', function () {
                const firstInput = contactModalEl.querySelector('input, textarea, button');
                if (firstInput) firstInput.focus();
                });
            }

            // Client-side Bootstrap validation for contact form (keeps server fallback)
            (function () {
                const forms = document.querySelectorAll('.needs-validation');
                Array.prototype.slice.call(forms).forEach(function (form) {
                form.addEventListener('submit', function (event) {
                    if (!form.checkValidity()) {
                    event.preventDefault();
                    event.stopPropagation();
                    form.classList.add('was-validated');
                    return;
                    }
                    const submitBtn = form.querySelector('button[type="submit"]');
                    if (submitBtn) {
                    submitBtn.disabled = true;
                    submitBtn.innerHTML = '<i class="bi bi-hourglass-split me-1"></i> Mengirim...';
                    }
                    // server handles actual submission
                }, false);
                });
            })();
            });
        </script>

    </div>

    
    <link href="https://unpkg.com/aos@next/dist/aos.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.3/css/lightbox.min.css" rel="stylesheet">
    <!-- Swiper CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />

    
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
            // Hero Slideshow
            const slides = document.querySelectorAll(".slide");
            let index = 0;
            setInterval(() => {
                slides[index].classList.remove("active");
                index = (index + 1) % slides.length;
                slides[index].classList.add("active");
            }, 5000);

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

            // SweetAlert untuk success messages
            <?php if(session('success')): ?>
                Swal.fire({
                    icon: 'success',
                    title: 'Berhasil!',
                    text: '<?php echo e(session('success')); ?>',
                    timer: 3000,
                    showConfirmButton: false
                });
            <?php endif; ?>

            // Add to cart functionality for homepage products
            document.querySelectorAll('.btn-keranjang-home').forEach(btn => {
                btn.addEventListener('click', function() {
                    const produkId = this.getAttribute('data-id');
                    const produkNama = this.getAttribute('data-nama');

                    // Show loading state
                    this.disabled = true;
                    this.innerHTML = '<i class="bi bi-hourglass-split"></i> Menambahkan...';

                    fetch("<?php echo e(route('keranjang.tambah')); ?>", {
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

        .produk-carousel {
            display: flex;
            gap: 25px;
            overflow-x: auto;
            padding-bottom: 10px;
            scroll-behavior: smooth;
        }

        .produk-carousel::-webkit-scrollbar {
            height: 8px;
        }

        .produk-carousel::-webkit-scrollbar-thumb {
            background: var(--green);
            border-radius: 4px;
        }

        .produk-carousel::-webkit-scrollbar-track {
            background: rgba(0, 0, 0, 0.05);
        }

        .produk-card {
            flex: 0 0 260px;
            /* setiap card lebar tetap 260px */
            background: white;
            border-radius: 15px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.08);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            overflow: hidden;
        }

        .produk-card:hover {
            transform: translateY(-6px);
            box-shadow: 0 6px 20px rgba(0, 0, 0, 0.12);
        }

        .produk-img img {
            width: 100%;
            height: 220px;
            object-fit: cover;
        }

        .produk-info {
            text-align: left;
            padding: 18px;
        }

        .produk-info h3 {
            color: var(--green-dark);
            font-size: 1.2rem;
            margin-bottom: 5px;
        }

        .produk-info p {
            color: #666;
            font-size: 0.95rem;
            margin-bottom: 10px;
            min-height: 48px;
        }

        .harga {
            color: var(--green-dark);
            font-weight: 700;
            display: block;
            margin-bottom: 15px;
        }

        .produk-actions {
            display: flex;
            gap: 8px;
            flex-wrap: wrap;
        }

        .produk-btn {
            background: var(--green);
            color: white;
            border: none;
            border-radius: 8px;
            padding: 8px 14px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            font-size: 0.9rem;
            flex: 1;
            min-width: 100px;
            text-decoration: none;
            text-align: center;
        }

        .produk-btn:hover {
            background: var(--green-dark);
            transform: translateY(-2px);
            text-decoration: none;
            color: white;
        }

        .btn-keranjang-home {
            background: #ffc107;
            color: #333;
        }

        .btn-keranjang-home:hover {
            background: #e0a800;
            color: #333;
        }

        .btn-keranjang-home:disabled {
            background: #ccc;
            cursor: not-allowed;
            transform: none;
        }

        .btn-login {
            background: #6c757d;
            color: white;
        }

        .btn-login:hover {
            background: #5a6268;
            color: white;
        }


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
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.master', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\belajar_laravel\resources\views/pages/beranda.blade.php ENDPATH**/ ?>