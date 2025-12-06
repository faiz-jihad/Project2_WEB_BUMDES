<div class="product-card">
    <div class="product-image-container">
        <img src="{{ $product->gambar ? asset('storage/' . $product->gambar) : asset('images/no-image.jpg') }}"
            alt="{{ $product->nama }}" class="product-image" loading="lazy">
        @if ($product->stok <= 0)
            <div class="product-badge out-of-stock">Habis</div>
        @elseif($product->stok <= 5)
            <div class="product-badge low-stock">Stok Terbatas</div>
        @endif
    </div>

    <div class="product-info">
        <h5 class="product-title">{{ Str::limit($product->nama, 40) }}</h5>
        <p class="product-description">
            {{ Str::limit($product->deskripsi ?? 'Produk berkualitas dari BUMDes Madusari', 60) }}</p>

        <div class="product-price">
            <span class="price">Rp {{ number_format($product->harga, 0, ',', '.') }}</span>
        </div>

        <div class="product-actions">
            @if ($product->stok > 0)
                <button class="btn btn-sm btn-success btn-keranjang-home" data-id="{{ $product->id }}"
                    data-nama="{{ $product->nama }}" data-harga="{{ $product->harga }}">
                    <i class="fas fa-cart-plus"></i> Keranjang
                </button>
            @else
                <button class="btn btn-sm btn-secondary" disabled>
                    <i class="fas fa-times"></i> Habis
                </button>
            @endif

            <a href="{{ route('produk.show', $product->slug ?? $product->id) }}" class="btn btn-sm btn-outline-success">
                <i class="fas fa-eye"></i> Lihat
            </a>
        </div>
    </div>
</div>

<style>
    .product-card {
        background: white;
        border-radius: 12px;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
        overflow: hidden;
        transition: all 0.3s ease;
        height: 100%;
        display: flex;
        flex-direction: column;
    }

    .product-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15);
    }

    .product-image-container {
        position: relative;
        height: 200px;
        overflow: hidden;
    }

    .product-image {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.3s ease;
    }

    .product-card:hover .product-image {
        transform: scale(1.05);
    }

    .product-badge {
        position: absolute;
        top: 10px;
        right: 10px;
        padding: 4px 8px;
        border-radius: 4px;
        font-size: 0.75rem;
        font-weight: 600;
        text-transform: uppercase;
    }

    .product-badge.out-of-stock {
        background: #dc3545;
        color: white;
    }

    .product-badge.low-stock {
        background: #ffc107;
        color: #212529;
    }

    .product-info {
        padding: 1rem;
        flex: 1;
        display: flex;
        flex-direction: column;
    }

    .product-title {
        font-size: 1rem;
        font-weight: 600;
        color: #212529;
        margin-bottom: 0.5rem;
        line-height: 1.3;
    }

    .product-description {
        color: #6c757d;
        font-size: 0.85rem;
        line-height: 1.4;
        margin-bottom: 1rem;
        flex: 1;
    }

    .product-price {
        margin-bottom: 1rem;
    }

    .price {
        font-size: 1.1rem;
        font-weight: 700;
        color: #198754;
    }

    .product-actions {
        display: flex;
        gap: 0.5rem;
    }

    .product-actions .btn {
        flex: 1;
        font-size: 0.8rem;
        padding: 0.5rem;
    }

    @media (max-width: 768px) {
        .product-image-container {
            height: 150px;
        }

        .product-info {
            padding: 0.75rem;
        }

        .product-title {
            font-size: 0.9rem;
        }

        .product-description {
            font-size: 0.8rem;
        }

        .price {
            font-size: 1rem;
        }

        .product-actions {
            flex-direction: column;
        }

        .product-actions .btn {
            width: 100%;
        }
    }
</style>
