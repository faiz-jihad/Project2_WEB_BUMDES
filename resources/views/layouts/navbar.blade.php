<!-- === Navbar Profesional & Modern === -->
<nav id="navbar" class="navbar">
    <div class="nav-container">
        <!-- Logo -->
        <a href="/" class="nav-logo">
            <img src="{{ asset('images/Bumdes.jpg') }}" alt="Logo" />
            <span><strong>BUMDes Madusari</strong></span>
        </a>

        <!-- Menu Links -->
        <ul class="nav-links" id="navLinks">
            <li><a href="/" class="active">Beranda</a></li>

            <!-- Berita  -->
            <li class="dropdown">
                <a href="#" class="dropbtn" aria-expanded="false">Berita <i class="bi bi-chevron-down"></i></a>
                <ul class="dropdown-menu">
                    <li><a href="/berita">Semua Berita</a></li>
                    <li><a href="/kategori/politik">Politik</a></li>
                    <li><a href="/kategori/kesehatan">Kesehatan</a></li>
                    <li><a href="/kategori/pariwisata">Pariwisata</a></li>
                </ul>
            </li>

            <li><a href="/produk">Produk</a></li>

            @auth
                @if (Auth::user()->role === 'admin')
                    <li><a href="/iot">IOT</a></li>
                @endif
            @endauth

            <li><a href="/galeri">Galeri</a></li>
        </ul>

        <!-- Right Icons -->
        <div class="nav-right">
            <!-- Notification  -->
            <div class="dropdown notification-dropdown">
                @auth
                    <a href="#" class="icon-btn dropbtn" aria-label="Notifikasi" aria-expanded="false">
                        <i class="bi bi-bell"></i>
                        @if (Auth::user()->unreadNotifications->count() > 0)
                            <span class="badge">{{ Auth::user()->unreadNotifications->count() }}</span>
                        @endif
                    </a>
                    <ul class="dropdown-menu notif-menu">
                        @forelse(Auth::user()->unreadNotifications as $notification)
                            <li>
                                <a href="{{ $notification->data['link'] ?? '#' }}">
                                    {{ $notification->data['message'] }}
                                </a>
                            </li>
                        @empty
                            <li><span class="empty">Tidak ada notifikasi</span></li>
                        @endforelse
                        <li class="text-center mt-2">
                            <a href="{{ route('notifikasi.index') }}" class="text-success fw-semibold">Lihat Semua</a>
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
                    <span class="badge">{{ count(session('keranjang', [])) }}</span>
                </a>

                <ul class="dropdown-menu cart-menu">
                    @php $keranjang = session('keranjang', []); @endphp
                    @if (count($keranjang) > 0)
                        @foreach ($keranjang as $item)
                            <li class="cart-item d-flex align-items-center gap-2 p-2 border-bottom">
                                <img src="{{ asset('storage/' . $item['gambar']) }}" alt="{{ $item['nama'] }}"
                                    class="cart-img rounded" style="width:50px; height:50px; object-fit:cover;">
                                <div class="cart-info flex-grow-1">
                                    <span class="cart-name fw-bold">{{ $item['nama'] }}</span>
                                    @if ($item['variasi'])
                                        <span class="cart-variant d-block text-muted"
                                            style="font-size:0.8rem;">{{ $item['variasi'] }}</span>
                                    @endif
                                    <span class="cart-qty text-muted">x{{ $item['jumlah'] }}</span>
                                    <span class="cart-price text-success fw-bold">Rp
                                        {{ number_format($item['harga'] * $item['jumlah'], 0, ',', '.') }}</span>
                                </div>
                            </li>
                        @endforeach
                        <li class="cart-footer d-flex justify-content-between p-2">
                            <a href="{{ route('keranjang.index') }}" class="btn btn-outline-success btn-sm">Lihat
                                Keranjang</a>
                            <a href="{{ route('checkout.index') }}">Checkout</a>
                        </li>
                    @else
                        <li class="empty text-center p-2"><span>Keranjang kosong</span></li>
                    @endif
                </ul>
            </div>

            <!-- User Login / Dropdown -->
            @guest
                <a href="{{ route('login') }}" class="login-btn">Masuk</a>
            @endguest

            @auth
                <div class="dropdown user-dropdown">
                    <a href="#" class="dropbtn user-btn" aria-expanded="false">
                        <img src="{{ Auth::user()->avatar ? asset('storage/' . Auth::user()->avatar) : asset('images/default-avatar.png') }}"
                            alt="User" />
                        <i class="bi bi-chevron-down"></i>
                    </a>
                    <ul class="dropdown-menu user-menu">
                        <li><a href="/akun"><i class="bi bi-person"></i> Akun Saya</a></li>
                        <li><a href="{{ route('settings') }}"><i class="bi bi-gear"></i> Pengaturan</a></li>
                        <li>
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

<!-- === STYLE === -->
<style>
    :root {
        --green: #198754;
        --dark-green: #146c43;
        --yellow: #ffc107;
        --light: #f8fff9;
    }

    /* Navbar */
    .navbar {
        position: fixed;
        top: 0;
        width: 100%;
        height: 90px;
        background: linear-gradient(180deg, var(--green), var(--dark-green));
        box-shadow: 0 3px 10px rgba(0, 0, 0, 0.15);
        color: white;
        z-index: 1000;
        transition: all 0.3s ease;
    }

    .navbar.scrolled {
        background: var(--dark-green);
    }

    .nav-container {
        max-width: 1200px;
        margin: 0 auto;
        padding: 0.9rem 2rem;
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 2rem;
    }

    /* Logo */
    .nav-logo {
        display: flex;
        align-items: center;
        gap: 10px;
        text-decoration: none;
        color: white;
        font-weight: 600;
        font-size: 1.3rem;
    }

    .nav-logo img {
        width: 48px;
        height: 48px;
        border-radius: 50%;
        border: 2px solid white;
        object-fit: cover;
    }

    /* Menu Links */
    .nav-links {
        display: flex;
        align-items: center;
        gap: 1.8rem;
        list-style: none;
    }

    .nav-links a {
        color: white;
        text-decoration: none;
        font-weight: 500;
        padding: 6px 0;
        position: relative;
        transition: color 0.3s ease;
    }

    .nav-links a::after {
        content: "";
        position: absolute;
        bottom: -3px;
        left: 0;
        width: 0%;
        height: 2px;
        background: var(--yellow);
        transition: width 0.3s ease;
    }

    .nav-links a:hover,
    .nav-links a.active {
        color: var(--yellow);
    }

    .nav-links a:hover::after,
    .nav-links a.active::after {
        width: 100%;
    }

    /* Dropdown */
    .dropdown {
        position: relative;
    }

    .dropbtn {
        display: flex;
        align-items: center;
        gap: 6px;
        cursor: pointer;
    }

    .dropdown-menu {
        display: none;
        position: absolute;
        top: 120%;
        left: 0;
        background: white;
        color: var(--green);
        border-radius: 10px;
        min-width: 180px;
        box-shadow: 0 6px 15px rgba(0, 0, 0, 0.12);
        overflow: hidden;
        transition: all 0.3s ease;
    }

    .dropdown:hover .dropdown-menu {
        display: block;
    }

    .dropdown-menu a,
    .dropdown-menu button {
        display: flex;
        align-items: center;
        gap: 10px;
        padding: 12px 18px;
        color: var(--green);
        background: none;
        border: none;
        width: 100%;
        font-size: 14px;
        cursor: pointer;
        text-decoration: none;
        transition: all 0.3s ease;
    }

    .dropdown-menu a:hover,
    .dropdown-menu button:hover {
        background: var(--green);
        color: white;
    }

    /* Notification Dropdown */
    .notification-dropdown {
        position: relative;
    }

    .notif-menu {
        display: none;
        position: absolute;
        top: 120%;
        right: 0;
        width: 250px;
        max-height: 350px;
        overflow-y: auto;
        background: white;
        color: var(--green);
        border-radius: 10px;
        box-shadow: 0 6px 15px rgba(0, 0, 0, 0.12);
        z-index: 99;
        transition: all 0.3s ease;
    }

    .notification-dropdown.open .notif-menu {
        display: block;
    }

    .notif-menu li {
        border-bottom: 1px solid #eee;
    }

    .notif-menu li:last-child {
        border-bottom: none;
    }

    .notif-menu a {
        display: block;
        padding: 10px 15px;
        color: var(--green);
        font-size: 14px;
        text-decoration: none;
    }

    .notif-menu a:hover {
        background: var(--green);
        color: white;
    }

    .notif-menu .empty {
        display: block;
        padding: 12px 15px;
        color: #888;
        font-style: italic;
        text-align: center;
    }

    /* Right Icons */
    .nav-right {
        display: flex;
        align-items: center;
        gap: 1rem;
    }

    .icon-btn {
        position: relative;
        color: white;
        font-size: 1.3rem;
        transition: color 0.3s ease;
    }

    .icon-btn:hover {
        color: var(--yellow);
    }

    .badge {
        position: absolute;
        top: -6px;
        right: -8px;
        background: var(--yellow);
        color: var(--green);
        font-size: 10px;
        font-weight: bold;
        border-radius: 50%;
        padding: 2px 5px;
    }

    /* Login Button */
    .login-btn {
        background: var(--yellow);
        color: var(--green);
        padding: 8px 18px;
        border-radius: 12px;
        font-weight: 700;
        text-decoration: none;
        transition: 0.3s;
    }

    .login-btn:hover {
        background: #e6b800;
        color: white;
    }

    /* User Dropdown */
    .user-btn {
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .user-btn img {
        width: 40px;
        height: 40px;
        border-radius: 50%;
        border: 2px solid white;
        object-fit: cover;
    }

    /* Mobile */
    .menu-toggle {
        display: none;
        font-size: 1.8rem;
        cursor: pointer;
        color: white;
    }

    .cart-dropdown {
        position: relative;
    }

    .cart-menu {
        display: none;
        position: absolute;
        right: 0;
        top: 120%;
        width: 300px;
        max-height: 400px;
        overflow-y: auto;
        background: white;
        border-radius: 10px;
        box-shadow: 0 6px 15px rgba(0, 0, 0, 0.12);
        z-index: 100;
        transition: all 0.3s ease;
    }

    .cart-dropdown.open .cart-menu {
        display: block;
    }

    .cart-item {
        display: flex;
        gap: 10px;
        padding: 10px;
        border-bottom: 1px solid #eee;
    }

    .cart-item:last-child {
        border-bottom: none;
    }

    .cart-img {
        width: 50px;
        height: 50px;
        object-fit: cover;
        border-radius: 5px;
    }

    .cart-info {
        display: flex;
        flex-direction: column;
        font-size: 14px;
    }

    .cart-name {
        font-weight: 600;
    }

    .cart-qty,
    .cart-price {
        color: #555;
    }

    .cart-footer {
        display: flex;
        justify-content: space-between;
        padding: 10px;
    }

    .cart-footer .btn {
        padding: 6px 12px;
        border-radius: 6px;
        text-decoration: none;
        font-weight: 600;
    }

    .btn-cart {
        background: #f1f1f1;
        color: #333;
    }

    .btn-checkout {
        background: #198754;
        color: white;
    }

    .empty {
        text-align: center;
        padding: 15px;
        font-style: italic;
        color: #888;
    }


    @media (max-width: 900px) {
        .nav-links {
            position: absolute;
            top: 90px;
            left: 0;
            width: 100%;
            flex-direction: column;
            background: var(--green);
            padding: 20px 0;
            gap: 1.5rem;
            opacity: 0;
            pointer-events: none;
            transform: translateY(-10px);
            transition: all 0.3s ease;
        }

        .nav-links.show {
            opacity: 1;
            pointer-events: auto;
            transform: translateY(0);
        }

        .dropdown-menu {
            position: static;
            display: none;
            background: var(--dark-green);
            box-shadow: none;
        }

        .dropdown.open .dropdown-menu {
            display: block;
        }

        .dropdown-menu a,
        .dropdown-menu button {
            color: white;
        }

        .dropdown-menu a:hover,
        .dropdown-menu button:hover {
            background: var(--yellow);
            color: var(--green);
        }

        .menu-toggle {
            display: block;
        }
    }

    @keyframes fadeDown {
        from {
            opacity: 0;
            transform: translateY(-10px);
        }

        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
</style>

<!-- === SCRIPT === -->
<script>
    const navbar = document.getElementById("navbar");
    const menuToggle = document.getElementById("menuToggle");
    const navLinks = document.getElementById("navLinks");

    // Scroll effect
    window.addEventListener("scroll", () => {
        navbar.classList.toggle("scrolled", window.scrollY > 10);
    });

    // Mobile toggle
    menuToggle.addEventListener("click", () => {
        navLinks.classList.toggle("show");
        menuToggle.innerHTML = navLinks.classList.contains("show") ?
            '<i class="bi bi-x-lg"></i>' : '<i class="bi bi-list"></i>';
    });

    // Dropdown mobile
    document.querySelectorAll(".dropdown > .dropbtn").forEach(btn => {
        btn.addEventListener("click", e => {
            if (window.innerWidth <= 900) {
                e.preventDefault();
                btn.parentElement.classList.toggle("open");
            }
        });
    });

    // Notification
    const notifBtn = document.querySelector('.notification-dropdown .dropbtn');
    notifBtn.addEventListener('click', e => {
        e.preventDefault();
        notifBtn.parentElement.classList.toggle('open');
    });
    document.addEventListener('click', e => {
        if (!notifBtn.parentElement.contains(e.target)) {
            notifBtn.parentElement.classList.remove('open');
        }
    });

    //CArt

    const cartBtn = document.querySelector('.cart-dropdown .dropbtn');
    cartBtn.addEventListener('click', e => {
        e.preventDefault();
        cartBtn.parentElement.classList.toggle('open');
    });

    document.addEventListener('click', e => {
        if (!cartBtn.parentElement.contains(e.target)) {
            cartBtn.parentElement.classList.remove('open');
        }
    });
</script>
