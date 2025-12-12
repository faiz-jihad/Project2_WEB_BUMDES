<!-- === Navbar Profesional & Modern === -->
<nav id="navbar" class="navbar">
    <div class="nav-container">
        <!-- Logo -->
        <a href="/" class="nav-logo">
            <img src="{{ asset('images/logo.jpg') }}" alt="Logo" />
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

        <!-- Overlay for mobile -->
        <div class="mobile-overlay" id="mobileOverlay"></div>


        <!-- Right Icons -->
        <div class="nav-right">
            <!-- ICON NOTIFIKASI -->
            <div class="dropdown notification-dropdown">
                @auth
                    <a href="#" class="icon-btn dropbtn" aria-label="Notifikasi" aria-expanded="false">
                        <i class="bi bi-bell"></i>
                        @if (auth()->user()->unreadNotifications->count() > 0)
                            <span class="badge">
                                {{ auth()->user()->unreadNotifications->count() }}
                            </span>
                        @endif
                    </a>

                    <!-- Desktop Notification Dropdown -->
                    <div class="dropdown-menu notif-menu desktop-menu">
                        <div class="notif-header">
                            <h6 class="mb-0 fw-bold">
                                <i class="bi bi-bell me-2"></i>Notifikasi
                                @if (auth()->user()->unreadNotifications->count() > 0)
                                    <span class="badge">{{ auth()->user()->unreadNotifications->count() }}</span>
                                @endif
                            </h6>
                        </div>

                        <div class="notif-list">
                            @forelse(auth()->user()->unreadNotifications->take(5) as $notification)
                                <a href="{{ $notification->data['url'] ?? '#' }}" class="notif-item unread">
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
                            @empty
                                <div class="notif-empty">
                                    <div class="empty-state">
                                        <i class="bi bi-bell-slash empty-icon"></i>
                                        <span class="empty-text">Tidak ada notifikasi baru</span>
                                    </div>
                                </div>
                            @endforelse

                            @if (auth()->user()->unreadNotifications->count() > 5)
                                <div class="notif-more">
                                    <small class="text-muted">
                                        +{{ auth()->user()->unreadNotifications->count() - 5 }} notifikasi lainnya
                                    </small>
                                </div>
                            @endif
                        </div>

                        <div class="notif-footer">
                            <a href="{{ route('notifikasi.index') }}" class="view-all-btn">
                                <i class="bi bi-eye me-2"></i>Lihat Semua Notifikasi
                            </a>
                        </div>
                    </div>

                    <!-- Mobile Notification Sidebar -->
                    <div class="mobile-sidebar notif-sidebar">
                        <div class="sidebar-header">
                            <h5><i class="bi bi-bell me-2"></i>Notifikasi</h5>
                            <button class="sidebar-close" aria-label="Tutup">
                                <i class="bi bi-x-lg"></i>
                            </button>
                        </div>

                        <div class="sidebar-content">
                            @forelse(auth()->user()->unreadNotifications as $notification)
                                <a href="{{ $notification->data['url'] ?? '#' }}" class="notif-item unread">
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
                                        <span
                                            class="notif-title">{{ Str::limit($notification->data['message'] ?? 'Notifikasi baru', 80) }}</span>
                                        <small class="notif-time">
                                            <i
                                                class="bi bi-clock me-1"></i>{{ $notification->created_at->diffForHumans() }}
                                        </small>
                                    </div>
                                </a>
                            @empty
                                <div class="notif-empty">
                                    <i class="bi bi-bell-slash"></i>
                                    <p>Tidak ada notifikasi baru</p>
                                </div>
                            @endforelse
                        </div>

                        <div class="sidebar-footer">
                            <a href="{{ route('notifikasi.index') }}" class="btn btn-outline-primary w-100">
                                <i class="bi bi-eye me-2"></i>Lihat Semua
                            </a>
                        </div>
                    </div>
                @endauth
            </div>

            <!-- CART -->
            @auth
                <div class="dropdown cart-dropdown">
                    <a href="#" class="icon-btn dropbtn" aria-label="Keranjang" title="Keranjang Belanja">
                        <i class="bi bi-cart"></i>
                        <span class="badge" id="cartBadge">0</span>
                    </a>

                    <!-- Desktop Cart Dropdown -->
                    <div class="dropdown-menu cart-menu desktop-menu">
                        <div class="cart-header">
                            <h6><i class="bi bi-cart me-2"></i>Keranjang Belanja</h6>
                            <span class="badge bg-primary" id="cartCountBadge">0 item</span>
                        </div>

                        <div class="cart-list" id="cartList">
                            <!-- Items will be loaded here -->
                        </div>

                        <div class="cart-footer">
                            <div class="cart-total">
                                <span>Total:</span>
                                <strong id="cartTotal">Rp 0</strong>
                            </div>
                            <div class="cart-actions">
                                <a href="/keranjang" class="btn btn-outline-secondary">Lihat Keranjang</a>
                                <a href="/checkout" class="btn btn-primary">Checkout</a>
                            </div>
                        </div>
                    </div>

                    <!-- Mobile Cart Sidebar -->
                    <div class="mobile-sidebar cart-sidebar">
                        <div class="sidebar-header">
                            <h5><i class="bi bi-cart me-2"></i>Keranjang Belanja</h5>
                            <button class="sidebar-close" aria-label="Tutup">
                                <i class="bi bi-x-lg"></i>
                            </button>
                        </div>

                        <div class="sidebar-content" id="mobileCartList">
                            <!-- Items will be loaded here -->
                        </div>

                        <div class="sidebar-footer">
                            <div class="cart-summary">
                                <div class="total-price">
                                    <span>Total:</span>
                                    <strong id="mobileCartTotal">Rp 0</strong>
                                </div>
                                <a href="/keranjang" class="btn btn-outline-primary w-100 mb-2">
                                    Lihat Detail Keranjang
                                </a>
                                <a href="/checkout" class="btn btn-primary w-100">
                                    <i class="bi bi-bag-check me-2"></i>Checkout
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            @endauth

            <!-- User Login -->
            @guest
                <a href="{{ route('login') }}" class="login-btn" style="color: #ffff">Masuk</a>
            @endguest

            @auth
                <div class="dropdown user-dropdown">
                    <a href="#" class="icon-btn dropbtn user-btn" aria-expanded="false">
                        @php
                            $avatar = Auth::user()->avatar;
                            $avatarUrl = null;

                            if ($avatar) {
                                if (filter_var($avatar, FILTER_VALIDATE_URL)) {
                                    $avatarUrl = $avatar;
                                }
                                elseif (strpos($avatar, 'http') === false && strpos($avatar, '//') === false) {
                                    $avatarUrl = asset('storage/' . $avatar);
                                }
                            }

                            // Fallback ke default
                            $avatarUrl = $avatarUrl ?? asset('images/bumdes.jpg');
                        @endphp

                        <img src="{{ $avatarUrl }}" alt="{{ Auth::user()->name }}" class="user-avatar"
                            onerror="this.src='{{ asset('images/bumdes.jpg') }}'">
                    </a>

                    <!-- Desktop User Dropdown -->
                    <div class="dropdown-menu user-menu desktop-menu">
                        <div class="user-info">
                            <div class="user-avatar">
                                @php
                                    $dropdownAvatar = Auth::user()->avatar;
                                    $dropdownAvatarUrl = null;

                                    if ($dropdownAvatar) {
                                        // Jika avatar adalah URL (Google/Facebook)
                                        if (filter_var($dropdownAvatar, FILTER_VALIDATE_URL)) {
                                            $dropdownAvatarUrl = $dropdownAvatar;
                                        }
                                        // Jika avatar adalah path relatif
                                        elseif (
                                            strpos($dropdownAvatar, 'http') === false &&
                                            strpos($dropdownAvatar, '//') === false
                                        ) {
                                            $dropdownAvatarUrl = asset('storage/' . $dropdownAvatar);
                                        }
                                    }

                                    // Fallback ke default
                                    $dropdownAvatarUrl = $dropdownAvatarUrl ?? asset('images/bumdes.jpg');
                                @endphp
                                <img src="{{ $dropdownAvatarUrl }}" alt="{{ Auth::user()->name }}"
                                    class="user-avatar-img" onerror="this.src='{{ asset('images/bumdes.jpg') }}'">
                            </div>
                            <div class="user-details">
                                <span class="user-name">{{ Auth::user()->name }}</span>
                                <span class="user-email">{{ Auth::user()->email }}</span>
                            </div>
                        </div>

                        <div class="user-links">
                            <a href="/akun"><i class="bi bi-person"></i> Akun Saya</a>
                            <a href="{{ route('pesanan.index') }}"><i class="bi bi-receipt"></i> Pesanan Saya</a>
                            @if (Auth::user()->role === 'penulis')
                                <a href="{{ route('penulis.berita.index') }}"><i class="bi bi-newspaper"></i>
                                    Dashboard</a>
                            @endif
                        </div>

                        <div class="user-footer">
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="btn btn-danger w-100">
                                    <i class="bi bi-box-arrow-right me-2"></i>Keluar
                                </button>
                            </form>
                        </div>
                    </div>

                    <!-- Mobile User Sidebar -->
                    <div class="mobile-sidebar user-sidebar">
                        <div class="sidebar-header">
                            <div class="user-profile">
                                @php
                                    $mobileAvatar = Auth::user()->avatar;
                                    $mobileAvatarUrl = null;

                                    if ($mobileAvatar) {
                                        // Jika avatar adalah URL (Google/Facebook)
                                        if (filter_var($mobileAvatar, FILTER_VALIDATE_URL)) {
                                            $mobileAvatarUrl = $mobileAvatar;
                                        }
                                        // Jika avatar adalah path relatif
                                        elseif (
                                            strpos($mobileAvatar, 'http') === false &&
                                            strpos($mobileAvatar, '//') === false
                                        ) {
                                            $mobileAvatarUrl = asset('storage/' . $mobileAvatar);
                                        }
                                    }

                                    // Fallback ke default
                                    $mobileAvatarUrl = $mobileAvatarUrl ?? asset('images/bumdes.jpg');
                                @endphp
                                <img src="{{ $mobileAvatarUrl }}" alt="{{ Auth::user()->name }}"
                                    class="user-avatar-img" onerror="this.src='{{ asset('images/bumdes.jpg') }}'">
                                <div>
                                    <h6>{{ Auth::user()->name }}</h6>
                                    <small>{{ Auth::user()->email }}</small>
                                </div>
                            </div>
                            <button class="sidebar-close" aria-label="Tutup">
                                <i class="bi bi-x-lg"></i>
                            </button>
                        </div>

                        <div class="sidebar-content">
                            <a href="/akun" class="sidebar-link">
                                <i class="bi bi-person"></i>
                                <span>Akun Saya</span>
                            </a>
                            <a href="{{ route('pesanan.index') }}" class="sidebar-link">
                                <i class="bi bi-receipt"></i>
                                <span>Pesanan Saya</span>
                            </a>
                            @if (Auth::user()->role === 'penulis')
                                <a href="{{ route('penulis.berita.index') }}" class="sidebar-link">
                                    <i class="bi bi-newspaper"></i>
                                    <span>Dashboard</span>
                                </a>
                            @endif
                        </div>

                        <div class="sidebar-footer">
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="btn btn-outline-danger w-100">
                                    <i class="bi bi-box-arrow-right me-2"></i>Keluar
                                </button>
                            </form>
                        </div>
                    </div>
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

<style>
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

    .nav-container {
        position: relative;
        width: 100%;
        max-width: 1440px;
        margin: 0 auto;
        display: grid;
        grid-template-columns: auto 1fr auto;
        align-items: center;
        justify-content: space-between;
        padding: 0 60px;
        z-index: 2;
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
    .nav-right {
        display: flex;
        align-items: center;
        gap: 20px;
        position: relative;
        justify-content: flex-end;
    }

    .nav-right .icon-btn {
        position: relative;
        display: flex;
        align-items: center;
        justify-content: center;
        width: 40px;
        height: 40px;
        border-radius: 50%;
        transition: all 0.3s ease;
    }

    .nav-right .icon-btn .user-avatar {
        width: 100%;
        height: 100%;
        border-radius: 50%;
        object-fit: cover;
        border: 2px solid rgba(255, 255, 255, 0.4);
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.15);
        background: linear-gradient(135deg, rgba(255, 255, 255, 0.1) 0%, rgba(255, 255, 255, 0.05) 100%);
    }

    .nav-right .icon-btn:hover .user-avatar {
        border-color: rgba(255, 255, 255, 0.9);
        transform: scale(1.05);
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.25);
    }

    .nav-right .icon-btn:active .user-avatar {
        transform: scale(0.95);
        transition: transform 0.1s ease;
    }

    .nav-right .icon-btn:hover {
        background: rgba(255, 255, 255, 0.1);
    }

    .nav-right i {
        font-size: 1.45rem;
        color: #ffffff;
        transition: color 0.3s ease;
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

    /* === DROPDOWN SYSTEM === */
    .dropdown {
        position: relative;
    }

    /* Desktop Dropdowns */
    .desktop-menu {
        display: none;
        position: absolute;
        top: 110%;
        right: 0;
        background: #ffffff;
        border-radius: 16px;
        box-shadow: 0 12px 40px rgba(0, 0, 0, 0.12);
        min-width: 320px;
        max-width: 90vw;
        max-height: 70vh;
        overflow: hidden;
        z-index: 1001;
        animation: fadeInUp 0.3s cubic-bezier(0.25, 0.46, 0.45, 0.94);
    }

    .dropdown:hover .desktop-menu {
        display: block;
    }

    /* Mobile Sidebars */
    .mobile-sidebar {
        position: fixed;
        top: 0;
        right: -100%;
        width: 320px;
        height: 100vh;
        background: #ffffff;
        z-index: 1100;
        transition: right 0.3s cubic-bezier(0.25, 0.46, 0.45, 0.94);
        display: flex;
        flex-direction: column;
        box-shadow: -5px 0 25px rgba(0, 0, 0, 0.15);
    }

    .mobile-sidebar.active {
        right: 0;
    }

    /* Sidebar Header */
    .sidebar-header {
        padding: 20px;
        display: flex;
        justify-content: space-between;
        align-items: center;
        border-bottom: 1px solid #e5e7eb;
        background: linear-gradient(135deg, #1b7f5b 0%, #166749 100%);
        color: white;
    }

    .sidebar-header h5 {
        margin: 0;
        font-weight: 600;
    }

    .sidebar-close {
        background: rgba(255, 255, 255, 0.9);
        border: none;
        color: #1b7f5b;
        font-size: 1.5rem;
        cursor: pointer;
        padding: 8px;
        display: flex;
        align-items: center;
        justify-content: center;
        transition: all 0.3s ease;
        border-radius: 50%;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
        z-index: 1200;
        position: relative;
    }

    .sidebar-close:hover {
        transform: scale(1.1);
    }

    /* Sidebar Content */
    .sidebar-content {
        flex: 1;
        overflow-y: auto;
        padding: 15px;
    }

    /* Sidebar Footer */
    .sidebar-footer {
        padding: 20px;
        border-top: 1px solid #e5e7eb;
        background: #f9fafb;
    }

    /* Mobile Overlay */
    .mobile-overlay {
        position: fixed;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: rgba(0, 0, 0, 0.5);
        z-index: 1099;
        opacity: 0;
        visibility: hidden;
        transition: all 0.3s ease;
    }

    .mobile-overlay.active {
        opacity: 1;
        visibility: visible;
    }

    /* === NOTIFICATION STYLES === */
    .notif-menu {
        min-width: 350px;
    }

    .notif-header {
        padding: 15px 20px;
        border-bottom: 1px solid #e5e7eb;
    }

    .notif-list {
        max-height: 300px;
        overflow-y: auto;
    }

    .notif-item {
        display: flex;
        align-items: flex-start;
        gap: 12px;
        padding: 12px 20px;
        border-bottom: 1px solid #f3f4f6;
        transition: background 0.2s ease;
    }

    .notif-item:hover {
        background: #f9fafb;
    }

    .notif-icon {
        width: 40px;
        height: 40px;
        border-radius: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        background: #f3f4f6;
        flex-shrink: 0;
    }

    .notif-content {
        flex: 1;
    }

    .notif-title {
        display: block;
        font-weight: 500;
        margin-bottom: 4px;
    }

    .notif-time {
        color: #6b7280;
        font-size: 0.85rem;
    }

    .notif-indicator {
        width: 8px;
        height: 8px;
        background: #ef4444;
        border-radius: 50%;
        margin-top: 8px;
    }

    .notif-empty {
        text-align: center;
        padding: 40px 20px;
        color: #6b7280;
    }

    .notif-empty i {
        font-size: 3rem;
        margin-bottom: 10px;
        opacity: 0.5;
    }

    .notif-more {
        text-align: center;
        padding: 10px;
        background: #f9fafb;
    }

    .notif-footer {
        padding: 15px 20px;
        border-top: 1px solid #e5e7eb;
    }

    .view-all-btn {
        display: block;
        text-align: center;
        color: #1b7f5b;
        font-weight: 500;
        transition: color 0.2s ease;
    }

    .view-all-btn:hover {
        color: #166749;
    }

    /* === CART STYLES === */
    .cart-menu {
        min-width: 350px;
    }

    .cart-header {
        padding: 15px 20px;
        display: flex;
        justify-content: space-between;
        align-items: center;
        border-bottom: 1px solid #e5e7eb;
    }

    .cart-list {
        max-height: 300px;
        overflow-y: auto;
        padding: 15px;
    }

    .cart-item {
        display: flex;
        gap: 12px;
        padding: 10px;
        border-radius: 8px;
        transition: background 0.2s ease;
    }

    .cart-item:hover {
        background: #f9fafb;
    }

    .cart-item img {
        width: 50px;
        height: 50px;
        border-radius: 8px;
        object-fit: cover;
    }

    .cart-item-details {
        flex: 1;
    }

    .cart-item-name {
        font-weight: 500;
        margin-bottom: 4px;
    }

    .cart-item-meta {
        font-size: 0.85rem;
        color: #6b7280;
    }

    .cart-footer {
        padding: 15px 20px;
        border-top: 1px solid #e5e7eb;
    }

    .cart-total {
        display: flex;
        justify-content: space-between;
        margin-bottom: 15px;
        font-size: 1.1rem;
    }

    .cart-actions {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 10px;
    }

    /* === USER DROPDOWN === */
    .user-menu {
        min-width: 280px;
    }

    .user-info {
        padding: 20px;
        display: flex;
        gap: 15px;
        align-items: center;
        background: linear-gradient(135deg, #f8fafc 0%, #f1f5f9 100%);
        border-bottom: 1px solid #e5e7eb;
    }

    .user-avatar img {
        width: 50px;
        height: 50px;
        border-radius: 50%;
        object-fit: cover;
    }

    .user-details {
        flex: 1;
    }

    .user-name {
        display: block;
        font-weight: 600;
        margin-bottom: 4px;
    }

    .user-email {
        font-size: 0.85rem;
        color: #6b7280;
    }

    .user-links {
        padding: 10px 0;
    }

    .user-links a {
        display: flex;
        align-items: center;
        gap: 10px;
        padding: 12px 20px;
        transition: background 0.2s ease;
    }

    .user-links a:hover {
        background: #f9fafb;
        color: #1b7f5b;
    }

    .user-links a i {
        width: 20px;
    }

    .user-footer {
        padding: 15px 20px;
        border-top: 1px solid #e5e7eb;
    }

    /* Sidebar Links */
    .sidebar-link {
        display: flex;
        align-items: center;
        gap: 15px;
        padding: 15px;
        border-radius: 8px;
        margin-bottom: 5px;
        transition: all 0.2s ease;
    }

    .sidebar-link:hover {
        background: #f3f4f6;
        color: #1b7f5b;
    }

    .sidebar-link i {
        width: 24px;
        font-size: 1.2rem;
    }

    .user-profile {
        display: flex;
        align-items: center;
        gap: 12px;
    }

    .user-profile img,
    .user-profile .user-avatar-img {
        width: 45px;
        height: 45px;
        border-radius: 50%;
        object-fit: cover;
        border: 2px solid rgba(255, 255, 255, 0.4);
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.15);
    }

    .user-profile img:hover,
    .user-profile .user-avatar-img:hover {
        border-color: rgba(255, 255, 255, 0.7);
        transform: scale(1.05);
    }

    .user-profile h6 {
        margin: 0;
        font-size: 1rem;
    }

    .user-profile small {
        color: rgba(255, 255, 255, 0.8);
    }

    /* === BUTTONS === */
    .btn {
        padding: 8px 16px;
        border-radius: 8px;
        font-weight: 500;
        transition: all 0.2s ease;
        border: none;
        cursor: pointer;
        text-align: center;
    }

    .btn-primary {
        background: #1b7f5b;
        color: white;
    }

    .btn-primary:hover {
        background: #166749;
        color: white;
    }

    .btn-outline-primary {
        border: 1px solid #1b7f5b;
        color: #1b7f5b;
        background: transparent;
    }

    .btn-outline-primary:hover {
        background: #1b7f5b;
        color: white;
    }

    .btn-outline-secondary {
        border: none;
        color: #374151;
        background: transparent;
    }

    .btn-outline-secondary:hover {
        background: #f3f4f6;
    }

    .btn-danger {
        background: #dc2626;
        color: white;
    }

    .btn-danger:hover {
        background: #b91c1c;
    }

    .btn-outline-danger {
        border: 1px solid #dc2626;
        color: #dc2626;
        background: transparent;
    }

    .btn-outline-danger:hover {
        background: #dc2626;
        color: white;
    }

    /* === MOBILE TOGGLE === */
    .menu-toggle {
        display: none;
        font-size: 1.8rem;
        cursor: pointer;
        color: white;
        margin-left: 10px;
    }

    /* === RESPONSIVE === */
    @media (max-width: 992px) {
        .nav-container {
            padding: 0 20px;
        }

        .menu-toggle {
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
            padding: 80px 30px 30px;
            gap: 0;
            box-shadow: -5px 0 25px rgba(0, 0, 0, 0.15);
            transition: right 0.3s ease;
            z-index: 1100;
        }

        .nav-links.active {
            right: 0;
        }

        .nav-links li {
            width: 100%;
        }

        .nav-links li a {
            display: block;
            padding: 15px;
            border-radius: 8px;
            margin-bottom: 5px;
        }

        .nav-links li a:hover {
            background: #f3f4f6;
        }

        /* Hide desktop dropdowns on mobile */
        .desktop-menu {
            display: none !important;
        }

        /* Show dropdown buttons */
        .dropdown .icon-btn {
            display: flex;
        }

        .navbar::after {
            width: 200px;
        }
    }

    @media (max-width: 576px) {
        .navbar::after {
            width: 330px;
            clip-path: polygon(10% 0, 100% 0, 100% 100%, 0% 100%);
        }

        .mobile-sidebar {
            width: 100%;
        }
    }

    @media (min-width: 993px) {

        /* Hide mobile sidebars on desktop */
        .mobile-sidebar {
            display: none;
        }
    }

    /* Animation */
    @keyframes fadeInUp {
        from {
            opacity: 0;
            transform: translateY(10px);
        }

        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
</style>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        // Mobile Menu Toggle
        const menuToggle = document.getElementById("menuToggle");
        const navLinks = document.getElementById("navLinks");
        const mobileOverlay = document.getElementById("mobileOverlay");

        menuToggle.addEventListener("click", function() {
            navLinks.classList.toggle("active");
            mobileOverlay.classList.toggle("active");
            document.body.style.overflow = navLinks.classList.contains("active") ? "hidden" : "";
        });

        mobileOverlay.addEventListener("click", function() {
            navLinks.classList.remove("active");
            closeAllSidebars();
            this.classList.remove("active");
            document.body.style.overflow = "";
        });

        // Dropdown and Sidebar Management
        const dropdowns = document.querySelectorAll(".dropdown");
        const sidebars = document.querySelectorAll(".mobile-sidebar");

        function closeAllSidebars() {
            sidebars.forEach(sidebar => {
                sidebar.classList.remove("active");
            });
            mobileOverlay.classList.remove("active");
            document.body.style.overflow = "";
        }

        // Desktop dropdown hover
        dropdowns.forEach(dropdown => {
            const btn = dropdown.querySelector(".dropbtn");

            // Desktop hover
            dropdown.addEventListener("mouseenter", function() {
                if (window.innerWidth > 992) {
                    closeAllSidebars();
                }
            });

            // Mobile click
            btn.addEventListener("click", function(e) {
                e.preventDefault();

                if (window.innerWidth <= 992) {
                    // Mobile: Open sidebar
                    const sidebar = dropdown.querySelector(".mobile-sidebar");
                    closeAllSidebars();
                    navLinks.classList.remove("active");

                    if (sidebar) {
                        sidebar.classList.add("active");
                        mobileOverlay.classList.add("active");
                        document.body.style.overflow = "hidden";

                        // Load content if cart sidebar
                        if (sidebar.classList.contains("cart-sidebar")) {
                            loadCartItems(true);
                        }
                    }
                }
            });
        });

        // Close sidebar buttons
        document.querySelectorAll(".sidebar-close").forEach(btn => {
            btn.addEventListener("click", closeAllSidebars);
        });

        // Close on escape key
        document.addEventListener("keydown", function(e) {
            if (e.key === "Escape") {
                closeAllSidebars();
                navLinks.classList.remove("active");
                mobileOverlay.classList.remove("active");
                document.body.style.overflow = "";
            }
        });

        // Cart Functions
        const cartBadge = document.getElementById("cartBadge");
        const cartCountBadge = document.getElementById("cartCountBadge");
        const cartList = document.getElementById("cartList");
        const mobileCartList = document.getElementById("mobileCartList");
        const cartTotal = document.getElementById("cartTotal");
        const mobileCartTotal = document.getElementById("mobileCartTotal");

        async function fetchCart() {
            try {
                const response = await fetch("/keranjang/get", {
                    headers: {
                        "X-Requested-With": "XMLHttpRequest",
                        "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]')
                            ?.content || ""
                    }
                });

                if (!response.ok) throw new Error("Fetch failed");
                return await response.json();
            } catch (error) {
                console.error("Error fetching cart:", error);
                return {
                    items: [],
                    total_items: 0,
                    total_price: 0
                };
            }
        }

        function updateCartBadge(count) {
            if (cartBadge) {
                cartBadge.textContent = count;
                cartBadge.style.display = count > 0 ? "flex" : "none";
            }
            if (cartCountBadge) {
                cartCountBadge.textContent = count + " item" + (count !== 1 ? "s" : "");
            }
        }

        function formatPrice(price) {
            return new Intl.NumberFormat("id-ID", {
                style: "currency",
                currency: "IDR",
                minimumFractionDigits: 0
            }).format(price);
        }

        async function loadCartItems(isMobile = false) {
            try {
                const data = await fetchCart();
                updateCartBadge(data.total_items || 0);

                const totalPrice = data.total_price || 0;
                const formattedTotal = formatPrice(totalPrice);

                if (cartTotal) cartTotal.textContent = formattedTotal;
                if (mobileCartTotal) mobileCartTotal.textContent = formattedTotal;

                if (data.items && data.items.length > 0) {
                    const itemsHTML = data.items.map(item => `
                    <div class="cart-item">
                        <img src="${item.gambar ? "/storage/" + item.gambar : "/images/no-image.jpg"}"
                             alt="${item.nama}"
                             onerror="this.src='/images/no-image.jpg'">
                        <div class="cart-item-details">
                            <div class="cart-item-name">${item.nama}</div>
                            <div class="cart-item-meta">
                                ${item.variasi ? `${item.variasi} • ` : ""}
                                ${item.jumlah} × ${formatPrice(item.harga)}
                            </div>
                            <div class="cart-item-price">
                                ${formatPrice(item.harga * item.jumlah)}
                            </div>
                        </div>
                    </div>
                `).join("");

                    if (cartList) cartList.innerHTML = itemsHTML;
                    if (mobileCartList) mobileCartList.innerHTML = itemsHTML;
                } else {
                    const emptyHTML = `
                    <div class="text-center py-5">
                        <i class="bi bi-cart-x" style="font-size: 3rem; color: #9ca3af;"></i>
                        <p class="mt-3 text-muted">Keranjang belanja kosong</p>
                    </div>
                `;

                    if (cartList) cartList.innerHTML = emptyHTML;
                    if (mobileCartList) mobileCartList.innerHTML = emptyHTML;
                }
            } catch (error) {
                console.error("Error loading cart items:", error);
            }
        }

        // Initial load
        loadCartItems();

        // Listen for cart updates
        document.addEventListener("cartUpdated", loadCartItems);

        // Prevent dropdown clicks from propagating
        document.querySelectorAll(".dropdown-menu, .mobile-sidebar").forEach(el => {
            el.addEventListener("click", e => e.stopPropagation());
        });
    });
</script>
