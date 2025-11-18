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
                                            <img src="{{ $item['gambar'] ?? asset('images/no-image.jpg') }}"
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
                                    <button type="button" class="btn btn-outline-primary btn-sm" data-bs-toggle="modal"
                                        data-bs-target="#detailModal{{ $pesanan->id_pesanan }}">
                                        <i class="bi bi-eye"></i> Detail
                                    </button>
                                    <a href="{{ route('pesanan.nota', $pesanan->uuid) }}"
                                        class="btn btn-outline-success btn-sm" target="_blank">
                                        <i class="bi bi-receipt"></i> Nota
                                    </a>
                                    @if ($pesanan->status == 'pending')
                                        <button type="button" class="btn btn-outline-warning btn-sm" data-bs-toggle="modal"
                                            data-bs-target="#editModal{{ $pesanan->id_pesanan }}">
                                            <i class="bi bi-pencil"></i> Edit
                                        </button>
                                        <form action="{{ route('pesanan.destroy', $pesanan->uuid) }}" method="POST"
                                            class="d-inline"
                                            onsubmit="return confirm('Apakah Anda yakin ingin membatalkan pesanan ini?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-outline-danger btn-sm">
                                                <i class="bi bi-x-circle"></i> Batal
                                            </button>
                                        </form>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @endforeach

                    {{-- Detail Modal --}}
                    @foreach ($pesanans as $pesanan)
                        <div class="modal fade" id="detailModal{{ $pesanan->id_pesanan }}" tabindex="-1"
                            aria-labelledby="detailModalLabel{{ $pesanan->id_pesanan }}" aria-hidden="true">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="detailModalLabel{{ $pesanan->id_pesanan }}">Detail
                                            Pesanan #{{ $pesanan->id_pesanan }}</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <h6>Informasi Pesanan</h6>
                                                <p><strong>Status:</strong>
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
                                                </p>
                                                <p><strong>Tanggal:</strong>
                                                    {{ $pesanan->created_at->format('d/m/Y H:i') }}</p>
                                                <p><strong>Metode Pembayaran:</strong>
                                                    {{ ucfirst($pesanan->metode_pembayaran) }}</p>
                                            </div>
                                            <div class="col-md-6">
                                                <h6>Informasi Pemesan</h6>
                                                <p><strong>Nama:</strong> {{ $pesanan->nama_pemesan }}</p>
                                                <p><strong>Alamat:</strong> {{ $pesanan->alamat }}</p>
                                                <p><strong>No. HP:</strong> {{ $pesanan->no_hp }}</p>
                                                @if ($pesanan->catatan)
                                                    <p><strong>Catatan:</strong> {{ $pesanan->catatan }}</p>
                                                @endif
                                            </div>
                                        </div>
                                        <hr>
                                        <h6>Detail Produk</h6>
                                        <div class="order-items">
                                            @foreach ($pesanan->items as $item)
                                                <div class="order-item">
                                                    <div class="item-image">
                                                        <img src="{{ $item['gambar'] ?? asset('images/no-image.jpg') }}"
                                                            alt="{{ $item['nama'] }}">
                                                    </div>
                                                    <div class="item-details">
                                                        <h4>{{ $item['nama'] }}</h4>
                                                        @if (isset($item['variasi']) && $item['variasi'])
                                                            <p class="item-variant">{{ $item['variasi'] }}</p>
                                                        @endif
                                                        <p class="item-price">Rp
                                                            {{ number_format($item['harga'], 0, ',', '.') }} x
                                                            {{ $item['jumlah'] }}</p>
                                                    </div>
                                                    <div class="item-total">
                                                        <strong>Rp
                                                            {{ number_format($item['subtotal'], 0, ',', '.') }}</strong>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                        <hr>
                                        <div class="text-end">
                                            <h5>Total: Rp {{ number_format($pesanan->total_harga, 0, ',', '.') }}</h5>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary"
                                            data-bs-dismiss="modal">Tutup</button>
                                        <a href="{{ route('pesanan.nota', $pesanan->uuid) }}" class="btn btn-success"
                                            target="_blank">
                                            <i class="bi bi-receipt"></i> Lihat Nota
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach

                    {{-- Edit Modal --}}
                    @foreach ($pesanans as $pesanan)
                        <div class="modal fade" id="editModal{{ $pesanan->id_pesanan }}" tabindex="-1"
                            aria-labelledby="editModalLabel{{ $pesanan->id_pesanan }}" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="editModalLabel{{ $pesanan->id_pesanan }}">Edit
                                            Pesanan #{{ $pesanan->id_pesanan }}</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <form action="{{ route('pesanan.update', $pesanan->uuid) }}" method="POST">
                                            @csrf
                                            @method('PUT')
                                            <div class="mb-3">
                                                <label for="nama_pemesan{{ $pesanan->id_pesanan }}"
                                                    class="form-label">Nama Pemesan</label>
                                                <input type="text" class="form-control"
                                                    id="nama_pemesan{{ $pesanan->id_pesanan }}" name="nama_pemesan"
                                                    value="{{ $pesanan->nama_pemesan }}" required>
                                            </div>
                                            <div class="mb-3">
                                                <label for="alamat{{ $pesanan->id_pesanan }}"
                                                    class="form-label">Alamat</label>
                                                <textarea class="form-control" id="alamat{{ $pesanan->id_pesanan }}" name="alamat" rows="3" required>{{ $pesanan->alamat }}</textarea>
                                            </div>
                                            <div class="mb-3">
                                                <label for="no_hp{{ $pesanan->id_pesanan }}" class="form-label">No.
                                                    HP</label>
                                                <input type="text" class="form-control"
                                                    id="no_hp{{ $pesanan->id_pesanan }}" name="no_hp"
                                                    value="{{ $pesanan->no_hp }}" required>
                                            </div>
                                            <div class="mb-3">
                                                <label for="catatan{{ $pesanan->id_pesanan }}"
                                                    class="form-label">Catatan</label>
                                                <textarea class="form-control" id="catatan{{ $pesanan->id_pesanan }}" name="catatan" rows="2">{{ $pesanan->catatan }}</textarea>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary"
                                                    data-bs-dismiss="modal">Batal</button>
                                                <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                {{-- Pagination --}}
                <div class="pagination-wrapper">
                    @if ($pesanans->hasPages())
                        <nav aria-label="Pagination">
                            <ul class="pagination pagination-custom">
                                {{-- Previous Page Link --}}
                                @if ($pesanans->onFirstPage())
                                    <li class="page-item disabled">
                                        <span class="page-link">
                                            <i class="bi bi-chevron-left"></i>
                                            <span class="d-none d-sm-inline">Sebelumnya</span>
                                        </span>
                                    </li>
                                @else
                                    <li class="page-item">
                                        <a class="page-link" href="{{ $pesanans->previousPageUrl() }}" rel="prev">
                                            <i class="bi bi-chevron-left"></i>
                                            <span class="d-none d-sm-inline">Sebelumnya</span>
                                        </a>
                                    </li>
                                @endif

                                {{-- Pagination Elements --}}
                                @foreach ($pesanans->getUrlRange(1, $pesanans->lastPage()) as $page => $url)
                                    @if ($page == $pesanans->currentPage())
                                        <li class="page-item active">
                                            <span class="page-link">{{ $page }}</span>
                                        </li>
                                    @else
                                        <li class="page-item">
                                            <a class="page-link" href="{{ $url }}">{{ $page }}</a>
                                        </li>
                                    @endif
                                @endforeach

                                {{-- Next Page Link --}}
                                @if ($pesanans->hasMorePages())
                                    <li class="page-item">
                                        <a class="page-link" href="{{ $pesanans->nextPageUrl() }}" rel="next">
                                            <span class="d-none d-sm-inline">Selanjutnya</span>
                                            <i class="bi bi-chevron-right"></i>
                                        </a>
                                    </li>
                                @else
                                    <li class="page-item disabled">
                                        <span class="page-link">
                                            <span class="d-none d-sm-inline">Selanjutnya</span>
                                            <i class="bi bi-chevron-right"></i>
                                        </span>
                                    </li>
                                @endif
                            </ul>
                        </nav>

                        {{-- Pagination Info --}}
                        <div class="pagination-info">
                            <small class="text-muted">
                                Menampilkan {{ $pesanans->firstItem() }}-{{ $pesanans->lastItem() }} dari
                                {{ $pesanans->total() }} pesanan
                            </small>
                        </div>
                    @endif
                </div>
            @else
                <div class="empty-orders">
                    <div class="empty-icon">
                        <i class="bi bi-receipt"></i>
                    </div>
                    <h3>Belum ada pesanan</h3>
                    <p>Anda belum memiliki pesanan. Mulai berbelanja sekarang!</p>
                    <a href="{{ route('produk.index') }}" class="btn btn-success">
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
            flex-direction: column;
            align-items: center;
            gap: 15px;
            margin-top: 40px;
        }

        .pagination-custom {
            margin: 0;
            gap: 5px;
        }

        .pagination-custom .page-item {
            margin: 0;
        }

        .pagination-custom .page-link {
            border: 2px solid #e9ecef;
            color: #198754;
            background: white;
            border-radius: 8px;
            padding: 8px 16px;
            font-weight: 500;
            transition: all 0.3s ease;
            text-decoration: none;
            display: flex;
            align-items: center;
            gap: 5px;
        }

        .pagination-custom .page-link:hover {
            background: #f8fff9;
            border-color: #198754;
            color: #146c43;
            transform: translateY(-1px);
            box-shadow: 0 4px 8px rgba(25, 135, 84, 0.2);
        }

        .pagination-custom .page-item.active .page-link {
            background: linear-gradient(135deg, #198754, #146c43);
            border-color: #198754;
            color: white;
            box-shadow: 0 4px 12px rgba(25, 135, 84, 0.3);
        }

        .pagination-custom .page-item.disabled .page-link {
            background: #f8f9fa;
            border-color: #dee2e6;
            color: #6c757d;
            cursor: not-allowed;
        }

        .pagination-info {
            font-size: 0.9rem;
            color: #6c757d;
            text-align: center;
        }

        @media (max-width: 576px) {
            .pagination-custom .page-link span {
                display: none;
            }

            .pagination-custom .page-link {
                padding: 8px 12px;
                min-width: 40px;
                justify-content: center;
            }
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
