@extends('layouts.master')

@section('title', 'Produk Kami - BUMDes Madusari')

@section('content')
    <section class="produk-section">
        <div class="produk-container" data-aos="fade-up">
            <h1 class="produk-title">Produk Unggulan BUMDes Madusari</h1>
            <p class="produk-subtitle">Temukan berbagai produk berkualitas hasil karya masyarakat desa kami.</p>

            <!-- Filter Kategori -->
            @php
                $kategoriList = $produk->pluck('kategori')->unique()->filter();
            @endphp
            <div class="filter-buttons">
                <button class="filter-btn active" data-filter="all">Semua</button>
                @foreach ($kategoriList as $kategori)
                    <button class="filter-btn" data-filter="{{ strtolower($kategori) }}">
                        {{ ucfirst($kategori) }}
                    </button>
                @endforeach
            </div>

            <!-- Grid Produk -->
            <div class="produk-grid">
                @forelse ($produk as $item)
                    <article class="produk-card" data-category="{{ strtolower($item->kategori) }}" data-aos="zoom-in"
                        data-aos-delay="{{ $loop->index * 50 }}">
                        <div class="produk-img">
                            <img src="{{ $item->gambar ? asset('storage/' . $item->gambar) : asset('images/no-image.jpg') }}"
                                alt="{{ $item->nama }}" loading="lazy">
                        </div>
                        <div class="produk-info">
                            <h3>{{ $item->nama }}</h3>
                            <p>{{ Str::limit($item->deskripsi, 80) }}</p>
                            <span class="harga">Rp {{ number_format($item->harga, 0, ',', '.') }}</span>
                            <div class="produk-actions">
                                <button class="produk-btn lihat-detail" data-nama="{{ $item->nama }}"
                                    data-deskripsi="{{ $item->deskripsi }}"
                                    data-harga="Rp {{ number_format($item->harga, 0, ',', '.') }}"
                                    data-gambar="{{ asset('storage/' . $item->gambar) }}">
                                    Quick View
                                </button>
                                <a href="{{ route('produk.show', $item->id) }}" class="produk-link">Lihat Detail</a>
                            </div>
                        </div>
                    </article>
                @empty
                    <p class="no-produk">Belum ada produk yang tersedia saat ini.</p>
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
                <a href="https://wa.me/6281234567890" target="_blank" class="modal-btn">Hubungi Kami</a>
            </div>
        </div>
    </div>

    <style>
        :root {
            --green: #198754;
            --green-dark: #146c43;
            --bg: #f8fff9;
            --text: #333;
        }

        body {
            background: var(--bg);
            font-family: 'Poppins', sans-serif;
        }

        /* --- Section --- */
        .produk-section {
            padding: 120px 20px 80px;
            text-align: center;
            background: var(--bg);
        }

        .produk-container {
            max-width: 1200px;
            margin: 0 auto;
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
            margin-bottom: 45px;
        }

        /* --- Filter --- */
        .filter-buttons {
            display: flex;
            justify-content: center;
            gap: 12px;
            flex-wrap: wrap;
            margin-bottom: 50px;
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

        .filter-btn:hover,
        .filter-btn.active {
            background: var(--green);
            color: white;
            transform: translateY(-2px);
        }

        /* --- Grid Produk --- */
        .produk-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(260px, 1fr));
            gap: 28px;
            justify-content: center;
            align-items: stretch;
            padding: 0 10px;
        }

        .produk-card {
            background: white;
            border-radius: 15px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.08);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            overflow: hidden;
            max-width: 300px;
            margin: auto;
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
            padding: 16px;
        }

        .produk-info h3 {
            color: var(--green-dark);
            font-size: 1.1rem;
            margin-bottom: 6px;
            font-weight: 600;
        }

        .produk-info p {
            color: #666;
            font-size: 0.9rem;
            margin-bottom: 8px;
            min-height: 45px;
            line-height: 1.4;
        }

        .harga {
            color: var(--green-dark);
            font-weight: 700;
            display: block;
            margin-bottom: 12px;
            font-size: 1.05rem;
        }

        .produk-actions {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 10px;
        }

        .produk-btn,
        .produk-link {
            background: var(--green);
            color: white;
            border: none;
            border-radius: 8px;
            padding: 8px 14px;
            font-weight: 600;
            cursor: pointer;
            text-decoration: none;
            transition: all 0.3s ease;
            flex: 1;
            text-align: center;
        }

        .produk-btn:hover,
        .produk-link:hover {
            background: var(--green-dark);
            transform: translateY(-2px);
        }

        /* --- Modal --- */
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
            transition: opacity 0.3s ease;
        }

        .modal.hidden {
            visibility: hidden;
            opacity: 0;
        }

        .modal-content {
            background: white;
            border-radius: 15px;
            padding: 25px;
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
            max-width: 800px;
            width: 90%;
            position: relative;
            box-shadow: 0 6px 25px rgba(0, 0, 0, 0.2);
            animation: scaleIn 0.3s ease;
        }

        @keyframes scaleIn {
            from {
                transform: scale(0.95);
                opacity: 0;
            }

            to {
                transform: scale(1);
                opacity: 1;
            }
        }

        .modal-img img {
            width: 100%;
            max-width: 300px;
            height: 300px;
            object-fit: cover;
            border-radius: 10px;
            border: 3px solid var(--green);
        }

        .modal-info {
            flex: 1;
            text-align: left;
        }

        .modal-info h2 {
            color: var(--green-dark);
            margin-bottom: 10px;
        }

        .modal-info p {
            color: #555;
            margin-bottom: 10px;
            line-height: 1.5;
        }

        .modal-harga {
            font-weight: 700;
            color: var(--green);
            display: block;
            margin-bottom: 15px;
        }

        .modal-btn {
            background: var(--green);
            color: white;
            padding: 10px 20px;
            border-radius: 8px;
            font-weight: 600;
            border: none;
            cursor: pointer;
            text-decoration: none;
            transition: 0.3s;
        }

        .modal-btn:hover {
            background: var(--green-dark);
        }

        .close-btn {
            position: absolute;
            top: 15px;
            right: 20px;
            font-size: 24px;
            cursor: pointer;
            color: #666;
            background: none;
            border: none;
        }

        .close-btn:hover {
            color: var(--green-dark);
        }

        /* --- Responsif --- */
        @media (max-width: 992px) {
            .produk-grid {
                grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
                gap: 22px;
            }
        }

        @media (max-width: 768px) {
            .produk-grid {
                grid-template-columns: repeat(2, 1fr);
                gap: 16px;
            }

            .produk-card {
                max-width: 100%;
            }

            .produk-info p {
                font-size: 0.85rem;
            }

            .produk-actions {
                flex-direction: column;
            }
        }

        @media (max-width: 480px) {
            .produk-grid {
                grid-template-columns: 1fr;
                gap: 14px;
            }

            .produk-card {
                width: 90%;
                margin: 0 auto;
            }

            .produk-actions {
                flex-direction: column;
                gap: 6px;
            }
        }
    </style>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const filterButtons = document.querySelectorAll('.filter-btn');
            const produkCards = document.querySelectorAll('.produk-card');

            filterButtons.forEach(btn => {
                btn.addEventListener('click', () => {
                    filterButtons.forEach(b => b.classList.remove('active'));
                    btn.classList.add('active');
                    const filter = btn.dataset.filter;

                    produkCards.forEach(card => {
                        const match = filter === 'all' || card.dataset.category === filter;
                        card.style.display = match ? 'block' : 'none';
                    });
                });
            });

            const modal = document.getElementById('produkModal');
            const modalImg = document.getElementById('modalGambar');
            const modalNama = document.getElementById('modalNama');
            const modalDeskripsi = document.getElementById('modalDeskripsi');
            const modalHarga = document.getElementById('modalHarga');
            const closeBtn = document.querySelector('.close-btn');

            document.querySelectorAll('.lihat-detail').forEach(btn => {
                btn.addEventListener('click', () => {
                    modal.classList.remove('hidden');
                    modalImg.src = btn.dataset.gambar;
                    modalNama.textContent = btn.dataset.nama;
                    modalDeskripsi.textContent = btn.dataset.deskripsi;
                    modalHarga.textContent = btn.dataset.harga;
                });
            });

            closeBtn.addEventListener('click', () => modal.classList.add('hidden'));
            modal.addEventListener('click', e => {
                if (e.target === modal) modal.classList.add('hidden');
            });
        });
    </script>
@endsection
