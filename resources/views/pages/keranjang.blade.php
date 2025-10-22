@extends('layouts.master')

@section('title', 'Keranjang Belanja - BUMDes Madusari')

@section('content')
    <section class="keranjang-section">
        <div class="container" data-aos="fade-up">
            <h1 class="keranjang-title">Keranjang Belanja</h1>

            @if (count($keranjang) > 0)
                <div class="keranjang-wrapper">
                    @foreach ($keranjang as $key => $item)
                        <div class="keranjang-card" data-id="{{ $key }}">
                            <div class="checkbox-area">
                                <input type="checkbox" class="pilih-produk">
                            </div>

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

                                    <p class="subtotal">Subtotal:
                                        <span>Rp {{ number_format($item['harga'] * $item['jumlah'], 0, ',', '.') }}</span>
                                    </p>
                                </div>
                            </div>

                            <button class="btn-hapus" style="color: #dc3545">X</button>
                        </div>
                    @endforeach
                </div>

                {{-- Sticky Footer --}}
                <div class="sticky-footer">
                    <div class="footer-left">
                        <input type="checkbox" id="pilih-semua"> <label for="pilih-semua">Pilih Semua</label>
                    </div>
                    <div class="footer-right">
                        <div class="total-text">
                            Total: <span id="totalHargaMobile">Rp {{ number_format($total, 0, ',', '.') }}</span>
                        </div>
                        <a href="#" class="btn-checkout">Checkout</a>
                    </div>
                </div>
            @else
                <div class="keranjang-empty">
                    <img src="{{ asset('images/empty-cart.svg') }}" alt="Kosong" class="empty-img">
                    <p>Keranjang kamu masih kosong.</p>
                    <a href="{{ route('produk.index') }}" class="btn-lanjut">Lihat Produk</a>
                </div>
            @endif
        </div>
    </section>

    {{-- Modal Konfirmasi Hapus --}}
    <div id="hapusModal" class="hapus-modal">
        <div class="hapus-modal-content">
            <p>Apakah kamu yakin ingin menghapus produk ini?</p>
            <div class="modal-actions">
                <button id="batalHapus" class="btn-batal">Batal</button>
                <button id="konfirmasiHapus" class="btn-konfirmasi">Hapus</button>
            </div>
        </div>
    </div>

    <style>
        :root {
            --green: #198754;
            --green-dark: #146c43;
            --gray-bg: #f8fff9;
            --border: #eaeaea;
            --text: #333;
        }

        /* Struktur utama */
        .keranjang-section {
            padding: 120px 20px 100px;
            background: var(--gray-bg);
            min-height: 100vh;
        }

        .keranjang-title {
            font-size: 1.8rem;
            color: var(--green-dark);
            font-weight: 700;
            margin-bottom: 25px;
        }

        /* Card produk */
        .keranjang-card {
            display: flex;
            align-items: flex-start;
            background: #fff;
            border-radius: 12px;
            padding: 15px;
            margin-bottom: 15px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
            position: relative;
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
            width: 90px;
            height: 90px;
            object-fit: cover;
            border-radius: 10px;
            border: 1px solid var(--border);
        }

        .produk-info {
            flex: 1;
        }

        .nama-produk {
            font-size: 1.05rem;
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
            width: 26px;
            height: 26px;
            border-radius: 5px;
            cursor: pointer;
            font-weight: 700;
            font-size: 1rem;
        }

        .jumlah-input {
            width: 40px;
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
            background: none;
            border: none;
            font-size: 1.3rem;
            color: #dc3545;
            cursor: pointer;
            position: absolute;
            top: 10px;
            right: 10px;
        }

        /* Sticky footer */
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

        /* Modal Konfirmasi */
        .hapus-modal {
            display: none;
            position: fixed;
            inset: 0;
            background: rgba(0, 0, 0, 0.4);
            justify-content: center;
            align-items: center;
            z-index: 200;
        }

        .hapus-modal-content {
            background: white;
            border-radius: 12px;
            padding: 20px;
            text-align: center;
            width: 80%;
            max-width: 350px;
        }

        .modal-actions {
            display: flex;
            justify-content: space-between;
            margin-top: 15px;
        }

        .btn-batal,
        .btn-konfirmasi {
            flex: 1;
            padding: 8px 10px;
            border-radius: 8px;
            font-weight: 600;
            cursor: pointer;
            border: none;
        }

        .btn-batal {
            background: #ccc;
        }

        .btn-konfirmasi {
            background: #dc3545;
            color: white;
        }

        /* Kosong */
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
            color: white;
            padding: 10px 20px;
            border-radius: 8px;
            text-decoration: none;
            font-weight: 600;
        }

        @media (max-width: 600px) {
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
        }
    </style>

    <script>
        let selectedForDelete = null;

        // jumlah produk +/-
        document.querySelectorAll('.btn-jumlah').forEach(btn => {
            btn.addEventListener('click', function() {
                const parent = this.closest('.keranjang-card');
                const input = parent.querySelector('.jumlah-input');
                const harga = parseInt(parent.querySelector('.harga').innerText.replace(/\D/g, ''));
                let jumlah = parseInt(input.value);

                if (this.classList.contains('plus')) jumlah++;
                else if (this.classList.contains('minus') && jumlah > 1) jumlah--;

                input.value = jumlah;
                const subtotal = harga * jumlah;
                parent.querySelector('.subtotal span').innerText = 'Rp ' + subtotal.toLocaleString('id-ID');
                updateTotal();
            });
        });

        // pilih semua
        document.getElementById('pilih-semua')?.addEventListener('change', function() {
            document.querySelectorAll('.pilih-produk').forEach(cb => cb.checked = this.checked);
            updateTotal();
        });

        // update total
        function updateTotal() {
            let total = 0;
            document.querySelectorAll('.pilih-produk:checked').forEach(cb => {
                const card = cb.closest('.keranjang-card');
                const subtotal = parseInt(card.querySelector('.subtotal span').innerText.replace(/\D/g, ''));
                total += subtotal;
            });
            document.getElementById('totalHargaMobile').innerText = 'Rp ' + total.toLocaleString('id-ID');
        }

        // hapus produk
        document.querySelectorAll('.btn-hapus').forEach(btn => {
            btn.addEventListener('click', () => {
                selectedForDelete = btn.closest('.keranjang-card');
                document.getElementById('hapusModal').style.display = 'flex';
            });
        });

        document.getElementById('batalHapus').addEventListener('click', () => {
            document.getElementById('hapusModal').style.display = 'none';
        });

        document.getElementById('konfirmasiHapus').addEventListener('click', () => {
            if (selectedForDelete) selectedForDelete.remove();
            updateTotal();
            document.getElementById('hapusModal').style.display = 'none';
        });
    </script>
@endsection
