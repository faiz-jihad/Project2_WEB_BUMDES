@extends('layouts.master')

@section('title', 'Checkout - BUMDes Madusari')

@section('content')
    <section class="checkout-section">
        <div class="container" data-aos="fade-up">
            <h1 class="checkout-title">Checkout</h1>

            @if (count($keranjang) > 0)
                <div class="checkout-wrapper">

                    {{-- Ringkasan Produk --}}
                    <div class="checkout-items">
                        <h2>Ringkasan Pesanan</h2>
                        <ul>
                            @foreach ($keranjang as $key => $item)
                                <li class="checkout-item">
                                    <div class="item-left">
                                        <img src="{{ asset('storage/' . $item['gambar']) }}" alt="{{ $item['nama'] }}">
                                        <div>
                                            <h4>{{ $item['nama'] }}</h4>
                                            @if ($item['variasi'])
                                                <p>Variasi: {{ $item['variasi'] }}</p>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="item-right">
                                        <p>{{ $item['jumlah'] }} x Rp {{ number_format($item['harga'], 0, ',', '.') }}</p>
                                    </div>
                                </li>
                            @endforeach
                        </ul>

                        <div class="checkout-total">
                            <span>Total:</span>
                            <span class="total-price">Rp {{ number_format($total, 0, ',', '.') }}</span>
                        </div>
                    </div>

                    {{-- Form Checkout --}}
                    <div class="checkout-form">
                        <h2>Detail Pengiriman</h2>
                        <form action="{{ route('checkout.proses') }}" method="POST">
                            @csrf
                            <div class="form-group">
                                <label for="nama">Nama Penerima</label>
                                <input type="text" id="nama" name="nama" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="alamat">Alamat Lengkap</label>
                                <textarea id="alamat" name="alamat" class="form-control" rows="3" required></textarea>
                            </div>
                            <div class="form-group">
                                <label for="no_hp">No. HP</label>
                                <input type="text" id="no_hp" name="no_hp" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="pembayaran">Metode Pembayaran</label>
                                <select name="pembayaran" id="pembayaran" class="form-control" required>
                                    <option value="">-- Pilih --</option>
                                    <option value="transfer">Transfer Bank</option>
                                    <option value="cod">Cash on Delivery</option>
                                </select>
                            </div>

                            <button type="submit" class="btn btn-checkout">Konfirmasi Pesanan</button>
                        </form>
                    </div>
                </div>
            @else
                <div class="checkout-empty text-center">
                    <img src="{{ asset('images/empty-cart.svg') }}" alt="Kosong" class="empty-img mb-3">
                    <p>Keranjang kamu masih kosong.</p>
                    <a href="{{ route('produk.index') }}" class="btn-lanjut">Lihat Produk</a>
                </div>
            @endif
        </div>
    </section>

    {{-- CSS --}}
    <style>
        .checkout-section {
            padding: 120px 20px 100px;
            background: #f8fff9;
            min-height: 100vh;
        }

        .checkout-title {
            font-size: 2rem;
            font-weight: 700;
            color: #146c43;
            margin-bottom: 30px;
        }

        .checkout-wrapper {
            display: flex;
            gap: 30px;
            flex-wrap: wrap;
        }

        .checkout-items,
        .checkout-form {
            background: #fff;
            padding: 20px;
            border-radius: 12px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
            flex: 1 1 400px;
        }

        .checkout-items h2,
        .checkout-form h2 {
            margin-bottom: 15px;
            color: #198754;
        }

        .checkout-item {
            display: flex;
            justify-content: space-between;
            margin-bottom: 12px;
        }

        .checkout-item .item-left {
            display: flex;
            gap: 10px;
            align-items: center;
        }

        .checkout-item img {
            width: 60px;
            height: 60px;
            object-fit: cover;
            border-radius: 8px;
            border: 1px solid #eaeaea;
        }

        .checkout-item h4 {
            font-size: 1rem;
            font-weight: 600;
        }

        .checkout-item p {
            font-size: 0.9rem;
            color: #666;
        }

        .checkout-total {
            display: flex;
            justify-content: space-between;
            font-weight: 700;
            font-size: 1.1rem;
            margin-top: 15px;
        }

        .checkout-form .form-group {
            margin-bottom: 15px;
        }

        .checkout-form label {
            display: block;
            margin-bottom: 5px;
            font-weight: 600;
        }

        .checkout-form .form-control {
            width: 100%;
            padding: 8px 10px;
            border-radius: 6px;
            border: 1px solid #eaeaea;
        }

        .btn-checkout {
            background: #198754;
            color: #fff;
            padding: 10px 20px;
            border-radius: 8px;
            font-weight: 600;
            border: none;
            cursor: pointer;
            transition: 0.3s;
        }

        .btn-checkout:hover {
            background: #146c43;
        }

        .checkout-empty {
            text-align: center;
            padding: 80px 20px;
        }

        .empty-img {
            width: 160px;
            opacity: 0.8;
        }

        .btn-lanjut {
            background: #198754;
            color: #fff;
            padding: 10px 20px;
            border-radius: 8px;
            text-decoration: none;
            font-weight: 600;
        }
    </style>
@endsection
