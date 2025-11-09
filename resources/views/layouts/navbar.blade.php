<!-- === Navbar Profesional & Modern === -->
<nav id="navbar" class="navbar">
    <div class="nav-container">
        <!-- Logo -->
        <a href="/" class="nav-logo">
            <img src="{{ asset('images/Bumdes.jpg') }}" alt="Logo" />
            {{-- <span><strong>BUMDes Madusari</strong></span> --}}
        </a>
        <!-- Menu Links -->
        <ul class="nav-links" id="navLinks">
            <li><a href="/" data-route="/">Beranda</a></li>
            <li><a href="/berita" data-route="/berita">Berita</a></li>
            <li><a href="/produk" data-route="/produk">Produk</a></li>
            @auth
                @if (Auth::user()->role === 'admin')
                    <li><a href="/iot" data-route="/iot">IOT</a></li>
                @endif
            @endauth
            <li><a href="/galeri" data-route="/galeri">Galeri</a></li>
        </ul>

        <!-- Right Icons -->
        <div class="nav-right">
            <!-- Notification  -->
            <div class="dropdown notification-dropdown">
                @auth
                    <a href="#" class="icon-btn dropbtn" aria-label="Notifikasi" aria-expanded="false">
                        <i class="bi bi-bell"></i>
                        @if (Auth::user()->unreadNotifications->count() > 0)
                            <span class="badge"
                                onclick="window.location.href='{{ route('notifikasi.index') }}'">{{ Auth::user()->unreadNotifications->count() }}</span>
                        @endif
                    </a>
                    <ul class="dropdown-menu notif-menu">
                        <button class="mobile-close-btn" aria-label="Tutup">X</button>
                        @forelse(Auth::user()->unreadNotifications as $notification)
                            <li class="notif-item unread">
                                <a href="{{ $notification->data['url'] ?? '#' }}">
                                    {{ $notification->data['message'] }}
                                </a>
                            </li>
                        @empty
                            <li><span class="empty">Tidak ada notifikasi</span></li>
                        @endforelse
                        <li class="text-center mt-2">
                            <a href="{{ route('notifikasi.index') }}" class="view-all-btn">Lihat Semua</a>
                        </li>
                    </ul>
                @else
                    <a href="{{ route('login') }}" class="icon-btn" aria-label="Login untuk notifikasi">
                        <i class="bi bi-bell"></i>
                    </a>
                @endauth
            </div>


            {{-- Cart  --}}
            <div class="dropdown cart-dropdown">
                <a href="#" class="icon-btn dropbtn" aria-label="Keranjang" title="Keranjang Belanja">
                    <i class="bi bi-cart"></i>
                    <span class="badge" id="cartBadge" onclick="window.location.href='/keranjang'">0</span>
                </a>

                <ul class="dropdown-menu cart-menu" id="cartMenu">
                    <button class="mobile-close-btn" aria-label="Tutup">X</button>
                    <li class="empty text-center p-2"><span>Keranjang kosong</span></li>
                </ul>
            </div>

            <!-- User Login  -->
            @guest
                <a href="{{ route('login') }}" class="login-btn">Masuk</a>
            @endguest

            @auth
                <div class="dropdown user-dropdown">
                    <a href="#" class="icon-btn dropbtn user-btn" aria-expanded="false">
                        <img src="{{ Auth::user()->avatar ? asset('storage/' . Auth::user()->avatar) : asset('images/bumdes.jpg') }}"
                            alt="User" />
                    </a>

                    <ul class="dropdown-menu user-menu" id="userMenu">
                        <button class="mobile-close-btn" aria-label="Tutup">X</button>
                        <li class="user-info">
                            <div class="user-avatar">
                                <img src="{{ Auth::user()->avatar ? asset('storage/' . Auth::user()->avatar) : asset('images/bumdes.jpg') }}"
                                    alt="User" />
                            </div>
                            <div class="user-details">
                                <span class="user-name">{{ Auth::user()->name }}</span>
                                <span class="user-email">{{ Auth::user()->email }}</span>
                            </div>
                        </li>
                        <li class="divider"></li>
                        <li><a href="/akun"><i class="bi bi-person"></i> Akun Saya</a></li>
                        <li><a href="{{ route('pesanan.index') }}"><i class="bi bi-receipt"></i> Pesanan Saya</a></li>
                        @auth
                            @if (Auth::user()->role === 'penulis')
                                <li><a href="penulis/berita"><i class="bi bi-newspaper"></i> Dashboard</a></li>
                            @endif
                        @endauth
                        <li class="user-footer">
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit"><i class="bi bi-box-arrow-right"></i> Keluar</button>
                            </form>
                        </li>
                    </ul>
                </div>
            @endauth

            <!-- Mobile Toggle -->
            <div class="menu-toggle" id="menuToggle">
                <i class="bi bi-list"></i>
            </div>
        </div>
    </div>
</nav>

<!-- Icon Library -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet" />
<!-- Navbar Script -->

<style>
    /* === RESET & BASE === */
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
        font-family: "Inter", "Poppins", sans-serif;
    }

    body {
        background: #f8f9fb;
        overflow-x: hidden;
    }

    a {
        text-decoration: none;
        color: inherit;
    }

    ul {
        list-style: none;
    }

    /* === NAVBAR === */
    .navbar {
        width: 100%;
        background: linear-gradient(135deg, rgba(255, 255, 255, 0.85) 0%, rgba(248, 250, 252, 0.8) 50%, rgba(241, 245, 249, 0.75) 100%);
        background-image:
            radial-gradient(circle at 25% 25%, rgba(27, 127, 91, 0.04) 0%, transparent 25%),
            radial-gradient(circle at 75% 75%, rgba(27, 127, 91, 0.03) 0%, transparent 30%),
            linear-gradient(90deg, transparent 0%, rgba(27, 127, 91, 0.02) 50%, transparent 100%);
        border-bottom: 1px solid rgba(27, 127, 91, 0.1);
        position: fixed;
        top: 0;
        left: 0;
        right: 0;
        z-index: 1000;
        transition: all 0.3s ease;

        box-shadow: 0 2px 20px rgba(0, 0, 0, 0.08);
    }

    #navbar.scrolled {
        box-shadow: 0 8px 32px rgba(0, 0, 0, 0.08), 0 0 0 1px rgba(27, 127, 91, 0.05);
        background: rgba(255, 255, 255, 0.95);

    }

    .nav-container {
        width: 100%;
        max-width: 1440px;
        margin: 0 auto;
        display: grid;
        grid-template-columns: auto 1fr auto;
        /* kiri - tengah - kanan */
        align-items: center;
        justify-content: space-between;
        padding: 15px 60px;
    }

    .nav-logo {
        display: flex;
        align-items: center;
        gap: 12px;
        flex-shrink: 0;
    }

    .nav-logo img {
        width: 44px;
        height: 44px;
        border-radius: 8px;
        object-fit: cover;
    }

    /* === MENU === */
    .nav-links {
        flex: 1;
        display: flex;
        justify-content: center;
        align-items: center;
        gap: 36px;
        transition: all 0.3s ease;
    }

    .nav-links li a {
        color: #333;
        font-weight: 600;
        font-size: 1.05rem;
        position: relative;
        padding: 6px 0;
        transition: color 0.25s ease;
    }

    .nav-links li a:hover,
    .nav-links li a.active {
        color: #1b7f5b;
    }

    .nav-links li a::after {
        content: "";
        position: absolute;
        left: 0;
        bottom: -5px;
        width: 0%;
        height: 2px;
        background: #1b7f5b;
        border-radius: 2px;
        transition: width 0.3s ease;
    }

    .nav-links li a:hover::after,
    .nav-links li a.active::after {
        width: 100%;
    }

    /* === RIGHT ICONS === */
    .nav-left {
        justify-content: flex-start;
    }

    .nav-centre {
        display: flex;
        justify-content: center;
    }

    .nav-right {
        display: flex;
        align-items: center;
        gap: 20px;
        position: relative;
        justify-content: flex-end;
    }

    /* icon umum */
    .nav-right .icon-btn {
        position: relative;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .nav-right i {
        font-size: 1.45rem;
        color: #333;
        transition: color 0.3s ease;
    }

    .nav-right i:hover {
        color: #1b7f5b;
    }

    /* === BADGE === */
    .badge {
        position: absolute;
        top: -4px;
        right: -8px;
        background: #e63946;
        color: #fff;
        font-size: 0.7rem;
        width: 18px;
        height: 18px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.2s ease;
    }

    .badge:hover {
        background: #d32f3f;
        transform: scale(1.1);
    }

    /* === DROPDOWN === */
    .dropdown {
        position: relative;
    }

    .dropdown-menu {
        display: none;
        position: absolute;
        top: 110%;
        right: 0;
        background: #ffffff;
        border-radius: 16px;
        box-shadow: 0 12px 40px rgba(0, 0, 0, 0.12), 0 0 0 1px rgba(27, 127, 91, 0.08);
        min-width: 260px;
        overflow: hidden;
        animation: fadeInUp 0.3s cubic-bezier(0.25, 0.46, 0.45, 0.94);
        z-index: 999;

        border: 1px solid rgba(27, 127, 91, 0.06);
    }

    .dropdown.open .dropdown-menu {
        display: block;
    }

    /* Animasi dropdown yang lebih halus */
    @keyframes fadeInUp {
        from {
            opacity: 0;
            transform: translateY(12px) scale(0.95);
        }

        to {
            opacity: 1;
            transform: translateY(0) scale(1);
        }
    }

    /* Tombol Close — Desktop */
    @media (min-width: 993px) {
        .dropdown-menu .mobile-close-btn {
            position: absolute;
            top: 15px;
            right: 15px;
            width: 32px;
            height: 32px;
            background: rgba(240, 240, 240, 0.9);
            border: none;
            border-radius: 50%;
            color: #555;
            font-size: 20px;
            font-weight: bold;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: all 0.25s ease;
            z-index: 10;
        }

        .dropdown-menu .mobile-close-btn:hover {
            background: #e6f2ee;
            color: #1b7f5b;
            transform: scale(1.1);
        }
    }

    .dropdown-menu li {
        border-bottom: 1px solid #f1f1f1;
    }

    .dropdown-menu li:last-child {
        border-bottom: none;
    }

    .dropdown-menu a,
    .dropdown-menu span {
        display: block;
        padding: 12px 18px;
        font-size: 0.9rem;
        color: #333;
        transition: all 0.3s cubic-bezier(0.25, 0.46, 0.45, 0.94);
        border-radius: 8px;
        margin: 2px 6px;
        position: relative;
        overflow: hidden;
    }

    .dropdown-menu a:hover {
        background: linear-gradient(135deg, rgba(27, 127, 91, 0.08) 0%, rgba(27, 127, 91, 0.04) 100%);
        color: #1b7f5b;
        transform: translateX(4px);
        box-shadow: 0 4px 12px rgba(27, 127, 91, 0.15);
    }

    .dropdown-menu a::before {
        content: '';
        position: absolute;
        left: 0;
        top: 0;
        width: 0%;
        height: 100%;
        background: linear-gradient(90deg, rgba(27, 127, 91, 0.1) 0%, rgba(27, 127, 91, 0.05) 100%);
        transition: width 0.3s ease;
        z-index: -1;
    }

    .dropdown-menu a:hover::before {
        width: 100%;
    }

    /* === USER DROPDOWN === */
    .user-dropdown img {
        width: 40px;
        height: 40px;
        border-radius: 50%;
        object-fit: cover;
        border: 2px solid rgba(27, 127, 91, 0.1);
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        box-shadow: 0 2px 8px rgba(27, 127, 91, 0.1);
    }

    .user-dropdown img:hover {
        border-color: rgba(27, 127, 91, 0.3);
        transform: scale(1.02);
        box-shadow: 0 4px 12px rgba(27, 127, 91, 0.15);
    }

    .user-menu {
        min-width: 300px;
        padding: 0;
        border-radius: 16px;
        overflow: hidden;
        background: #ffffff;
        box-shadow:
            0 25px 50px -12px rgba(27, 127, 91, 0.15),
            0 0 0 1px rgba(27, 127, 91, 0.08),
            0 10px 25px -5px rgba(27, 127, 91, 0.1);
        border: 1px solid rgba(27, 127, 91, 0.1);
    }

    .user-info {
        display: flex;
        align-items: center;
        gap: 16px;
        padding: 24px 24px 20px;
        background: linear-gradient(135deg, rgba(27, 127, 91, 0.03) 0%, rgba(27, 127, 91, 0.01) 100%);
        border-bottom: 1px solid rgba(27, 127, 91, 0.08);
        position: relative;
    }

    .user-info::after {
        content: '';
        position: absolute;
        bottom: 0;
        left: 24px;
        right: 24px;
        height: 1px;
        background: linear-gradient(90deg, transparent 0%, rgba(27, 127, 91, 0.15) 50%, transparent 100%);
    }

    .user-avatar {
        position: relative;
        flex-shrink: 0;
    }

    .user-avatar img {
        width: 56px;
        height: 56px;
        border-radius: 50%;
        object-fit: cover;
        border: 3px solid #ffffff;
        box-shadow: 0 4px 14px rgba(27, 127, 91, 0.12);
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    }

    .user-avatar img:hover {
        transform: scale(1.03);
        box-shadow: 0 6px 20px rgba(27, 127, 91, 0.18);
    }

    .user-details {
        flex: 1;
        min-width: 0;
        display: flex;
        flex-direction: column;
        gap: 2px;
    }

    .user-details .user-name {
        font-weight: 600;
        font-size: 1.05rem;
        color: #1b7f5b;
        line-height: 1.3;
        display: block;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
        letter-spacing: -0.01em;
    }

    .user-details .user-email {
        font-size: 0.875rem;
        color: #64748b;
        font-weight: 400;
        line-height: 1.4;
        display: block;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }

    .user-menu a {
        display: flex;
        align-items: center;
        gap: 14px;
        padding: 16px 24px;
        font-size: 0.95rem;
        color: #374151;
        font-weight: 500;
        transition: all 0.2s cubic-bezier(0.4, 0, 0.2, 1);
        border-bottom: 1px solid rgba(27, 127, 91, 0.04);
        position: relative;
        text-decoration: none;
    }

    .user-menu a:last-child {
        border-bottom: none;
    }

    .user-menu a:hover {
        background: linear-gradient(135deg, rgba(27, 127, 91, 0.06) 0%, rgba(27, 127, 91, 0.03) 100%);
        color: #1b7f5b;
        transform: translateX(2px);
        padding-left: 28px;
    }

    .user-menu a:hover::before {
        content: '';
        position: absolute;
        left: 24px;
        top: 50%;
        transform: translateY(-50%);
        width: 4px;
        height: 4px;
        background: #1b7f5b;
        border-radius: 50%;
        opacity: 1;
    }

    .user-menu a i {
        font-size: 1.1rem;
        color: #6b7280;
        width: 18px;
        text-align: center;
        transition: all 0.2s cubic-bezier(0.4, 0, 0.2, 1);
        flex-shrink: 0;
    }

    .user-menu a:hover i {
        color: #1b7f5b;
        transform: scale(1.05);
    }

    .user-footer {
        padding: 20px 24px 24px;
        background: linear-gradient(135deg, rgba(248, 250, 252, 0.8) 0%, rgba(241, 245, 249, 0.6) 100%);
        border-top: 1px solid rgba(27, 127, 91, 0.08);
    }

    .user-footer button {
        width: 100%;
        padding: 12px 20px;
        background: linear-gradient(135deg, #dc2626 0%, #b91c1c 100%);
        border: none;
        border-radius: 8px;
        font-weight: 500;
        color: #ffffff;
        font-size: 0.95rem;
        transition: all 0.2s cubic-bezier(0.4, 0, 0.2, 1);
        box-shadow: 0 2px 8px rgba(220, 38, 38, 0.15);
        cursor: pointer;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
    }

    .user-footer button:hover {
        background: linear-gradient(135deg, #b91c1c 0%, #991b1b 100%);
        transform: translateY(-1px);
        box-shadow: 0 4px 12px rgba(220, 38, 38, 0.25);
    }

    .user-footer button:active {
        transform: translateY(0);
        box-shadow: 0 2px 8px rgba(220, 38, 38, 0.15);
    }

    .user-footer button i {
        font-size: 1rem;
    }

    /* === CART DROPDOWN === */
    .cart-dropdown .dropdown-menu {
        min-width: 320px;
        padding-bottom: 8px;
    }

    .cart-item {
        display: flex;
        align-items: center;
        gap: 14px;
        padding: 14px 16px;
        transition: all 0.3s cubic-bezier(0.25, 0.46, 0.45, 0.94);
        border-radius: 10px;
        margin: 4px 8px;
        position: relative;
        overflow: hidden;
    }

    .cart-item:hover {
        background: linear-gradient(135deg, rgba(27, 127, 91, 0.06) 0%, rgba(27, 127, 91, 0.03) 100%);
        transform: translateX(4px);
        box-shadow: 0 4px 16px rgba(27, 127, 91, 0.1);
    }

    .cart-item img {
        width: 52px;
        height: 52px;
        border-radius: 10px;
        object-fit: cover;
        border: 1px solid rgba(27, 127, 91, 0.1);
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);
        transition: transform 0.3s ease;
    }

    .cart-item:hover img {
        transform: scale(1.05);
    }

    .cart-item strong {
        font-size: 0.95rem;
        font-weight: 600;
        color: #1b7f5b;
        display: block;
        margin-bottom: 4px;
    }

    .cart-item span {
        font-size: 0.85rem;
        color: #64748b;
        margin-bottom: 4px;
    }

    .cart-item div:last-child {
        font-size: 0.9rem;
        color: #475569;
        font-weight: 500;
    }

    .cart-footer {
        padding: 14px 8px 8px;
        display: flex;
        gap: 8px;
        margin: 12px 8px 0;
    }

    .cart-footer a {
        flex: 1;
        text-align: center;
        padding: 12px 0;
        border-radius: 12px;
        font-weight: 600;
        transition: all 0.3s cubic-bezier(0.25, 0.46, 0.45, 0.94);
        position: relative;
        overflow: hidden;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
    }

    .cart-footer .btn-view {
        background: linear-gradient(135deg, #f1f5f9 0%, #e2e8f0 100%);
        color: #1b7f5b;
        border: 1px solid rgba(27, 127, 91, 0.2);
    }

    .cart-footer .btn-view:hover {
        background: linear-gradient(135deg, #e2e8f0 0%, #cbd5e1 100%);
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(27, 127, 91, 0.2);
    }

    .cart-footer .btn-checkout {
        background: linear-gradient(135deg, #1b7f5b 0%, #166749 100%);
        color: #fff;
        border: 1px solid rgba(27, 127, 91, 0.3);
    }

    .cart-footer .btn-checkout:hover {
        background: linear-gradient(135deg, #166749 0%, #14523d 100%);
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(27, 127, 91, 0.3);
    }

    /* === MOBILE TOGGLE === */
    #menuToggle {
        display: none;
        font-size: 1.8rem;
        cursor: pointer;
    }

    /* === OVERLAY === */
    .overlay {
        position: fixed;
        inset: 0;
        background: rgba(0, 0, 0, 0.4);
        opacity: 0;
        visibility: hidden;
        z-index: 900;
        transition: opacity 0.25s ease, visibility 0.25s;
    }

    .overlay.active {
        opacity: 1;
        visibility: visible;
    }

    /* === RESPONSIVE === */
    @media (max-width: 992px) {
        .nav-container {
            padding: 12px 20px;
        }

        #menuToggle {
            display: block;
        }

        .nav-links {
            position: fixed;
            top: 0;
            right: -100%;
            width: 300px;
            height: 100vh;
            flex-direction: column;
            background: #ffffff;
            background-image:
                radial-gradient(circle at 25% 25%, rgba(27, 127, 91, 0.04) 0%, transparent 25%),
                radial-gradient(circle at 75% 75%, rgba(27, 127, 91, 0.03) 0%, transparent 30%),
                radial-gradient(circle at 50% 50%, rgba(27, 127, 91, 0.02) 0%, transparent 35%),
                linear-gradient(45deg, transparent 49%, rgba(27, 127, 91, 0.01) 49%, rgba(27, 127, 91, 0.01) 51%, transparent 51%),
                linear-gradient(-45deg, transparent 49%, rgba(27, 127, 91, 0.01) 49%, rgba(27, 127, 91, 0.01) 51%, transparent 51%);
            background-size: 20px 20px, 30px 30px, 40px 40px, 20px 20px, 20px 20px;
            padding: 100px 30px 30px;
            gap: 20px;
            box-shadow: -8px 0 40px rgba(0, 0, 0, 0.15), 0 0 0 1px rgba(27, 127, 91, 0.08);
            transition: right 0.4s cubic-bezier(0.25, 0.46, 0.45, 0.94);

            border-left: 1px solid rgba(27, 127, 91, 0.1);
            overflow-y: auto;
            -webkit-overflow-scrolling: touch;
        }

        .nav-links.show {
            right: 0;
            animation: slideInFromRight 0.4s cubic-bezier(0.25, 0.46, 0.45, 0.94) forwards;
        }

        @keyframes slideInFromRight {
            0% {
                opacity: 0;
                transform: translateX(30px);
            }

            50% {
                opacity: 0.8;
                transform: translateX(8px);
            }

            100% {
                opacity: 1;
                transform: translateX(0);
            }
        }

        .nav-links li {
            position: relative;
            overflow: hidden;
            border-radius: 12px;
        }

        .nav-links li a {
            font-size: 1.15rem;
            font-weight: 600;
            padding: 16px 20px;
            border-radius: 12px;
            transition: all 0.3s cubic-bezier(0.25, 0.46, 0.45, 0.94);
            position: relative;
            display: block;
            color: #334155;
            text-decoration: none;
            border: 1px solid transparent;
        }

        .nav-links li a:hover {
            background: linear-gradient(135deg, rgba(255, 255, 255, 0.15) 0%, rgba(255, 255, 255, 0.08) 100%);
            color: #fff;
            transform: translateX(8px) scale(1.02);
            box-shadow: 0 8px 25px rgba(255, 255, 255, 0.1);
            border-color: rgba(255, 255, 255, 0.2);
        }

        .nav-links li a.active {
            background: linear-gradient(135deg, #fff 0%, rgba(255, 255, 255, 0.9) 100%);
            color: #1b7f5b;
            box-shadow: 0 6px 20px rgba(255, 255, 255, 0.2);
            border-color: rgba(255, 255, 255, 0.3);
        }

        .nav-links li a::before {
            content: '';
            position: absolute;
            left: 0;
            top: 0;
            width: 0%;
            height: 100%;
            background: linear-gradient(90deg, rgba(255, 255, 255, 0.2) 0%, rgba(255, 255, 255, 0.1) 100%);
            transition: width 0.3s ease;
            z-index: -1;
        }

        .nav-links li a:hover::before {
            width: 100%;
        }

        /* Icon untuk setiap menu item */
        .nav-links li a::after {
            content: '';
            position: absolute;
            right: 20px;
            top: 50%;
            transform: translateY(-50%);
            width: 8px;
            height: 8px;
            background: rgba(255, 255, 255, 0.4);
            border-radius: 50%;
            transition: all 0.3s ease;
            opacity: 0;
        }

        .nav-links li a:hover::after,
        .nav-links li a.active::after {
            opacity: 1;
            background: #1b7f5b;
            transform: translateY(-50%) scale(1.2);
        }

        /* === SIDEBAR / DROPDOWN UMUM === */
        .dropdown-menu {
            position: fixed;
            top: 0;
            right: -100%;
            width: 300px;
            height: 100vh;
            background: #ffffff;
            background-image:
                radial-gradient(circle at 25% 25%, rgba(27, 127, 91, 0.04) 0%, transparent 25%),
                radial-gradient(circle at 75% 75%, rgba(27, 127, 91, 0.03) 0%, transparent 30%),
                radial-gradient(circle at 50% 50%, rgba(27, 127, 91, 0.02) 0%, transparent 35%),
                linear-gradient(45deg, transparent 49%, rgba(27, 127, 91, 0.01) 49%, rgba(27, 127, 91, 0.01) 51%, transparent 51%),
                linear-gradient(-45deg, transparent 49%, rgba(27, 127, 91, 0.01) 49%, rgba(27, 127, 91, 0.01) 51%, transparent 51%);
            background-size: 20px 20px, 30px 30px, 40px 40px, 20px 20px, 20px 20px;
            box-shadow: -8px 0 32px rgba(0, 0, 0, 0.12), 0 0 0 1px rgba(27, 127, 91, 0.08);
            border-radius: 0;
            border: none;
            transition: right 0.4s cubic-bezier(0.25, 0.46, 0.45, 0.94), opacity 0.4s ease;
            opacity: 0;
            z-index: 1001;
            padding: 80px 20px 20px;
            overflow-y: auto;
            -webkit-overflow-scrolling: touch;
            touch-action: pan-y;

        }

        /* Saat terbuka */
        .dropdown.open .dropdown-menu {
            right: 0;
            opacity: 1;
            animation: slideInRight 0.4s cubic-bezier(0.25, 0.46, 0.45, 0.94) forwards;
        }

        /* Animasi buka modern */
        @keyframes slideInRight {
            0% {
                opacity: 0;
                transform: translateX(40px) scale(0.95);
            }

            50% {
                opacity: 0.8;
                transform: translateX(10px) scale(0.98);
            }

            100% {
                opacity: 1;
                transform: translateX(0) scale(1);
            }
        }

        /* Tombol Close — Umum (Desktop & Mobile) */
        .dropdown-menu .mobile-close-btn {
            position: absolute;
            top: 15px;
            right: 15px;
            width: 32px;
            height: 32px;
            background: rgba(240, 240, 240, 0.9);
            border: none;
            border-radius: 50%;
            color: #555;
            font-size: 20px;
            font-weight: bold;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: all 0.25s ease;
            z-index: 10;
        }

        .dropdown-menu .mobile-close-btn:hover {
            background: #e6f2ee;
            color: #1b7f5b;
            transform: scale(1.1);
        }

        /* === SPESIFIKASI SIDEBAR === */
        .notification-dropdown .dropdown-menu {
            width: 320px;
        }

        .cart-dropdown .dropdown-menu {
            width: 320px;
        }

        .user-dropdown .dropdown-menu {
            width: 280px;
        }

        /* === ITEM STYLING === */
        .notif-item,
        .cart-item,
        .user-menu li {
            border-bottom: 1px solid #f1f1f1;
            padding: 15px 0;
        }

        .notif-item:last-child,
        .cart-item:last-child,
        .user-menu li:last-child {
            border-bottom: none;
        }

        .user-info {
            margin-bottom: 20px;
        }

        .user-menu a {
            padding: 15px 0;
            display: flex;
            align-items: center;
            gap: 10px;
            transition: all 0.2s ease;
        }

        .user-menu a:hover {
            color: #1b7f5b;
            transform: translateX(3px);
        }

        .user-footer {
            margin-top: 20px;
        }

        /* === RESPONSIVE === */
        @media (max-width: 992px) {
            .dropdown-menu {
                width: 300px;
            }

            .dropdown-menu .mobile-close-btn {
                top: 20px;
                right: 20px;
                width: 36px;
                height: 36px;
                font-size: 22px;
            }
        }

        @media (max-width: 576px) {
            .nav-container {
                padding: 10px 15px;
            }

            .cart-dropdown .dropdown-menu {
                min-width: 260px;
            }
        }

        /* === ANIMASI TAMBAHAN === */
        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(10px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .lightbox-modal {
            position: fixed;
            display: none;
            z-index: 1500;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgba(0, 0, 0, 0.9);
        }
</style>
<script>
    document.addEventListener("DOMContentLoaded", () => {
        const navbar = document.getElementById("navbar");
        const menuToggle = document.getElementById("menuToggle");
        const navLinks = document.getElementById("navLinks");
        const overlay = document.createElement("div");
        overlay.className = "overlay";
        document.body.appendChild(overlay);

        window.addEventListener("scroll", () => {
            navbar.classList.toggle("scrolled", window.scrollY > 20);
        });

        menuToggle.addEventListener("click", () => {
            navLinks.classList.toggle("show");
            menuToggle.innerHTML = navLinks.classList.contains("show") ?
                '<i class="bi bi-x-lg"></i>' :
                '<i class="bi bi-list"></i>';
        });

        const dropdowns = document.querySelectorAll(".dropdown");

        dropdowns.forEach(drop => {
            const btn = drop.querySelector(".dropbtn");

            btn.addEventListener("click", e => {
                e.preventDefault();
                e.stopPropagation();

                dropdowns.forEach(d => {
                    if (d !== drop) d.classList.remove("open");
                });

                const wasOpen = drop.classList.contains("open");
                drop.classList.toggle("open");
                const isNowOpen = drop.classList.contains("open");
                overlay.classList.toggle("active", isNowOpen);

                // Load cart items when cart dropdown is opened
                if (!wasOpen && isNowOpen && drop.classList.contains("cart-dropdown")) {
                    loadCartItems();
                }
            });

            if (window.innerWidth > 900) {
                drop.addEventListener("mouseenter", () => {
                    dropdowns.forEach(d => d.classList.remove("open"));
                    drop.classList.add("open");
                });
                drop.addEventListener("mouseleave", () => {
                    drop.classList.remove("open");
                });
            }
        });

        overlay.addEventListener("click", () => {
            dropdowns.forEach(d => d.classList.remove("open"));
            overlay.classList.remove("active");
        });

        // Close mobile sidebars when clicking the close button
        document.addEventListener("click", (e) => {
            if (e.target.classList.contains("mobile-close-btn")) {
                const dropdown = e.target.closest(".dropdown");
                if (dropdown) {
                    dropdown.classList.remove("open");
                    overlay.classList.remove("active");
                }
            }
        });

        // Add swipe gesture support for mobile sidebars
        let startX = 0;
        let startY = 0;
        let isSwiping = false;

        document.addEventListener("touchstart", (e) => {
            if (e.target.closest(".dropdown-menu")) {
                startX = e.touches[0].clientX;
                startY = e.touches[0].clientY;
                isSwiping = true;
            }
        });

        document.addEventListener("touchmove", (e) => {
            if (!isSwiping) return;

            const currentX = e.touches[0].clientX;
            const currentY = e.touches[0].clientY;
            const diffX = startX - currentX;
            const diffY = startY - currentY;

            // Only handle horizontal swipes (left to right)
            if (Math.abs(diffX) > Math.abs(diffY) && diffX > 50) {
                const dropdown = e.target.closest(".dropdown");
                if (dropdown && dropdown.classList.contains("open")) {
                    dropdown.classList.remove("open");
                    overlay.classList.remove("active");
                    isSwiping = false;
                }
            }
        });

        document.addEventListener("touchend", () => {
            isSwiping = false;
        });

        const cartBadge = document.getElementById("cartBadge");
        const cartMenu = document.getElementById("cartMenu");

        // Load cart items and update badge on page load
        updateCartBadge();
        loadCartItems();

        function updateCartBadge() {
            fetchCart()
                .then(data => {
                    const count = data.total_items || 0;
                    setBadgeCount(cartBadge, count);
                })
                .catch(() => {
                    const sessionCart = sessionStorage.getItem("keranjang");
                    if (sessionCart) {
                        const cart = JSON.parse(sessionCart);
                        const total = Object.values(cart).reduce((a, b) => a + (b.jumlah || 0), 0);
                        setBadgeCount(cartBadge, total);
                    } else {
                        setBadgeCount(cartBadge, 0);
                    }
                });
        }

        function setBadgeCount(badge, count) {
            if (!badge) return;
            badge.textContent = count;
            badge.style.display = count > 0 ? "flex" : "none";
        }

        async function fetchCart() {
            const response = await fetch("/keranjang/get", {
                headers: {
                    "X-Requested-With": "XMLHttpRequest",
                    "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]')?.content || ""
                },
                credentials: "same-origin"
            });
            if (!response.ok) throw new Error("Failed");
            return response.json();
        }

        async function loadCartItems() {
            try {
                const data = await fetchCart();
                if (!cartMenu) return;

                // Always include close button for mobile
                const closeBtnHtml = '<button class="mobile-close-btn" aria-label="Tutup">×</button>';

                if (data.items && data.items.length > 0) {
                    cartMenu.innerHTML = closeBtnHtml + data.items.map(item => `
          <li class="cart-item">
            <img src="${item.gambar ? "/storage/" + item.gambar : "/images/no-image.jpg"}" alt="${item.nama}">
            <div class="cart-info">
              <strong>${item.nama}</strong>
              ${item.variasi ? `<small>${item.variasi}</small>` : ""}
              <div>x${item.jumlah} &middot;
                <span class="text-success fw-bold">Rp ${new Intl.NumberFormat('id-ID').format(item.harga * item.jumlah)}</span>
              </div>
            </div>
          </li>
        `).join('') + `
          <li class="cart-footer">
            <a href="/keranjang" class="btn-view">Lihat Keranjang</a>
            <a href="/checkout" class="btn-checkout">Checkout</a>
          </li>
        `;
                } else {
                    cartMenu.innerHTML = closeBtnHtml +
                        `<li class="empty text-center p-2"><span>Keranjang kosong</span></li>`;
                }
            } catch (e) {
                console.error(e);
                cartMenu.innerHTML = '<button class="mobile-close-btn" aria-label="Tutup">×</button>' +
                    `<li class="empty text-center p-2"><span>Keranjang kosong</span></li>`;
            }
        }

        // Remove duplicate cart button handler since it's now handled in the main dropdown loop

        // Remove duplicate button handlers since they're now handled in the main dropdown loop

        document.addEventListener("click", e => {
            if (!e.target.closest(".dropdown") && !e.target.closest("#menuToggle")) {
                dropdowns.forEach(d => d.classList.remove("open"));
                overlay.classList.remove("active");
            }
        });

        window.addEventListener("resize", () => {
            if (window.innerWidth > 900) {
                navLinks.classList.remove("show");
                menuToggle.innerHTML = '<i class="bi bi-list"></i>';
            }
        });

        // Listen for cart updates from other pages (like keranjang page)
        document.addEventListener('cartUpdated', () => {
            updateCartBadge();
        });
    });
</script>
