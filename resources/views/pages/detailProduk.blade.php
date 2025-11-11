@extends('layouts.master')

@section('title', $produk->nama . ' - BUMDes Madusari')

@section('content')
    <section class="produk-detail-section">
        <div class="produk-detail-container" data-aos="fade-up">
            <!-- Tombol Kembali -->
            <div class="back-btn">
                <a href="{{ route('produk.index') }}">&larr; Kembali ke Produk</a>
            </div>

            @if (session('error'))
                <div class="alert alert-danger"
                    style="background: #f8d7da; color: #721c24; padding: 15px; border-radius: 8px; margin-bottom: 20px; border: 1px solid #f5c6cb;">
                    <strong>Error:</strong> {{ session('error') }}
                </div>
            @endif

            <div class="produk-detail-grid">
                <!-- Galeri Gambar -->
                <div class="produk-detail-img">
                    <img id="mainImage" src="{{ asset('storage/' . $produk->gambar) }}" alt="{{ $produk->nama }}">
                    <div class="thumbnail-container">
                        @if ($produk->gambar2)
                            <img class="thumbnail" src="{{ asset('storage/' . $produk->gambar2) }}" alt="Thumbnail 2">
                        @endif
                        @if ($produk->gambar3)
                            <img class="thumbnail" src="{{ asset('storage/' . $produk->gambar3) }}" alt="Thumbnail 3">
                        @endif
                    </div>
                </div>

                <!-- Info Produk -->
                <div class="produk-detail-info">
                    <h1>{{ $produk->nama }}</h1>
                    <p class="kategori">Kategori: {{ $produk->kategori }}</p>
                    <span class="harga">Rp {{ number_format($produk->harga, 0, ',', '.') }}</span>
                    <p class="deskripsi">{{ $produk->deskripsi }}</p>

                    <!-- Variasi -->
                    @if ($produk->variasi)
                        <label for="variasi">Pilih Variasi:</label>
                        <select id="variasi" class="variasi-select">
                            @foreach (explode(',', $produk->variasi) as $var)
                                <option value="{{ trim($var) }}">{{ trim($var) }}</option>
                            @endforeach
                        </select>
                    @endif

                    <!-- Stok -->
                    @if ($produk->stok)
                        <p class="stok">Stok tersedia: {{ $produk->stok }}</p>
                    @endif

                    <!-- Tombol Aksi -->
                    <div class="produk-detail-actions">
                        <a href="https://wa.me/6281234567890?text=Saya%20tertarik%20dengan%20produk%20{{ urlencode($produk->nama) }}"
                            target="_blank" class="btn-hubungi">
                            <i class="bi bi-whatsapp"></i> Hubungi Kami
                        </a>
                        @auth
                            <button class="btn-keranjang" id="addToCartBtn" data-id="{{ $produk->id }}">
                                Tambah ke Keranjang
                            </button>
                        @else
                            <a href="{{ route('login') }}" class="btn-login-detail">
                                <i class="bi bi-person"></i> Login untuk Tambah Keranjang
                            </a>
                        @endauth
                    </div>
                </div>
            </div>
        </div>
    </section>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet" />

    <style>
        :root {
            --green: #198754;
            --green-dark: #146c43;
            --bg: #f8fff9;
            --text: #333;
        }

        /* ====== SECTION ====== */
        .produk-detail-section {
            padding: 120px 20px 80px;
            background: var(--bg) url('{{ asset('images/texture-fabric.png') }}') repeat;
            background-size: 300px;
            background-blend-mode: overlay;
            animation: fadeIn 0.6s ease;
        }

        .produk-detail-container {
            max-width: 1000px;
            margin: auto;
            background: rgba(255, 255, 255, 0.9);
            border-radius: 20px;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.1);
            padding: 40px;
        }

        /* ====== NAVIGASI ====== */
        .back-btn a {
            color: var(--green-dark);
            text-decoration: none;
            font-weight: 600;
            margin-bottom: 20px;
            display: inline-block;
            transition: color 0.3s;
        }

        .back-btn a:hover {
            color: var(--green);
        }

        /* ====== GRID ====== */
        .produk-detail-grid {
            display: flex;
            gap: 40px;
            flex-wrap: wrap;
            align-items: flex-start;
        }

        /* ====== GAMBAR ====== */
        .produk-detail-img {
            flex: 1;
            min-width: 300px;
        }

        .produk-detail-img img#mainImage {
            width: 100%;
            height: auto;
            border-radius: 15px;
            border: 3px solid var(--green);
            object-fit: cover;
            transition: transform 0.3s;
        }

        .produk-detail-img img#mainImage:hover {
            transform: scale(1.02);
        }

        .thumbnail-container {
            margin-top: 10px;
            display: flex;
            gap: 10px;
        }

        .thumbnail {
            width: 70px;
            height: 70px;
            object-fit: cover;
            border-radius: 8px;
            cursor: pointer;
            border: 2px solid transparent;
            transition: border 0.3s, transform 0.2s;
        }

        .thumbnail:hover {
            border: 2px solid var(--green);
            transform: scale(1.05);
        }

        /* ====== INFO ====== */
        .produk-detail-info {
            flex: 1;
            min-width: 300px;
            text-align: left;
        }

        .produk-detail-info h1 {
            font-size: 2rem;
            color: var(--green-dark);
            margin-bottom: 10px;
        }

        .kategori {
            font-size: 1rem;
            color: #555;
            margin-bottom: 10px;
        }

        .harga {
            font-size: 1.6rem;
            font-weight: 700;
            color: var(--green);
            display: block;
            margin-bottom: 20px;
        }

        .deskripsi {
            font-size: 1rem;
            line-height: 1.6;
            color: #555;
            margin-bottom: 25px;
        }

        .stok {
            font-weight: 600;
            color: #555;
            margin-bottom: 15px;
        }

        .variasi-select {
            padding: 8px 12px;
            margin-bottom: 20px;
            border-radius: 6px;
            border: 1px solid #ccc;
            outline: none;
        }

        /* ====== ACTION BUTTONS ====== */
        .produk-detail-actions {
            display: flex;
            gap: 15px;
            flex-wrap: wrap;
        }

        .btn-hubungi,
        .btn-keranjang {
            display: flex;
            align-items: center;
            gap: 8px;
            padding: 12px 25px;
            border-radius: 8px;
            font-weight: 600;
            cursor: pointer;
            border: none;
            text-decoration: none;
            transition: all 0.3s ease;
        }

        .btn-hubungi {
            background: var(--green);
            color: white;
        }

        .btn-hubungi:hover {
            background: var(--green-dark);
            transform: translateY(-2px);
        }

        .btn-keranjang {
            background: #ffc107;
            color: #333;
        }

        .btn-keranjang:hover {
            background: #e0a800;
            transform: translateY(-2px);
        }

        .btn-login-detail {
            display: flex;
            align-items: center;
            gap: 8px;
            padding: 12px 25px;
            border-radius: 8px;
            font-weight: 600;
            cursor: pointer;
            border: none;
            text-decoration: none;
            transition: all 0.3s ease;
            background: #6c757d;
            color: white;
        }

        .btn-login-detail:hover {
            background: #5a6268;
            transform: translateY(-2px);
        }

        /* ====== RESPONSIVE ====== */
        @media (max-width: 768px) {
            .produk-detail-grid {
                flex-direction: column;
                gap: 25px;
            }

            .thumbnail-container {
                justify-content: center;
            }

            .produk-detail-container {
                padding: 25px;
            }
        }

        /* ====== ANIMASI ====== */
        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(15px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
    </style>

    <script>
        document.querySelectorAll('.thumbnail').forEach(thumb => {
            thumb.addEventListener('click', () => {
                document.getElementById('mainImage').src = thumb.src;
            });
        });

        document.getElementById('addToCartBtn').addEventListener('click', function() {
            const produkId = this.getAttribute('data-id');
            const variasi = document.getElementById('variasi') ? document.getElementById('variasi').value : '';

            // Show loading state
            this.disabled = true;
            this.innerHTML = '<i class="bi bi-hourglass-split"></i> Menambahkan...';

            fetch("{{ route('keranjang.tambah') }}", {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                    },
                    body: JSON.stringify({
                        produk_id: produkId,
                        variasi: variasi
                    })
                })
                .then(res => res.json())
                .then(data => {
                    // Reset button state
                    this.disabled = false;
                    this.innerHTML = 'Tambah ke Keranjang';

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
                            text: data.message || 'Gagal menambahkan produk ke keranjang.'
                        });
                    }
                })
                .catch(error => {
                    // Reset button state
                    this.disabled = false;
                    this.innerHTML = 'Tambah ke Keranjang';

                    console.error('Error:', error);
                    Swal.fire({
                        icon: 'error',
                        title: 'Error!',
                        text: 'Terjadi kesalahan saat menambahkan produk ke keranjang.'
                    });
                });
        });
    </script>

    <!-- Produk Lainnya Section -->
    @if ($produkLainnya->count() > 0)
        <section class="produk-lainnya-section">
            <div class="produk-lainnya-container" data-aos="fade-up">
                <h2 class="produk-lainnya-title">Produk Lainnya</h2>
                <div class="produk-lainnya-grid">
                    @foreach ($produkLainnya as $item)
                        <article class="produk-lainnya-card" data-slug="{{ $item->slug }}">
                            <div class="produk-lainnya-img">
                                <img src="{{ $item->gambar ? asset('storage/' . $item->gambar) : asset('images/no-image.jpg') }}"
                                    alt="{{ $item->nama }}" loading="lazy">
                                @if ($item->stok == 0)
                                    <div class="out-of-stock-badge">Habis</div>
                                @endif
                            </div>
                            <div class="produk-lainnya-info">
                                <h3>{{ $item->nama }}</h3>
                                <span class="harga">Rp {{ number_format($item->harga, 0, ',', '.') }}</span>
                                <span class="stok-info">Stok: {{ $item->stok }}</span>
                            </div>
                        </article>
                    @endforeach
                </div>
            </div>
        </section>
    @endif

    <style>
        /* Produk Lainnya Section */
        .produk-lainnya-section {
            padding: 60px 20px;
            background: #f8f9fa;
        }

        .produk-lainnya-container {
            max-width: 1200px;
            margin: auto;
        }

        .produk-lainnya-title {
            font-size: 1.8rem;
            font-weight: 700;
            color: var(--green-dark);
            text-align: center;
            margin-bottom: 40px;
        }

        .produk-lainnya-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
            gap: 20px;
        }

        .produk-lainnya-card {
            background: white;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.08);
            cursor: pointer;
            transition: transform 0.2s, box-shadow 0.2s;
            height: 300px;
        }

        .produk-lainnya-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 6px 20px rgba(0, 0, 0, 0.15);
        }

        .produk-lainnya-img {
            height: 180px;
            overflow: hidden;
            position: relative;
        }

        .produk-lainnya-img img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .produk-lainnya-info {
            padding: 15px;
            text-align: left;
        }

        .produk-lainnya-info h3 {
            font-size: 1rem;
            font-weight: 600;
            margin-bottom: 8px;
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }

        .produk-lainnya-info .harga {
            font-weight: 700;
            color: var(--green-dark);
            font-size: 0.95rem;
            display: block;
            margin-bottom: 4px;
        }

        .produk-lainnya-info .stok-info {
            font-size: 0.8rem;
            color: #666;
        }

        .out-of-stock-badge {
            position: absolute;
            top: 8px;
            right: 8px;
            background: #dc3545;
            color: white;
            padding: 3px 6px;
            border-radius: 4px;
            font-size: 0.7rem;
            font-weight: 600;
            text-transform: uppercase;
            z-index: 10;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .produk-lainnya-grid {
                grid-template-columns: repeat(2, 1fr);
                gap: 15px;
            }

            .produk-lainnya-card {
                height: 280px;
            }

            .produk-lainnya-img {
                height: 160px;
            }
        }

        @media (max-width: 480px) {
            .produk-lainnya-grid {
                grid-template-columns: repeat(2, 1fr);
                gap: 12px;
            }
        }
    </style>

    <script>
        // Handle click on produk lainnya cards
        document.querySelectorAll('.produk-lainnya-card').forEach(card => {
            card.addEventListener('click', function() {
                const slug = this.getAttribute('data-slug');
                window.location.href = `/produk/${slug}`;
            });
        });
    </script>
@endsection
