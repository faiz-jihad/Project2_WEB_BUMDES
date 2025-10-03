<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">

    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">

    <!-- Custom CSS -->
    <link rel="stylesheet" href="<?php echo e(asset('css/navbar.css')); ?>">

    <title>Navbar Responsif</title>
</head>

<body>
    <nav class="navbar navbar-expand-lg bg-body-tertiary shadow-sm py-2">
        <div class="container px-4"> <!-- Tambah padding container -->

            <!-- Logo -->
            <a class="navbar-brand d-flex align-items-center me-4" href="/">
                <img src="<?php echo e(asset('images/bumdes.jpg')); ?>" alt="Logo" width="50" height="35"
                    class="d-inline-block align-text-top me-2">
                <span class="fw-bold"></span>
            </a>

            <!-- Toggler -->
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <!-- Navbar Content -->
            <div class="collapse navbar-collapse" id="navbarNav">
                <!-- Left Menu -->
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item mx-2">
                        <a class="nav-link active" aria-current="page" href="/Beranda">Home</a>
                    </li>
                    <li class="nav-item mx-2">
                        <a class="nav-link" href="/produk">Produk</a>
                    </li>
                    <li class="nav-item dropdown mx-2">
                        <a class="nav-link dropdown-toggle" href="#" id="beritaDropdown" role="button"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            Berita
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="beritaDropdown">
                            <li><a class="dropdown-item" href="/about">Berita Utama</a></li>
                            <li><a class="dropdown-item" href="#">Event Desa</a></li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li><a class="dropdown-item" href="#">Lainnya</a></li>
                        </ul>
                    </li>
                    <li class="nav-item mx-2">
                        <a class="nav-link" href="/keranjang">
                            <i class="bi bi-cart4 me-1"></i> Keranjang
                        </a>
                    </li>
                </ul>

                <!-- Right Menu (Auth) -->
                <ul class="navbar-nav ms-auto">
                    <?php if(auth()->guard()->guest()): ?>
                        <!-- Jika belum login -->
                        <li class="nav-item ms-2">
                            <a href="<?php echo e(route('login')); ?>" class="btn btn-primary rounded-pill px-3 py-1 shadow-sm"
                                style="font-size: 0.9rem;">
                                <i class="bi bi-box-arrow-in-right me-1"></i> Login
                            </a>
                        </li>
                    <?php endif; ?>

                    <?php if(auth()->guard()->check()): ?>
                        <!-- Jika sudah login -->
                        <li class="nav-item dropdown ms-3">
                            <!-- Toggle hanya icon -->
                            <a class="nav-link dropdown-toggle d-flex align-items-center" href="#" id="userDropdown"
                                role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="bi bi-person-circle fs-4"></i>
                            </a>

                            <!-- Dropdown -->
                            <ul class="dropdown-menu dropdown-menu-end user-dropdown shadow border-0 rounded-3 py-2"
                                aria-labelledby="userDropdown" style="min-width: 220px;">

                                <!-- Nama user -->
                                <li class="dropdown-header text-center">
                                    <div class="fw-bold"><?php echo e(Auth::user()->name); ?></div>
                                    <small class="text-muted">Online</small>
                                </li>

                                <li>
                                    <hr class="dropdown-divider">
                                </li>

                                <!-- Menu -->
                                <li>
                                    <a class="dropdown-item d-flex align-items-center" href="<?php echo e(route('akun')); ?>">
                                        <i class="bi bi-person-circle me-2 text-primary"></i> Akun Saya
                                    </a>
                                </li>
                                <li>
                                    <a class="dropdown-item d-flex align-items-center" href="<?php echo e(route('settings')); ?>">
                                        <i class="bi bi-gear me-2 text-secondary"></i> Settings
                                    </a>
                                </li>

                                <li>
                                    <hr class="dropdown-divider">
                                </li>

                                <li>
                                    <form action="<?php echo e(route('logout')); ?>" method="POST">
                                        <?php echo csrf_field(); ?>
                                        <button type="submit" class="dropdown-item d-flex align-items-center text-danger">
                                            <i class="bi bi-box-arrow-right me-2"></i> Logout
                                        </button>
                                    </form>
                                </li>
                            </ul>
                        </li>
                    <?php endif; ?>
                </ul>
            </div>
        </div>
    </nav>

    
</body>

</html>
<?php /**PATH C:\laragon\www\belajar_laravel\resources\views/layouts/navbar.blade.php ENDPATH**/ ?>