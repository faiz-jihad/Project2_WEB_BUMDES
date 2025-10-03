<?php $__env->startSection('content'); ?>
    <!DOCTYPE html>
    <html lang="id">

    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <title>Bumdes Madusari Bayalangu Kidul</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
        <style>
            /* Custom Styles */
            .nav-link.active {
                color: #00c851 !important;
                /* Warna hijau untuk menu aktif */
                font-weight: 700;
            }

            .header-img {
                border-radius: 1rem;
                height: 320px;
                object-fit: cover;
                width: 100%;
                position: relative;
            }

            .header-text {
                position: absolute;
                top: 20%;
                left: 5%;
                color: white;
            }

            .header-text h1 {
                font-weight: 700;
                font-size: 3rem;
            }

            .header-text h5 {
                font-weight: 500;
                letter-spacing: 0.05em;
            }

            .search-input {
                max-width: 400px;
                margin-top: 1.5rem;
            }

            .partner-logos img {
                height: 70px;
                object-fit: contain;
                margin: 0 15px;
            }

            .card-price {
                background: rgba(143, 137, 130, 0.6);
                color: white;
                padding: 0.5rem 1rem;
                border-radius: 0 0 0.5rem 0.5rem;
                font-weight: 600;
                font-size: 1.25rem;
            }

            .carousel-control-prev-icon,
            .carousel-control-next-icon {
                filter: invert(1);
            }

            .footer-links a {
                display: block;
                color: black;
                text-decoration: none;
            }

            .footer-links a:hover {
                text-decoration: underline;
            }

            .footer-section {
                background: white;
                border-radius: 1rem;
                padding: 2rem;
            }

            .form-control-rounded {
                border-radius: 2rem;
            }
        </style>
    </head>

    <body>


        <!-- Header with Image and Search -->
        <div class="container my-4 position-relative" style="font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;">
            <!-- Hero Section -->
            <div class="position-relative rounded-3 overflow-hidden shadow-sm" style="min-height: 420px;">
                <!-- Background -->
                <img src="<?php echo e(asset('images/bg2.jpg')); ?>" alt="Pemandangan Sawah" class="w-100 h-100 object-fit-cover" />

                <!-- Overlay -->
                <div class="position-absolute top-0 start-0 w-100 h-100 bg-dark opacity-25"></div>

                <!-- Content -->
                <div class="position-absolute top-50 start-50 translate-middle text-center text-white px-3 w-100">
                    <h1 class="fw-bold mb-2">BUMDES MADUSARI</h1>
                    <h4 class="fw-normal mb-4">BAYALANGU KIDUL</h4>

                    <!-- Search Box -->
                    <form class="mx-auto" style="max-width: 500px;">
                        <input type="search" class="form-control form-control-lg rounded-pill shadow-sm"
                            placeholder="Cari disini" />
                    </form>

                    <!-- Logo Section -->
                    <div class="bg-white rounded-3 shadow-sm d-flex flex-wrap align-items-center justify-content-center gap-4 p-3 mt-4 mx-auto"
                        style="max-width: 650px;">
                        <img src="<?php echo e(asset('images/bumn.png')); ?>" alt="BUMN" class="img-fluid"
                            style="height:40px;object-fit:contain;max-width:100%;" />
                        <img src="<?php echo e(asset('images/bumdes.jpg')); ?>" alt="Madusari Logo" class="img-fluid"
                            style="height:60px;object-fit:contain;max-width:100%;" />
                        <img src="<?php echo e(asset('images/ikatan.jpg')); ?>" alt="Agribisnis" class="img-fluid"
                            style="height:70px;object-fit:contain;max-width:100%;" />
                        <img src="<?php echo e(asset('images/masyarakat.jpg')); ?>" alt="Pemuda" class="img-fluid"
                            style="height:60px;object-fit:contain;max-width:100%;" />
                    </div>
                    <style>
                        @media (max-width: 576px) {
                            .bg-white.rounded-3.shadow-sm.d-flex.flex-wrap img {
                                height: 32px !important;
                                margin-bottom: 8px;
                            }
                        }
                    </style>
                </div>
            </div>

            <!-- CSS tambahan -->
            <style>
                .object-fit-cover {
                    object-fit: cover;
                }

                input[type="search"]:focus {
                    transform: scale(1.03);
                    box-shadow: 0 0 15px rgba(0, 0, 0, 0.25);
                    transition: 0.3s ease;
                }
            </style>

            
        </div>

        <!-- Berita Section -->
        <div class="container my-5">
            <h3 class="mb-4">Berita</h3>
            <div class="d-flex align-items-center justify-content-between mb-3">
                <div></div>
                <div>
                    <button id="prevBtn" class="btn btn-link text-dark fs-3 me-2" type="button" aria-label="Previous">
                        &#8592;
                    </button>
                    <button id="nextBtn" class="btn btn-link text-dark fs-3" type="button" aria-label="Next">
                        &#8594;
                    </button>
                </div>
            </div>

            <!-- Slider wrapper -->
            <div class="overflow-hidden">
                <div id="beritaWrapper" class="d-flex transition">
                    <!-- Card 1 -->
                    <div class="col-12 col-md-4 flex-shrink-0 px-2">
                        <div class="card border-0">
                            <img src="<?php echo e(asset('images/bg2.jpg')); ?>" class="card-img-top rounded-3" alt="Panen Padi" />
                            <div class="card-body p-0 mt-2">
                                <h6 class="card-title fw-bold text-truncate">Panen Padi Mencapai Puluhan Ton....</h6>
                            </div>
                        </div>
                    </div>
                    <!-- Card 2 -->
                    <div class="col-12 col-md-4 flex-shrink-0 px-2">
                        <div class="card border-0">
                            <img src="<?php echo e(asset('images/bg2.jpg')); ?>" class="card-img-top rounded-3"
                                alt="Peternakan Lele" />
                            <div class="card-body p-0 mt-2">
                                <h6 class="card-title fw-bold text-truncate">Peternakan Lele Menjadi Pendapatan Besar...
                                </h6>
                            </div>
                        </div>
                    </div>
                    <!-- Card 3 -->
                    <div class="col-12 col-md-4 flex-shrink-0 px-2">
                        <div class="card border-0">
                            <img src="<?php echo e(asset('images/bg2.jpg')); ?>" class="card-img-top rounded-3"
                                alt="Pemberdayaan Masyarakat" />
                            <div class="card-body p-0 mt-2">
                                <h6 class="card-title fw-bold text-truncate">Pemberdayaan Masyarakat Mengenai Bisnis.....
                                </h6>
                            </div>
                        </div>
                    </div>
                    <!-- Card 4 -->
                    <div class="col-12 col-md-4 flex-shrink-0 px-2">
                        <div class="card border-0">
                            <img src="<?php echo e(asset('images/bg2.jpg')); ?>" class="card-img-top rounded-3"
                                alt="Siswa Pintar" />
                            <div class="card-body p-0 mt-2">
                                <h6 class="card-title fw-bold text-truncate">Siswa Pintar di.....</h6>
                            </div>
                        </div>
                    </div>
                    <!-- Card 5 -->
                    <div class="col-12 col-md-4 flex-shrink-0 px-2">
                        <div class="card border-0">
                            <img src="<?php echo e(asset('images/bg2.jpg')); ?>" class="card-img-top rounded-3"
                                alt="Bisnis Masyarakat" />
                            <div class="card-body p-0 mt-2">
                                <h6 class="card-title fw-bold text-truncate">P Masyarakat Mengenai Bisnis.....</h6>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- CSS tambahan -->
        <style>
            #beritaWrapper {
                transition: transform 0.5s ease-in-out;
            }
        </style>

        <!-- JavaScript -->
        <script>
            const wrapper = document.getElementById("beritaWrapper");
            const prevBtn = document.getElementById("prevBtn");
            const nextBtn = document.getElementById("nextBtn");

            let currentIndex = 0;
            const cardWidth = wrapper.querySelector(".col-12").offsetWidth + 16; // width card + gap
            const totalCards = wrapper.children.length;

            function updateSlider() {
                wrapper.style.transform = `translateX(-${currentIndex * cardWidth}px)`;
            }

            nextBtn.addEventListener("click", () => {
                if (currentIndex < totalCards - 3) { // tampil 3 card sekaligus
                    currentIndex++;
                    updateSlider();
                }
            });

            prevBtn.addEventListener("click", () => {
                if (currentIndex > 0) {
                    currentIndex--;
                    updateSlider();
                }
            });
        </script>

        <!-- Partner Section -->
        <div class="container my-5 text-center partner-logos">
            <h4 class="mb-4">Partner</h4>
            <div class="d-flex justify-content-center align-items-center gap-5 flex-wrap">
                <img src="<?php echo e(asset('images/bumn.png')); ?>" alt="BUMN" />
                <img src="<?php echo e(asset('images/bumdes.jpg')); ?>" alt="Bulog" />
                <img src="<?php echo e(asset('images/masyarakat.jpg')); ?>" alt="Kemenko Perekonomian" style="height: 110px" />
            </div>
        </div>

        <!-- Produk Section -->
        <div class="container my-5">
            <h4 class="mb-4">Produk</h4>
            <div class="row g-4">
                <div class="col-12 col-sm-6 col-md-4">
                    <div class="card border-0 shadow-sm rounded-3 overflow-hidden">
                        <img src="https://i.ibb.co/bWsyqYR/rice.jpg" class="card-img-top" alt="Beras" />
                        <div class="card-price">Beras<br>10.000</div>
                    </div>
                </div>
                <div class="col-12 col-sm-6 col-md-4">
                    <div class="card border-0 shadow-sm rounded-3 overflow-hidden">
                        <img src="https://i.ibb.co/Jpzh53z/lele.jpg" class="card-img-top" alt="Lele" />
                        <div class="card-price">Lele<br>10.000</div>
                    </div>
                </div>
                <div class="col-12 col-sm-6 col-md-4">
                    <div class="card border-0 shadow-sm rounded-3 overflow-hidden">
                        <img src="https://i.ibb.co/8cT6FvD/plant.jpg" class="card-img-top" alt="Tanaman Hias" />
                        <div class="card-price">Tanaman Hias<br>10.000</div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Foto Kegiatan (Carousel) -->
        <div class="container my-5">
            <h5 class="text-center mb-4">Foto Kegiatan</h5>
            <div id="fotoKegiatanCarousel" class="carousel slide" data-bs-ride="carousel">
                <div class="carousel-inner rounded-3 shadow-sm" style="max-height: 380px; overflow: hidden;">
                    <div class="carousel-item active">
                        <img src="<?php echo e(asset('images/gbr.jpg')); ?>" class="d-block w-100" alt="Penanaman Pohon" />
                    </div>
                    <div class="carousel-item active">
                        <img src="<?php echo e(asset('images/gbr2.jpg')); ?>" class="d-block w-100" alt="Penanaman Pohon" />
                    </div>
                    <div class="carousel-item active">
                        <img src="<?php echo e(asset('images/gbr3.jpg')); ?>" class="d-block w-100" alt="Penanaman Pohon" />
                    </div>
                    <!-- Tambah slide berikutnya kalau ada -->
                </div>
                <button class="carousel-control-prev" type="button" data-bs-target="#fotoKegiatanCarousel"
                    data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#fotoKegiatanCarousel"
                    data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </button>
            </div>
        </div>
        <!-- Bootstrap JS & Icon (optional) -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet" />

    </body>

    </html>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.master', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\belajar_laravel\resources\views//pages/Beranda.blade.php ENDPATH**/ ?>