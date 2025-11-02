@extends('layouts.master')

@section('title', 'Produk Kami - BUMDes Madusari')

@section('content')
    <section class="produk-section">
        <div class="produk-container" data-aos="fade-up">
            <h1 class="produk-title">Produk Unggulan BUMDes Madusari</h1>
            <p class="produk-subtitle">Temukan berbagai produk berkualitas hasil karya masyarakat desa kami.</p>

            <!-- Search -->
            <div class="search-box mb-4">
                <input type="text" id="produkSearch" placeholder="Cari produk..." />
            </div>

            <!-- Filter Kategori -->
            @php
                $kategoriList = $produk->pluck('kategori')->unique()->filter();
            @endphp
            <div class="filter-buttons mb-4">
                <button class="filter-btn active" data-filter="all">Semua</button>
                @foreach ($kategoriList as $kategori)
                    <button class="filter-btn" data-filter="{{ strtolower($kategori) }}">
                        {{ ucfirst($kategori) }}
                    </button>
                @endforeach
            </div>

            <!-- Grid Produk  -->
            <div class="produk-grid">
                @forelse ($produk as $item)
                    <article class="produk-card" data-category="{{ strtolower($item->kategori) }}"
                        data-nama="{{ $item->nama }}" data-deskripsi="{{ $item->deskripsi }}"
                        data-harga="Rp {{ number_format($item->harga, 0, ',', '.') }}"
                        data-gambar="{{ $item->gambar ? asset('storage/' . $item->gambar) : asset('images/no-image.jpg') }}"
                        data-id="{{ $item->id }}" data-slug="{{ $item->slug }}">
                        <div class="produk-img">
                            <img src="{{ $item->gambar ? asset('storage/' . $item->gambar) : asset('images/no-image.jpg') }}"
                                alt="{{ $item->nama }}" loading="lazy">
                        </div>
                        <div class="produk-info">
                            <h3>{{ $item->nama }}</h3>
                            <span class="harga">Rp {{ number_format($item->harga, 0, ',', '.') }}</span>
                            <p>{{ Str::limit($item->deskripsi, 100) }}</p>
                            <div class="produk-actions">
                                @auth
                                    <button class="btn-keranjang-icon" data-id="{{ $item->id }}"
                                        title="Tambah ke Keranjang">
                                        <i class="bi bi-cart-plus"></i>
                                    </button>
                                @else
                                    <a href="{{ route('login') }}" class="btn-login-icon" title="Login untuk Tambah Keranjang">
                                        <i class="bi bi-person"></i>
                                    </a>
                                @endauth
                            </div>
                        </div>
                    </article>
                @empty
                    <p class="no-produk text-center">Belum ada produk yang tersedia saat ini.</p>
                @endforelse
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
                <a href="https://wa.me/6281234567890" target="_blank" class="modal-btn">Beli</a>
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

        /* Grid */
        .produk-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
            gap: 16px;
        }

        /* Responsive Grid */
        @media (max-width: 768px) {
            .produk-grid {
                grid-template-columns: repeat(2, 1fr);
                gap: 12px;
            }
        }

        @media (max-width: 480px) {
            .produk-grid {
                grid-template-columns: repeat(2, 1fr);
                gap: 10px;
            }
        }

        .produk-card {
            background: white;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.08);
            cursor: pointer;
            display: flex;
            flex-direction: column;
            height: 350px;
            transition: transform 0.2s;
        }

        .produk-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 6px 15px rgba(0, 0, 0, 0.12);
        }

        .produk-img {
            height: 200px;
            overflow: hidden;
            border: 2px solid #f0f0f0;
            border-radius: 8px 8px 0 0;
            background: #f8f8f8;
        }

        .produk-img img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            display: block;
        }

        .produk-info {
            padding: 15px;
            text-align: left;
            flex: 1;
            display: flex;
            flex-direction: column;
        }

        .produk-info h3 {
            font-size: 1.1rem;
            font-weight: 600;
            margin-bottom: 8px;
            flex-shrink: 0;
        }

        .harga {
            font-weight: 700;
            color: var(--green-dark);
            font-size: 1rem;
            display: block;
            margin-bottom: 8px;
            flex-shrink: 0;
        }

        .produk-info p {
            font-size: 0.9rem;
            color: #555;
            line-height: 1.4;
            flex: 1;
            overflow: hidden;
            display: -webkit-box;
            -webkit-line-clamp: 3;
            -webkit-box-orient: vertical;
        }

        .produk-actions {
            margin-top: 10px;
            text-align: right;
        }

        .btn-keranjang-icon {
            background: #ffc107;
            color: #333;
            border: none;
            border-radius: 6px;
            padding: 8px 12px;
            cursor: pointer;
            font-size: 1.1rem;
            transition: all 0.3s ease;
        }

        .btn-keranjang-icon:hover {
            background: #e0a800;
            transform: scale(1.1);
        }

        .btn-keranjang-icon i {
            font-size: 1.2rem;
        }

        .btn-login-icon {
            background: #6c757d;
            color: white;
            border: none;
            border-radius: 6px;
            padding: 8px 12px;
            cursor: pointer;
            font-size: 1.1rem;
            transition: all 0.3s ease;
            text-decoration: none;
            display: inline-block;
        }

        .btn-login-icon:hover {
            background: #5a6268;
            transform: scale(1.1);
        }

        .btn-login-icon i {
            font-size: 1.2rem;
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
                card.addEventListener('click', (e) => {
                    // Prevent redirect if clicking on cart button
                    if (e.target.closest('.btn-keranjang-icon')) {
                        e.stopPropagation();
                        return;
                    }
                    // Redirect to detail page instead of showing modal
                    const produkSlug = card.dataset.slug;
                    window.location.href = `/produk/${produkSlug}`;
                });
            });

            // Add to cart functionality
            document.querySelectorAll('.btn-keranjang-icon').forEach(btn => {
                btn.addEventListener('click', function() {
                    const produkId = this.getAttribute('data-id');

                    // Show loading state
                    this.disabled = true;
                    this.innerHTML = '<i class="bi bi-hourglass-split"></i>';

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
                            this.innerHTML = '<i class="bi bi-cart-plus"></i>';

                            if (data.success) {
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Berhasil!',
                                    text: 'Produk berhasil ditambahkan ke keranjang!',
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
                            this.innerHTML = '<i class="bi bi-cart-plus"></i>';

                            console.error('Error:', error);
                            Swal.fire({
                                icon: 'error',
                                title: 'Error!',
                                text: 'Terjadi kesalahan saat menambahkan produk ke keranjang.'
                            });
                        });
                });
            });
            closeBtn.addEventListener('click', () => modal.classList.add('hidden'));
            modal.addEventListener('click', e => {
                if (e.target === modal) modal.classList.add('hidden');
            });

            // No longer needed with fixed height cards

            // Removed masonry resize logic as we're using fixed height cards now
        });
    </script>
@endsection
