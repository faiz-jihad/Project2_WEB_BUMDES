@extends('layouts.master')

@section('title', 'Keranjang Belanja - BUMDes Madusari')

@section('content')
    <section class="keranjang-section">
        <div class="container">
            <h1 class="keranjang-title">Keranjang Belanja</h1>

            @if (count($keranjang) > 0)
                <div class="keranjang-wrapper">
                    @foreach ($keranjang as $key => $item)
                        <div class="keranjang-card" data-id="{{ $key }}">
                            {{-- Checkbox --}}
                            <div class="checkbox-area">
                                <input type="checkbox" class="pilih-produk" checked>
                            </div>

                            {{-- Produk --}}
                            <div class="produk-area">
                                <img src="{{ asset('storage/' . $item['gambar']) }}" alt="{{ $item['nama'] }}"
                                    class="produk-img">
                                <div class="produk-info">
                                    <h4 class="nama-produk">{{ $item['nama'] }}</h4>
                                    @if ($item['variasi'])
                                        <p class="variasi">Variasi: {{ $item['variasi'] }}</p>
                                    @endif
                                    <p class="harga">Rp {{ number_format($item['harga'], 0, ',', '.') }}</p>

                                    <div class="jumlah-box">
                                        <button class="btn-jumlah minus">−</button>
                                        <input type="text" value="{{ $item['jumlah'] }}" class="jumlah-input" readonly>
                                        <button class="btn-jumlah plus">+</button>
                                    </div>

                                    <p class="subtotal">Subtotal: <span>Rp
                                            {{ number_format($item['harga'] * $item['jumlah'], 0, ',', '.') }}</span></p>
                                </div>
                            </div>

                            {{-- Hapus --}}
                            <button class="btn-hapus" title="Hapus Produk">&times;</button>
                        </div>
                    @endforeach
                </div>

                {{-- Sticky Footer --}}
                <div class="sticky-footer">
                    <div class="footer-left">
                        <input type="checkbox" id="pilih-semua">
                        <label for="pilih-semua">Pilih Semua</label>
                    </div>
                    <div class="footer-right">
                        <div class="total-text">Total: <span id="totalHargaMobile">Rp
                                {{ number_format($total, 0, ',', '.') }}</span></div>
                        <a href="{{ route('checkout.index') }}" class="btn-checkout">Checkout</a>
                    </div>
                </div>
            @else
                <div class="keranjang-empty text-center">
                    <img src="{{ asset('images/empty-cart.svg') }}" alt="Kosong" class="empty-img mb-3">
                    <p>Keranjang kamu masih kosong.</p>
                    <a href="{{ route('produk.index') }}" class="btn-lanjut">Lihat Produk</a>
                </div>
            @endif
        </div>
    </section>

    {{-- CSS --}}
    <style>
        :root {
            --green: #198754;
            --green-dark: #146c43;
            --gray-bg: #f8fff9;
            --border: #eaeaea;
            --text: #333;
        }

        .keranjang-section {
            padding: 100px 20px 120px;
            background: var(--gray-bg);
            min-height: 100vh;
        }

        .keranjang-title {
            font-size: 2rem;
            font-weight: 700;
            color: var(--green-dark);
            margin-bottom: 30px;
        }

        .keranjang-wrapper {
            display: flex;
            flex-direction: column;
            gap: 20px;
        }

        .keranjang-card {
            display: flex;
            align-items: flex-start;
            background: #fff;
            border-radius: 12px;
            padding: 15px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
            position: relative;
            transition: transform 0.2s;
        }

        .keranjang-card:hover {
            transform: scale(1.01);
        }

        .checkbox-area {
            flex-shrink: 0;
            padding-top: 10px;
        }

        .produk-area {
            display: flex;
            flex: 1;
            gap: 15px;
            align-items: flex-start;
        }

        .produk-img {
            width: 100px;
            height: 100px;
            object-fit: cover;
            border-radius: 10px;
            border: 1px solid var(--border);
        }

        .produk-info {
            flex: 1;
        }

        .nama-produk {
            font-size: 1.1rem;
            font-weight: 600;
            color: var(--green-dark);
            margin-bottom: 5px;
        }

        .variasi {
            color: #666;
            font-size: 0.9rem;
            margin-bottom: 5px;
        }

        .harga {
            color: var(--green);
            font-weight: 700;
            margin-bottom: 10px;
        }

        .jumlah-box {
            display: flex;
            align-items: center;
            gap: 6px;
            margin-bottom: 5px;
        }

        .btn-jumlah {
            background: var(--green);
            color: #fff;
            border: none;
            width: 28px;
            height: 28px;
            border-radius: 5px;
            cursor: pointer;
            font-weight: 700;
            font-size: 1rem;
        }

        .jumlah-input {
            width: 45px;
            text-align: center;
            border: 1px solid var(--border);
            border-radius: 6px;
            padding: 3px;
        }

        .subtotal {
            color: var(--text);
            font-weight: 600;
            margin-top: 5px;
        }

        .btn-hapus {
            position: absolute;
            top: 10px;
            right: 10px;
            font-size: 1.4rem;
            color: #dc3545;
            background: none;
            border: none;
            cursor: pointer;
        }

        .sticky-footer {
            position: fixed;
            bottom: 0;
            left: 0;
            width: 100%;
            background: #fff;
            box-shadow: 0 -3px 10px rgba(0, 0, 0, 0.08);
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 12px 15px;
            z-index: 100;
        }

        .footer-left {
            display: flex;
            align-items: center;
            gap: 8px;
            font-weight: 600;
        }

        .footer-right {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .total-text {
            font-weight: 700;
            color: var(--green-dark);
        }

        .btn-checkout {
            background: var(--green);
            color: #fff;
            padding: 10px 20px;
            border-radius: 8px;
            text-decoration: none;
            font-weight: 600;
        }

        .keranjang-empty {
            text-align: center;
            padding: 80px 20px;
        }

        .empty-img {
            width: 160px;
            opacity: 0.8;
        }

        .btn-lanjut {
            background: var(--green);
            color: #fff;
            padding: 10px 20px;
            border-radius: 8px;
            text-decoration: none;
            font-weight: 600;
        }

        @media(max-width:600px) {
            .produk-img {
                width: 80px;
                height: 80px;
            }

            .nama-produk {
                font-size: 0.95rem;
            }

            .harga {
                font-size: 0.9rem;
            }

            .jumlah-input {
                width: 35px;
            }
        }
    </style>

    {{-- JS --}}
    <script>
        const csrfToken = '{{ csrf_token() }}';

        // Pilih semua
        document.getElementById('pilih-semua')?.addEventListener('change', function() {
            document.querySelectorAll('.pilih-produk').forEach(cb => cb.checked = this.checked);
            updateTotal();
        });

        // Update total
        function updateTotal() {
            let total = 0;
            document.querySelectorAll('.pilih-produk:checked').forEach(cb => {
                const card = cb.closest('.keranjang-card');
                const subtotal = parseInt(card.querySelector('.subtotal span').innerText.replace(/\D/g, ''));
                total += subtotal;
            });
            document.getElementById('totalHargaMobile').innerText = 'Rp ' + total.toLocaleString('id-ID');
        }

        // Tombol jumlah
        document.querySelectorAll('.btn-jumlah').forEach(btn => {
            btn.addEventListener('click', function() {
                const card = this.closest('.keranjang-card');
                const input = card.querySelector('.jumlah-input');
                let jumlah = parseInt(input.value);
                if (this.classList.contains('plus')) jumlah++;
                else if (this.classList.contains('minus') && jumlah > 1) jumlah--;
                input.value = jumlah;

                const harga = parseInt(card.querySelector('.harga').innerText.replace(/\D/g, ''));
                card.querySelector('.subtotal span').innerText = 'Rp ' + (harga * jumlah).toLocaleString(
                    'id-ID');
                updateTotal();

                // Update session
                fetch('{{ route('keranjang.updateJumlah') }}', {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': csrfToken,
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify({
                        id: card.dataset.id,
                        jumlah: jumlah
                    })
                });
            });
        });

        // Hapus produk
        document.querySelectorAll('.btn-hapus').forEach(btn => {
            btn.addEventListener('click', () => {
                const card = btn.closest('.keranjang-card');
                const id = card.dataset.id;
                if (confirm('Apakah kamu yakin ingin menghapus produk ini?')) {
                    fetch('{{ route('keranjang.hapus') }}', {
                            method: 'POST',
                            headers: {
                                'X-CSRF-TOKEN': csrfToken,
                                'Content-Type': 'application/json'
                            },
                            body: JSON.stringify({
                                id: id
                            })
                        })
                        .then(res => res.json())
                        .then(data => {
                            if (data.success) {
                                card.remove();
                                updateTotal();
                            } else {
                                alert('Gagal menghapus produk.');
                            }
                        });
                }
            });
        });
    </script>
@endsection
