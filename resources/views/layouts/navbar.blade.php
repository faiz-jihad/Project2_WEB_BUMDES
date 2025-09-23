<!-- partials/navbar.blade.php -->

<nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm py-3 sticky-top">
    <div class="container">
        <!-- Logo -->
        <a class="navbar-brand d-flex align-items-center" href="/">
            <img src="{{ asset('images/bumdes.jpg') }}" alt="Logo BUMDES" width="50" height="50" class="me-2" />
            <div>
                <small class="d-block text-secondary">BUMDES MADUSARI</small>
                <small class="fw-bold ">BAYALANGU KIDUL</small>
            </div>
        </a>

        <!-- Toggler Mobile -->
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <!-- Menu -->
        <div class="collapse navbar-collapse justify-content-center" id="navbarNav">
            <ul class="navbar-nav align-items-center gap-3 fs-5">
                <li class="nav-item">
                    <a class="nav-link {{ Request::is('Beranda') ? 'active' : '' }}" href="/Beranda">Beranda</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ Request::is('contact') ? 'active' : '' }}" href="/contact">Produk</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ Request::is('about') ? 'active' : '' }}" href="/about">Berita</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ Request::is('details') ? 'active' : '' }}" href="/details">Keranjang</a>
                </li>
            </ul>
        </div>

        <!-- Profile/Account -->
        <a href="#" class="text-dark fs-3 ms-3 profile-icon">
            <i class="bi bi-person-circle"></i>
        </a>
    </div>
</nav>

@push('styles')
<style>
    /* Aktif */
    .nav-link.active {
        color: #00c851 !important;
        font-weight: 700;
        position: relative;
    }

    .nav-link.active::after {
        content: '';
        position: absolute;
        bottom: -5px;
        left: 50%;
        transform: translateX(-50%);
        width: 40%;
        height: 3px;
        background: #00c851;
        border-radius: 2px;
    }

    /* Hover dengan transisi */
    .nav-link {
        position: relative;
        transition: all 0.3s ease;
    }

    .nav-link:hover {
        color: #009432 !important;
        transform: translateY(-2px);
    }

    /* Efek hover untuk profile */
    .profile-icon {
        transition: transform 0.3s ease, color 0.3s ease;
    }

    .profile-icon:hover {
        transform: scale(1.2);
        color: #00c851 !important;
    }
</style>
@endpush
