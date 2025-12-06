@extends('layouts.master')

@section('title', $produk->nama . ' - BUMDes Madusari')

@section('content')
<br><br><b></b>
    <nav class="breadcrumb-nav">
        <div class="container">
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="{{ route('produk.index') }}">
                        <i class="bi bi-house"></i> Produk
                    </a>
                </li>
                <li class="breadcrumb-item">
                    <a href="{{ route('produk.index') }}?category={{ strtolower($produk->kategori) }}">
                        {{ $produk->kategori }}
                    </a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">{{ $produk->nama }}</li>
            </ol>
        </div>
    </nav>

    <!-- Product Detail Section -->
    <section class="product-detail-section">
        <div class="container">
            <div class="product-detail-wrapper">
                <!-- Product Gallery -->
                <div class="product-gallery">
                    <div class="main-image-container">
                        <img id="mainProductImage"
                            src="{{ $produk->gambar ? asset('storage/' . $produk->gambar) : asset('images/no-image.jpg') }}"
                            alt="{{ $produk->nama }}" class="main-image">

                        <!-- Badges -->
                        @if ($produk->stok == 0)
                            <div class="product-badge out-of-stock">Habis</div>
                        @elseif ($produk->stok < 10)
                            <div class="product-badge low-stock">Terbatas</div>
                        @endif

                        @if ($produk->harga > 100000)
                            <div class="product-badge shipping">Gratis Ongkir</div>
                        @endif
                    </div>

                    <!-- Thumbnails -->
                    <div class="thumbnail-container">
                        <div class="thumbnail-wrapper">
                            @php
                                $gambarArray = [];
                                if ($produk->gambar) {
                                    $gambarArray[] = $produk->gambar;
                                }
                                if ($produk->gambar2) {
                                    $gambarArray[] = $produk->gambar2;
                                }
                                if ($produk->gambar3) {
                                    $gambarArray[] = $produk->gambar3;
                                }
                            @endphp

                            @foreach ($gambarArray as $index => $gambar)
                                <img src="{{ asset('storage/' . $gambar) }}" alt="{{ $produk->nama }} {{ $index + 1 }}"
                                    class="thumbnail @if ($loop->first) active @endif"
                                    data-index="{{ $index }}">
                            @endforeach
                        </div>
                    </div>
                </div>

                <!-- Product Info -->
                <div class="product-info">
                    <div class="product-header">
                        <h1 class="product-title">{{ $produk->nama }}</h1>

                        <!-- Rating & Sold -->
                        <div class="product-meta-header">
                            <div class="product-rating">
                                <div class="stars">
                                    @for ($i = 1; $i <= 5; $i++)
                                        @if ($i <= 4)
                                            <i class="bi bi-star-fill"></i>
                                        @else
                                            <i class="bi bi-star-half"></i>
                                        @endif
                                    @endfor
                                </div>
                                <span class="rating-score">4.5</span>
                                <span class="rating-count">(120 ulasan)</span>
                            </div>
                            <div class="product-sold">
                                Terjual <strong>120</strong>
                            </div>
                        </div>
                    </div>

                    <!-- Price -->
                    <div class="product-price-section">
                        <div class="current-price">
                            Rp {{ number_format($produk->harga, 0, ',', '.') }}
                        </div>
                        @if ($produk->harga_awal)
                            <div class="original-price">
                                Rp {{ number_format($produk->harga_awal, 0, ',', '.') }}
                            </div>
                            <div class="discount-badge">
                                {{ round((($produk->harga_awal - $produk->harga) / $produk->harga_awal) * 100) }}%
                            </div>
                        @endif
                    </div>

                    <!-- Stock & Category -->
                    <div class="product-details-grid">
                        <div class="detail-item">
                            <span class="detail-label">Kategori:</span>
                            <span class="detail-value">
                                <a href="{{ route('produk.index') }}?category={{ strtolower($produk->kategori) }}">
                                    {{ $produk->kategori }}
                                </a>
                            </span>
                        </div>
                        <div class="detail-item">
                            <span class="detail-label">Stok:</span>
                            <span
                                class="detail-value {{ $produk->stok == 0 ? 'text-danger' : ($produk->stok < 10 ? 'text-warning' : 'text-success') }}">
                                {{ $produk->stok }} tersedia
                            </span>
                        </div>
                        <div class="detail-item">
                            <span class="detail-label">Berat:</span>
                            <span class="detail-value">{{ $produk->berat ?? '500' }} gram</span>
                        </div>
                        <div class="detail-item">
                            <span class="detail-label">Kondisi:</span>
                            <span class="detail-value">{{ $produk->kondisi ?? 'Baru' }}</span>
                        </div>
                    </div>

                    <!-- Variasi -->
                    @if ($produk->variasi)
                        <div class="product-variations">
                            <div class="variation-label">Pilih Variasi:</div>
                            <div class="variation-options">
                                @foreach (explode(',', $produk->variasi) as $var)
                                    <button class="variation-option" data-value="{{ trim($var) }}">
                                        {{ trim($var) }}
                                    </button>
                                @endforeach
                            </div>
                        </div>
                    @endif

                    <!-- Description -->
                    <div class="product-description">
                        <h3>Deskripsi Produk</h3>
                        <div class="description-content">
                            {!! nl2br(e($produk->deskripsi)) !!}
                        </div>
                    </div>

                    <!-- Action Buttons -->
                    <div class="product-actions">
                        <div class="action-group">
                            <button class="btn-favorite" title="Tambahkan ke Favorit">
                                <i class="bi bi-heart"></i>
                                <span>Favorit</span>
                            </button>
                            <button class="btn-share" title="Bagikan Produk">
                                <i class="bi bi-share"></i>
                                <span>Bagikan</span>
                            </button>
                        </div>

                        <div class="action-group main-actions">
                            @if ($produk->stok > 0)
                                <button class="btn-cart" id="addToCartBtn" data-id="{{ $produk->id }}">
                                    <i class="bi bi-cart-plus"></i>
                                    Tambah ke Keranjang
                                </button>
                            @else
                                <button class="btn-cart disabled" disabled>
                                    <i class="bi bi-cart-x"></i>
                                    Stok Habis
                                </button>
                            @endif

                            <a href="https://wa.me/6281234567890?text=Saya%20tertarik%20dengan%20produk%20{{ urlencode($produk->nama) }}%20-%20Rp%20{{ number_format($produk->harga, 0, ',', '.') }}"
                                target="_blank" class="btn-buy">
                                <i class="bi bi-whatsapp"></i>
                                Beli Sekarang
                            </a>
                        </div>
                    </div>

                    <!-- Login Required -->
                    @guest
                        <div class="login-required">
                            <i class="bi bi-info-circle"></i>
                            <span>Silakan <a href="{{ route('login') }}">login</a> untuk menambahkan ke keranjang</span>
                        </div>
                    @endguest

                    <!-- Seller Info -->
                    <div class="seller-info">
                        <div class="seller-header">
                            <i class="bi bi-shop"></i>
                            <h4>BUMDes Madusari</h4>
                        </div>
                        <div class="seller-details">
                            <div class="seller-stat">
                                <span class="stat-label">Produk</span>
                                <span class="stat-value">{{ $produkLainnya->count() + 1 }}</span>
                            </div>
                            <div class="seller-stat">
                                <span class="stat-label">Bergabung</span>
                                <span class="stat-value">2023</span>
                            </div>
                            <div class="seller-stat">
                                <span class="stat-label">Rating</span>
                                <span class="stat-value">4.8/5</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Related Products -->
    @if ($produkLainnya->count() > 0)
        <section class="related-products-section">
            <div class="container">
                <div class="section-header">
                    <h2>Produk Lainnya</h2>
                    <a href="{{ route('produk.index') }}" class="view-all">
                        Lihat Semua <i class="bi bi-arrow-right"></i>
                    </a>
                </div>

                <div class="related-products-grid">
                    @foreach ($produkLainnya as $item)
                        <div class="related-product-card" data-slug="{{ $item->slug }}">
                            <div class="product-image">
                                <a href="{{ route('produk.show', $item->slug) }}">
                                    <img src="{{ $item->gambar ? asset('storage/' . $item->gambar) : asset('images/no-image.jpg') }}"
                                        alt="{{ $item->nama }}">
                                </a>

                                @if ($item->stok == 0)
                                    <div class="stock-badge out-of-stock">Habis</div>
                                @elseif ($item->stok < 10)
                                    <div class="stock-badge low-stock">Terbatas</div>
                                @endif
                            </div>

                            <div class="product-info">
                                <h3 class="product-title">
                                    <a href="{{ route('produk.show', $item->slug) }}">
                                        {{ Str::limit($item->nama, 40) }}
                                    </a>
                                </h3>

                                <div class="product-price">
                                    <span class="current-price">
                                        Rp {{ number_format($item->harga, 0, ',', '.') }}
                                    </span>
                                </div>

                                <div class="product-meta">
                                    <div class="product-rating">
                                        <div class="stars">
                                            @for ($i = 1; $i <= 5; $i++)
                                                <i class="bi bi-star-fill"></i>
                                            @endfor
                                        </div>
                                        <span class="rating-score">4.5</span>
                                    </div>
                                    <div class="product-sold">
                                        Terjual 120
                                    </div>
                                </div>

                                @if ($item->harga > 100000)
                                    <span class="free-shipping">Gratis Ongkir</span>
                                @endif
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
    @endif

    <!-- CSS for Product Detail Page -->
    <style>
        /* =======================================
                   PRODUCT DETAIL PAGE STYLES (Shopee Style)
                   ======================================= */


        :root {
            --orange: #097e13;
            --orange-dark: #0c832a;
            --orange-light: #fff6f5;
            --gray-dark: #222;
            --gray-medium: #555;
            --gray-light: #888;
            --gray-bg: #f5f5f5;
            --gray-border: #e8e8e8;
            --blue: #05a;
            --success: #00bfa5;
            --warning: #ffb300;
            --danger: #ff5252;
            --shadow: 0 1px 2px 0 rgba(0, 0, 0, 0.1);
            --shadow-hover: 0 2px 5px 0 rgba(0, 0, 0, 0.1);
            --shadow-heavy: 0 4px 12px 0 rgba(0, 0, 0, 0.15);
            --transition: all 0.2s ease;
            --border-radius: 2px;
            --border-radius-sm: 4px;
            --border-radius-lg: 8px;
        }

        /* Breadcrumb */
        .breadcrumb-nav {
            background: #f5f5f5;
            padding: 12px 0;
            margin-bottom: 20px;
            border-bottom: 1px solid rgba(0, 0, 0, 0.05);
        }

        .breadcrumb {
            display: flex;
            align-items: center;
            gap: 8px;
            list-style: none;
            padding: 0;
            margin: 0;
            font-size: 13px;
        }

        .breadcrumb-item {
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .breadcrumb-item a {
            color: var(--gray-medium);
            text-decoration: none;
        }

        .breadcrumb-item a:hover {
            color: var(--orange);
        }

        .breadcrumb-item.active {
            color: var(--gray-dark);
            font-weight: 500;
        }

        .breadcrumb-item::after {
            content: '/';
            color: var(--gray-light);
            margin-left: 8px;
        }

        .breadcrumb-item:last-child::after {
            content: '';
        }

        /* Product Detail Wrapper */
        .product-detail-wrapper {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 40px;
            margin-bottom: 40px;
        }

        /* Product Gallery */
        .product-gallery {
            background: white;
            border-radius: var(--border-radius);
            padding: 20px;
            box-shadow: var(--shadow);
        }

        .main-image-container {
            position: relative;
            background: #f5f5f5;
            border-radius: var(--border-radius);
            overflow: hidden;
            margin-bottom: 20px;
            height: 400px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .main-image {
            max-width: 100%;
            max-height: 100%;
            object-fit: contain;
        }

        .product-badge {
            position: absolute;
            top: 10px;
            right: 10px;
            padding: 4px 8px;
            border-radius: var(--border-radius);
            font-size: 12px;
            font-weight: 500;
            color: white;
            z-index: 2;
        }

        .product-badge.out-of-stock {
            background: var(--danger);
        }

        .product-badge.low-stock {
            background: var(--warning);
        }

        .product-badge.shipping {
            background: var(--orange);
            top: 40px;
        }

        /* Thumbnails */
        .thumbnail-container {
            margin-top: 20px;
        }

        .thumbnail-wrapper {
            display: flex;
            gap: 10px;
            overflow-x: auto;
            padding-bottom: 10px;
        }

        .thumbnail {
            width: 70px;
            height: 70px;
            object-fit: cover;
            border-radius: var(--border-radius);
            border: 2px solid transparent;
            cursor: pointer;
            transition: var(--transition);
            flex-shrink: 0;
        }

        .thumbnail:hover,
        .thumbnail.active {
            border-color: var(--orange);
        }

        /* Product Info */
        .product-info {
            background: white;
            border-radius: var(--border-radius);
            padding: 20px;
            box-shadow: var(--shadow);
        }

        .product-header {
            margin-bottom: 20px;
            padding-bottom: 15px;
            border-bottom: 1px solid rgba(0, 0, 0, 0.05);
        }

        .product-title {
            font-size: 20px;
            font-weight: 500;
            color: var(--gray-dark);
            margin-bottom: 10px;
            line-height: 1.4;
        }

        .product-meta-header {
            display: flex;
            align-items: center;
            gap: 20px;
            flex-wrap: wrap;
        }

        .product-rating {
            display: flex;
            align-items: center;
            gap: 6px;
        }

        .product-rating .stars {
            display: flex;
            gap: 1px;
        }

        .product-rating .stars i {
            color: var(--warning);
            font-size: 14px;
        }

        .rating-score {
            color: var(--orange);
            font-weight: 500;
            font-size: 14px;
        }

        .rating-count {
            color: var(--gray-medium);
            font-size: 13px;
        }

        .product-sold {
            font-size: 13px;
            color: var(--gray-medium);
        }

        /* Price Section */
        .product-price-section {
            display: flex;
            align-items: center;
            gap: 15px;
            margin-bottom: 20px;
            padding-bottom: 15px;
            border-bottom: 1px solid rgba(0, 0, 0, 0.05);
        }

        .current-price {
            font-size: 28px;
            font-weight: 500;
            color: var(--orange);
        }

        .original-price {
            font-size: 16px;
            color: var(--gray-light);
            text-decoration: line-through;
        }

        .discount-badge {
            background: var(--orange);
            color: white;
            padding: 2px 6px;
            border-radius: var(--border-radius);
            font-size: 14px;
            font-weight: 500;
        }

        /* Details Grid */
        .product-details-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 12px;
            margin-bottom: 25px;
            padding-bottom: 15px;
            border-bottom: 1px solid rgba(0, 0, 0, 0.05);
        }

        .detail-item {
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .detail-label {
            font-size: 13px;
            color: var(--gray-medium);
            min-width: 70px;
        }

        .detail-value {
            font-size: 13px;
            color: var(--gray-dark);
            font-weight: 500;
        }

        .detail-value a {
            color: var(--orange);
            text-decoration: none;
        }

        .detail-value a:hover {
            text-decoration: underline;
        }

        .text-danger {
            color: var(--danger);
        }

        .text-warning {
            color: var(--warning);
        }

        .text-success {
            color: var(--success);
        }

        /* Variations */
        .product-variations {
            margin-bottom: 25px;
            padding-bottom: 15px;
            border-bottom: 1px solid rgba(0, 0, 0, 0.05);
        }

        .variation-label {
            font-size: 14px;
            color: var(--gray-dark);
            margin-bottom: 10px;
            font-weight: 500;
        }

        .variation-options {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
        }

        .variation-option {
            padding: 8px 16px;
            border: 1px solid rgba(0, 0, 0, 0.09);
            border-radius: var(--border-radius);
            background: white;
            color: var(--gray-dark);
            cursor: pointer;
            transition: var(--transition);
            font-size: 13px;
        }

        .variation-option:hover,
        .variation-option.active {
            border-color: var(--orange);
            color: var(--orange);
            background: var(--orange-light);
        }

        /* Description */
        .product-description {
            margin-bottom: 25px;
            padding-bottom: 15px;
            border-bottom: 1px solid rgba(0, 0, 0, 0.05);
        }

        .product-description h3 {
            font-size: 16px;
            font-weight: 500;
            color: var(--gray-dark);
            margin-bottom: 15px;
        }

        .description-content {
            font-size: 14px;
            color: var(--gray-medium);
            line-height: 1.8;
        }

        /* Action Buttons */
        .product-actions {
            margin-bottom: 20px;
        }

        .action-group {
            display: flex;
            gap: 10px;
            margin-bottom: 15px;
        }

        .btn-favorite,
        .btn-share {
            display: flex;
            align-items: center;
            gap: 6px;
            padding: 8px 16px;
            border: 1px solid rgba(0, 0, 0, 0.09);
            border-radius: var(--border-radius);
            background: white;
            color: var(--gray-dark);
            cursor: pointer;
            transition: var(--transition);
            font-size: 14px;
        }

        .btn-favorite:hover {
            border-color: var(--danger);
            color: var(--danger);
        }

        .btn-share:hover {
            border-color: var(--orange);
            color: var(--orange);
        }

        .main-actions {
            gap: 15px;
        }

        .btn-cart,
        .btn-buy {
            flex: 1;
            padding: 14px 20px;
            border-radius: var(--border-radius);
            font-weight: 500;
            font-size: 16px;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            transition: var(--transition);
            text-decoration: none;
            text-align: center;
        }

        .btn-cart {
            background: var(--orange-light);
            color: var(--orange);
            border: 1px solid var(--orange);
        }

        .btn-cart:hover:not(.disabled) {
            background: var(--orange);
            color: white;
            transform: translateY(-2px);
            box-shadow: var(--shadow-hover);
        }

        .btn-cart.disabled {
            opacity: 0.6;
            cursor: not-allowed;
            background: #f5f5f5;
            border-color: #ddd;
            color: var(--gray-light);
        }

        .btn-buy {
            background: var(--orange);
            color: white;
            border: 1px solid var(--orange);
        }

        .btn-buy:hover {
            background: var(--orange-dark);
            border-color: var(--orange-dark);
            transform: translateY(-2px);
            box-shadow: var(--shadow-hover);
        }

        /* Login Required */
        .login-required {
            display: flex;
            align-items: center;
            gap: 8px;
            padding: 10px;
            background: #fff8e1;
            border: 1px solid #ffecb3;
            border-radius: var(--border-radius);
            margin-bottom: 20px;
            font-size: 13px;
            color: #ff9800;
        }

        .login-required i {
            font-size: 16px;
        }

        .login-required a {
            color: var(--orange);
            font-weight: 500;
            text-decoration: none;
        }

        .login-required a:hover {
            text-decoration: underline;
        }

        /* Seller Info */
        .seller-info {
            background: #f9f9f9;
            border-radius: var(--border-radius);
            padding: 15px;
            border: 1px solid rgba(0, 0, 0, 0.05);
        }

        .seller-header {
            display: flex;
            align-items: center;
            gap: 10px;
            margin-bottom: 15px;
        }

        .seller-header i {
            font-size: 20px;
            color: var(--orange);
        }

        .seller-header h4 {
            margin: 0;
            font-size: 16px;
            font-weight: 500;
            color: var(--gray-dark);
        }

        .seller-details {
            display: flex;
            justify-content: space-around;
        }

        .seller-stat {
            text-align: center;
        }

        .stat-label {
            display: block;
            font-size: 12px;
            color: var(--gray-medium);
            margin-bottom: 4px;
        }

        .stat-value {
            display: block;
            font-size: 14px;
            font-weight: 500;
            color: var(--gray-dark);
        }

        /* Related Products */
        .related-products-section {
            padding: 40px 0;
            background: #f5f5f5;
        }

        .section-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 25px;
        }

        .section-header h2 {
            font-size: 20px;
            font-weight: 500;
            color: var(--gray-dark);
            margin: 0;
        }

        .view-all {
            color: var(--orange);
            text-decoration: none;
            font-size: 14px;
            display: flex;
            align-items: center;
            gap: 4px;
        }

        .view-all:hover {
            text-decoration: underline;
        }

        .related-products-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 20px;
        }

        .related-product-card {
            background: white;
            border-radius: var(--border-radius);
            overflow: hidden;
            box-shadow: var(--shadow);
            transition: var(--transition);
            cursor: pointer;
        }

        .related-product-card:hover {
            transform: translateY(-3px);
            box-shadow: var(--shadow-hover);
        }

        .related-product-card .product-image {
            position: relative;
            height: 180px;
            overflow: hidden;
            background: #f5f5f5;
        }

        .related-product-card .product-image img {
            width: 100%;
            height: 100%;
            object-fit: contain;
            padding: 15px;
            transition: var(--transition);
        }

        .related-product-card:hover .product-image img {
            transform: scale(1.05);
        }

        .related-product-card .stock-badge {
            position: absolute;
            top: 10px;
            right: 10px;
            padding: 3px 6px;
            border-radius: var(--border-radius);
            font-size: 11px;
            font-weight: 500;
            color: white;
        }

        .related-product-card .out-of-stock {
            background: var(--danger);
        }

        .related-product-card .low-stock {
            background: var(--warning);
        }

        .related-product-card .product-info {
            padding: 15px;
            box-shadow: none;
            background: transparent;
        }

        .related-product-card .product-title {
            font-size: 14px;
            margin-bottom: 8px;
            height: 40px;
            overflow: hidden;
        }

        .related-product-card .product-title a {
            color: var(--gray-dark);
            text-decoration: none;
        }

        .related-product-card .product-title a:hover {
            color: var(--orange);
        }

        .related-product-card .product-price {
            margin-bottom: 8px;
        }

        .related-product-card .current-price {
            font-size: 16px;
            font-weight: 500;
            color: var(--orange);
        }

        .related-product-card .product-meta {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 8px;
        }

        .related-product-card .product-rating {
            display: flex;
            align-items: center;
            gap: 4px;
        }

        .related-product-card .product-rating .stars i {
            font-size: 12px;
        }

        .related-product-card .rating-score {
            font-size: 12px;
            color: var(--orange);
        }

        .related-product-card .product-sold {
            font-size: 11px;
            color: var(--gray-medium);
        }

        .related-product-card .free-shipping {
            background: var(--orange);
            color: white;
            font-size: 10px;
            padding: 2px 5px;
            border-radius: var(--border-radius);
            display: inline-block;
        }

        /* Responsive */
        @media (max-width: 992px) {
            .product-detail-wrapper {
                grid-template-columns: 1fr;
                gap: 30px;
            }

            .related-products-grid {
                grid-template-columns: repeat(3, 1fr);
                gap: 15px;
            }
        }

        @media (max-width: 768px) {
            .product-detail-wrapper {
                gap: 20px;
            }

            .main-image-container {
                height: 300px;
            }

            .product-price-section {
                flex-wrap: wrap;
                gap: 10px;
            }

            .current-price {
                font-size: 24px;
            }

            .product-details-grid {
                grid-template-columns: 1fr;
            }

            .action-group {
                flex-direction: column;
            }

            .main-actions {
                flex-direction: column;
            }

            .btn-cart,
            .btn-buy {
                width: 100%;
            }

            .related-products-grid {
                grid-template-columns: repeat(2, 1fr);
                gap: 12px;
            }
        }

        @media (max-width: 576px) {
            .product-title {
                font-size: 18px;
            }

            .main-image-container {
                height: 250px;
            }

            .thumbnail {
                width: 60px;
                height: 60px;
            }

            .product-meta-header {
                flex-direction: column;
                gap: 10px;
                align-items: flex-start;
            }

            .related-products-grid {
                grid-template-columns: 1fr;
                gap: 15px;
            }
        }
    </style>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Thumbnail click handler
            document.querySelectorAll('.thumbnail').forEach(thumb => {
                thumb.addEventListener('click', function() {
                    // Update main image
                    const mainImage = document.getElementById('mainProductImage');
                    mainImage.src = this.src;

                    // Update active thumbnail
                    document.querySelectorAll('.thumbnail').forEach(t => {
                        t.classList.remove('active');
                    });
                    this.classList.add('active');
                });
            });

            // Variation click handler
            document.querySelectorAll('.variation-option').forEach(option => {
                option.addEventListener('click', function() {
                    document.querySelectorAll('.variation-option').forEach(o => {
                        o.classList.remove('active');
                    });
                    this.classList.add('active');
                });
            });

            // Add to cart handler
            const addToCartBtn = document.getElementById('addToCartBtn');
            if (addToCartBtn) {
                addToCartBtn.addEventListener('click', function() {
                    const produkId = this.getAttribute('data-id');
                    const variasiElement = document.querySelector('.variation-option.active');
                    const variasi = variasiElement ? variasiElement.dataset.value : null;

                    // Show loading state
                    const originalText = this.innerHTML;
                    this.innerHTML = '<i class="bi bi-hourglass-split"></i> Menambahkan...';
                    this.disabled = true;

                    fetch("{{ route('keranjang.tambah') }}", {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')
                                    .content
                            },
                            body: JSON.stringify({
                                produk_id: produkId,
                                variasi: variasi
                            })
                        })
                        .then(res => res.json())
                        .then(data => {
                            // Reset button
                            this.innerHTML = originalText;
                            this.disabled = false;

                            if (data.success) {
                                // Show success toast
                                showToast('Produk berhasil ditambahkan ke keranjang!', 'success');

                                // Trigger cart update event
                                document.dispatchEvent(new CustomEvent('cartUpdated'));
                            } else {
                                showToast(data.message || 'Gagal menambahkan produk ke keranjang.',
                                    'error');
                            }
                        })
                        .catch(error => {
                            // Reset button
                            this.innerHTML = originalText;
                            this.disabled = false;
                            showToast('Terjadi kesalahan. Silakan coba lagi.', 'error');
                            console.error('Error:', error);
                        });
                });
            }

            // Related products click handler
            document.querySelectorAll('.related-product-card').forEach(card => {
                card.addEventListener('click', function(e) {
                    if (!e.target.closest('a')) {
                        const slug = this.getAttribute('data-slug');
                        window.location.href = `/produk/${slug}`;
                    }
                });
            });

            // Share button handler
            const shareBtn = document.querySelector('.btn-share');
            if (shareBtn) {
                shareBtn.addEventListener('click', function() {
                    if (navigator.share) {
                        navigator.share({
                            title: "{{ $produk->nama }}",
                            text: "Lihat produk ini di BUMDes Madusari: {{ $produk->nama }}",
                            url: window.location.href
                        });
                    } else {
                        // Fallback for browsers that don't support Web Share API
                        navigator.clipboard.writeText(window.location.href);
                        showToast('Link berhasil disalin!', 'success');
                    }
                });
            }

            // Favorite button handler
            const favoriteBtn = document.querySelector('.btn-favorite');
            if (favoriteBtn) {
                favoriteBtn.addEventListener('click', function() {
                    this.classList.toggle('active');

                    if (this.classList.contains('active')) {
                        this.innerHTML = '<i class="bi bi-heart-fill"></i><span>Favorit</span>';
                        showToast('Ditambahkan ke favorit', 'success');
                    } else {
                        this.innerHTML = '<i class="bi bi-heart"></i><span>Favorit</span>';
                        showToast('Dihapus dari favorit', 'info');
                    }
                });
            }

            // Toast function
            function showToast(message, type) {
                const toast = document.createElement('div');
                toast.className = `toast toast-${type}`;
                toast.innerHTML = `
                    <i class="bi ${type === 'success' ? 'bi-check-circle' : 'bi-exclamation-circle'}"></i>
                    <span>${message}</span>
                `;

                document.body.appendChild(toast);

                setTimeout(() => {
                    toast.classList.add('show');
                }, 10);

                setTimeout(() => {
                    toast.classList.remove('show');
                    setTimeout(() => {
                        document.body.removeChild(toast);
                    }, 300);
                }, 3000);
            }

            // Add toast styles
            const toastStyle = document.createElement('style');
            toastStyle.textContent = `
                .toast {
                    position: fixed;
                    bottom: 20px;
                    right: 20px;
                    background: white;
                    border-radius: var(--border-radius);
                    padding: 12px 16px;
                    display: flex;
                    align-items: center;
                    gap: 10px;
                    box-shadow: 0 4px 12px rgba(0,0,0,0.15);
                    transform: translateY(100px);
                    opacity: 0;
                    transition: all 0.3s ease;
                    z-index: 9999;
                    min-width: 250px;
                }

                .toast.show {
                    transform: translateY(0);
                    opacity: 1;
                }

                .toast-success {
                    border-left: 4px solid var(--success);
                }

                .toast-error {
                    border-left: 4px solid var(--danger);
                }

                .toast-info {
                    border-left: 4px solid var(--warning);
                }

                .toast i {
                    font-size: 18px;
                }

                .toast-success i {
                    color: var(--success);
                }

                .toast-error i {
                    color: var(--danger);
                }

                .toast-info i {
                    color: var(--warning);
                }

                .toast span {
                    font-size: 14px;
                    color: var(--gray-dark);
                }
            `;
            document.head.appendChild(toastStyle);
        });
    </script>
@endsection
