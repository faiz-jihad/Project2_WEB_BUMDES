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
            --green-light: #e8f5e8;
            --gray-bg: #f8fff9;
            --border: #e0e0e0;
            --border-light: #f0f0f0;
            --text: #333;
            --text-light: #666;
            --shadow: 0 2px 8px rgba(0, 0, 0, 0.08);
            --shadow-hover: 0 4px 16px rgba(0, 0, 0, 0.12);
            --transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .keranjang-section {
            padding: 120px 20px 140px;
            background: linear-gradient(135deg, var(--gray-bg) 0%, #ffffff 100%);
            min-height: 100vh;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
        }

        .keranjang-title {
            font-size: 2.5rem;
            font-weight: 800;
            color: var(--green-dark);
            margin-bottom: 40px;
            text-align: center;
            position: relative;
        }

        .keranjang-title::after {
            content: '';
            position: absolute;
            bottom: -10px;
            left: 50%;
            transform: translateX(-50%);
            width: 60px;
            height: 4px;
            background: linear-gradient(90deg, var(--green), var(--green-dark));
            border-radius: 2px;
        }

        .keranjang-wrapper {
            display: flex;
            flex-direction: column;
            gap: 24px;
            margin-bottom: 100px;
        }

        .keranjang-card {
            display: flex;
            align-items: flex-start;
            background: #ffffff;
            border-radius: 16px;
            padding: 24px;
            box-shadow: var(--shadow);
            position: relative;
            transition: var(--transition);
            border: 1px solid var(--border-light);
            overflow: hidden;
        }

        .keranjang-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 4px;
            height: 100%;
            background: linear-gradient(180deg, var(--green), var(--green-dark));
            opacity: 0;
            transition: var(--transition);
        }

        .keranjang-card:hover {
            transform: translateY(-2px);
            box-shadow: var(--shadow-hover);
            border-color: var(--green-light);
        }

        .keranjang-card:hover::before {
            opacity: 1;
        }

        .checkbox-area {
            flex-shrink: 0;
            padding-top: 8px;
            margin-right: 16px;
        }

        .checkbox-area input[type="checkbox"] {
            width: 18px;
            height: 18px;
            accent-color: var(--green);
            cursor: pointer;
            border-radius: 4px;
        }

        .produk-area {
            display: flex;
            flex: 1;
            gap: 20px;
            align-items: flex-start;
        }

        .produk-img {
            width: 120px;
            height: 120px;
            object-fit: cover;
            border-radius: 12px;
            border: 2px solid var(--border-light);
            transition: var(--transition);
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.06);
        }

        .produk-img:hover {
            transform: scale(1.05);
            border-color: var(--green-light);
        }

        .produk-info {
            flex: 1;
            display: flex;
            flex-direction: column;
            gap: 8px;
        }

        .nama-produk {
            font-size: 1.25rem;
            font-weight: 700;
            color: var(--green-dark);
            margin: 0;
            line-height: 1.4;
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }

        .variasi {
            color: var(--text-light);
            font-size: 0.95rem;
            margin: 0;
            font-weight: 500;
            background: var(--green-light);
            padding: 4px 8px;
            border-radius: 6px;
            display: inline-block;
            width: fit-content;
        }

        .harga {
            color: var(--green);
            font-weight: 800;
            font-size: 1.1rem;
            margin: 8px 0;
            display: flex;
            align-items: center;
            gap: 4px;
        }

        .harga::before {
            content: '💰';
            font-size: 0.9rem;
        }

        .jumlah-box {
            display: flex;
            align-items: center;
            gap: 12px;
            margin: 12px 0;
            background: var(--green-light);
            padding: 8px 12px;
            border-radius: 25px;
            width: fit-content;
        }

        .btn-jumlah {
            background: var(--green);
            color: #fff;
            border: none;
            width: 32px;
            height: 32px;
            border-radius: 50%;
            cursor: pointer;
            font-weight: 700;
            font-size: 1.2rem;
            transition: var(--transition);
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 2px 4px rgba(25, 135, 84, 0.2);
        }

        .btn-jumlah:hover {
            background: var(--green-dark);
            transform: scale(1.1);
            box-shadow: 0 4px 8px rgba(25, 135, 84, 0.3);
        }

        .btn-jumlah:active {
            transform: scale(0.95);
        }

        .jumlah-input {
            width: 50px;
            text-align: center;
            border: 2px solid var(--border);
            border-radius: 8px;
            padding: 6px 8px;
            font-weight: 600;
            font-size: 1rem;
            background: #fff;
            transition: var(--transition);
        }

        .jumlah-input:focus {
            outline: none;
            border-color: var(--green);
            box-shadow: 0 0 0 3px rgba(25, 135, 84, 0.1);
        }

        .subtotal {
            color: var(--text);
            font-weight: 700;
            font-size: 1.1rem;
            margin: 8px 0 0 0;
            display: flex;
            align-items: center;
            gap: 6px;
        }

        .subtotal::before {
            content: '🧾';
            font-size: 0.9rem;
        }

        .btn-hapus {
            position: absolute;
            top: 16px;
            right: 16px;
            font-size: 1.5rem;
            color: #dc3545;
            background: rgba(220, 53, 69, 0.1);
            border: none;
            cursor: pointer;
            width: 36px;
            height: 36px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: var(--transition);
        }

        .btn-hapus:hover {
            background: #dc3545;
            color: #fff;
            transform: scale(1.1);
        }

        .sticky-footer {
            position: fixed;
            bottom: 0;
            left: 0;
            width: 100%;
            background: linear-gradient(135deg, #ffffff 0%, #f8fff9 100%);
            box-shadow: 0 -4px 20px rgba(0, 0, 0, 0.1);
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 20px 24px;
            z-index: 1000;
            border-top: 2px solid var(--green-light);
            backdrop-filter: blur(10px);
        }

        .footer-left {
            display: flex;
            align-items: center;
            gap: 12px;
            font-weight: 600;
            color: var(--text);
        }

        .footer-left input[type="checkbox"] {
            width: 20px;
            height: 20px;
            accent-color: var(--green);
            cursor: pointer;
        }

        .footer-left label {
            cursor: pointer;
            font-size: 1rem;
        }

        .footer-right {
            display: flex;
            align-items: center;
            gap: 20px;
        }

        .total-text {
            font-weight: 800;
            color: var(--green-dark);
            font-size: 1.2rem;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .total-text::before {
            content: '💵';
            font-size: 1.1rem;
        }

        .btn-checkout {
            background: linear-gradient(135deg, var(--green), var(--green-dark));
            color: #fff;
            padding: 14px 32px;
            border-radius: 25px;
            text-decoration: none;
            font-weight: 700;
            font-size: 1.1rem;
            transition: var(--transition);
            box-shadow: 0 4px 12px rgba(25, 135, 84, 0.3);
            border: none;
            position: relative;
            overflow: hidden;
        }

        .btn-checkout::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
            transition: var(--transition);
        }

        .btn-checkout:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(25, 135, 84, 0.4);
        }

        .btn-checkout:hover::before {
            left: 100%;
        }

        .keranjang-empty {
            text-align: center;
            padding: 100px 40px;
            background: #ffffff;
            border-radius: 20px;
            box-shadow: var(--shadow);
            margin: 40px auto;
            max-width: 500px;
        }

        .empty-img {
            width: 200px;
            opacity: 0.7;
            margin-bottom: 24px;
        }

        .keranjang-empty p {
            font-size: 1.2rem;
            color: var(--text-light);
            margin-bottom: 24px;
            font-weight: 500;
        }

        .btn-lanjut {
            background: linear-gradient(135deg, var(--green), var(--green-dark));
            color: #fff;
            padding: 14px 32px;
            border-radius: 25px;
            text-decoration: none;
            font-weight: 700;
            font-size: 1.1rem;
            transition: var(--transition);
            box-shadow: 0 4px 12px rgba(25, 135, 84, 0.3);
            display: inline-block;
        }

        .btn-lanjut:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(25, 135, 84, 0.4);
            color: #fff;
        }

        /* Loading animation */
        .loading {
            opacity: 0.6;
            pointer-events: none;
        }

        .loading::after {
            content: '';
            position: absolute;
            top: 50%;
            left: 50%;
            width: 20px;
            height: 20px;
            margin: -10px 0 0 -10px;
            border: 2px solid var(--green);
            border-top: 2px solid transparent;
            border-radius: 50%;
            animation: spin 1s linear infinite;
        }

        @keyframes spin {
            0% {
                transform: rotate(0deg);
            }

            100% {
                transform: rotate(360deg);
            }
        }

        /* Enhanced Mobile Design with Animations */
        @media(max-width: 768px) {
            .keranjang-section {
                padding: 100px 15px 140px;
                background: linear-gradient(135deg, var(--gray-bg) 0%, #ffffff 100%);
                animation: fadeInUp 0.6s ease-out;
            }

            .keranjang-title {
                font-size: 2rem;
                margin-bottom: 30px;
                animation: slideInDown 0.5s ease-out;
            }

            .keranjang-wrapper {
                gap: 16px;
            }

            .keranjang-card {
                padding: 20px;
                flex-direction: column;
                gap: 16px;
                border-radius: 20px;
                background: linear-gradient(135deg, #ffffff 0%, #f8fafc 100%);
                box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
                border: 1px solid rgba(25, 135, 84, 0.1);
                position: relative;
                overflow: hidden;
                animation: slideInUp 0.4s ease-out;
                animation-fill-mode: both;
            }

            .keranjang-card:nth-child(1) {
                animation-delay: 0.1s;
            }

            .keranjang-card:nth-child(2) {
                animation-delay: 0.2s;
            }

            .keranjang-card:nth-child(3) {
                animation-delay: 0.3s;
            }

            .keranjang-card:nth-child(4) {
                animation-delay: 0.4s;
            }

            .keranjang-card:nth-child(5) {
                animation-delay: 0.5s;
            }

            .keranjang-card::before {
                content: '';
                position: absolute;
                top: 0;
                left: 0;
                width: 100%;
                height: 4px;
                background: linear-gradient(90deg, var(--green), var(--green-dark));
                transform: scaleX(0);
                transform-origin: left;
                transition: transform 0.3s ease;
            }

            .keranjang-card:hover::before {
                transform: scaleX(1);
            }

            .checkbox-area {
                position: absolute;
                top: 16px;
                left: 16px;
                margin-right: 0;
                z-index: 2;
            }

            .checkbox-area input[type="checkbox"] {
                width: 20px;
                height: 20px;
                accent-color: var(--green);
                cursor: pointer;
                border-radius: 6px;
                transition: transform 0.2s ease;
            }

            .checkbox-area input[type="checkbox"]:checked {
                transform: scale(1.1);
            }

            .produk-area {
                flex-direction: row;
                text-align: left;
                gap: 16px;
                align-items: flex-start;
                margin-top: 8px;
            }

            .produk-img {
                width: 80px;
                height: 80px;
                border-radius: 12px;
                flex-shrink: 0;
                transition: transform 0.3s ease;
            }

            .produk-img:hover {
                transform: scale(1.05) rotate(2deg);
            }

            .produk-info {
                flex: 1;
                text-align: left;
                align-items: flex-start;
                gap: 6px;
            }

            .nama-produk {
                font-size: 1.1rem;
                line-height: 1.3;
                margin-bottom: 4px;
            }

            .variasi {
                font-size: 0.85rem;
                padding: 3px 6px;
                margin-bottom: 6px;
            }

            .harga {
                font-size: 1rem;
                margin: 6px 0;
            }

            .jumlah-box {
                justify-content: flex-start;
                margin: 10px 0;
                padding: 6px 10px;
                border-radius: 20px;
            }

            .btn-jumlah {
                width: 28px;
                height: 28px;
                font-size: 1rem;
                transition: all 0.2s ease;
            }

            .btn-jumlah:active {
                transform: scale(0.9);
            }

            .jumlah-input {
                width: 45px;
                padding: 4px 6px;
                font-size: 0.9rem;
            }

            .subtotal {
                font-size: 1rem;
                margin: 6px 0 0 0;
            }

            .btn-hapus {
                position: absolute;
                top: 12px;
                right: 12px;
                width: 32px;
                height: 32px;
                font-size: 1.2rem;
                background: rgba(220, 53, 69, 0.1);
                border-radius: 50%;
                transition: all 0.3s ease;
                z-index: 2;
            }

            .btn-hapus:hover {
                background: #dc3545;
                color: #fff;
                transform: scale(1.1) rotate(90deg);
            }

            .sticky-footer {
                padding: 16px 20px;
                flex-direction: column;
                gap: 16px;
                background: linear-gradient(135deg, rgba(255, 255, 255, 0.95) 0%, rgba(248, 250, 252, 0.95) 100%);
                backdrop-filter: blur(20px);
                border-top: 2px solid var(--green-light);
                animation: slideInUp 0.5s ease-out;
            }

            .footer-left {
                width: 100%;
                justify-content: center;
            }

            .footer-right {
                width: 100%;
                justify-content: space-between;
                align-items: center;
            }

            .total-text {
                font-size: 1.1rem;
                order: 1;
            }

            .btn-checkout {
                padding: 12px 24px;
                font-size: 1rem;
                order: 2;
                min-width: 140px;
                text-align: center;
            }
        }

        @media(max-width: 480px) {
            .keranjang-section {
                padding: 90px 12px 130px;
            }

            .keranjang-title {
                font-size: 1.8rem;
                margin-bottom: 25px;
            }

            .keranjang-card {
                padding: 16px;
                gap: 14px;
                border-radius: 16px;
            }

            .produk-area {
                gap: 12px;
            }

            .produk-img {
                width: 70px;
                height: 70px;
                border-radius: 10px;
            }

            .produk-info {
                gap: 4px;
            }

            .nama-produk {
                font-size: 1rem;
                line-height: 1.2;
            }

            .variasi {
                font-size: 0.8rem;
                padding: 2px 5px;
            }

            .harga {
                font-size: 0.95rem;
            }

            .jumlah-box {
                padding: 5px 8px;
                margin: 8px 0;
            }

            .btn-jumlah {
                width: 26px;
                height: 26px;
                font-size: 0.9rem;
            }

            .jumlah-input {
                width: 40px;
                padding: 3px 5px;
                font-size: 0.85rem;
            }

            .subtotal {
                font-size: 0.95rem;
            }

            .btn-hapus {
                width: 28px;
                height: 28px;
                font-size: 1.1rem;
                top: 10px;
                right: 10px;
            }

            .sticky-footer {
                padding: 14px 16px;
                gap: 14px;
            }

            .btn-checkout {
                padding: 10px 20px;
                font-size: 0.95rem;
                min-width: 120px;
            }

            .total-text {
                font-size: 1rem;
            }
        }

        /* Enhanced Animations */
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes slideInDown {
            from {
                opacity: 0;
                transform: translateY(-20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes slideInUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* Touch-friendly interactions for mobile */
        @media (hover: none) and (pointer: coarse) {
            .keranjang-card {
                transition: transform 0.2s ease, box-shadow 0.2s ease;
            }

            .keranjang-card:active {
                transform: scale(0.98);
                box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
            }

            .btn-jumlah:active {
                transform: scale(0.9);
                transition: transform 0.1s ease;
            }

            .btn-hapus:active {
                transform: scale(0.9);
                transition: transform 0.1s ease;
            }

            .checkbox-area input[type="checkbox"]:active {
                transform: scale(0.9);
            }
        }

        /* Loading state improvements */
        .loading {
            position: relative;
            overflow: hidden;
        }

        .loading::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(25, 135, 84, 0.1), transparent);
            animation: shimmer 1.5s infinite;
            z-index: 1;
        }

        @keyframes shimmer {
            0% {
                left: -100%;
            }

            100% {
                left: 100%;
            }
        }

        /* Quantity change animation */
        .quantity-change {
            animation: pulse 0.3s ease;
        }

        @keyframes pulse {
            0% {
                transform: scale(1);
            }

            50% {
                transform: scale(1.05);
            }

            100% {
                transform: scale(1);
            }
        }
    </style>

    {{-- SweetAlert2 --}}
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    {{-- JS --}}
    <script>
        const csrfToken = document.querySelector('meta[name="csrf-token"]').content;

        // Initialize on page load
        document.addEventListener('DOMContentLoaded', function() {
            updateTotal();
            addInteractiveEffects();
        });

        // Pilih semua dengan animasi
        document.getElementById('pilih-semua')?.addEventListener('change', function() {
            const checkboxes = document.querySelectorAll('.pilih-produk');
            checkboxes.forEach(cb => {
                cb.checked = this.checked;
                // Add visual feedback
                const card = cb.closest('.keranjang-card');
                if (this.checked) {
                    card.style.transform = 'scale(1.02)';
                    setTimeout(() => card.style.transform = '', 200);
                }
            });
            updateTotal();
        });

        // Update total dengan animasi
        function updateTotal() {
            let total = 0;
            document.querySelectorAll('.pilih-produk:checked').forEach(cb => {
                const card = cb.closest('.keranjang-card');
                const subtotalText = card.querySelector('.subtotal span').innerText;
                const subtotal = parseInt(subtotalText.replace(/\D/g, '')) || 0;
                total += subtotal;
            });

            const totalElement = document.getElementById('totalHargaMobile');
            if (totalElement) {
                // Animate total change
                totalElement.style.transform = 'scale(1.1)';
                totalElement.style.color = 'var(--green)';
                totalElement.innerText = 'Rp ' + total.toLocaleString('id-ID');

                setTimeout(() => {
                    totalElement.style.transform = '';
                    totalElement.style.color = '';
                }, 300);
            }
        }

        // Tombol jumlah dengan efek interaktif
        document.querySelectorAll('.btn-jumlah').forEach(btn => {
            btn.addEventListener('click', function() {
                const card = this.closest('.keranjang-card');
                const input = card.querySelector('.jumlah-input');
                let jumlah = parseInt(input.value) || 1;

                // Add loading state
                card.classList.add('loading');

                if (this.classList.contains('plus')) {
                    jumlah++;
                } else if (this.classList.contains('minus') && jumlah > 1) {
                    jumlah--;
                } else if (this.classList.contains('minus') && jumlah <= 1) {
                    // Jika jumlah sudah 1 dan user klik minus, tampilkan konfirmasi hapus
                    Swal.fire({
                        title: 'Hapus Produk?',
                        html: `Apakah kamu yakin ingin menghapus <strong>${card.querySelector('.nama-produk').innerText}</strong> dari keranjang?`,
                        icon: 'question',
                        showCancelButton: true,
                        confirmButtonColor: '#198754',
                        cancelButtonColor: '#6c757d',
                        confirmButtonText: '<i class="fas fa-trash"></i> Ya, Hapus',
                        cancelButtonText: '<i class="fas fa-times"></i> Batal',
                        customClass: {
                            popup: 'animated fadeInDown',
                            confirmButton: 'btn btn-success mx-2',
                            cancelButton: 'btn btn-secondary mx-2'
                        },
                        buttonsStyling: false
                    }).then((result) => {
                        if (result.isConfirmed) {
                            // Hapus produk
                            fetch('{{ route('keranjang.hapus') }}', {
                                    method: 'POST',
                                    headers: {
                                        'X-CSRF-TOKEN': csrfToken,
                                        'Content-Type': 'application/json'
                                    },
                                    body: JSON.stringify({
                                        id: card.dataset.id
                                    })
                                })
                                .then(res => {
                                    if (!res.ok) {
                                        throw new Error('Network response was not ok');
                                    }
                                    return res.json();
                                })
                                .then(data => {
                                    card.classList.remove('loading');
                                    if (data.success) {
                                        // Smooth removal animation
                                        card.style.transform = 'translateX(-100%)';
                                        card.style.opacity = '0';

                                        setTimeout(() => {
                                            card.remove();
                                            updateTotal();

                                            if (document.querySelectorAll(
                                                    '.keranjang-card').length === 0) {
                                                location
                                                    .reload(); // Reload to show empty state
                                            }

                                            document.dispatchEvent(new CustomEvent(
                                                'cartUpdated'));

                                            showNotification(
                                                'Produk berhasil dihapus dari keranjang!',
                                                'success');
                                        }, 300);
                                    } else {
                                        showNotification(data.message ||
                                            'Gagal menghapus produk.', 'error');
                                    }
                                })
                                .catch(error => {
                                    card.classList.remove('loading');
                                    console.error('Error:', error);
                                    showNotification('Terjadi kesalahan saat menghapus produk.',
                                        'error');
                                });
                        } else {
                            card.classList.remove('loading');
                        }
                    });
                    return; // Exit the function early
                }

                input.value = jumlah;

                const hargaText = card.querySelector('.harga').innerText;
                const harga = parseInt(hargaText.replace(/\D/g, '')) || 0;
                const subtotal = harga * jumlah;

                // Animate subtotal change
                const subtotalSpan = card.querySelector('.subtotal span');
                subtotalSpan.style.transform = 'scale(1.2)';
                subtotalSpan.style.color = 'var(--green)';
                subtotalSpan.innerText = 'Rp ' + subtotal.toLocaleString('id-ID');

                // Add quantity change animation class
                card.classList.add('quantity-change');

                setTimeout(() => {
                    subtotalSpan.style.transform = '';
                    subtotalSpan.style.color = '';
                    card.classList.remove('quantity-change');
                }, 300);

                updateTotal();

                // Update session dengan error handling yang lebih baik
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
                    })
                    .then(response => {
                        if (!response.ok) {
                            throw new Error('Network response was not ok');
                        }
                        return response.json();
                    })
                    .then(data => {
                        card.classList.remove('loading');
                        if (data.success) {
                            document.dispatchEvent(new CustomEvent('cartUpdated'));

                            // Success animation
                            this.style.background = '#28a745';
                            setTimeout(() => {
                                this.style.background = '';
                            }, 500);
                        } else {
                            // Revert on error
                            input.value = jumlah - (this.classList.contains('plus') ? 1 : -1);
                            updateTotal();
                            showNotification('Gagal memperbarui jumlah', 'error');
                        }
                    })
                    .catch(error => {
                        card.classList.remove('loading');
                        console.error('Error updating quantity:', error);

                        // Revert on error
                        input.value = jumlah - (this.classList.contains('plus') ? 1 : -1);
                        updateTotal();
                        showNotification('Terjadi kesalahan saat memperbarui jumlah', 'error');
                    });
            });
        });

        // Hapus produk dengan konfirmasi yang lebih interaktif
        document.querySelectorAll('.btn-hapus').forEach(btn => {
            btn.addEventListener('click', function() {
                const card = this.closest('.keranjang-card');
                const id = card.dataset.id;
                const productName = card.querySelector('.nama-produk').innerText;

                Swal.fire({
                    title: 'Hapus Produk?',
                    html: `Apakah kamu yakin ingin menghapus <strong>${productName}</strong> dari keranjang?`,
                    icon: 'question',
                    showCancelButton: true,
                    confirmButtonColor: '#198754',
                    cancelButtonColor: '#6c757d',
                    confirmButtonText: '<i class="fas fa-trash"></i> Ya, Hapus',
                    cancelButtonText: '<i class="fas fa-times"></i> Batal',
                    customClass: {
                        popup: 'animated fadeInDown',
                        confirmButton: 'btn btn-success mx-2',
                        cancelButton: 'btn btn-secondary mx-2'
                    },
                    buttonsStyling: false
                }).then((result) => {
                    if (result.isConfirmed) {
                        // Add loading state
                        card.classList.add('loading');

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
                            .then(res => {
                                if (!res.ok) {
                                    throw new Error('Network response was not ok');
                                }
                                return res.json();
                            })
                            .then(data => {
                                card.classList.remove('loading');
                                if (data.success) {
                                    // Smooth removal animation
                                    card.style.transform = 'translateX(-100%)';
                                    card.style.opacity = '0';

                                    setTimeout(() => {
                                        card.remove();
                                        updateTotal();

                                        if (document.querySelectorAll('.keranjang-card')
                                            .length === 0) {
                                            location
                                                .reload(); // Reload to show empty state
                                        }

                                        document.dispatchEvent(new CustomEvent(
                                            'cartUpdated'));

                                        showNotification(
                                            'Produk berhasil dihapus dari keranjang!',
                                            'success');
                                    }, 300);
                                } else {
                                    showNotification(data.message || 'Gagal menghapus produk.',
                                        'error');
                                }
                            })
                            .catch(error => {
                                card.classList.remove('loading');
                                console.error('Error:', error);
                                showNotification('Terjadi kesalahan saat menghapus produk.',
                                    'error');
                            });
                    }
                });
            });
        });

        // Fungsi untuk menampilkan notifikasi
        function showNotification(message, type = 'info') {
            const colors = {
                success: '#28a745',
                error: '#dc3545',
                warning: '#ffc107',
                info: '#17a2b8'
            };

            // Create notification element
            const notification = document.createElement('div');
            notification.style.cssText = `
                position: fixed;
                top: 20px;
                right: 20px;
                background: ${colors[type]};
                color: white;
                padding: 12px 20px;
                border-radius: 8px;
                box-shadow: 0 4px 12px rgba(0,0,0,0.15);
                z-index: 9999;
                font-weight: 500;
                transform: translateX(100%);
                transition: transform 0.3s ease;
                max-width: 300px;
            `;
            notification.innerHTML = `
                <div style="display: flex; align-items: center; gap: 8px;">
                    <i class="fas fa-${type === 'success' ? 'check' : type === 'error' ? 'times' : 'info'}-circle"></i>
                    <span>${message}</span>
                </div>
            `;

            document.body.appendChild(notification);

            // Animate in
            setTimeout(() => {
                notification.style.transform = 'translateX(0)';
            }, 100);

            // Auto remove
            setTimeout(() => {
                notification.style.transform = 'translateX(100%)';
                setTimeout(() => {
                    if (notification.parentNode) {
                        notification.parentNode.removeChild(notification);
                    }
                }, 300);
            }, 3000);
        }

        // Tambahkan efek interaktif lainnya
        function addInteractiveEffects() {
            // Checkbox hover effects
            document.querySelectorAll('.pilih-produk').forEach(cb => {
                cb.addEventListener('change', function() {
                    const card = this.closest('.keranjang-card');
                    if (this.checked) {
                        card.style.borderColor = 'var(--green)';
                        card.style.boxShadow = 'var(--shadow-hover)';
                    } else {
                        card.style.borderColor = '';
                        card.style.boxShadow = '';
                    }
                    updateTotal();
                });
            });

            // Input focus effects
            document.querySelectorAll('.jumlah-input').forEach(input => {
                input.addEventListener('focus', function() {
                    this.style.borderColor = 'var(--green)';
                    this.style.boxShadow = '0 0 0 3px rgba(25, 135, 84, 0.1)';
                });

                input.addEventListener('blur', function() {
                    this.style.borderColor = '';
                    this.style.boxShadow = '';
                });
            });

            // Card hover effects
            document.querySelectorAll('.keranjang-card').forEach(card => {
                card.addEventListener('mouseenter', function() {
                    this.style.transform = 'translateY(-2px)';
                });

                card.addEventListener('mouseleave', function() {
                    this.style.transform = '';
                });
            });
        }

        document.addEventListener('keydown', function(e) {
            if (e.ctrlKey && e.key === 'a') {
                e.preventDefault();
                const selectAll = document.getElementById('pilih-semua');
                if (selectAll) {
                    selectAll.checked = !selectAll.checked;
                    selectAll.dispatchEvent(new Event('change'));
                }
            }
        });
    </script>
@endsection
