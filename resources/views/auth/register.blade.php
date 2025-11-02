<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Akun - BUMDes Madusari</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: url('{{ asset('images/bgutama.jpg') }}') center/cover no-repeat;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            position: relative;
            font-family: 'Poppins', sans-serif;
        }

        /* Overlay gelap */
        body::before {
            content: "";
            position: absolute;
            inset: 0;
            background: linear-gradient(to bottom, rgba(0, 0, 0, 0.7), rgba(0, 0, 0, 0.9));
            z-index: 0;
        }

        /* Efek blur */
        .blur-circle {
            position: absolute;
            border-radius: 50%;
            filter: blur(80px);
            opacity: 0.4;
            animation: pulse 4s ease-in-out infinite alternate;
        }

        .blur1 {
            width: 300px;
            height: 300px;
            background: #ffffff40;
            top: 15%;
            left: 10%;
        }

        .blur2 {
            width: 400px;
            height: 400px;
            background: #ffb6c140;
            bottom: 10%;
            right: 10%;
        }

        @keyframes pulse {
            from {
                transform: scale(1);
                opacity: 0.4;
            }

            to {
                transform: scale(1.1);
                opacity: 0.6;
            }
        }

        /* Card Register */
        .register-card {
            position: relative;
            z-index: 2;
            background: rgba(255, 255, 255, 0.15);
            backdrop-filter: blur(20px);
            border: 1px solid rgba(255, 255, 255, 0.25);
            border-radius: 1.5rem;
            color: white;
            padding: 2rem 2.5rem;
            width: 100%;
            max-width: 420px;
            box-shadow: 0 0 30px rgba(0, 0, 0, 0.3);
        }

        .register-card h1 {
            font-weight: 700;
            margin-bottom: 0.5rem;
        }

        .form-control {
            border-radius: 0.75rem;
            padding: 0.75rem;
        }

        .btn-custom {
            background: #6366f1;
            color: white;
            font-weight: 600;
            border-radius: 0.75rem;
            transition: all 0.3s ease;
        }

        .btn-custom:hover {
            background: #4f46e5;
            transform: scale(1.02);
        }

        .btn-google {
            background: white;
            color: #444;
            border-radius: 0.75rem;
            font-weight: 500;
            transition: 0.3s;
        }

        .btn-google:hover {
            background: #f8f8f8;
        }

        .text-small {
            font-size: 0.9rem;
        }

        .toggle-password {
            position: absolute;
            right: 15px;
            top: 50%;
            transform: translateY(-50%);
            cursor: pointer;
            color: #666;
        }
    </style>
</head>

<body>

    <!-- Efek blur -->
    <div class="blur-circle blur1"></div>
    <div class="blur-circle blur2"></div>

    <div class="register-card">
        <h1 class="text-center">Register</h1>
        <p class="text-center text-light mb-4"></p>

        @if ($errors->any())
            <div class="alert alert-danger py-2 text-center">{{ $errors->first() }}</div>
        @endif

        <form method="POST" action="{{ route('register') }}">
            @csrf

            <!-- Nama -->
            <div class="mb-3">
                <input type="text" name="name" class="form-control" placeholder="Nama Lengkap" required autofocus
                    value="{{ old('name') }}">
            </div>

            <!-- Email -->
            <div class="mb-3">
                <input type="email" name="email" class="form-control" placeholder="Email" required
                    value="{{ old('email') }}">
            </div>

            <!-- Password -->
            <div class="mb-3 position-relative">
                <input type="password" id="password" name="password" class="form-control" placeholder="Password"
                    required>
                <span class="toggle-password" id="togglePassword">
                    <i class="bi bi-eye" id="eyeOpen"></i>
                    <i class="bi bi-eye-slash d-none" id="eyeClosed"></i>
                </span>
            </div>

            <!-- Konfirmasi Password -->
            <div class="mb-3">
                <input type="password" id="password_confirmation" name="password_confirmation" class="form-control"
                    placeholder="Konfirmasi Password" required>
            </div>

            <button type="submit" class="btn btn-custom w-100 mb-3">Daftar Sekarang</button>

            <p class="text-center text-small mb-3">Sudah punya akun?
                <a href="{{ route('login') }}" class="text-light fw-semibold text-decoration-underline">Masuk di
                    sini</a>
            </p>

            <!-- Google -->
            <a href="{{ url('/auth/google') }}"
                class="btn btn-google w-100 d-flex align-items-center justify-content-center gap-2">
                <img src="https://developers.google.com/identity/images/g-logo.png" alt="Google" width="20"
                    height="20">
                <span>Daftar dengan Google</span>
            </a>
        </form>
    </div>

    <!-- Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        const password = document.getElementById('password');
        const togglePassword = document.getElementById('togglePassword');
        const eyeOpen = document.getElementById('eyeOpen');
        const eyeClosed = document.getElementById('eyeClosed');

        togglePassword.addEventListener('click', () => {
            const isPassword = password.type === 'password';
            password.type = isPassword ? 'text' : 'password';
            eyeOpen.classList.toggle('d-none', !isPassword);
            eyeClosed.classList.toggle('d-none', isPassword);
        });

        // SweetAlert untuk error messages
        @if ($errors->any())
            Swal.fire({
                icon: 'error',
                title: 'Registrasi Gagal!',
                text: '{{ $errors->first() }}',
                confirmButtonColor: '#198754'
            });
        @endif

        // SweetAlert untuk success messages
        @if (session('success'))
            Swal.fire({
                icon: 'success',
                title: 'Berhasil!',
                text: '{{ session('success') }}',
                timer: 3000,
                showConfirmButton: false
            });
        @endif
    </script>

    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">

</body>

</html>
