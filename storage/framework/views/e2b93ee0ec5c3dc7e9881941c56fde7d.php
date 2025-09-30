
<link rel="stylesheet" href="<?php echo e(asset('css/navbar.css')); ?>">
<nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm py-3 sticky-top">
    <div class="container">
        <!-- Logo -->
        <a class="navbar-brand d-flex align-items-center" href="/">
            <img src="<?php echo e(asset('images/bumdes.jpg')); ?>" alt="Logo BUMDES" width="50" height="50" class="me-2" />
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
                    <a class="nav-link <?php echo e(Request::is('Beranda') ? 'active' : ''); ?>" href="/Beranda">Beranda</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?php echo e(Request::is('contact') ? 'active' : ''); ?>" href="/contact">Produk</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?php echo e(Request::is('about') ? 'active' : ''); ?>" href="/about">Berita</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?php echo e(Request::is('details') ? 'active' : ''); ?>" href="/details">Keranjang</a>
                </li>
            </ul>
        </div>

        <!-- Profile/Account Dropdown -->
        <div class="dropdown ms-3">
            <a href="#" class="text-dark fs-3 profile-icon dropdown-toggle" id="dropdownProfile" data-bs-toggle="dropdown" aria-expanded="false">
                <i class="bi bi-person-circle"></i>
            </a>
            <ul class="dropdown-menu dropdown-menu-end shadow" aria-labelledby="dropdownProfile">
                <?php if(auth()->guard()->check()): ?>
                    <li>
                        <a class="dropdown-item" href="/profile">
                            <i class="bi bi-person me-2"></i>Profil Saya
                        </a>
                    </li>
                    <li>
                        <a class="dropdown-item" href="/orders">
                            <i class="bi bi-bag-check me-2"></i>Pesanan Saya
                        </a>
                    </li>
                    <li>
                        <a class="dropdown-item" href="/settings">
                            <i class="bi bi-gear me-2"></i>Pengaturan
                        </a>
                    </li>
                    <li><hr class="dropdown-divider"></li>
                    <li>
                        <a class="dropdown-item text-danger" href="/logout">
                            <i class="bi bi-box-arrow-right me-2"></i>Keluar
                        </a>
                    </li>
                <?php else: ?>
                    <li>
                        <a class="dropdown-item" href="/login">
                            <i class="bi bi-box-arrow-in-right me-2"></i>Masuk
                        </a>
                    </li>
                    <li>
                        <a class="dropdown-item" href="/register">
                            <i class="bi bi-person-plus me-2"></i>Daftar
                        </a>
                    </li>
                <?php endif; ?>
            </ul>
        </div>
    </div>
</nav>
<?php /**PATH C:\laragon\www\belajar_laravel\resources\views/layouts/navbar.blade.php ENDPATH**/ ?>