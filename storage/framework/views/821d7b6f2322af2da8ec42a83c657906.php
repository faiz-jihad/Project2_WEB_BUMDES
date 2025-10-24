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
                                    <button class="produk-btn lihat-detail" data-bs-toggle="modal"
                                        data-bs-target="#produkModal" data-nama="<?php echo e($item->nama); ?>"
                                        data-deskripsi="<?php echo e($item->deskripsi); ?>"
                                        data-harga="Rp <?php echo e(number_format($item->harga, 0, ',', '.')); ?>"
                                        data-gambar="<?php echo e(asset('storage/' . $item->gambar)); ?>">
                                        Lihat Detail
                                    </button>
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
                <h2 class="fw-bold text-success mb-4" data-aos="zoom-in">Galeri Kegiatan</h2>
                <div class="row g-3">
                    <?php $__currentLoopData = ['desa1.jpg', 'desa2.jpg', 'desa3.jpg', 'desa4.jpg']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $img): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="col-md-3" data-aos="zoom-in">
                            <a href="<?php echo e(asset('images/' . $img)); ?>" data-lightbox="galeri">
                                <img src="<?php echo e(asset('images/' . $img)); ?>" loading="lazy"
                                    class="img-fluid rounded-3 shadow-sm hover-scale" alt="Galeri Desa">
                            </a>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            </div>
        </section>

        
        <section id="kontak" class="py-5 text-center">
            <div class="container">
                <h2 class="fw-bold text-success mb-3" data-aos="fade-down">Lokasi & Kontak</h2>
                <p class="text-muted" data-aos="fade-up">Kunjungi atau hubungi kami melalui WhatsApp dan Email.
                </p>
                <div class="row mt-4">
                    <div class="col-md-6" data-aos="fade-right">
                        <iframe src="https://www.google.com/maps?q=Bayalangu+Kidul,+Indramayu&output=embed" loading="lazy"
                            width="100%" height="350" style="border:0;" allowfullscreen=""></iframe>
                    </div>
                    <div class="col-md-6 d-flex flex-column justify-content-center" data-aos="fade-left">
                        <p><strong>Alamat:</strong> Bayalangu Kidul, Kabupaten Indramayu</p>
                        <p><strong>Email:</strong> info@bumdesmadusari.id</p>
                        <p><strong>WhatsApp:</strong> <a href="https://wa.me/6281234567890" target="_blank"
                                class="text-success fw-bold">+62 812 3456 7890</a></p>
                        <a href="https://wa.me/6281234567890" target="_blank"
                            class="btn btn-success rounded-pill mt-3 px-4 py-2">Hubungi Kami</a>
                    </div>
                </div>
            </div>
        </section>

    </div>

    
    <link href="https://unpkg.com/aos@next/dist/aos.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.3/css/lightbox.min.css" rel="stylesheet">

    
    <script src="https://unpkg.com/aos@next/dist/aos.js" defer></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.3/js/lightbox.min.js" defer></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" defer></script>

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
            margin-bottom: 10px;
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
        }

        .produk-btn:hover {
            background: var(--green-dark);
            transform: translateY(-2px);
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
    </style>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.master', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\belajar_laravel\resources\views/pages/Beranda.blade.php ENDPATH**/ ?>