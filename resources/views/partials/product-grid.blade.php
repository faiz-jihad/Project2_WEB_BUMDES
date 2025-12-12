<div class="products-grid" id="productsGrid">
    @forelse($produk as $item)
        <div class="product-card" data-category="{{ strtolower($item->kategori) }}" data-price="{{ $item->harga }}"
            data-stock="{{ $item->stok }}" data-name="{{ strtolower($item->nama) }}" data-slug="{{ $item->slug }}">
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
                    <button class="action-btn quick-view" data-product-id="{{ $item->id }}" title="Quick View">
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
            </div>

            <!-- Product Info -->
            <div class="product-info">
                <div class="product-category">{{ ucfirst($item->kategori) }}</div>
                <h3 class="product-title">
                    <a href="{{ route('produk.show', $item->slug) }}">{{ Str::limit($item->nama, 60) }}</a>
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
