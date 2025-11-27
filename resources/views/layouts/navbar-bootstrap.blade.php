<!-- === Navbar Bootstrap dengan Desain Tetap === -->
<nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm">
    <div class="container-fluid px-4">
        <!-- Logo -->
        <a href="/" class="navbar-brand d-flex align-items-center">
            <img src="{{ asset('images/Bumdes.jpg') }}" alt="Logo" width="44" height="44"
                class="rounded-circle me-3">
            <span class="fw-bold text-dark">BUMDes Madusari</span>
        </a>

        <!-- Mobile Toggle -->
        <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <!-- Navigation Links -->
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav mx-auto">
                <li class="nav-item">
                    <a href="/" class="nav-link px-3" data-route="/">Beranda</a>
                </li>
                <li class="nav-item">
                    <a href="/berita" class="nav-link px-3" data-route="/berita">Berita</a>
                </li>
                <li class="nav-item">
                    <a href="/produk" class="nav-link px-3" data-route="/produk">Produk</a>
                </li>
                @auth
                    @if (Auth::user()->role === 'admin')
                        <li class="nav-item">
                            <a href="/iot" class="nav-link px-3" data-route="/iot">IOT</a>
                        </li>
                    @endif
                @endauth
                <li class="nav-item">
                    <a href="/galeri" class="nav-link px-3" data-route="/galeri">Galeri</a>
                </li>
            </ul>

            <!-- Right Side Icons -->
            <ul class="navbar-nav ms-auto d-flex align-items-center">
                <!-- Notifications -->
                <li class="nav-item dropdown">
                    @auth
                        <a href="#" class="nav-link position-relative dropbtn" role="button"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="bi bi-bell fs-5"></i>
                            @if (auth()->user()->unreadNotifications->count() > 0)
                                <span
                                    class="badge bg-danger position-absolute top-0 start-100 translate-middle">{{ auth()->user()->unreadNotifications->count() }}</span>
                            @endif
                        </a>

                        <ul class="dropdown-menu dropdown-menu-end">
                            <button class="mobile-close-btn" aria-label="Tutup">×</button>

                            <!-- Header Notifikasi -->
                            <li class="notif-header">
                                <h6 class="mb-0 fw-bold text-dark">
                                    <i class="bi bi-bell me-2"></i>Notifikasi
                                    @if (auth()->user()->unreadNotifications->count() > 0)
                                        <span class="badge">{{ auth()->user()->unreadNotifications->count() }}</span>
                                    @endif
                                </h6>
                            </li>

                            @forelse(auth()->user()->unreadNotifications->take(5) as $notification)
                                <li class="notif-item unread">
                                    <a href="{{ $notification->data['url'] ?? '#' }}" class="notif-link">
                                        <div class="notif-icon">
                                            @if (isset($notification->data['type']))
                                                @if ($notification->data['type'] === 'berita')
                                                    <i class="bi bi-newspaper text-primary"></i>
                                                @elseif($notification->data['type'] === 'produk')
                                                    <i class="bi bi-box-seam text-success"></i>
                                                @elseif($notification->data['type'] === 'pesanan')
                                                    <i class="bi bi-receipt text-warning"></i>
                                                @else
                                                    <i class="bi bi-bell-fill text-info"></i>
                                                @endif
                                            @else
                                                <i class="bi bi-bell-fill text-info"></i>
                                            @endif
                                        </div>
                                        <div class="notif-content">
                                            <div class="notif-text">
                                                <span
                                                    class="notif-title">{{ Str::limit($notification->data['message'] ?? 'Notifikasi baru', 80) }}</span>
                                                <small class="notif-time">
                                                    <i
                                                        class="bi bi-clock me-1"></i>{{ $notification->created_at->diffForHumans() }}
                                                </small>
                                            </div>
                                            <div class="notif-indicator"></div>
                                        </div>
                                    </a>
                                </li>
                            @empty
                                <li class="notif-empty">
                                    <div class="empty-state">
                                        <i class="bi bi-bell-slash empty-icon"></i>
                                        <span class="empty-text">Tidak ada notifikasi baru</span>
                                        <small class="empty-subtext">Semua notifikasi sudah dibaca</small>
                                    </div>
                                </li>
                            @endforelse

                            @if (auth()->user()->unreadNotifications->count() > 5)
                                <li class="notif-more">
                                    <div class="text-center py-2">
                                        <small class="text-muted">
                                            +{{ auth()->user()->unreadNotifications->count() - 5 }} notifikasi lainnya
                                        </small>
                                    </div>
                                </li>
                            @endif

                            <!-- Footer Notifikasi -->
                            <li class="notif-footer">
                                <a href="{{ route('notifikasi.index') }}" class="view-all-btn">
                                    <i class="bi bi-eye me-2"></i>Lihat Semua Notifikasi
                                </a>
                            </li>
                        </ul>
                    @endauth
                </li>

                <!-- Cart -->
                <li class="nav-item dropdown">
                    <a href="#" class="nav-link position-relative dropbtn" role="button"
                        data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="bi bi-cart fs-5"></i>
                        <span class="badge bg-warning position-absolute top-0 start-100 translate-middle" id="cartBadge"
                            style="display: none;">0</span>
                    </a>

                    <ul class="dropdown-menu dropdown-menu-end cart-menu" id="cartMenu">
                        <button class="mobile-close-btn" aria-label="Tutup">×</button>
                        <li class="empty text-center p-2"><span>Keranjang kosong</span></li>
                    </ul>
                </li>

                <!-- User Menu -->
                @guest
                    <li class="nav-item">
                        <a href="{{ route('login') }}" class="btn btn-outline-primary btn-sm me-2">Masuk</a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('register') }}" class="btn btn-primary btn-sm">Daftar</a>
                    </li>
                @endguest

                @auth
                    <li class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle d-flex align-items-center dropbtn"
                            role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <img src="{{ Auth::user()->avatar ? asset('storage/' . Auth::user()->avatar) : asset('images/bumdes.jpg') }}"
                                alt="User" class="rounded-circle me-2" width="32" height="32">
                            <span class="d-none d-lg-inline">{{ Auth::user()->name }}</span>
                        </a>

                        <ul class="dropdown-menu dropdown-menu-end user-menu" id="userMenu">
                            <button class="mobile-close-btn" aria-label="Tutup">×</button>
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
                            <li><a href="{{ route('pesanan.index') }}"><i class="bi bi-receipt"></i> Pesanan Saya</a>
                            </li>
                            @auth
                                @if (Auth::user()->role === 'penulis')
                                    <li><a href="{{ route('penulis.berita.index') }}"><i class="bi bi-newspaper"></i>
                                            Dashboard</a>
                                    </li>
                                @endif
                            @endauth
                            <li class="user-footer">
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit"><i class="bi bi-box-arrow-right"></i> Keluar</button>
                                </form>
                            </li>
                        </ul>
                    </li>
                @endauth
            </ul>
        </div>
    </div>
</nav>

<!-- Bootstrap Icons -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">

<!-- Navbar Styles (Maintaining Original Design) -->
<style>
    /* === NAVBAR === */
    .navbar {
        position: fixed;
        top: 0;
        left: 0;
        right: 0;
        width: 100%;
        z-index: 1000;
        height: 80px;
        display: flex;
        align-items: center;
        background-color: #ffffff;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.2);
        overflow: visible;
    }

    /* Bagian biru miring di kanan */
    .navbar::after {
        content: "";
        position: absolute;
        top: 0;
        right: 0;
        width: 30%;
        height: 100%;
        background-color: var(--primary-color, #1b7f5b);
        clip-path: polygon(15% 0, 100% 0, 100% 100%, 0% 100%);
        z-index: 0;
    }

    .navbar .container-fluid {
        position: relative;
        z-index: 2;
    }

    .navbar-brand {
        flex-shrink: 0;
    }

    .navbar-brand img {
        width: 44px;
        height: 44px;
        border-radius: 8px;
        object-fit: cover;
    }

    /* === MENU === */
    .navbar-nav {
        gap: 36px;
    }

    .navbar-nav .nav-link {
        color: #333;
        font-weight: 600;
        font-size: 1.05rem;
        position: relative;
        padding: 6px 0;
        transition: color 0.25s ease;
        text-decoration: none;
    }

    .navbar-nav .nav-link:hover,
    .navbar-nav .nav-link.active {
        color: #1b7f5b;
    }

    .navbar-nav .nav-link::after {
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

    .navbar-nav .nav-link:hover::after,
    .navbar-nav .nav-link.active::after {
        width: 100%;
    }

    /* === RIGHT ICONS === */
    .navbar-nav.ms-auto .nav-link {
        position: relative;
        display: flex;
        align-items: center;
        justify-content: center;
        color: #ffffff;
        transition: color 0.3s ease;
        padding: 8px;
        border-radius: 8px;
    }

    .navbar-nav.ms-auto .nav-link:hover {
        color: #70ffcb;
        background: rgba(255, 255, 255, 0.1);
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
    .dropdown-menu {
        display: none;
        position: absolute;
        top: 110%;
        right: 0;
        background: #ffffff;
        border-radius: 16px;
        box-shadow: 0 12px 40px rgba(0, 0, 0, 0.12), 0 0 0 1px rgba(27, 127, 91, 0.08);
        min-width: 320px;
        max-width: 90vw;
        max-height: 80vh;
        overflow: hidden;
        animation: fadeInUp 0.3s cubic-bezier(0.25, 0.46, 0.45, 0.94);
        z-index: 999;
        border: 1px solid rgba(27, 127, 91, 0.06);
    }

    .dropdown.open .dropdown-menu {
        display: block;
    }

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

    /* Tombol Close */
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

    /* === USER DROPDOWN === */
    .user-menu {
        min-width: 300px;
        padding: 0;
        border-radius: 16px;
        overflow: hidden;
        background: #ffffff;
        box-shadow: 0 25px 50px -12px rgba(27, 127, 91, 0.15), 0 0 0 1px rgba(27, 127, 91, 0.08), 0 10px 25px -5px rgba(27, 127, 91, 0.1);
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
    .cart-menu {
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

    /* === MOBILE RESPONSIVE === */
    @media (max-width: 992px) {
        .navbar-toggler {
            position: relative;
            z-index: 1001;
        }

        .navbar-collapse {
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
            padding: 100px 30px 30px;
            gap: 20px;
            box-shadow: -8px 0 40px rgba(0, 0, 0, 0.15), 0 0 0 1px rgba(27, 127, 91, 0.08);
            transition: right 0.4s cubic-bezier(0.25, 0.46, 0.45, 0.94);
            border-left: 1px solid rgba(27, 127, 91, 0.1);
            overflow-y: auto;
            -webkit-overflow-scrolling: touch;
        }

        .navbar-collapse.show {
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

        .navbar-nav {
            flex-direction: column;
            gap: 20px;
        }

        .navbar-nav .nav-item {
            position: relative;
            overflow: hidden;
            border-radius: 12px;
        }

        .navbar-nav .nav-link {
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

        .navbar-nav .nav-link:hover {
            background: linear-gradient(135deg, rgba(255, 255, 255, 0.15) 0%, rgba(255, 255, 255, 0.08) 100%);
            color: #fff;
            transform: translateX(8px) scale(1.02);
            box-shadow: 0 8px 25px rgba(255, 255, 255, 0.1);
            border-color: rgba(255, 255, 255, 0.2);
        }

        .navbar-nav .nav-link.active {
            background: linear-gradient(135deg, #fff 0%, rgba(255, 255, 255, 0.9) 100%);
            color: #1b7f5b;
            box-shadow: 0 6px 20px rgba(255, 255, 255, 0.2);
            border-color: rgba(255, 255, 255, 0.3);
        }

        /* Dropdown mobile */
        .dropdown-menu {
            position: fixed;
            top: 0;
            right: -100%;
            width: 320px;
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
            transform: none;
            visibility: visible;
        }

        .dropdown.open .dropdown-menu {
            right: 0;
            opacity: 1;
            animation: slideInRight 0.4s cubic-bezier(0.25, 0.46, 0.45, 0.94) forwards;
            transform: none;
            visibility: visible;
        }

        @keyframes slideInRight {
            0% {
                opacity: 0;
                transform: translateX(100%) scale(0.95);
            }

            50% {
                opacity: 0.8;
                transform: translateX(20px) scale(0.98);
            }

            100% {
                opacity: 1;
                transform: translateX(0) scale(1);
            }
        }
    }

    /* === NOTIFICATION STYLES === */
    .notif-header {
        background: linear-gradient(135deg, rgba(27, 127, 91, 0.08) 0%, rgba(27, 127, 91, 0.04) 100%) !important;
        border-bottom: 1px solid rgba(27, 127, 91, 0.15) !important;
        padding: 16px 20px;
        margin: 0;
    }

    .notif-header h6 {
        font-size: 1rem;
        color: #1b7f5b !important;
        display: flex;
        align-items: center;
        margin: 0;
    }

    .notif-header .badge {
        font-size: 0.7rem;
        padding: 0.25rem 0.6rem;
        border-radius: 20px;
        background: linear-gradient(135deg, #ef4444 0%, #dc2626 100%) !important;
        color: #ffffff !important;
        font-weight: 600;
        box-shadow: 0 2px 4px rgba(239, 68, 68, 0.2);
        border: 1px solid rgba(255, 255, 255, 0.2);
    }

    .notif-item {
        border-bottom: 1px solid rgba(27, 127, 91, 0.08) !important;
        padding: 0;
        margin: 0;
        transition: all 0.2s cubic-bezier(0.4, 0, 0.2, 1);
    }

    .notif-item:last-child {
        border-bottom: none;
    }

    .notif-item:hover {
        background: linear-gradient(135deg, rgba(27, 127, 91, 0.06) 0%, rgba(27, 127, 91, 0.03) 100%) !important;
    }

    .notif-link {
        display: flex;
        align-items: flex-start;
        gap: 12px;
        padding: 16px 20px;
        text-decoration: none;
        color: inherit;
        position: relative;
        transition: all 0.2s cubic-bezier(0.4, 0, 0.2, 1);
    }

    .notif-link:hover {
        background: linear-gradient(135deg, rgba(27, 127, 91, 0.08) 0%, rgba(27, 127, 91, 0.04) 100%) !important;
        transform: translateX(2px);
        padding-left: 24px;
    }

    .notif-icon {
        flex-shrink: 0;
        width: 36px;
        height: 36px;
        display: flex;
        align-items: center;
        justify-content: center;
        background: rgba(255, 255, 255, 0.95) !important;
        border-radius: 10px;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.15) !important;
        margin-top: 2px;
    }

    .notif-icon i {
        font-size: 1.1rem;
        color: #1b7f5b !important;
    }

    .notif-content {
        flex: 1;
        min-width: 0;
    }

    .notif-text {
        display: flex;
        flex-direction: column;
        gap: 4px;
    }

    .notif-title {
        font-size: 0.9rem;
        font-weight: 500;
        color: #374151 !important;
        line-height: 1.4;
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }

    .notif-time {
        font-size: 0.75rem;
        color: #6b7280 !important;
        font-weight: 400;
        display: flex;
        align-items: center;
        gap: 4px;
    }

    .notif-time i {
        font-size: 0.7rem;
        opacity: 0.7;
    }

    .notif-indicator {
        position: absolute;
        left: 16px;
        top: 18px;
        width: 8px;
        height: 8px;
        background: #ef4444 !important;
        border-radius: 50%;
        border: 2px solid #ffffff !important;
        box-shadow: 0 0 0 1px rgba(239, 68, 68, 0.3) !important;
    }

    .notif-empty {
        padding: 24px 20px;
        margin: 0;
        text-align: center;
    }

    .empty-state {
        display: flex;
        flex-direction: column;
        align-items: center;
        gap: 8px;
    }

    .empty-icon {
        font-size: 2rem;
        color: #d1d5db !important;
        margin-bottom: 4px;
    }

    .empty-text {
        font-size: 0.9rem;
        color: #6b7280 !important;
        font-weight: 500;
    }

    .empty-subtext {
        font-size: 0.75rem;
        color: #9ca3af !important;
    }

    .notif-more {
        border-top: 1px solid rgba(27, 127, 91, 0.12) !important;
        margin: 0;
        background: rgba(27, 127, 91, 0.03) !important;
    }

    .notif-more small {
        font-size: 0.8rem;
        color: #6b7280 !important;
        font-style: italic;
    }

    .notif-footer {
        border-top: 1px solid rgba(27, 127, 91, 0.12) !important;
        padding: 0;
        margin: 0;
        background: linear-gradient(135deg, rgba(248, 250, 252, 0.9) 0%, rgba(241, 245, 249, 0.7) 100%) !important;
    }

    .view-all-btn {
        display: block;
        padding: 14px 20px;
        font-size: 0.9rem;
        font-weight: 600;
        color: #1b7f5b !important;
        text-decoration: none;
        text-align: center;
        transition: all 0.2s cubic-bezier(0.4, 0, 0.2, 1);
        border-radius: 0;
    }

    .view-all-btn:hover {
        background: linear-gradient(135deg, rgba(27, 127, 91, 0.12) 0%, rgba(27, 127, 91, 0.06) 100%) !important;
        color: #166749 !important;
        transform: translateY(-1px);
    }

    .view-all-btn i {
        font-size: 0.9rem;
    }
</style>

<!-- Navbar Script -->
<script>
    document.addEventListener("DOMContentLoaded", function() {
                const navbar = document.querySelector('.navbar');
                const menuToggle = document.querySelector('.navbar-toggler');
                const navLinks = document.getElementById("navbarNav");
                const overlay = document.createElement("div");
                overlay.className = "overlay";
                document.body.appendChild(overlay);

                // Scroll effect
                window.addEventListener("scroll", () => {
                    navbar.classList.toggle("scrolled", window.scrollY > 20);
                });

                // Mobile menu toggle
                menuToggle.addEventListener("click", () => {
                    navLinks.classList.toggle("show");
                    menuToggle.innerHTML = navLinks.classList.contains("show") ?
                        '<span class="navbar-toggler-icon"></span>' :
                        '<span class="navbar-toggler-icon"></span>';
                });

                // Dropdown functionality
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

                        // Mobile overlay
                        if (window.innerWidth <= 992) {
                            overlay.classList.toggle("active", isNowOpen);
                        }

                        // Load cart items when cart dropdown is opened
                        if (!wasOpen && isNowOpen && drop.classList.contains("cart-dropdown")) {
                            loadCartItems();
                        }
                    });
                });

                // Close dropdowns when clicking outside
                document.addEventListener("click", e => {
                    if (!e.target.closest(".dropdown") && !e.target.closest(".navbar-toggler")) {
                        dropdowns.forEach(d => d.classList.remove("open"));
                        overlay.classList.remove("active");
                    }
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

                // Cart functionality
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

                            const closeBtnHtml = '<button class="mobile-close-btn" aria-label="Tutup">×</button>';

                            if (data.items && data.items.length > 0) {
                                cartMenu.innerHTML = closeBtnHtml + data.items.map(item => `
                        <li class="cart-item">
                            <img src="${item.gambar ? "/storage/" + item.gambar : "/images/no-image.jpg"}" alt="${item.nama}">
                            <div class="cart-info">
                                <strong>${item.nama
