@extends('layouts.master')

@section('title', 'Galeri Foto - BUMDes Madusari')

@section('content')
    <section class="galeri-section">
        <div class="container">
            <h1 class="galeri-title">Galeri Foto</h1>

            {{-- Filter Kategori --}}
            <div class="galeri-filter mb-4 text-center">
                <a href="{{ route('galeri.index', ['kategori' => 'all']) }}"
                    class="filter-btn {{ $kategori == 'all' ? 'active' : '' }}">Semua</a>
                @foreach ($kategoriList as $kat)
                    <a href="{{ route('galeri.index', ['kategori' => $kat]) }}"
                        class="filter-btn {{ $kategori == $kat ? 'active' : '' }}">{{ $kat }}</a>
                @endforeach
            </div>

            @if ($galeri->count() > 0)
                <div class="galeri-grid">
                    @foreach ($galeri as $item)
                        <div class="galeri-item" data-aos="fade-up">
                            <img src="{{ asset('storage/' . $item->gambar) }}" alt="{{ $item->judul }}" class="galeri-img"
                                onclick="openModal('{{ asset('storage/' . $item->gambar) }}')">
                            <div class="galeri-caption">{{ $item->judul }}</div>
                        </div>
                    @endforeach
                </div>

                {{-- Pagination --}}
                <div class="mt-5 d-flex justify-content-center">
                    {{ $galeri->withQueryString()->links() }}
                </div>
            @else
                <p class="text-center text-muted mt-5">Belum ada foto di galeri.</p>
            @endif
        </div>
    </section>

    {{-- Lightbox --}}
    <div id="lightboxModal" class="lightbox-modal" onclick="closeModal()">
        <span class="close">&times;</span>
        <img class="modal-content" id="lightboxImg">
    </div>

    <style>
        :root {
            --green: #198754;
            --green-dark: #146c43;
            --gray-bg: #f8f9fa;
            --card-bg: #ffffff;
            --shadow: rgba(0, 0, 0, 0.15);
        }

        .galeri-section {
            padding: 100px 20px;
            background: var(--gray-bg);
            min-height: 100vh;
        }

        .galeri-title {
            font-size: 2.2rem;
            font-weight: 700;
            color: var(--green-dark);
            margin-bottom: 40px;
            text-align: center;
        }

        .galeri-filter {
            margin-bottom: 40px;
        }

        .filter-btn {
            display: inline-block;
            padding: 10px 20px;
            margin: 5px;
            border-radius: 25px;
            border: 1px solid var(--green);
            color: var(--green);
            font-weight: 600;
            text-decoration: none;
            transition: all 0.3s ease;
        }

        .filter-btn.active,
        .filter-btn:hover {
            background: var(--green);
            color: #fff;
            transform: translateY(-2px);
        }

        /* Pinterest-like Grid */
        .galeri-grid {
            column-count: 4;
            column-gap: 20px;
        }

        .galeri-item {
            break-inside: avoid;
            margin-bottom: 20px;
            position: relative;
            border-radius: 12px;
            overflow: hidden;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            background: var(--card-bg);
            box-shadow: 0 4px 12px var(--shadow);
        }

        .galeri-item:hover {
            transform: translateY(-5px) scale(1.02);
            box-shadow: 0 8px 25px var(--shadow);
        }

        .galeri-img {
            width: 100%;
            display: block;
            border-bottom: 2px solid var(--green);
        }

        .galeri-caption {
            position: absolute;
            bottom: 0;
            width: 100%;
            background: rgba(25, 135, 84, 0.85);
            color: #fff;
            text-align: center;
            padding: 6px 0;
            font-size: 0.9rem;
            font-weight: 600;
            letter-spacing: 0.5px;
        }

        /* Lightbox */
        .lightbox-modal {
            display: none;
            position: fixed;
            z-index: 500;
            padding-top: 80px;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.9);
            overflow: auto;
        }

        .lightbox-modal .modal-content {
            margin: auto;
            display: block;
            max-width: 90%;
            max-height: 80%;
            border-radius: 10px;
            animation: fadeIn 0.4s;
        }

        .lightbox-modal .close {
            position: absolute;
            top: 25px;
            right: 35px;
            color: #fff;
            font-size: 45px;
            font-weight: bold;
            cursor: pointer;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
            }

            to {
                opacity: 1;
            }
        }

        @media (max-width: 1200px) {
            .galeri-grid {
                column-count: 3;
            }
        }

        @media (max-width: 900px) {
            .galeri-grid {
                column-count: 2;
            }
        }

        @media (max-width: 600px) {
            .galeri-grid {
                column-count: 1;
            }

            .filter-btn {
                padding: 8px 15px;
                font-size: 0.9rem;
            }
        }
    </style>

    <script>
        function openModal(src) {
            document.getElementById("lightboxModal").style.display = "block";
            document.getElementById("lightboxImg").src = src;
        }

        function closeModal() {
            document.getElementById("lightboxModal").style.display = "none";
        }
    </script>
@endsection
