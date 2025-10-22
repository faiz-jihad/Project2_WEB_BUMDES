@extends('layouts.master')

@section('title', $produk->nama . ' - BUMDes Madusari')

@section('content')
    <section class="produk-detail-section">
        <div class="produk-detail-container" data-aos="fade-up">
            <!-- Tombol Kembali -->
            <div class="back-btn">
                <a href="{{ route('produk.index') }}">&larr; Kembali ke Produk</a>
            </div>

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
                        <button class="btn-keranjang" id="addToCartBtn" data-id="{{ $produk->id }}">
                            Tambah ke Keranjang
                        </button>
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

            fetch("{{ route('keranjang.tambah') }}", {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({
                        produk_id: produkId,
                        variasi: variasi
                    })
                })
                .then(res => res.json())
                .then(data => {
                    if (data.success) {
                        alert('Produk berhasil ditambahkan ke keranjang!');
                    }
                });
        });
    </script>
@endsection
