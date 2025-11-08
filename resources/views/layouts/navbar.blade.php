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
        background: #fff;
        border-bottom: 1px solid #e5e5e5;
        position: sticky;
        top: 0;
        z-index: 1000;
        transition: all 0.3s ease;
    }

    #navbar.scrolled {
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.08);
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
        background: #fff;
        border-radius: 10px;
        box-shadow: 0 5px 20px rgba(0, 0, 0, 0.1);
        min-width: 260px;
        overflow: hidden;
        animation: fadeIn 0.25s ease;
        z-index: 999;
    }

    .dropdown.open .dropdown-menu {
        display: block;
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
        padding: 10px 16px;
        font-size: 0.9rem;
        color: #333;
        transition: background 0.2s ease;
    }

    .dropdown-menu a:hover {
        background: #f5f7fb;
        color: #1b7f5b;
    }

    /* === USER DROPDOWN === */
    .user-dropdown img {
        width: 38px;
        height: 38px;
        border-radius: 50%;
        object-fit: cover;
    }

    .user-menu {
        min-width: 220px;
    }

    .user-info {
        display: flex;
        align-items: center;
        gap: 10px;
        padding: 12px 16px;
    }

    .user-avatar img {
        width: 45px;
        height: 45px;
        border-radius: 50%;
        object-fit: cover;
    }

    .user-details .user-name {
        font-weight: 600;
    }

    .user-details .user-email {
        font-size: 0.8rem;
        color: #666;
    }

    .user-footer button {
        width: 100%;
        padding: 10px;
        background: #f8f9fb;
        border: none;
        font-weight: 600;
        color: #333;
        transition: background 0.25s;
    }

    .user-footer button:hover {
        background: #e9ecef;
        color: #1b7f5b;
    }

    /* === CART DROPDOWN === */
    .cart-dropdown .dropdown-menu {
        min-width: 300px;
        padding-bottom: 6px;
    }

    .cart-item {
        display: flex;
        align-items: center;
        gap: 12px;
        padding: 10px 14px;
    }

    .cart-item img {
        width: 48px;
        height: 48px;
        border-radius: 6px;
        object-fit: cover;
    }

    .cart-item strong {
        font-size: 0.9rem;
    }

    .cart-item span {
        font-size: 0.85rem;
        color: #777;
    }

    .cart-footer {
        padding: 10px;
        display: flex;
        gap: 10px;
    }

    .cart-footer a {
        flex: 1;
        text-align: center;
        padding: 8px 0;
        border-radius: 8px;
        font-weight: 600;
        transition: all 0.3s ease;
    }

    .cart-footer .btn-view {
        background: #e9efff;
        color: #1b7f5b;
    }

    .cart-footer .btn-view:hover {
        background: #d7e3ff;
    }

    .cart-footer .btn-checkout {
        background: #1b7f5b;
        color: #fff;
    }

    .cart-footer .btn-checkout:hover {
        background: #166749;
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
            width: 270px;
            height: 100vh;
            flex-direction: column;
            background: #fff;
            padding: 90px 25px;
            gap: 25px;
            box-shadow: -3px 0 15px rgba(0, 0, 0, 0.08);
            transition: right 0.3s ease;
        }

        .nav-links.show {
            right: 0;
        }

        .nav-links li a {
            font-size: 1.1rem;
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
                radial-gradient(circle at 10% 10%, rgba(27, 127, 91, 0.05) 0%, transparent 25%),
                radial-gradient(circle at 80% 90%, rgba(27, 127, 91, 0.08) 0%, transparent 30%);
            box-shadow: -3px 0 15px rgba(0, 0, 0, 0.08);
            border-radius: 0;
            border: none;
            transition: right 0.35s ease, opacity 0.35s ease;
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
            animation: fadeSlideIn 0.4s ease forwards;
        }

        /* Animasi buka */
        @keyframes fadeSlideIn {
            from {
                opacity: 0;
                transform: translateX(30px);
            }

            to {
                opacity: 1;
                transform: translateX(0);
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
        updateCartBadge();

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
    });
</script>
