@extends('layouts.master')

@section('title', 'Nota Pesanan - BUMDes Madusari')

@section('content')
    <section class="nota-section">
        <br><br><br>
        <div class="container" data-aos="fade-up">
            <div class="nota-wrapper">
                <div class="nota-header">
                    <div class="logo-section">
                        <img src="{{ asset('images/bumdes.jpg') }}" alt="BUMDes Madusari" class="logo">
                        <div>
                            <h1>BUMDes Madusari</h1>
                            <p>Desa Bayalangu Kidul, Kecamatan Gegesik, Cirebon</p>
                        </div>
                    </div>
                    <div class="nota-info">
                        <h2>NOTA PESANAN</h2>
                        <p><strong>ID Pesanan:</strong> {{ $pesanan->id_pesanan }}</p>
                        <p><strong>Tanggal:</strong> {{ $pesanan->created_at->format('d/m/Y H:i') }}</p>
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
                    </div>
                </div>

                <div class="customer-info">
                    <h3>Informasi Pemesan</h3>
                    <div class="info-grid">
                        <div>
                            <p><strong>Nama:</strong> {{ $pesanan->nama_pemesan }}</p>
                            <p><strong>No. HP:</strong> {{ $pesanan->no_hp }}</p>
                        </div>
                        <div>
                            <p><strong>Alamat:</strong></p>
                            <p>{{ $pesanan->alamat }}</p>
                        </div>
                    </div>
                    @if ($pesanan->user)
                        <p><strong>User:</strong> {{ $pesanan->user->name }} ({{ $pesanan->user->email }})</p>
                    @else
                        <p><strong>User:</strong> Guest</p>
                    @endif
                </div>

                <div class="order-details">
                    <h3>Detail Pesanan</h3>
                    <table class="order-table">
                        <thead>
                            <tr>
                                <th>Produk</th>
                                <th>Harga</th>
                                <th>Jumlah</th>
                                <th>Subtotal</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($pesanan->items as $item)
                                <tr>
                                    <td>
                                        <div class="product-info">
                                            <strong>{{ $item['nama'] }}</strong>
                                            @if (isset($item['variasi']) && $item['variasi'])
                                                <br><small>Variasi: {{ $item['variasi'] }}</small>
                                            @endif
                                        </div>
                                    </td>
                                    <td>Rp {{ number_format($item['harga'], 0, ',', '.') }}</td>
                                    <td>{{ $item['jumlah'] }}</td>
                                    <td>Rp {{ number_format($item['subtotal'], 0, ',', '.') }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr class="total-row">
                                <td colspan="3"><strong>Total</strong></td>
                                <td><strong>Rp {{ number_format($pesanan->total_harga, 0, ',', '.') }}</strong></td>
                            </tr>
                        </tfoot>
                    </table>
                </div>

                <div class="payment-info">
                    <h3>Informasi Pembayaran</h3>
                    <div class="payment-details">
                        <p><strong>Metode Pembayaran:</strong>
                            @if ($pesanan->metode_pembayaran == 'transfer')
                                Transfer Bank
                            @else
                                Bayar di Tempat (COD)
                            @endif
                        </p>
                        @if ($pesanan->metode_pembayaran == 'transfer')
                            <div class="bank-info">
                                <p><strong>Informasi Transfer:</strong></p>
                                <p>Bank: BRI</p>
                                <p>No. Rekening: 1234-5678-9012-3456</p>
                                <p>Atas Nama: BUMDes Madusari</p>
                                <p class="note">* Transfer sesuai nominal total pesanan</p>
                            </div>
                        @endif
                    </div>
                </div>

                @if ($pesanan->catatan)
                    <div class="notes">
                        <h3>Catatan</h3>
                        <p>{{ $pesanan->catatan }}</p>
                    </div>
                @endif

                <div class="nota-footer">
                    <div class="thank-you">
                        <p>Terima kasih telah berbelanja di BUMDes Madusari!</p>
                        <p>Jika ada pertanyaan, hubungi kami di: 0812-3456-7890</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- CSS --}}
    <style>
        .nota-section {
            padding: 10px;
            background: #fff;
            min-height: 100vh;
        }

        .nota-wrapper {
            max-width: 1200px;
            margin: 0 auto;
            background: #fff;
            padding: 20px;
            border-radius: 12px;
            box-shadow: none;
        }

        .nota-header {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            margin-bottom: 30px;
            border-bottom: 2px solid #146c43;
            padding-bottom: 20px;
        }

        .logo-section {
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .logo {
            width: 60px;
            height: 60px;
            object-fit: contain;
        }

        .logo-section h1 {
            font-size: 1.5rem;
            color: #146c43;
            margin: 0;
        }

        .logo-section p {
            font-size: 0.9rem;
            color: #666;
            margin: 5px 0 0 0;
        }

        .nota-info h2 {
            font-size: 1.8rem;
            color: #198754;
            margin: 0 0 10px 0;
        }

        .nota-info p {
            margin: 5px 0;
            font-size: 0.95rem;
        }

        .status-badge {
            padding: 4px 8px;
            border-radius: 4px;
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

        .customer-info,
        .order-details,
        .payment-info,
        .notes {
            margin-bottom: 25px;
        }

        .customer-info h3,
        .order-details h3,
        .payment-info h3,
        .notes h3 {
            color: #198754;
            margin-bottom: 10px;
            font-size: 1.1rem;
        }

        .info-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
            margin-bottom: 10px;
        }

        .order-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
            overflow-x: auto;
            display: block;
        }

        .order-table thead,
        .order-table tbody,
        .order-table tfoot {
            display: table;
            width: 100%;
            table-layout: fixed;
        }

        .order-table th,
        .order-table td {
            padding: 12px;
            text-align: left;
            border-bottom: 1px solid #eaeaea;
            word-wrap: break-word;
        }

        .order-table th {
            background: #f8fff9;
            font-weight: 600;
            color: #146c43;
        }

        .product-info {
            max-width: 300px;
        }

        .total-row {
            background: #f8fff9;
            font-weight: 700;
        }

        .total-row td {
            border-top: 2px solid #146c43;
        }

        .bank-info {
            background: #f8fff9;
            padding: 15px;
            border-radius: 8px;
            margin-top: 10px;
        }

        .bank-info p {
            margin: 5px 0;
        }

        .note {
            font-style: italic;
            color: #856404;
        }

        .nota-footer {
            margin-top: 40px;
            padding-top: 20px;
            border-top: 1px solid #eaeaea;
            text-align: center;
        }

        .thank-you {
            margin-bottom: 20px;
        }

        .thank-you p {
            margin: 5px 0;
            color: #666;
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .nota-section {
                padding: 5px;
            }

            .nota-wrapper {
                padding: 15px;
                border-radius: 8px;
            }

            .nota-header {
                flex-direction: column;
                gap: 20px;
                text-align: center;
            }

            .logo-section {
                justify-content: center;
            }

            .nota-info h2 {
                font-size: 1.5rem;
            }

            .info-grid {
                grid-template-columns: 1fr;
                gap: 15px;
            }

            .order-table {
                font-size: 0.9rem;
            }

            .order-table th,
            .order-table td {
                padding: 8px 4px;
            }

            .product-info {
                max-width: 150px;
            }

            .nota-footer {
                margin-top: 30px;
                padding-top: 15px;
            }

            .thank-you p {
                font-size: 0.9rem;
            }
        }

        @media (max-width: 480px) {
            .nota-wrapper {
                padding: 10px;
            }

            .nota-header {
                margin-bottom: 20px;
                padding-bottom: 15px;
            }

            .logo {
                width: 50px;
                height: 50px;
            }

            .logo-section h1 {
                font-size: 1.3rem;
            }

            .logo-section p {
                font-size: 0.8rem;
            }

            .nota-info h2 {
                font-size: 1.3rem;
            }

            .nota-info p {
                font-size: 0.9rem;
            }

            .customer-info h3,
            .order-details h3,
            .payment-info h3,
            .notes h3 {
                font-size: 1rem;
            }

            .order-table {
                font-size: 0.8rem;
            }

            .order-table th,
            .order-table td {
                padding: 6px 2px;
            }

            .bank-info {
                padding: 10px;
            }

            .nota-footer {
                margin-top: 30px;
                padding-top: 15px;
            }

            .thank-you p {
                font-size: 0.9rem;
            }
        }

        @media print {
            .nota-section {
                padding: 0;
                background: #fff;
            }

            .nota-wrapper {
                box-shadow: none;
                padding: 20px;
            }
        }
    </style>
@endsection
