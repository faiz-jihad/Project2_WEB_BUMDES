<?php $__env->startSection('title', 'Produk Kami - BUMDes Madusari'); ?>

<?php $__env->startSection('content'); ?>
    <section class="produk-section">
        <div class="produk-container" data-aos="fade-up">
            <h1 class="produk-title">Produk Unggulan BUMDes Madusari</h1>
            <p class="produk-subtitle">Temukan berbagai produk berkualitas hasil karya masyarakat desa kami.</p>

            <!-- Search -->
            <div class="search-box mb-4">
                <input type="text" id="produkSearch" placeholder="Cari produk..." />
            </div>

            <!-- Filter Kategori -->
            <?php
                $kategoriList = $produk->pluck('kategori')->unique()->filter();
            ?>
            <div class="filter-buttons mb-4">
                <button class="filter-btn active" data-filter="all">Semua</button>
                <?php $__currentLoopData = $kategoriList; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $kategori): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <button class="filter-btn" data-filter="<?php echo e(strtolower($kategori)); ?>">
                        <?php echo e(ucfirst($kategori)); ?>

                    </button>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>

            <!-- Grid Produk (Masonry) -->
            <div class="produk-grid">
                <?php $__empty_1 = true; $__currentLoopData = $produk; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <article class="produk-card" data-category="<?php echo e(strtolower($item->kategori)); ?>"
                        data-nama="<?php echo e($item->nama); ?>" data-deskripsi="<?php echo e($item->deskripsi); ?>"
                        data-harga="Rp <?php echo e(number_format($item->harga, 0, ',', '.')); ?>"
                        data-gambar="<?php echo e($item->gambar ? asset('storage/' . $item->gambar) : asset('images/no-image.jpg')); ?>">
                        <div class="produk-img">
                            <img src="<?php echo e($item->gambar ? asset('storage/' . $item->gambar) : asset('images/no-image.jpg')); ?>"
                                alt="<?php echo e($item->nama); ?>" loading="lazy">
                        </div>
                        <div class="produk-info">
                            <h3><?php echo e($item->nama); ?></h3>
                            <span class="harga">Rp <?php echo e(number_format($item->harga, 0, ',', '.')); ?></span>
                            <p><?php echo e(Str::limit($item->deskripsi, 100)); ?></p>
                        </div>
                    </article>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <p class="no-produk text-center">Belum ada produk yang tersedia saat ini.</p>
                <?php endif; ?>
            </div>
        </div>
    </section>

    <!-- Modal Produk -->
    <div id="produkModal" class="modal hidden">
        <div class="modal-content">
            <button class="close-btn">&times;</button>
            <div class="modal-img">
                <img id="modalGambar" src="" alt="Produk">
            </div>
            <div class="modal-info">
                <h2 id="modalNama"></h2>
                <p id="modalDeskripsi"></p>
                <span id="modalHarga" class="modal-harga"></span>
                <a href="https://wa.me/6281234567890" target="_blank" class="modal-btn">Hubungi Kami</a>
            </div>
        </div>
    </div>

    <style>
        :root {
            --green: #198754;
            --green-dark: #146c43;
            --bg: #f8fff9;
        }

        /* Section */
        .produk-section {
            padding: 120px 20px 80px;
            background: var(--bg);
            text-align: center;
        }

        .produk-title {
            font-size: 2.3rem;
            font-weight: 700;
            color: var(--green-dark);
            margin-bottom: 10px;
        }

        .produk-subtitle {
            font-size: 1.1rem;
            color: #555;
            margin-bottom: 30px;
        }

        /* Search */
        .search-box {
            text-align: center;
            margin-bottom: 20px;
        }

        .search-box input {
            width: 100%;
            max-width: 400px;
            padding: 10px 14px;
            border-radius: 8px;
            border: 1px solid #ccc;
            font-size: 1rem;
        }

        /* Filter */
        .filter-buttons {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            gap: 12px;
        }

        .filter-btn {
            background: white;
            border: 2px solid var(--green);
            color: var(--green-dark);
            padding: 8px 18px;
            border-radius: 25px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .filter-btn.active,
        .filter-btn:hover {
            background: var(--green);
            color: white;
        }

        /* Grid Masonry */
        .produk-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(180px, 1fr));
            grid-auto-rows: 10px;
            /* Untuk masonry */
            gap: 16px;
        }

        .produk-card {
            background: white;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.08);
            cursor: pointer;
            display: flex;
            flex-direction: column;
            transition: transform 0.2s;
        }

        .produk-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 6px 15px rgba(0, 0, 0, 0.12);
        }

        .produk-img img {
            width: 100%;
            display: block;
            border-bottom: 1px solid #eee;
        }

        .produk-info {
            padding: 10px;
            text-align: left;
        }

        .produk-info h3 {
            font-size: 1rem;
            font-weight: 600;
            margin-bottom: 5px;
        }

        .harga {
            font-weight: 700;
            color: var(--green-dark);
            font-size: 0.95rem;
            display: block;
            margin-bottom: 6px;
        }

        .produk-info p {
            font-size: 0.85rem;
            color: #555;
            line-height: 1.3;
        }

        /* Modal */
        .modal {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.6);
            display: flex;
            justify-content: center;
            align-items: center;
            z-index: 2000;
        }

        .modal.hidden {
            display: none;
        }

        .modal-content {
            background: white;
            border-radius: 12px;
            padding: 20px;
            max-width: 700px;
            width: 90%;
            display: flex;
            flex-wrap: wrap;
            gap: 15px;
            position: relative;
        }

        .modal-img img {
            width: 100%;
            max-width: 300px;
            border-radius: 10px;
        }

        .modal-info {
            flex: 1;
            text-align: left;
        }

        .modal-info h2 {
            margin-bottom: 10px;
            color: var(--green-dark);
        }

        .modal-info p {
            margin-bottom: 10px;
            color: #555;
        }

        .modal-harga {
            font-weight: 700;
            color: var(--green);
            margin-bottom: 12px;
            display: block;
        }

        .modal-btn {
            background: var(--green);
            color: #fff;
            padding: 8px 18px;
            border-radius: 8px;
            text-decoration: none;
        }

        .close-btn {
            position: absolute;
            top: 10px;
            right: 15px;
            font-size: 24px;
            background: none;
            border: none;
            cursor: pointer;
            color: #555;
        }

        .close-btn:hover {
            color: var(--green-dark);
        }
    </style>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const filterButtons = document.querySelectorAll('.filter-btn');
            const produkCards = document.querySelectorAll('.produk-card');
            const searchInput = document.getElementById('produkSearch');

            // Filter
            filterButtons.forEach(btn => {
                btn.addEventListener('click', () => {
                    filterButtons.forEach(b => b.classList.remove('active'));
                    btn.classList.add('active');
                    const filter = btn.dataset.filter;
                    produkCards.forEach(card => {
                        card.style.display = (filter === 'all' || card.dataset.category ===
                            filter) ? 'flex' : 'none';
                    });
                });
            });

            // Search
            searchInput.addEventListener('input', () => {
                const query = searchInput.value.toLowerCase();
                produkCards.forEach(card => {
                    const nama = card.dataset.nama.toLowerCase();
                    card.style.display = (nama.includes(query)) ? 'flex' : 'none';
                });
            });

            // Modal
            const modal = document.getElementById('produkModal');
            const modalImg = document.getElementById('modalGambar');
            const modalNama = document.getElementById('modalNama');
            const modalDeskripsi = document.getElementById('modalDeskripsi');
            const modalHarga = document.getElementById('modalHarga');
            const closeBtn = document.querySelector('.close-btn');

            produkCards.forEach(card => {
                card.addEventListener('click', () => {
                    modal.classList.remove('hidden');
                    modalImg.src = card.dataset.gambar;
                    modalNama.textContent = card.dataset.nama;
                    modalDeskripsi.textContent = card.dataset.deskripsi;
                    modalHarga.textContent = card.dataset.harga;
                });
            });
            closeBtn.addEventListener('click', () => modal.classList.add('hidden'));
            modal.addEventListener('click', e => {
                if (e.target === modal) modal.classList.add('hidden');
            });

            // Masonry layout - adjust row spans
            function resizeCards() {
                produkCards.forEach(card => {
                    const grid = card.parentElement;
                    const rowHeight = parseInt(window.getComputedStyle(grid).getPropertyValue(
                        'grid-auto-rows'));
                    const rowGap = parseInt(window.getComputedStyle(grid).getPropertyValue('gap'));
                    const cardHeight = card.querySelector('.produk-img').offsetHeight + card.querySelector(
                        '.produk-info').offsetHeight;
                    const rowSpan = Math.ceil((cardHeight + rowGap) / (rowHeight + rowGap));
                    card.style.gridRowEnd = "span " + rowSpan;
                });
            }

            window.addEventListener('load', resizeCards);
            window.addEventListener('resize', resizeCards);
        });
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.master', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\belajar_laravel\resources\views/pages/produk.blade.php ENDPATH**/ ?>