<!-- === Navbar Profesional & Modern === -->
<nav id="navbar" class="navbar">
    <div class="nav-container">
        <!-- Logo -->
        <a href="/" class="nav-logo">
            <img src="<?php echo e(asset('images/Bumdes.jpg')); ?>" alt="Logo" />
            <span><strong>BUMDes Madusari</strong></span>
        </a>

        <!-- Menu Links -->
        <ul class="nav-links" id="navLinks">
            <li><a href="/" class="active">Beranda</a></li>

            <li><a href="/berita">Berita</a></li>

            <li><a href="/produk">Produk</a></li>


            <?php if(auth()->guard()->check()): ?>
                <?php if(Auth::user()->role === 'admin'): ?>
                    <li><a href="/iot">IOT</a></li>
                <?php endif; ?>
            <?php endif; ?>

            <li><a href="/galeri">Galeri</a></li>
        </ul>

        <!-- Right Icons -->
        <div class="nav-right">
            <!-- Notification  -->
            <div class="dropdown notification-dropdown">
                <?php if(auth()->guard()->check()): ?>
                    <a href="#" class="icon-btn dropbtn" aria-label="Notifikasi" aria-expanded="false">
                        <i class="bi bi-bell"></i>
                        <?php if(Auth::user()->unreadNotifications->count() > 0): ?>
                            <span class="badge"><?php echo e(Auth::user()->unreadNotifications->count()); ?></span>
                        <?php endif; ?>
                    </a>
                    <ul class="dropdown-menu notif-menu">
                        <?php $__empty_1 = true; $__currentLoopData = Auth::user()->unreadNotifications; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $notification): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                            <li>
                                <a href="<?php echo e($notification->data['url'] ?? '#'); ?>">
                                    <?php echo e($notification->data['message']); ?>

                                </a>
                            </li>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                            <li><span class="empty">Tidak ada notifikasi</span></li>
                        <?php endif; ?>
                        <li class="text-center mt-2">
                            <a href="<?php echo e(route('notifikasi.index')); ?>" class="text-success fw-semibold">Lihat Semua</a>
                        </li>
                    </ul>
                <?php else: ?>
                    <a href="<?php echo e(route('login')); ?>" class="icon-btn" aria-label="Login untuk notifikasi">
                        <i class="bi bi-bell"></i>
                    </a>
                <?php endif; ?>
            </div>


            
            <div class="dropdown cart-dropdown">
                <a href="#" class="icon-btn dropbtn" aria-label="Keranjang" title="Keranjang Belanja">
                    <i class="bi bi-cart"></i>
                    <span class="badge" id="cartBadge">0</span>
                </a>

                <ul class="dropdown-menu cart-menu" id="cartMenu">
                    <li class="empty text-center p-2"><span>Keranjang kosong</span></li>
                </ul>
            </div>

            <!-- User Login / Dropdown -->
            <?php if(auth()->guard()->guest()): ?>
                <a href="<?php echo e(route('login')); ?>" class="login-btn">Masuk</a>
            <?php endif; ?>

            <?php if(auth()->guard()->check()): ?>
                <div class="dropdown user-dropdown">
                    <a href="#" class="dropbtn user-btn" aria-expanded="false">
                        <img src="<?php echo e(Auth::user()->avatar ? asset('storage/' . Auth::user()->avatar) : asset('images/default-avatar.png')); ?>"
                            alt="User" />
                        <i class="bi bi-chevron-down"></i>
                    </a>
                    <ul class="dropdown-menu user-menu">
                        <li><a href="/akun"><i class="bi bi-person"></i> Akun Saya</a></li>
                        <li><a href="<?php echo e(route('pesanan.index')); ?>"><i class="bi bi-receipt"></i> Pesanan Saya</a></li>
                        <?php if(auth()->guard()->check()): ?>
                            <?php if(Auth::user()->role === 'penulis'): ?>
                                <li><a href="penulis/berita" <i class="bi bi-newspaper"></i>Dashboard</a></li>
                            <?php endif; ?>
                        <?php endif; ?>
                        <li>
                            <form method="POST" action="<?php echo e(route('logout')); ?>">
                                <?php echo csrf_field(); ?>
                                <button type="submit"><i class="bi bi-box-arrow-right"></i> Keluar</button>
                            </form>
                        </li>
                    </ul>
                </div>
            <?php endif; ?>

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
        --shadow: 0 3px 10px rgba(0, 0, 0, 0.15);
        --border-radius: 10px;
        --transition: all 0.3s ease;
    }

    /* Navbar */
    .navbar {
        position: fixed;
        top: 0;
        width: 100%;
        height: 90px;
        background: linear-gradient(180deg, var(--green), var(--dark-green));
        box-shadow: var(--shadow);
        color: white;
        z-index: 1000;
        transition: var(--transition);
    }

    .navbar.scrolled {
        background: var(--dark-green);
        box-shadow: 0 5px 20px rgba(0, 0, 0, 0.2);
    }

    .nav-container {
        max-width: 1200px;
        margin: 0 auto;
        padding: 0.9rem 2rem;
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 2rem;
        flex-wrap: wrap;
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
        flex-shrink: 0;
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
        margin: 0;
        padding: 0;
        flex: 1;
        justify-content: center;
    }

    .nav-links a {
        color: white;
        text-decoration: none;
        font-weight: 500;
        padding: 6px 0;
        position: relative;
        transition: var(--transition);
        white-space: nowrap;
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
        border-radius: 1px;
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
        transition: var(--transition);
    }

    .dropdown-menu {
        display: none;
        position: absolute;
        top: 120%;
        left: 0;
        background: white;
        color: var(--green);
        border-radius: var(--border-radius);
        min-width: 180px;
        max-width: 280px;
        box-shadow: 0 6px 15px rgba(0, 0, 0, 0.12);
        overflow: hidden;
        transition: var(--transition);
        z-index: 1000;
        /* Responsive positioning */
        right: auto;
        transform: none;
    }

    /* Adjust dropdown position on smaller screens */
    @media (max-width: 1200px) {
        .dropdown-menu {
            min-width: 160px;
        }
    }

    @media (max-width: 768px) {
        .dropdown-menu {
            min-width: 140px;
            max-width: 200px;
        }
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
        transition: var(--transition);
        text-align: left;
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
        width: 280px;
        max-height: 350px;
        overflow-y: auto;
        background: white;
        color: var(--green);
        border-radius: var(--border-radius);
        box-shadow: 0 6px 15px rgba(0, 0, 0, 0.12);
        z-index: 1000;
        transition: var(--transition);
        /* Responsive adjustments */
        max-width: 90vw;
    }

    /* Adjust notification dropdown on smaller screens */
    @media (max-width: 480px) {
        .notif-menu {
            width: 250px;
            right: -10px;
        }
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
        gap: 0.75rem;
        flex-shrink: 0;
    }

    .icon-btn {
        position: relative;
        color: white;
        font-size: 1.3rem;
        transition: var(--transition);
        padding: 8px;
        border-radius: 50%;
    }

    .icon-btn:hover {
        color: var(--yellow);
        background: rgba(255, 255, 255, 0.1);
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
        min-width: 16px;
        height: 16px;
        display: flex;
        align-items: center;
        justify-content: center;
        line-height: 1;
    }

    .badge:empty,
    .badge[data-count="0"] {
        display: none;
    }

    /* Login Button */
    .login-btn {
        background: var(--yellow);
        color: var(--green);
        padding: 8px 18px;
        border-radius: 12px;
        font-weight: 700;
        text-decoration: none;
        transition: var(--transition);
        white-space: nowrap;
    }

    .login-btn:hover {
        background: #e6b800;
        color: white;
        transform: translateY(-1px);
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
        font-size: 1.5rem;
        cursor: pointer;
        color: white;
        padding: 6px;
        border-radius: 4px;
        transition: var(--transition);
    }

    .menu-toggle:hover {
        background: rgba(255, 255, 255, 0.1);
    }

    .cart-dropdown {
        position: relative;
    }

    .cart-menu {
        display: none;
        position: absolute;
        right: 0;
        top: 120%;
        width: 320px;
        max-height: 400px;
        overflow-y: auto;
        background: white;
        border-radius: var(--border-radius);
        box-shadow: 0 6px 15px rgba(0, 0, 0, 0.12);
        z-index: 1000;
        transition: var(--transition);
        /* Responsive adjustments */
        max-width: 90vw;
    }

    /* Adjust cart dropdown on smaller screens */
    @media (max-width: 480px) {
        .cart-menu {
            width: 280px;
            right: -10px;
        }
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
        .nav-container {
            padding: 0.5rem 1rem;
        }

        .nav-logo {
            font-size: 1.1rem;
        }

        .nav-logo img {
            width: 40px;
            height: 40px;
        }

        .nav-links {
            position: fixed;
            top: 90px;
            left: 0;
            width: 100%;
            height: calc(100vh - 90px);
            flex-direction: column;
            background: var(--green);
            padding: 30px 20px;
            gap: 2rem;
            opacity: 0;
            pointer-events: none;
            transform: translateY(-20px);
            transition: var(--transition);
            overflow-y: auto;
            z-index: 999;
        }

        .nav-links.show {
            opacity: 1;
            pointer-events: auto;
            transform: translateY(0);
        }

        .nav-links li {
            width: 100%;
            text-align: center;
        }

        .nav-links a {
            font-size: 1.1rem;
            padding: 12px 0;
            display: block;
        }

        .dropdown-menu {
            position: static;
            display: none;
            background: var(--dark-green);
            box-shadow: none;
            border-radius: 0;
            margin-top: 10px;
        }

        .dropdown.open .dropdown-menu {
            display: block;
        }

        .dropdown-menu a,
        .dropdown-menu button {
            color: white;
            justify-content: center;
            padding: 15px 20px;
        }

        .dropdown-menu a:hover,
        .dropdown-menu button:hover {
            background: var(--yellow);
            color: var(--green);
        }

        .nav-right {
            gap: 0.125rem;
        }

        .icon-btn {
            font-size: 1.2rem;
            padding: 6px;
        }

        .login-btn {
            padding: 6px 12px;
            font-size: 0.9rem;
        }

        .user-btn img {
            width: 35px;
            height: 35px;
        }

        .menu-toggle {
            display: block;
            font-size: 1.5rem;
            padding: 8px;
        }

        .notif-menu,
        .cart-menu {
            width: 100vw;
            max-width: none;
            left: 0;
            right: 0;
            border-radius: 0;
            /* Ensure proper positioning on mobile */
            position: fixed;
            top: auto;
            bottom: 0;
            left: 0;
            right: 0;
            width: 100%;
            max-height: 60vh;
            border-radius: var(--border-radius) var(--border-radius) 0 0;
        }

        .cart-menu {
            width: 100vw;
            max-width: none;
            /* Mobile cart menu inherits the fixed positioning */
        }
    }

    @media (max-width: 576px) {
        .navbar {
            height: 70px;
        }

        .nav-links {
            top: 70px;
            height: calc(100vh - 70px);
        }

        .nav-container {
            padding: 0.4rem 0.8rem;
        }

        .nav-logo {
            font-size: 1rem;
        }

        .nav-logo img {
            width: 35px;
            height: 35px;
        }

        .nav-links {
            padding: 20px 15px;
            gap: 1.5rem;
        }

        .nav-links a {
            font-size: 1rem;
            padding: 10px 0;
        }

        .dropdown-menu a,
        .dropdown-menu button {
            padding: 12px 15px;
            font-size: 0.9rem;
        }

        .icon-btn {
            font-size: 1.1rem;
            padding: 5px;
        }

        .login-btn {
            padding: 5px 10px;
            font-size: 0.8rem;
        }

        .user-btn img {
            width: 30px;
            height: 30px;
        }

        .menu-toggle {
            font-size: 1.2rem;
            padding: 4px;
        }

        .badge {
            font-size: 9px;
            padding: 1px 4px;
            min-width: 14px;
            height: 14px;
            top: -5px;
            right: -6px;
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
    if (notifBtn) {
        notifBtn.addEventListener('click', e => {
            e.preventDefault();
            e.stopPropagation();

            // Close other dropdowns first
            document.querySelectorAll('.dropdown.open').forEach(dropdown => {
                if (!dropdown.contains(notifBtn)) {
                    dropdown.classList.remove('open');
                }
            });

            notifBtn.parentElement.classList.toggle('open');
        });
    }

    // Cart dropdown
    const cartBtn = document.querySelector('.cart-dropdown .dropbtn');
    if (cartBtn) {
        cartBtn.addEventListener('click', e => {
            e.preventDefault();
            e.stopPropagation();

            // Close other dropdowns first
            document.querySelectorAll('.dropdown.open').forEach(dropdown => {
                if (!dropdown.contains(cartBtn)) {
                    dropdown.classList.remove('open');
                }
            });

            cartBtn.parentElement.classList.toggle('open');

            // Load cart items when opening dropdown
            if (cartBtn.parentElement.classList.contains('open')) {
                loadCartItems();
            }
        });
    }

    // User dropdown
    const userBtn = document.querySelector('.user-dropdown .dropbtn');
    if (userBtn) {
        userBtn.addEventListener('click', e => {
            e.preventDefault();
            e.stopPropagation();

            // Close other dropdowns first
            document.querySelectorAll('.dropdown.open').forEach(dropdown => {
                if (!dropdown.contains(userBtn)) {
                    dropdown.classList.remove('open');
                }
            });

            userBtn.parentElement.classList.toggle('open');
        });
    }

    // Close dropdowns when clicking outside
    document.addEventListener('click', e => {
        // Close notification dropdown
        if (notifBtn && !notifBtn.parentElement.contains(e.target)) {
            notifBtn.parentElement.classList.remove('open');
        }
        // Close cart dropdown
        if (cartBtn && !cartBtn.parentElement.contains(e.target)) {
            cartBtn.parentElement.classList.remove('open');
        }
        // Close user dropdown
        if (userBtn && !userBtn.parentElement.contains(e.target)) {
            userBtn.parentElement.classList.remove('open');
        }
    });

    // Prevent dropdown close when clicking inside cart menu
    const cartMenu = document.getElementById('cartMenu');
    if (cartMenu) {
        cartMenu.addEventListener('click', e => {
            e.stopPropagation();
        });
    }

    // Initialize cart on page load
    updateCartBadge();

    // Listen for cart updates
    document.addEventListener('cartUpdated', function() {
        updateCartBadge();
    });

    // Function to update cart badge
    function updateCartBadge() {
        // First try AJAX for logged-in users
        fetch("/keranjang/get", {
                method: "GET",
                headers: {
                    "X-Requested-With": "XMLHttpRequest",
                    "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]')?.content || '',
                },
                credentials: 'same-origin'
            })
            .then((response) => {
                if (!response.ok) {
                    throw new Error('Network response was not ok');
                }
                return response.json();
            })
            .then((data) => {
                const badge = document.getElementById("cartBadge");
                if (badge) {
                    const count = data.total_items || 0;
                    badge.textContent = count;
                    badge.setAttribute('data-count', count);
                    if (count === 0) {
                        badge.style.display = 'none';
                    } else {
                        badge.style.display = 'flex';
                    }
                }
            })
            .catch((error) => {
                console.error("Error updating cart badge:", error);
                // Fallback: try to get from session storage for guest users
                try {
                    const sessionCart = sessionStorage.getItem("keranjang");
                    if (sessionCart) {
                        const cart = JSON.parse(sessionCart);
                        const total = Object.values(cart).reduce(
                            (sum, item) => sum + (item.jumlah || 0),
                            0
                        );
                        const badge = document.getElementById("cartBadge");
                        if (badge) {
                            badge.textContent = total;
                            badge.setAttribute('data-count', total);
                            if (total === 0) {
                                badge.style.display = 'none';
                            } else {
                                badge.style.display = 'flex';
                            }
                        }
                    } else {
                        // No session cart, set to 0
                        const badge = document.getElementById("cartBadge");
                        if (badge) {
                            badge.textContent = "0";
                            badge.setAttribute('data-count', '0');
                            badge.style.display = 'none';
                        }
                    }
                } catch (e) {
                    console.error("Fallback cart count failed:", e);
                    // Set to 0 if all fails
                    const badge = document.getElementById("cartBadge");
                    if (badge) {
                        badge.textContent = "0";
                        badge.setAttribute('data-count', '0');
                        badge.style.display = 'none';
                    }
                }
            });
    }

    // Function to load cart items for dropdown
    function loadCartItems() {
        fetch("/keranjang/get", {
                method: "GET",
                headers: {
                    "X-Requested-With": "XMLHttpRequest",
                    "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]')?.content || '',
                },
                credentials: 'same-origin'
            })
            .then((response) => {
                if (!response.ok) {
                    throw new Error('Network response was not ok');
                }
                return response.json();
            })
            .then((data) => {
                const cartMenu = document.getElementById("cartMenu");
                if (!cartMenu) return;

                // Update badge first
                const badge = document.getElementById("cartBadge");
                if (badge) {
                    const count = data.total_items || 0;
                    badge.textContent = count;
                    badge.setAttribute('data-count', count);
                    if (count === 0) {
                        badge.style.display = 'none';
                    } else {
                        badge.style.display = 'flex';
                    }
                }

                if (data.items && data.items.length > 0) {
                    let html = "";
                    data.items.forEach((item) => {
                        html += `
                        <li class="cart-item d-flex align-items-center gap-2 p-2 border-bottom">
                            <img src="${item.gambar ? "/storage/" + item.gambar : "/images/no-image.jpg"}" alt="${item.nama}"
                                class="cart-img rounded" style="width:50px; height:50px; object-fit:cover;">
                            <div class="cart-info flex-grow-1">
                                <span class="cart-name fw-bold">${item.nama}</span>
                                ${item.variasi ? `<span class="cart-variant d-block text-muted" style="font-size:0.8rem;">${item.variasi}</span>` : ''}
                                <span class="cart-qty text-muted">x${item.jumlah}</span>
                                <span class="cart-price text-success fw-bold">Rp ${new Intl.NumberFormat('id-ID').format((item.harga || 0) * (item.jumlah || 1))}</span>
                            </div>
                        </li>
                    `;
                    });
                    html += `
                    <li class="cart-footer d-flex justify-content-between p-2">
                        <a href="/keranjang" class="btn btn-outline-success btn-sm">Lihat Keranjang</a>
                        <a href="/checkout" class="btn btn-success btn-sm">Checkout</a>
                    </li>
                `;
                    cartMenu.innerHTML = html;
                } else {
                    cartMenu.innerHTML = '<li class="empty text-center p-2"><span>Keranjang kosong</span></li>';
                }
            })
            .catch((error) => {
                console.error("Error loading cart items:", error);
                // Fallback: try to get from session storage for guest users
                try {
                    const sessionCart = sessionStorage.getItem("keranjang");
                    if (sessionCart) {
                        const cart = JSON.parse(sessionCart);
                        const cartMenu = document.getElementById("cartMenu");
                        if (cartMenu) {
                            // Update badge from session
                            const total = Object.values(cart).reduce(
                                (sum, item) => sum + (item.jumlah || 0),
                                0
                            );
                            const badge = document.getElementById("cartBadge");
                            if (badge) {
                                badge.textContent = total;
                                badge.setAttribute('data-count', total);
                                if (total === 0) {
                                    badge.style.display = 'none';
                                } else {
                                    badge.style.display = 'flex';
                                }
                            }

                            if (Object.keys(cart).length > 0) {
                                let html = "";
                                Object.values(cart).forEach((item) => {
                                    html += `
                                    <li class="cart-item d-flex align-items-center gap-2 p-2 border-bottom">
                                        <img src="${item.gambar ? '/storage/' + item.gambar : '/images/no-image.jpg'}" alt="${item.nama}"
                                            class="cart-img rounded" style="width:50px; height:50px; object-fit:cover;">
                                        <div class="cart-info flex-grow-1">
                                            <span class="cart-name fw-bold">${item.nama}</span>
                                            ${item.variasi ? `<span class="cart-variant d-block text-muted" style="font-size:0.8rem;">${item.variasi}</span>` : ''}
                                            <span class="cart-qty text-muted">x${item.jumlah || 1}</span>
                                            <span class="cart-price text-success fw-bold">Rp ${new Intl.NumberFormat('id-ID').format((item.harga || 0) * (item.jumlah || 1))}</span>
                                        </div>
                                    </li>
                                `;
                                });
                                html += `
                                <li class="cart-footer d-flex justify-content-between p-2">
                                    <a href="/keranjang" class="btn btn-outline-success btn-sm">Lihat Keranjang</a>
                                    <a href="/checkout" class="btn btn-success btn-sm">Checkout</a>
                                </li>
                            `;
                                cartMenu.innerHTML = html;
                            } else {
                                cartMenu.innerHTML =
                                    '<li class="empty text-center p-2"><span>Keranjang kosong</span></li>';
                            }
                        }
                    } else {
                        // No session cart
                        const cartMenu = document.getElementById("cartMenu");
                        if (cartMenu) {
                            cartMenu.innerHTML =
                                '<li class="empty text-center p-2"><span>Keranjang kosong</span></li>';
                        }
                        // Set badge to 0
                        const badge = document.getElementById("cartBadge");
                        if (badge) {
                            badge.textContent = "0";
                            badge.setAttribute('data-count', '0');
                            badge.style.display = 'none';
                        }
                    }
                } catch (e) {
                    console.error("Fallback cart loading failed:", e);
                    // Set empty cart if all fails
                    const cartMenu = document.getElementById("cartMenu");
                    if (cartMenu) {
                        cartMenu.innerHTML = '<li class="empty text-center p-2"><span>Keranjang kosong</span></li>';
                    }
                    // Set badge to 0
                    const badge = document.getElementById("cartBadge");
                    if (badge) {
                        badge.textContent = "0";
                    }
                }
            });
    }
</script>
<?php /**PATH C:\laragon\www\belajar_laravel\resources\views/layouts/navbar.blade.php ENDPATH**/ ?>