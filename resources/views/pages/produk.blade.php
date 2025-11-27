@extends('layouts.master')

@section('title', 'Produk Kami - BUMDes Madusari')

@section('content')
    <!-- Hero Section -->

    <section class="hero-section">
        <br><br>
        <div class="container">
            <div class="hero-content">
                <h1 class="hero-title">Temukan Produk Unggulan Kami</h1>
                <p class="hero-subtitle">Koleksi produk berkualitas dari masyarakat desa Madusari</p>
                <div class="hero-stats">
                    <div class="stat-item">
                        <span class="stat-number">{{ $produk->count() }}</span>
                        <span class="stat-label">Produk</span>
                    </div>
                    <div class="stat-item">
                        <span class="stat-number">{{ $produk->where('stok', '>', 0)->count() }}</span>
                        <span class="stat-label">Tersedia</span>
                    </div>
                    <div class="stat-item">
                        <span class="stat-number">{{ $produk->pluck('kategori')->unique()->count() }}</span>
                        <span class="stat-label">Kategori</span>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Main Content -->
    <section class="products-section">
        <div class="container">
            <!-- Modern Filters & Search Bar -->
            <div class="filters-section">
                <!-- Top Bar with Search and Controls -->
                <div class="filters-top-bar">
                    <div class="search-sort-group">
                        <!-- Enhanced Search Bar -->
                        <div class="search-container">
                            <div class="search-input-wrapper">
                                <i class="fas fa-search search-icon"></i>
                                <input type="text" id="productSearch" placeholder="Cari produk..." class="search-input"
                                    value="{{ request('search') }}">
                                @if (request('search'))
                                    <button class="clear-search" onclick="clearSearch()">
                                        <i class="fas fa-times"></i>
                                    </button>
                                @endif
                            </div>
                        </div>

                        <!-- Sort Dropdown -->
                        <div class="sort-container">
                            <div class="sort-dropdown">
                                <button class="sort-btn" id="sortBtn">
                                    <i class="fas fa-sort-amount-down"></i>
                                    <span id="sortText">Urutkan</span>
                                    <i class="fas fa-chevron-down"></i>
                                </button>
                                <div class="sort-menu" id="sortMenu">
                                    <div class="sort-option active" data-value="latest">
                                        <i class="fas fa-clock"></i>
                                        Terbaru
                                    </div>
                                    <div class="sort-option" data-value="oldest">
                                        <i class="fas fa-history"></i>
                                        Terlama
                                    </div>
                                    <div class="sort-option" data-value="price-low">
                                        <i class="fas fa-arrow-down"></i>
                                        Harga Terendah
                                    </div>
                                    <div class="sort-option" data-value="price-high">
                                        <i class="fas fa-arrow-up"></i>
                                        Harga Tertinggi
                                    </div>
                                    <div class="sort-option" data-value="name-asc">
                                        <i class="fas fa-sort-alpha-down"></i>
                                        Nama A-Z
                                    </div>
                                    <div class="sort-option" data-value="name-desc">
                                        <i class="fas fa-sort-alpha-up"></i>
                                        Nama Z-A
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- View Toggle -->
                        <div class="view-toggle">
                            <button class="view-btn active" data-view="grid" title="Grid View">
                                <i class="fas fa-th"></i>
                            </button>
                            <button class="view-btn" data-view="list" title="List View">
                                <i class="fas fa-list"></i>
                            </button>
                        </div>

                        <!-- Filter Toggle Button -->
                        <button class="filter-toggle-btn" id="filterToggleBtn">
                            <i class="fas fa-sliders-h"></i>
                            <span>Filter</span>
                            <span class="filter-count" id="filterCount">0</span>
                        </button>
                    </div>
                </div>

                <!-- Modern Category Pills -->
                <div class="category-filters">
                    <div class="category-scroll">
                        <button class="category-pill active" data-category="all">
                            <i class="fas fa-th-large"></i>
                            <span>Semua</span>
                            <span class="pill-count">{{ $produk->count() }}</span>
                        </button>
                        @php
                            $categories = $produk->pluck('kategori')->unique()->filter();
                        @endphp
                        @foreach ($categories as $category)
                            <button class="category-pill" data-category="{{ strtolower($category) }}">
                                <i class="fas fa-tag"></i>
                                <span>{{ ucfirst($category) }}</span>
                                <span class="pill-count">{{ $produk->where('kategori', $category)->count() }}</span>
                            </button>
                        @endforeach
                    </div>
                </div>

                <!-- Modern Filter Sidebar -->
                <div class="filter-sidebar" id="filterSidebar">
                    <div class="filter-sidebar-header">
                        <h3><i class="fas fa-filter"></i> Filter Produk</h3>
                        <button class="close-filter" id="closeFilter">
                            <i class="fas fa-times"></i>
                        </button>
                    </div>

                    <div class="filter-sidebar-content">
                        <!-- Price Range Filter -->
                        <div class="filter-group">
                            <div class="filter-group-header">
                                <i class="fas fa-dollar-sign"></i>
                                <span>Rentang Harga</span>
                            </div>
                            <div class="price-range-inputs">
                                <div class="price-input-group">
                                    <label for="minPrice">Minimum</label>
                                    <input type="number" id="minPrice" placeholder="0" class="price-input">
                                </div>
                                <div class="price-separator">
                                    <i class="fas fa-arrow-right"></i>
                                </div>
                                <div class="price-input-group">
                                    <label for="maxPrice">Maksimum</label>
                                    <input type="number" id="maxPrice" placeholder="Tidak terbatas"
                                        class="price-input">
                                </div>
                            </div>
                        </div>

                        <!-- Stock Status Filter -->
                        <div class="filter-group">
                            <div class="filter-group-header">
                                <i class="fas fa-boxes"></i>
                                <span>Status Stok</span>
                            </div>
                            <div class="stock-status-options">
                                <label class="status-option">
                                    <input type="checkbox" value="available" checked>
                                    <span class="status-indicator available"></span>
                                    <span class="status-text">Tersedia</span>
                                </label>
                                <label class="status-option">
                                    <input type="checkbox" value="low" checked>
                                    <span class="status-indicator low"></span>
                                    <span class="status-text">Stok Rendah</span>
                                </label>
                                <label class="status-option">
                                    <input type="checkbox" value="out" checked>
                                    <span class="status-indicator out"></span>
                                    <span class="status-text">Habis</span>
                                </label>
                            </div>
                        </div>

                        <!-- Active Filters Display -->
                        <div class="active-filters" id="activeFilters">
                            <div class="active-filters-header">
                                <span>Filter Aktif</span>
                                <button class="clear-all-filters" onclick="resetAllFilters()">
                                    <i class="fas fa-trash"></i>
                                    Hapus Semua
                                </button>
                            </div>
                            <div class="active-filters-list" id="activeFiltersList">
                                <!-- Active filters will be populated here -->
                            </div>
                        </div>
                    </div>

                    <div class="filter-sidebar-footer">
                        <button class="btn btn-outline-secondary" onclick="resetFilters()">
                            <i class="fas fa-undo"></i>
                            Reset
                        </button>
                        <button class="btn btn-success" onclick="applyFilters()">
                            <i class="fas fa-check"></i>
                            Terapkan Filter
                        </button>
                    </div>
                </div>

                <!-- Filter Overlay -->
                <div class="filter-overlay" id="filterOverlay"></div>
            </div>

            <!-- Products Grid/List -->
            <div class="products-container" id="productsContainer">
                <div class="products-grid" id="productsGrid">
                    @forelse($produk as $item)
                        <div class="product-card" data-category="{{ strtolower($item->kategori) }}"
                            data-price="{{ $item->harga }}" data-stock="{{ $item->stok }}"
                            data-name="{{ strtolower($item->nama) }}" data-slug="{{ $item->slug }}">
                            <!-- Product Image -->
                            <div class="product-image">
                                <img src="{{ $item->gambar ? asset('storage/' . $item->gambar) : asset('images/no-image.jpg') }}"
                                    alt="{{ $item->nama }}" loading="lazy">

                                <!-- Stock Badge -->
                                @if ($item->stok <= 0)
                                    <div class="stock-badge out-of-stock">
                                        <i class="fas fa-times-circle"></i>
                                        Habis
                                    </div>
                                @elseif($item->stok <= 5)
                                    <div class="stock-badge low-stock">
                                        <i class="fas fa-exclamation-triangle"></i>
                                        Stok Rendah
                                    </div>
                                @else
                                    <div class="stock-badge in-stock">
                                        <i class="fas fa-check-circle"></i>
                                        Tersedia
                                    </div>
                                @endif

                                <!-- Quick Actions -->
                                <div class="product-actions">
                                    <button class="action-btn quick-view" data-product-id="{{ $item->id }}"
                                        title="Quick View">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                    @auth
                                        <button class="action-btn add-to-cart" data-product-id="{{ $item->id }}"
                                            data-name="{{ $item->nama }}" title="Tambah ke Keranjang">
                                            <i class="fas fa-cart-plus"></i>
                                        </button>
                                    @else
                                        <button class="action-btn login-required" title="Login untuk membeli">
                                            <i class="fas fa-sign-in-alt"></i>
                                        </button>
                                    @endauth
                                </div>

                                <!-- Hover Overlay -->
                                <div class="product-overlay">
                                    <button class="view-details-btn"
                                        onclick="window.location.href='{{ route('produk.show', $item->slug) }}'">
                                        Lihat Detail
                                    </button>
                                </div>
                            </div>

                            <!-- Product Info -->
                            <div class="product-info">
                                <div class="product-category">{{ ucfirst($item->kategori) }}</div>
                                <h3 class="product-title">
                                    <a
                                        href="{{ route('produk.show', $item->slug) }}">{{ Str::limit($item->nama, 60) }}</a>
                                </h3>
                                <p class="product-description">{{ Str::limit($item->deskripsi, 100) }}</p>

                                <div class="product-meta">
                                    <div class="product-price">
                                        <span class="current-price">Rp
                                            {{ number_format($item->harga, 0, ',', '.') }}</span>
                                    </div>
                                    <div class="product-stock-info">
                                        <i class="fas fa-boxes"></i>
                                        <span>{{ $item->stok }} tersedia</span>
                                    </div>
                                </div>

                                <div class="product-rating">
                                    <div class="stars">
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star-half-alt"></i>
                                    </div>
                                    <span class="rating-score">(4.5)</span>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="no-products">
                            <div class="no-products-icon">
                                <i class="fas fa-box-open"></i>
                            </div>
                            <h3>Tidak ada produk ditemukan</h3>
                            <p>Coba ubah filter pencarian atau kategori</p>
                            <button class="btn btn-primary" onclick="resetAllFilters()">
                                <i class="fas fa-refresh"></i>
                                Reset Semua Filter
                            </button>
                        </div>
                    @endforelse
                </div>

                {{-- <!-- Load More Button -->
                @if (isset($produk) && $produk->hasPages())
                    <div class="load-more-container">
                        {{ $produk->links() }}
                    </div>
                @endif --}}
            </div>
        </div>
    </section>

    <!-- Quick View Modal -->
    <div class="modal fade" id="quickViewModal" tabindex="-1">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Quick View</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="modal-product-image">
                                <img id="modalProductImage" src="" alt="Product Image" class="img-fluid">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="modal-product-info">
                                <div class="product-category" id="modalProductCategory"></div>
                                <h3 id="modalProductName"></h3>
                                <div class="product-price">
                                    <span class="current-price" id="modalProductPrice"></span>
                                </div>
                                <div class="product-stock-info">
                                    <i class="fas fa-boxes"></i>
                                    <span id="modalProductStock"></span>
                                </div>
                                <div class="product-rating">
                                    <div class="stars">
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star-half-alt"></i>
                                    </div>
                                    <span class="rating-score">(4.5)</span>
                                </div>
                                <p class="product-description" id="modalProductDescription"></p>
                                <div class="modal-actions">
                                    <a href="#" id="modalViewFullBtn" class="btn btn-primary">
                                        <i class="fas fa-eye"></i>
                                        Lihat Detail Lengkap
                                    </a>
                                    <button id="modalAddToCartBtn" class="btn btn-success">
                                        <i class="fas fa-cart-plus"></i>
                                        Tambah ke Keranjang
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <style>
        /* =======================================
                                           GLOBAL RESETS & UTILITIES
                                        ======================================= */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        img {
            max-width: 100%;
            display: block;
        }

        button {
            cursor: pointer;
            border: none;
            background: none;
            font-family: inherit;
        }

        :root {
            --green: #28a745;
            --green-dark: #218838;
            --green-light: #d4edda;
            --gray-dark: #333;
            --gray-medium: #666;
            --gray-light: #999;
            --gray-bg: #f8f9fa;
            --gray-border: #e9ecef;
            --shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
            --shadow-hover: 0 4px 16px rgba(0, 0, 0, 0.15);
            --transition: all 0.3s ease;
        }

        /* =======================================
                                           HERO SECTION
                                        ======================================= */
        .hero-section {
            padding: 85px 0;
            background: linear-gradient(rgba(0, 0, 0, .45), rgba(0, 0, 0, .45)),
                url('/images/bg2.jpg') center/cover no-repeat;
            color: white;
            text-align: center;
        }

        .hero-title {
            font-size: 2.8rem;
            font-weight: 700;
            margin-bottom: 8px;
        }

        .hero-subtitle {
            font-size: 1.2rem;
            opacity: .9;
            margin-bottom: 35px;
        }

        .hero-stats {
            display: flex;
            justify-content: center;
            gap: 40px;
        }

        .stat-item {
            text-align: center;
        }

        .stat-number {
            font-size: 2rem;
            font-weight: 700;
        }

        .stat-label {
            display: block;
            margin-top: 4px;
            opacity: .85;
        }

        /* =======================================
                                           MODERN FILTERS & SEARCH
                                        ======================================= */
        .filters-section {
            margin: 40px 0;
            background: white;
            border-radius: 16px;
            padding: 24px;
            box-shadow: var(--shadow);
        }

        /* Top Bar */
        .filters-top-bar {
            margin-bottom: 24px;
        }

        .search-sort-group {
            display: flex;
            gap: 16px;
            align-items: center;
            flex-wrap: wrap;
        }

        /* Enhanced Search */
        .search-container {
            flex: 1;
            min-width: 280px;
        }

        .search-input-wrapper {
            position: relative;
        }

        .search-input {
            width: 100%;
            padding: 14px 50px;
            border: 2px solid var(--gray-border);
            border-radius: 12px;
            font-size: 16px;
            transition: var(--transition);
            background: white;
        }

        .search-input:focus {
            border-color: var(--green);
            box-shadow: 0 0 0 3px rgba(40, 167, 69, 0.1);
            outline: none;
        }

        .search-icon {
            position: absolute;
            left: 16px;
            top: 50%;
            transform: translateY(-50%);
            color: var(--gray-light);
            font-size: 18px;
        }

        .clear-search {
            position: absolute;
            right: 16px;
            top: 50%;
            transform: translateY(-50%);
            color: var(--gray-light);
            font-size: 16px;
            padding: 4px;
            border-radius: 50%;
            transition: var(--transition);
        }

        .clear-search:hover {
            background: var(--gray-bg);
            color: var(--gray-medium);
        }

        /* Sort Dropdown */
        .sort-container {
            position: relative;
        }

        .sort-dropdown {
            position: relative;
        }

        .sort-btn {
            display: flex;
            align-items: center;
            gap: 8px;
            padding: 12px 16px;
            background: white;
            border: 2px solid var(--gray-border);
            border-radius: 12px;
            font-size: 14px;
            font-weight: 500;
            cursor: pointer;
            transition: var(--transition);
            min-width: 140px;
        }

        .sort-btn:hover {
            border-color: var(--green);
        }

        .sort-dropdown.open .sort-btn {
            border-color: var(--green);
            box-shadow: 0 0 0 3px rgba(40, 167, 69, 0.1);
        }

        .sort-menu {
            position: absolute;
            top: 100%;
            left: 0;
            right: 0;
            background: white;
            border: 1px solid var(--gray-border);
            border-radius: 12px;
            box-shadow: var(--shadow-hover);
            opacity: 0;
            visibility: hidden;
            transform: translateY(-10px);
            transition: var(--transition);
            z-index: 1000;
            margin-top: 4px;
        }

        .sort-dropdown.open .sort-menu {
            opacity: 1;
            visibility: visible;
            transform: translateY(0);
        }

        .sort-option {
            display: flex;
            align-items: center;
            gap: 8px;
            padding: 12px 16px;
            cursor: pointer;
            transition: var(--transition);
            border-bottom: 1px solid var(--gray-border);
        }

        .sort-option:last-child {
            border-bottom: none;
        }

        .sort-option:hover,
        .sort-option.active {
            background: var(--green-light);
            color: var(--green-dark);
        }

        .sort-option i {
            width: 16px;
            text-align: center;
        }

        /* View Toggle */
        .view-toggle {
            display: flex;
            border: 2px solid var(--gray-border);
            border-radius: 12px;
            overflow: hidden;
        }

        .view-btn {
            padding: 12px 16px;
            background: white;
            transition: var(--transition);
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .view-btn.active {
            background: var(--green);
            color: white;
        }

        .view-btn:not(.active):hover {
            background: var(--gray-bg);
        }

        .view-btn i {
            font-size: 16px;
        }

        /* Filter Toggle Button */
        .filter-toggle-btn {
            display: flex;
            align-items: center;
            gap: 8px;
            padding: 12px 20px;
            background: var(--green);
            color: white;
            border-radius: 12px;
            font-weight: 500;
            transition: var(--transition);
            position: relative;
        }

        .filter-toggle-btn:hover {
            background: var(--green-dark);
            transform: translateY(-1px);
            box-shadow: var(--shadow-hover);
        }

        .filter-toggle-btn i {
            font-size: 16px;
        }

        .filter-count {
            display: none;
            align-items: center;
            justify-content: center;
            min-width: 20px;
            height: 20px;
            background: white;
            color: var(--green);
            border-radius: 10px;
            font-size: 12px;
            font-weight: 600;
        }

        /* =======================================
                                           CATEGORY PILLS
                                        ======================================= */
        .category-filters {
            margin-bottom: 24px;
        }

        .category-scroll {
            display: flex;
            gap: 8px;
            overflow-x: auto;
            padding-bottom: 8px;
            scrollbar-width: thin;
            scrollbar-color: var(--gray-border) transparent;
        }

        .category-scroll::-webkit-scrollbar {
            height: 4px;
        }

        .category-scroll::-webkit-scrollbar-track {
            background: var(--gray-bg);
            border-radius: 2px;
        }

        .category-scroll::-webkit-scrollbar-thumb {
            background: var(--gray-border);
            border-radius: 2px;
        }

        .category-pill {
            display: flex;
            align-items: center;
            gap: 6px;
            padding: 10px 16px;
            background: white;
            border: 2px solid var(--gray-border);
            border-radius: 25px;
            font-size: 14px;
            font-weight: 500;
            color: var(--gray-medium);
            transition: var(--transition);
            white-space: nowrap;
            flex-shrink: 0;
        }

        .category-pill:hover {
            border-color: var(--green);
            color: var(--green);
        }

        .category-pill.active {
            background: var(--green);
            border-color: var(--green);
            color: white;
        }

        .category-pill i {
            font-size: 12px;
        }

        .pill-count {
            background: var(--gray-bg);
            color: var(--gray-medium);
            padding: 2px 6px;
            border-radius: 10px;
            font-size: 12px;
            font-weight: 600;
        }

        .category-pill.active .pill-count {
            background: rgba(255, 255, 255, 0.2);
            color: white;
        }

        /* =======================================
                                           FILTER SIDEBAR
                                        ======================================= */
        .filter-sidebar {
            position: fixed;
            top: 0;
            right: -400px;
            width: 380px;
            height: 100vh;
            background: white;
            box-shadow: -4px 0 20px rgba(0, 0, 0, 0.15);
            transition: var(--transition);
            z-index: 1050;
            overflow-y: auto;
        }

        .filter-sidebar.open {
            right: 0;
        }

        .filter-sidebar-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 24px;
            border-bottom: 1px solid var(--gray-border);
            background: var(--gray-bg);
        }

        .filter-sidebar-header h3 {
            margin: 0;
            font-size: 18px;
            font-weight: 600;
            color: var(--gray-dark);
        }

        .filter-sidebar-header h3 i {
            color: var(--green);
            margin-right: 8px;
        }

        .close-filter {
            width: 32px;
            height: 32px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--gray-medium);
            transition: var(--transition);
        }

        .close-filter:hover {
            background: var(--gray-border);
            color: var(--gray-dark);
        }

        .filter-sidebar-content {
            padding: 24px;
        }

        .filter-group {
            margin-bottom: 24px;
        }

        .filter-group:last-child {
            margin-bottom: 0;
        }

        .filter-group-header {
            display: flex;
            align-items: center;
            gap: 8px;
            margin-bottom: 16px;
            font-size: 16px;
            font-weight: 600;
            color: var(--gray-dark);
        }

        .filter-group-header i {
            color: var(--green);
            width: 18px;
        }

        /* Price Range */
        .price-range-inputs {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .price-input-group {
            flex: 1;
        }

        .price-input-group label {
            display: block;
            font-size: 12px;
            font-weight: 500;
            color: var(--gray-medium);
            margin-bottom: 4px;
        }

        .price-input {
            width: 100%;
            padding: 10px 12px;
            border: 1px solid var(--gray-border);
            border-radius: 8px;
            font-size: 14px;
            transition: var(--transition);
        }

        .price-input:focus {
            border-color: var(--green);
            outline: none;
            box-shadow: 0 0 0 2px rgba(40, 167, 69, 0.1);
        }

        .price-separator {
            color: var(--gray-medium);
            font-weight: 500;
        }

        /* Stock Status */
        .stock-status-options {
            display: flex;
            flex-direction: column;
            gap: 12px;
        }

        .status-option {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 12px;
            border: 1px solid var(--gray-border);
            border-radius: 8px;
            transition: var(--transition);
            cursor: pointer;
        }

        .status-option:hover {
            border-color: var(--green);
            background: var(--green-light);
        }

        .status-indicator {
            width: 12px;
            height: 12px;
            border-radius: 50%;
        }

        .status-indicator.available {
            background: #28a745;
        }

        .status-indicator.low {
            background: #ffc107;
        }

        .status-indicator.out {
            background: #dc3545;
        }

        .status-text {
            font-size: 14px;
            font-weight: 500;
            color: var(--gray-dark);
        }

        /* Active Filters */
        .active-filters {
            border-top: 1px solid var(--gray-border);
            padding-top: 24px;
            margin-top: 24px;
        }

        .active-filters-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 12px;
        }

        .active-filters-header span {
            font-size: 14px;
            font-weight: 600;
            color: var(--gray-dark);
        }

        .clear-all-filters {
            display: flex;
            align-items: center;
            gap: 4px;
            font-size: 12px;
            color: var(--gray-medium);
            transition: var(--transition);
        }

        .clear-all-filters:hover {
            color: #dc3545;
        }

        .active-filters-list {
            display: flex;
            flex-wrap: wrap;
            gap: 8px;
        }

        .filter-tag {
            display: flex;
            align-items: center;
            gap: 6px;
            padding: 6px 10px;
            background: var(--green-light);
            border: 1px solid var(--green);
            border-radius: 16px;
            font-size: 12px;
            color: var(--green-dark);
        }

        .filter-tag span {
            font-weight: 500;
        }

        .remove-filter {
            width: 16px;
            height: 16px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--green-dark);
            transition: var(--transition);
        }

        .remove-filter:hover {
            background: var(--green);
            color: white;
        }

        .filter-sidebar-footer {
            position: sticky;
            bottom: 0;
            left: 0;
            right: 0;
            padding: 24px;
            background: white;
            border-top: 1px solid var(--gray-border);
            display: flex;
            gap: 12px;
        }

        .filter-sidebar-footer .btn {
            flex: 1;
            padding: 12px 20px;
            border-radius: 8px;
            font-weight: 500;
            transition: var(--transition);
        }

        .filter-sidebar-footer .btn-outline-secondary {
            border: 2px solid var(--gray-border);
            color: var(--gray-medium);
        }

        .filter-sidebar-footer .btn-outline-secondary:hover {
            background: var(--gray-bg);
            border-color: var(--gray-medium);
        }

        .filter-sidebar-footer .btn-success {
            background: var(--green);
            border: 2px solid var(--green);
        }

        .filter-sidebar-footer .btn-success:hover {
            background: var(--green-dark);
            border-color: var(--green-dark);
        }

        /* Filter Overlay */
        .filter-overlay {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(0, 0, 0, 0.5);
            opacity: 0;
            visibility: hidden;
            transition: var(--transition);
            z-index: 1040;
        }

        .filter-overlay.active {
            opacity: 1;
            visibility: visible;
        }

        /* =======================================
                                           PRODUCTS GRID
                                        ======================================= */
        .products-container {
            margin-top: 32px;
        }

        .products-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
            gap: 24px;
        }

        .products-grid.list-view {
            grid-template-columns: 1fr;
            gap: 16px;
        }

        /* =======================================
                                           PRODUCT CARD
                                        ======================================= */
        .product-card {
            background: white;
            border-radius: 16px;
            overflow: hidden;
            box-shadow: var(--shadow);
            transition: var(--transition);
            position: relative;
        }

        .product-card:hover {
            transform: translateY(-4px);
            box-shadow: var(--shadow-hover);
        }

        /* IMAGE AREA */
        .product-image {
            position: relative;
            height: 240px;
            overflow: hidden;
        }

        .product-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: var(--transition);
        }

        .product-card:hover img {
            transform: scale(1.05);
        }

        /* STOCK BADGE */
        .stock-badge {
            position: absolute;
            top: 12px;
            left: 12px;
            padding: 6px 12px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 600;
            color: white;
            backdrop-filter: blur(8px);
        }

        .in-stock {
            background: rgba(40, 167, 69, 0.9);
        }

        .low-stock {
            background: rgba(255, 193, 7, 0.9);
        }

        .out-of-stock {
            background: rgba(220, 53, 69, 0.9);
        }

        /* QUICK ACTIONS */
        .product-actions {
            position: absolute;
            top: 12px;
            right: 12px;
            display: flex;
            flex-direction: column;
            gap: 8px;
        }

        .action-btn {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.9);
            backdrop-filter: blur(8px);
            color: var(--gray-medium);
            display: flex;
            align-items: center;
            justify-content: center;
            transition: var(--transition);
            opacity: 0;
            transform: translateX(10px);
        }

        .product-card:hover .action-btn {
            opacity: 1;
            transform: translateX(0);
        }

        .action-btn:hover {
            background: white;
            color: var(--green);
            transform: scale(1.1);
        }

        .login-required {
            color: var(--gray-light);
        }

        .login-required:hover {
            color: var(--gray-medium);
        }

        /* OVERLAY */
        .product-overlay {
            position: absolute;
            inset: 0;
            background: rgba(0, 0, 0, 0.6);
            opacity: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: var(--transition);
        }

        .product-card:hover .product-overlay {
            opacity: 1;
        }

        .view-details-btn {
            padding: 12px 24px;
            background: var(--green);
            border-radius: 25px;
            color: white;
            font-weight: 500;
            text-decoration: none;
            transition: var(--transition);
        }

        .view-details-btn:hover {
            background: var(--green-dark);
            transform: scale(1.05);
        }

        /* INFO AREA */
        .product-info {
            padding: 20px;
        }

        .product-category {
            font-size: 12px;
            color: var(--green);
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            margin-bottom: 8px;
        }

        .product-title {
            margin-bottom: 8px;
        }

        .product-title a {
            font-size: 18px;
            font-weight: 600;
            color: var(--gray-dark);
            text-decoration: none;
            transition: var(--transition);
        }

        .product-title a:hover {
            color: var(--green);
        }

        .product-description {
            font-size: 14px;
            color: var(--gray-medium);
            line-height: 1.5;
            margin-bottom: 16px;
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }

        /* PRICE + STOCK */
        .product-meta {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 12px;
        }

        .current-price {
            font-size: 20px;
            font-weight: 700;
            color: var(--green);
        }

        .product-stock-info {
            font-size: 13px;
            color: var(--gray-medium);
        }

        .product-stock-info i {
            margin-right: 4px;
        }

        /* RATING */
        .product-rating {
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .stars {
            display: flex;
            gap: 2px;
        }

        .stars i {
            color: #ffc107;
            font-size: 14px;
        }

        .rating-score {
            font-size: 13px;
            color: var(--gray-medium);
            font-weight: 500;
        }

        /* =======================================
                                           NO PRODUCTS
                                        ======================================= */
        .no-products {
            grid-column: 1 / -1;
            text-align: center;
            padding: 60px 20px;
            background: white;
            border-radius: 16px;
            box-shadow: var(--shadow);
        }

        .no-products-icon {
            font-size: 64px;
            color: var(--gray-light);
            margin-bottom: 16px;
        }

        .no-products h3 {
            font-size: 24px;
            color: var(--gray-dark);
            margin-bottom: 8px;
        }

        .no-products p {
            color: var(--gray-medium);
            margin-bottom: 24px;
        }

        .no-products .btn {
            padding: 12px 24px;
            background: var(--green);
            color: white;
            border-radius: 8px;
            text-decoration: none;
            font-weight: 500;
            transition: var(--transition);
        }

        .no-products .btn:hover {
            background: var(--green-dark);
            transform: translateY(-1px);
        }

        /* =======================================
                                           MODAL QUICK VIEW
                                        ======================================= */
        .modal-content {
            border-radius: 16px;
            border: none;
            box-shadow: var(--shadow-hover);
        }

        .modal-product-image img {
            border-radius: 12px;
        }

        /* =======================================
                                           RESPONSIVE BREAKPOINTS
                                        ======================================= */
        @media (max-width: 1200px) {
            .filter-sidebar {
                width: 340px;
            }
        }

        @media (max-width: 992px) {
            .hero-title {
                font-size: 2.3rem;
            }

            .search-sort-group {
                flex-direction: column;
                align-items: stretch;
            }

            .search-container {
                min-width: auto;
            }

            .sort-container,
            .view-toggle,
            .filter-toggle-btn {
                align-self: flex-start;
            }

            .filter-sidebar {
                width: 320px;
            }
        }

        @media (max-width: 768px) {
            .hero-section {
                padding: 55px 20px;
            }

            .hero-title {
                font-size: 2rem;
            }

            .filters-section {
                padding: 20px;
                margin: 20px 0;
            }

            .products-grid {
        grid-template-columns: repeat(2, 1fr);
                gap: 16px;
            }

            .filter-sidebar {
                width: 100%;
                right: -100%;
            }

            .filter-sidebar.open {
                right: 0;
            }
        }

        @media (max-width: 576px) {
            .products-grid {
        grid-template-columns: repeat(2, 1fr);
            }

            .product-info {
                padding: 16px;
            }

            .product-title a {
                font-size: 16px;
            }

            .current-price {
                font-size: 18px;
            }

            .category-scroll {
                padding-bottom: 12px;
            }

            .category-pill {
                padding: 8px 12px;
                font-size: 13px;
            }
        }

        @media (max-width: 480px) {
            .products-grid {
        grid-template-columns: repeat(2, 1fr);
            }

            .hero-stats {
                flex-direction: column;
                gap: 20px;
            }

            .search-sort-group {
                gap: 12px;
            }

            .filter-toggle-btn {
                padding: 10px 16px;
                font-size: 14px;
            }

            .filter-toggle-btn span:not(.filter-count) {
                display: none;
            }
        }
        /* ====== Tokopedia-style sort dropdown & UI ====== */
.sort-dropdown { position: relative; display: inline-block; font-family: inherit; }
#sortBtn {
  background: #fff; border: 1px solid #e6e6e6; padding: .5rem .8rem; border-radius: .5rem;
  display:flex; align-items:center; gap:.5rem; cursor:pointer;
  box-shadow: 0 1px 2px rgba(16,24,40,.03);
}
#sortBtn i.fa-chevron-down { transition: transform .18s ease; }

.sort-menu {
  position: absolute; top: calc(100% + 8px); right: 0; min-width: 210px;
  background: #fff; border-radius: 8px; box-shadow: 0 12px 30px rgba(2,6,23,.08);
  overflow: hidden; transform-origin: top right;
  opacity: 0; pointer-events: none; transform: translateY(-8px) scale(.98);
  transition: transform .16s ease, opacity .18s ease;
  z-index: 80;
}
.sort-dropdown.open .sort-menu { opacity: 1; pointer-events: auto; transform: translateY(0) scale(1); }
.sort-menu .sort-option {
  padding: .6rem .9rem; display:flex; align-items:center; gap:.6rem; cursor:pointer;
  transition: background .12s ease, color .12s ease;
}
.sort-menu .sort-option:hover { background: #f8fafc; }
.sort-menu .sort-option.active {
  background: linear-gradient(90deg,#f0fdfa,#ecfeff);
  font-weight: 600;
}

/* underline bar like tokopedia when using inline sort (if added) */
.sort-inline { display:flex; gap: .5rem; align-items:center; }
.sort-inline .token { padding:.3rem .6rem; border-radius: 999px; cursor:pointer; transition: all .12s ease; }
.sort-inline .token.active { background:#f0fdfa; font-weight:600; transform: translateY(-1px); }

/* Product grid animation */
.products-grid { display: grid; grid-template-columns: repeat(auto-fill,minmax(240px,1fr)); gap:1rem; transition: opacity .18s ease; }
.product-card { background: #fff; border-radius: 10px; overflow: hidden; transition: transform .18s ease, opacity .18s ease; }
.product-card.removing { transform: translateY(-8px); opacity:0; pointer-events:none; }
.products-grid.fade-in .product-card { opacity:0; transform: translateY(8px); }
.products-grid.fade-in.show .product-card { opacity:1; transform: translateY(0); transition-delay: 0.02s; }

/* Sidebar animation */
.filter-sidebar { position: fixed; right: -420px; top: 0; width: 380px; height: 100vh; background:#fff; box-shadow: -18px 40px 80px rgba(3,10,26,.12); transition: right .22s cubic-bezier(.2,.9,.2,1); z-index: 90; padding:1rem; overflow:auto; }
.filter-sidebar.active { right: 0; }
.filter-overlay { position: fixed; inset:0; background: rgba(2,6,23,.45); opacity:0; pointer-events:none; transition: opacity .18s ease; z-index: 80; }
.filter-overlay.active { opacity:1; pointer-events:auto; }

/* Active filter count badge */
.filter-toggle-btn .filter-count { background:#ef4444; color:#fff; border-radius:999px; padding: .08rem .45rem; margin-left:.5rem; font-size:.75rem; }

/* small helpers */
.hidden { display:none !important; }
.no-results { padding:2rem; text-align:center; color:#6b7280; }


    </style>
@endsection
@section('scripts')
 <script>
document.addEventListener("DOMContentLoaded", function () {

    const cards = document.querySelectorAll(".product-card");
    const searchInput = document.getElementById("productSearch");
    const productsGrid = document.getElementById("productsGrid");

    /* Category pills */
    const categoryButtons = document.querySelectorAll(".category-pill");

    /* Filter sidebar */
    const filterToggle = document.getElementById("filterToggleBtn");
    const filterPanel = document.getElementById("filterSidebar");
    const filterOverlay = document.getElementById("filterOverlay");
    const closeFilter = document.getElementById("closeFilter");

    /* Price */
    const minPrice = document.getElementById("minPrice");
    const maxPrice = document.getElementById("maxPrice");

    /* Stock */
    const stockCheckboxes = document.querySelectorAll(".stock-status-options input[type='checkbox']");

    /* Sort options */
    const sortOptions = document.querySelectorAll(".sort-option");

    let currentSort = "latest";

    /* ==========================
       Open/Close Filter Sidebar
    =========================== */
    filterToggle.addEventListener("click", () => {
        filterPanel.classList.add("active");
        filterOverlay.classList.add("active");
    });

    closeFilter.addEventListener("click", () => {
        filterPanel.classList.remove("active");
        filterOverlay.classList.remove("active");
    });

    filterOverlay.addEventListener("click", () => {
        filterPanel.classList.remove("active");
        filterOverlay.classList.remove("active");
    });

    /* ==========================
       APPLY FILTERS (Client-side)
    =========================== */
    function applyFilters() {
        const search = searchInput.value.toLowerCase();
        const min = minPrice.value ? parseInt(minPrice.value) : 0;
        const max = maxPrice.value ? parseInt(maxPrice.value) : Infinity;

        const activeCategory = document.querySelector(".category-pill.active").dataset.category;

        const stockSelected = Array.from(stockCheckboxes)
            .filter(cb => cb.checked)
            .map(cb => cb.value);

        cards.forEach(card => {
            const name = card.dataset.name;
            const category = card.dataset.category;
            const price = parseInt(card.dataset.price);
            const stock = parseInt(card.dataset.stock);

            let visible = true;

            if (!name.includes(search)) visible = false;
            if (activeCategory !== "all" && category !== activeCategory) visible = false;
            if (price < min || price > max) visible = false;

            let stockVisible = false;
            if (stock > 5 && stockSelected.includes("available")) stockVisible = true;
            if (stock > 0 && stock <= 5 && stockSelected.includes("low")) stockVisible = true;
            if (stock <= 0 && stockSelected.includes("out")) stockVisible = true;
            if (!stockVisible) visible = false;

            card.style.display = visible ? "" : "none";
        });

        applySorting();
    }

    /* ===========================================
   SORTING — FIXED & COMPATIBLE WITH YOUR HTML
=========================================== */
function applySorting() {

    let items = Array.from(document.querySelectorAll(".product-card"));

    // Filter hanya elemen yang terlihat (agar hasil bersih)
    let visibleItems = items.filter(i => i.style.display !== "none");

    if (currentSort === "price-low") {
        visibleItems.sort((a, b) => a.dataset.price - b.dataset.price);
    }
    else if (currentSort === "price-high") {
        visibleItems.sort((a, b) => b.dataset.price - a.dataset.price);
    }
    else if (currentSort === "name-asc") {
        visibleItems.sort((a, b) => a.dataset.name.localeCompare(b.dataset.name));
    }
    else if (currentSort === "name-desc") {
        visibleItems.sort((a, b) => b.dataset.name.localeCompare(a.dataset.name));
    }
    else if (currentSort === "latest") {
        visibleItems.sort((a, b) => b.dataset.id - a.dataset.id);
    }
    else if (currentSort === "oldest") {
        visibleItems.sort((a, b) => a.dataset.id - b.dataset.id);
    }

    visibleItems.forEach(item => productsGrid.appendChild(item));
}

/* When clicking a sort option */
sortOptions.forEach(option => {
    option.addEventListener("click", function () {
        sortOptions.forEach(o => o.classList.remove("active"));
        this.classList.add("active");

        currentSort = this.dataset.value;
        applyFilters();  // filter dulu
        applySorting();  // baru sort
    });
});


    /* ==========================
       EVENT HANDLERS
    =========================== */
    searchInput.addEventListener("input", applyFilters);
    minPrice.addEventListener("input", applyFilters);
    maxPrice.addEventListener("input", applyFilters);
    stockCheckboxes.forEach(cb => cb.addEventListener("change", applyFilters));

    categoryButtons.forEach(btn => {
        btn.addEventListener("click", function () {
            categoryButtons.forEach(b => b.classList.remove("active"));
            this.classList.add("active");
            applyFilters();
        });
    });

    /* Reset */
    window.resetFilters = function () {
        minPrice.value = "";
        maxPrice.value = "";
        stockCheckboxes.forEach(cb => cb.checked = true);
        applyFilters();
    };

    window.resetAllFilters = function () {
        searchInput.value = "";
        minPrice.value = "";
        maxPrice.value = "";
        stockCheckboxes.forEach(cb => cb.checked = true);

        categoryButtons.forEach(b => b.classList.remove("active"));
        document.querySelector('[data-category="all"]').classList.add("active");

        applyFilters();
    };

    /* Initial run */
    applyFilters();

});
</script>
