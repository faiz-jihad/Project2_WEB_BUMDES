<!-- === Navbar Hijau Modern & Responsif === -->
<nav id="navbar" class="navbar">
    <div class="nav-container">
        <!-- Logo -->
        <a href="/" class="nav-logo">
            <img src="{{ asset('images/Bumdes.jpg') }}" alt="Logo" />
            <span><strong>BUMDes Madusari</strong></span>
        </a>

        <!-- Menu -->
        <ul class="nav-links" id="navLinks">
            <li><a href="/" class="active">Beranda</a></li>

            <!-- Dropdown Berita -->
            <li class="dropdown">
                <a href="#" class="dropbtn">Berita <i class="bi bi-chevron-down"></i></a>
                <ul class="dropdown-menu">
                    <li><a href="/about">Semua Berita</a></li>
                    <li><a href="/about">Politik</a></li>
                    <li><a href="/about">Kesehatan</a></li>
                    <li><a href="/about">Pariwisata</a></li>
                </ul>
            </li>

            <li><a href="/produk">Produk</a></li>
            <li><a href="/keranjang">Keranjang</a></li>

            <!-- Search -->
            <li class="nav-search">
                <input type="text" placeholder="Cari berita..." id="searchInput" />
                <i class="bi bi-search"></i>
            </li>

            <!-- Login / User -->
            @guest
                <li><a href="{{ route('login') }}" class="login-btn" style="text-decoration: none">Masuk</a></li>
            @endguest

            @auth
                <li class="dropdown user-dropdown">
                    <a href="#" class="dropbtn user-btn">
                        <img src="{{ Auth::user()->profile_photo_url ?? asset('img/default-avatar.png') }}"
                            alt="User" />
                        <i class="bi bi-chevron-down"></i>
                    </a>
                    <ul class="dropdown-menu user-menu">
                        <li><a href="/akun"><i class="bi bi-person"></i> Akun Saya</a></li>
                        <li><a href="{{ route('settings') }}"><i class="bi bi-gear"></i> Pengaturan</a></li>
                        <li>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit"><i class="bi bi-box-arrow-right"></i> Logout</button>
                            </form>
                        </li>
                    </ul>
                </li>
            @endauth
        </ul>

        <!-- Toggle Mobile -->
        <div class="menu-toggle" id="menuToggle">
            <i class="bi bi-list"></i>
        </div>
    </div>
</nav>

<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet" />


    <style>
     :root {
        --green: #198754;
        --dark-green: #146c43;
        --yellow: #ffc107;
        --light: #f8fff9;
    }

    /* ======== Navbar Utama ======== */
    .navbar {
        position: fixed;
        top: 0;
        width: 100%;
        height: 90px;
        background: var(--green);
        background-image:
            url('{{ asset('images/texture-fabric.png') }}'),
            linear-gradient(180deg, var(--green), var(--dark-green));
        background-repeat: repeat;
        background-size: 300px, cover;
        background-blend-mode: overlay;
        box-shadow: 0 3px 10px rgba(0, 0, 0, 0.15);
        color: white;
        z-index: 1000;
        transition: all 0.3s ease;
    }

    /* Saat discroll */
    .navbar.scrolled {
        background: var(--dark-green);
        background-image:
            url('{{ asset('images/texture-fabric.png') }}'),
            linear-gradient(180deg, var(--dark-green), #0f5132);
        background-blend-mode: overlay;
    }

    .nav-container {
        max-width: 1200px;
        margin: 0 auto;
        padding: 0.9rem 2rem;
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 2rem;
        position: relative;
        z-index: 2;
    }

    /* ======== Tekstur Bergerak Halus (Opsional) ======== */
    .navbar::before {
        content: "";
        position: absolute;
        inset: 0;
        background: repeating-linear-gradient(45deg,
                rgba(255, 255, 255, 0.03) 0,
                rgba(255, 255, 255, 0.03) 2px,
                transparent 2px,
                transparent 6px);
        animation: move 10s linear infinite;
        pointer-events: none;
        z-index: 1;
    }

    @keyframes move {
        from {
            background-position: 0 0;
        }

        to {
            background-position: 120px 120px;
        }
    }

    /* ======== Logo ======== */
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
    }

    /* ======== Menu Links ======== */
    .nav-links {
        display: flex;
        align-items: center;
        gap: 1.8rem;
        list-style: none;
        transition: all 0.3s ease;
    }

    .nav-links li {
        position: relative;
    }

    .nav-links a {
        color: white;
        text-decoration: none;
        font-weight: 500;
        padding: 6px 0;
        transition: color 0.3s ease;
    }

    .nav-links a:hover {
        color: var(--yellow);
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

    .nav-links a:hover::after,
    .nav-links a.active::after {
        width: 100%;
    }

    /* ======== Dropdown ======== */
    .dropdown {
        position: relative;
    }

    .dropbtn {
        display: flex;
        align-items: center;
        gap: 6px;
    }

    .dropdown-menu {
        display: none;
        position: absolute;
        top: 120%;
        left: 0;
        background: white;
        color: var(--green);
        border-radius: 10px;
        min-width: 190px;
        box-shadow: 0 6px 15px rgba(0, 0, 0, 0.12);
        overflow: hidden;
        animation: fadeDown 0.25s ease;
        z-index: 99;
    }

    .dropdown-menu li {
        border-bottom: 1px solid #eee;
    }

    .dropdown-menu li:last-child {
        border-bottom: none;
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

    .dropdown:hover .dropdown-menu {
        display: block;
    }

    /* ======== Search ======== */
    .nav-search {
        position: relative;
    }

    .nav-search input {
        padding: 8px 35px 8px 14px;
        border-radius: 25px;
        border: none;
        outline: none;
        font-size: 14px;
        color: var(--green);
    }

    .nav-search i {
        position: absolute;
        right: 12px;
        top: 8px;
        color: var(--green);
        font-size: 16px;
    }

    /* ======== Login Button ======== */
    .login-btn {
        background: var(--yellow);
        color: var(--green);
        padding: 12px 24px;
        border-radius: 12px;
        font-weight: 700;
        text-decoration: none;
        transition: 0.3s;
    }

    .login-btn:hover {
        background: #e6b800;
        color: white;
    }

    /* ======== User Dropdown ======== */
    .user-btn {
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .user-btn img {
        width: 42px;
        height: 42px;
        border-radius: 50%;
        border: 2px solid white;
        object-fit: cover;
    }

    .user-menu {
        right: 0;
        left: auto;
        top: 120%;
        border-radius: 10px;
    }

    .user-menu li {
        text-align: left;
    }

    /* ======== Mobile Menu ======== */
    .menu-toggle {
        display: none;
        font-size: 1.8rem;
        cursor: pointer;
        color: white;
    }

    @media (max-width: 900px) {
        .nav-container {
            flex-wrap: wrap;
            padding: 1rem 1.5rem;
        }

        .menu-toggle {
            display: block;
        }

        .nav-links {
            position: absolute;
            top: 70px;
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
            animation: slideDown 0.3s ease;
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
    }

    /* ======== Animations ======== */
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

    @keyframes slideDown {
        from {
            opacity: 0;
            transform: translateY(-8px);
        }

        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
</style>


<script>
    const navbar = document.getElementById("navbar");
    const menuToggle = document.getElementById("menuToggle");
    const navLinks = document.getElementById("navLinks");

    // Scroll effect
    window.addEventListener("scroll", () => {
        navbar.classList.toggle("scrolled", window.scrollY > 10);
    });

    // Mobile menu
    menuToggle.addEventListener("click", () => {
        navLinks.classList.toggle("show");
        menuToggle.innerHTML = navLinks.classList.contains("show") ?
            '<i class="bi bi-x-lg"></i>' :
            '<i class="bi bi-list"></i>';
    });

    // Dropdown (mobile)
    document.querySelectorAll(".dropdown > .dropbtn").forEach(btn => {
        btn.addEventListener("click", e => {
            if (window.innerWidth <= 900) {
                e.preventDefault();
                btn.parentElement.classList.toggle("open");
            }
        });
    });
</script>
