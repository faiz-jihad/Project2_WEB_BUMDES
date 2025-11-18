@extends('layouts.master')

@section('title', 'Detail Pesanan - ' . $pesanan->id_pesanan)

@section('content')
    <section class="order-detail-section">
        <div class="container" data-aos="fade-up">
            <div class="order-header">
                <h1>Detail Pesanan</h1>
                <div class="order-info">
                    <span class="order-id">ID Pesanan: <strong>{{ $pesanan->id_pesanan }}</strong></span>
                    <span class="order-date">Tanggal: {{ $pesanan->created_at->format('d/m/Y H:i') }}</span>
                </div>
            </div>

            <div class="order-content">
                {{-- Status & Actions --}}
                <div class="order-status-card">
                    <div class="status-header">
                        <h3>Status Pesanan</h3>
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

                    <div class="status-actions">
                        @if ($pesanan->status == 'pending' && $pesanan->metode_pembayaran == 'transfer')
                            <form action="{{ route('pesanan.mark-paid', $pesanan->uuid) }}" method="POST" class="d-inline">
                                @csrf
                                @method('POST')
                                <button type="submit" class="btn btn-success btn-sm">
                                    <i class="fas fa-check"></i> Tandai Sudah Bayar
                                </button>
                            </form>
                        @endif

                        @if ($pesanan->status == 'pending')
                            <a href="{{ route('pesanan.edit', $pesanan->uuid) }}" class="btn btn-warning btn-sm">
                                <i class="fas fa-edit"></i> Edit Pesanan
                            </a>
                            <form action="{{ route('pesanan.destroy', $pesanan->uuid) }}" method="POST" class="d-inline"
                                onsubmit="return confirm('Apakah Anda yakin ingin membatalkan pesanan ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">
                                    <i class="fas fa-times"></i> Batalkan Pesanan
                                </button>
                            </form>
                        @endif

                        <a href="{{ route('pesanan.nota', $pesanan->uuid) }}" class="btn btn-primary btn-sm"
                            target="_blank">
                            <i class="fas fa-print"></i> Lihat Nota
                        </a>
                    </div>
                </div>

                {{-- Customer Information --}}
                <div class="info-section">
                    <div class="customer-info">
                        <h3>Informasi Pemesan</h3>
                        <div class="info-content">
                            <p><strong>Nama:</strong> {{ $pesanan->nama_pemesan }}</p>
                            <p><strong>No. HP:</strong> {{ $pesanan->no_hp }}</p>
                            <p><strong>Alamat:</strong> {{ $pesanan->alamat }}</p>
                            @if ($pesanan->user)
                                <p><strong>Email:</strong> {{ $pesanan->user->email }}</p>
                            @else
                                <p><strong>User:</strong> Guest</p>
                            @endif
                        </div>
                    </div>

                    <div class="payment-info">
                        <h3>Informasi Pembayaran</h3>
                        <div class="info-content">
                            <p><strong>Metode:</strong>
                                @if ($pesanan->metode_pembayaran == 'transfer')
                                    Transfer Bank
                                @else
                                    Bayar di Tempat (COD)
                                @endif
                            </p>
                            <p><strong>Total:</strong> Rp {{ number_format($pesanan->total_harga, 0, ',', '.') }}</p>
                            @if ($pesanan->metode_pembayaran == 'transfer')
                                <div class="bank-details">
                                    <p><strong>Rekening Tujuan:</strong></p>
                                    <p>Bank: BRI</p>
                                    <p>No. Rekening: 1234-5678-9012-3456</p>
                                    <p>Atas Nama: BUMDes Madusari</p>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>

                {{-- Order Items --}}
                <div class="order-items">
                    <h3>Detail Produk</h3>
                    <div class="items-table">
                        <div class="table-header">
                            <span>Produk</span>
                            <span>Harga</span>
                            <span>Jumlah</span>
                            <span>Subtotal</span>
                        </div>
                        @foreach ($pesanan->items as $item)
                            <div class="table-row">
                                <div class="product-info">
                                    <strong>{{ $item['nama'] }}</strong>
                                    @if (isset($item['variasi']) && $item['variasi'])
                                        <br><small>Variasi: {{ $item['variasi'] }}</small>
                                    @endif
                                </div>
                                <div class="price">Rp {{ number_format($item['harga'], 0, ',', '.') }}</div>
                                <div class="quantity">{{ $item['jumlah'] }}</div>
                                <div class="subtotal">Rp {{ number_format($item['subtotal'], 0, ',', '.') }}</div>
                            </div>
                        @endforeach
                        <div class="table-footer">
                            <div class="total-row">
                                <span><strong>Total</strong></span>
                                <span><strong>Rp {{ number_format($pesanan->total_harga, 0, ',', '.') }}</strong></span>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Notes --}}
                @if ($pesanan->catatan)
                    <div class="notes-section">
                        <h3>Catatan</h3>
                        <p>{{ $pesanan->catatan }}</p>
                    </div>
                @endif

                {{-- Back Button --}}
                <div class="action-buttons">
                    <a href="{{ route('pesanan.index') }}" class="btn btn-secondary">
                        <i class="fas fa-arrow-left"></i> Kembali ke Daftar Pesanan
                    </a>
                </div>
            </div>
        </div>
    </section>

    {{-- CSS --}}
    <style>
        .order-detail-section {
            padding: 120px 20px 100px;
            background: #f8fff9;
            min-height: 100vh;
        }

        .order-header {
            text-align: center;
            margin-bottom: 30px;
        }

        .order-header h1 {
            font-size: 2rem;
            color: #146c43;
            margin-bottom: 10px;
        }

        .order-info {
            display: flex;
            justify-content: center;
            gap: 20px;
            flex-wrap: wrap;
        }

        .order-id,
        .order-date {
            background: #fff;
            padding: 8px 16px;
            border-radius: 6px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .order-content {
            max-width: 1000px;
            margin: 0 auto;
        }

        .order-status-card {
            background: #fff;
            padding: 20px;
            border-radius: 12px;
            margin-bottom: 25px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
        }

        .status-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 15px;
        }

        .status-header h3 {
            margin: 0;
            color: #198754;
        }

        .status-badge {
            padding: 6px 12px;
            border-radius: 20px;
            font-size: 0.85rem;
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

        .status-actions {
            display: flex;
            gap: 10px;
            flex-wrap: wrap;
        }

        .status-actions .btn {
            white-space: nowrap;
        }

        .info-section {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 25px;
            margin-bottom: 25px;
        }

        .customer-info,
        .payment-info {
            background: #fff;
            padding: 20px;
            border-radius: 12px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
        }

        .customer-info h3,
        .payment-info h3 {
            color: #198754;
            margin-bottom: 15px;
        }

        .info-content p {
            margin: 8px 0;
            line-height: 1.5;
        }

        .bank-details {
            background: #f8fff9;
            padding: 15px;
            border-radius: 8px;
            margin-top: 10px;
        }

        .bank-details p {
            margin: 5px 0;
            font-size: 0.9rem;
        }

        .order-items {
            background: #fff;
            padding: 20px;
            border-radius: 12px;
            margin-bottom: 25px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
        }

        .order-items h3 {
            color: #198754;
            margin-bottom: 20px;
        }

        .items-table {
            border: 1px solid #eaeaea;
            border-radius: 8px;
            overflow: hidden;
        }

        .table-header {
            background: #f8fff9;
            padding: 15px;
            display: grid;
            grid-template-columns: 3fr 1fr 1fr 1fr;
            gap: 10px;
            font-weight: 600;
            color: #146c43;
            border-bottom: 1px solid #eaeaea;
        }

        .table-row {
            padding: 15px;
            display: grid;
            grid-template-columns: 3fr 1fr 1fr 1fr;
            gap: 10px;
            border-bottom: 1px solid #f0f0f0;
            align-items: center;
        }

        .table-row:last-child {
            border-bottom: none;
        }

        .product-info {
            line-height: 1.4;
        }

        .product-info small {
            color: #666;
        }

        .price,
        .quantity,
        .subtotal {
            text-align: center;
            font-weight: 500;
        }

        .table-footer {
            background: #f8fff9;
            border-top: 2px solid #146c43;
        }

        .total-row {
            padding: 15px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            font-size: 1.1rem;
        }

        .notes-section {
            background: #fff;
            padding: 20px;
            border-radius: 12px;
            margin-bottom: 25px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
        }

        .notes-section h3 {
            color: #198754;
            margin-bottom: 10px;
        }

        .notes-section p {
            background: #f8fff9;
            padding: 15px;
            border-radius: 8px;
            line-height: 1.5;
        }

        .action-buttons {
            text-align: center;
        }

        .action-buttons .btn {
            padding: 12px 24px;
            font-size: 1rem;
        }

        @media (max-width: 768px) {
            .info-section {
                grid-template-columns: 1fr;
            }

            .order-info {
                flex-direction: column;
                gap: 10px;
            }

            .status-header {
                flex-direction: column;
                align-items: flex-start;
                gap: 10px;
            }

            .status-actions {
                justify-content: flex-start;
            }

            .table-header,
            .table-row {
                grid-template-columns: 2fr 1fr 1fr 1fr;
                font-size: 0.9rem;
            }

            .total-row {
                flex-direction: column;
                gap: 10px;
                text-align: center;
            }
        }
    </style>
@endsection
