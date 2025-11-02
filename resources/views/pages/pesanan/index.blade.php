@extends('layouts.master')

@section('title', 'Pesanan Saya - BUMDes Madusari')

@section('content')
    <section class="orders-section">
        <div class="container" data-aos="fade-up">
            <div class="orders-header">
                <h1>Pesanan Saya</h1>
                <p>Kelola dan pantau status pesanan Anda</p>
            </div>

            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <i class="bi bi-check-circle-fill"></i>
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            @if (session('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <i class="bi bi-exclamation-triangle-fill"></i>
                    {{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            @if ($pesanans->count() > 0)
                <div class="orders-grid">
                    @foreach ($pesanans as $pesanan)
                        <div class="order-card">
                            <div class="order-header">
                                <div class="order-info">
                                    <h3>Pesanan #{{ $pesanan->id_pesanan }}</h3>
                                    <p class="order-date">{{ $pesanan->created_at->format('d/m/Y H:i') }}</p>
                                </div>
                                <div class="order-status">
                                    <span class="status-badge status-{{ $pesanan->status }}">
                                        @switch($pesanan->status)
                                            @case('pending')
                                                Menunggu Pembayaran
                                            @break

                                            @case('sudah_bayar')
                                                Sudah Bayar
                                            @break

                                            @case('diproses')
                                                Diproses
                                            @break

                                            @case('dikirim')
                                                Dikirim
                                            @break

                                            @case('selesai')
                                                Selesai
                                            @break

                                            @case('dibatalkan')
                                                Dibatalkan
                                            @break
                                        @endswitch
                                    </span>
                                </div>
                            </div>

                            <div class="order-items">
                                @foreach ($pesanan->items as $item)
                                    <div class="order-item">
                                        <div class="item-image">
                                            <img src="{{ asset('storage/' . ($item['gambar'] ?? 'images/no-image.jpg')) }}"
                                                alt="{{ $item['nama'] }}">
                                        </div>
                                        <div class="item-details">
                                            <h4>{{ $item['nama'] }}</h4>
                                            @if (isset($item['variasi']) && $item['variasi'])
                                                <p class="item-variant">{{ $item['variasi'] }}</p>
                                            @endif
                                            <p class="item-price">Rp {{ number_format($item['harga'], 0, ',', '.') }} x
                                                {{ $item['jumlah'] }}</p>
                                        </div>
                                        <div class="item-total">
                                            <strong>Rp {{ number_format($item['subtotal'], 0, ',', '.') }}</strong>
                                        </div>
                                    </div>
                                @endforeach
                            </div>

                            <div class="order-footer">
                                <div class="order-total">
                                    <strong>Total: Rp {{ number_format($pesanan->total_harga, 0, ',', '.') }}</strong>
                                </div>
                                <div class="order-actions">
                                    <a href="{{ route('pesanan.show', $pesanan->id_pesanan) }}"
                                        class="btn btn-outline-primary btn-sm">
                                        <i class="bi bi-eye"></i> Detail
                                    </a>
                                    <a href="{{ route('pesanan.nota', $pesanan->id_pesanan) }}"
                                        class="btn btn-outline-success btn-sm" target="_blank">
                                        <i class="bi bi-receipt"></i> Nota
                                    </a>
                                    @if ($pesanan->status == 'pending')
                                        <a href="{{ route('pesanan.edit', $pesanan->id_pesanan) }}"
                                            class="btn btn-outline-warning btn-sm">
                                            <i class="bi bi-pencil"></i> Edit
                                        </a>
                                        <form action="{{ route('pesanan.destroy', $pesanan->id_pesanan) }}" method="POST"
                                            class="d-inline"
                                            onsubmit="return confirm('Apakah Anda yakin ingin membatalkan pesanan ini?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-outline-danger btn-sm">
                                                <i class="bi bi-x-circle"></i> Batal
                                            </button>
                                        </form>
                                    @endif
                                    @if ($pesanan->status == 'pending' && $pesanan->metode_pembayaran == 'transfer')
                                        <form action="{{ route('pesanan.mark-paid', $pesanan->id) }}" method="POST"
                                            class="d-inline">
                                            @csrf
                                            @method('POST')
                                            <button type="submit" class="btn btn-outline-info btn-sm">
                                                <i class="bi bi-check-circle"></i> Sudah Bayar
                                            </button>
                                        </form>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                {{-- Pagination --}}
                <div class="pagination-wrapper">
                    {{ $pesanans->links() }}
                </div>
            @else
                <div class="empty-orders">
                    <div class="empty-icon">
                        <i class="bi bi-receipt"></i>
                    </div>
                    <h3>Belum ada pesanan</h3>
                    <p>Anda belum memiliki pesanan. Mulai berbelanja sekarang!</p>
                    <a href="{{ route('produk.index') }}" class="btn btn-primary">
                        <i class="bi bi-shop"></i> Mulai Belanja
                    </a>
                </div>
            @endif
        </div>
    </section>

    {{-- CSS --}}
    <style>
        .orders-section {
            padding: 120px 20px 100px;
            background: #f8fff9;
            min-height: 100vh;
        }

        .orders-header {
            text-align: center;
            margin-bottom: 40px;
        }

        .orders-header h1 {
            font-size: 2.5rem;
            color: #146c43;
            margin-bottom: 10px;
        }

        .orders-header p {
            font-size: 1.1rem;
            color: #666;
            margin: 0;
        }

        .alert {
            margin-bottom: 30px;
            border-radius: 10px;
            border: none;
        }

        .alert-success {
            background: #d1e7dd;
            color: #0f5132;
        }

        .alert-danger {
            background: #f8d7da;
            color: #721c24;
        }

        .orders-grid {
            display: grid;
            gap: 25px;
            margin-bottom: 40px;
        }

        .order-card {
            background: #fff;
            border-radius: 15px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.08);
            overflow: hidden;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .order-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.12);
        }

        .order-header {
            background: linear-gradient(135deg, #198754, #146c43);
            color: white;
            padding: 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .order-info h3 {
            margin: 0;
            font-size: 1.2rem;
        }

        .order-date {
            margin: 5px 0 0 0;
            font-size: 0.9rem;
            opacity: 0.9;
        }

        .status-badge {
            padding: 6px 12px;
            border-radius: 20px;
            font-size: 0.8rem;
            font-weight: 600;
        }

        .status-pending {
            background: #fff3cd;
            color: #856404;
        }

        .status-sudah_bayar,
        .status-selesai {
            background: #d1e7dd;
            color: #0f5132;
        }

        .status-diproses {
            background: #cff4fc;
            color: #055160;
        }

        .status-dikirim {
            background: #e7f3ff;
            color: #084c7d;
        }

        .status-dibatalkan {
            background: #f8d7da;
            color: #721c24;
        }

        .order-items {
            padding: 20px;
        }

        .order-item {
            display: flex;
            align-items: center;
            gap: 15px;
            padding: 15px 0;
            border-bottom: 1px solid #f0f0f0;
        }

        .order-item:last-child {
            border-bottom: none;
        }

        .item-image {
            width: 60px;
            height: 60px;
            border-radius: 8px;
            overflow: hidden;
            flex-shrink: 0;
        }

        .item-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .item-details {
            flex: 1;
        }

        .item-details h4 {
            margin: 0 0 5px 0;
            font-size: 1rem;
            color: #333;
        }

        .item-variant {
            color: #666;
            font-size: 0.85rem;
            margin: 2px 0;
        }

        .item-price {
            color: #666;
            font-size: 0.9rem;
            margin: 0;
        }

        .item-total {
            font-size: 1rem;
            color: #198754;
        }

        .order-footer {
            background: #f8fff9;
            padding: 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            gap: 15px;
        }

        .order-total {
            font-size: 1.1rem;
        }

        .order-actions {
            display: flex;
            gap: 8px;
            flex-wrap: wrap;
        }

        .order-actions .btn {
            white-space: nowrap;
            font-size: 0.85rem;
        }

        .pagination-wrapper {
            display: flex;
            justify-content: center;
            margin-top: 40px;
        }

        .empty-orders {
            text-align: center;
            padding: 80px 20px;
            background: #fff;
            border-radius: 15px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.08);
        }

        .empty-icon {
            font-size: 4rem;
            color: #198754;
            margin-bottom: 20px;
        }

        .empty-orders h3 {
            color: #333;
            margin-bottom: 10px;
        }

        .empty-orders p {
            color: #666;
            margin-bottom: 30px;
        }

        .empty-orders .btn {
            padding: 12px 30px;
            font-size: 1rem;
        }

        @media (max-width: 768px) {
            .orders-header h1 {
                font-size: 2rem;
            }

            .order-header {
                flex-direction: column;
                align-items: flex-start;
                gap: 10px;
            }

            .order-footer {
                flex-direction: column;
                align-items: stretch;
                text-align: center;
            }

            .order-actions {
                justify-content: center;
            }

            .order-item {
                flex-direction: column;
                align-items: flex-start;
                gap: 10px;
            }

            .item-image {
                align-self: center;
            }
        }
    </style>
@endsection
