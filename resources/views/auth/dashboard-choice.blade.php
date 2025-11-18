<x-guest-layout>
    <div class="container">
        <div class="card">
            <div class="header">
                <h2>Pilih Dashboard</h2>
                <p>Selamat datang! Pilih tujuan Anda:</p>
            </div>

            <div class="buttons">
                <!-- Admin/Filament Dashboard -->
                <form method="POST" action="{{ route('dashboard.admin') }}">
                    @csrf
                    <button type="submit" class="btn btn-primary">
                        <span class="icon"></span>
                        Panel Admin (Filament)
                    </button>
                </form>

                <!-- Home/Dashboard -->
                <form method="POST" action="{{ route('dashboard.home') }}">
                    @csrf
                    <button type="submit" class="btn btn-secondary">
                        <span class="icon"></span>
                        Beranda Website
                    </button>
                </form>
            </div>

            <div class="logout">
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="btn-logout">
                        Keluar dari akun
                    </button>
                </form>
            </div>
        </div>
    </div>

    <style>
        /* Container & Centering */
        .container {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 1rem;
            background-color: #f9fafb;
        }

        .card {
            width: 100%;
            max-width: 400px;
            padding: 2rem;
            background-color: #fff;
            border-radius: 12px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            text-align: center;
        }

        /* Header */
        .header h2 {
            font-size: 1.75rem;
            font-weight: 700;
            margin-bottom: 0.5rem;
            color: #111827;
        }

        .header p {
            font-size: 0.9rem;
            color: #6b7280;
            margin-bottom: 1.5rem;
        }

        /* Buttons */
        .buttons form {
            margin-bottom: 1rem;
        }

        .btn {
            width: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 0.75rem 1rem;
            border-radius: 8px;
            font-size: 0.9rem;
            font-weight: 500;
            cursor: pointer;
            transition: all 0.3s ease;
            border: none;
        }

        .btn .icon {
            margin-right: 0.5rem;
            font-size: 1.2rem;
        }

        .btn-primary {
            background-color: #166a10;
            color: #fff;
        }

        .btn-primary:hover {
            background-color: #11512b;
        }

        .btn-secondary {
            background-color: #fff;
            color: #374151;
            border: 1px solid #d1d5db;
        }

        .btn-secondary:hover {
            background-color: #f3f4f6;
        }

        /* Logout */
        .logout .btn-logout {
            background: none;
            border: none;
            color: #6b7280;
            font-size: 0.85rem;
            text-decoration: underline;
            cursor: pointer;
            transition: color 0.3s ease;
        }

        .logout .btn-logout:hover {
            color: #111827;
        }

        /* Responsive */
        @media (max-width: 480px) {
            .card {
                padding: 1.5rem;
            }

            .btn {
                padding: 0.6rem 1rem;
                font-size: 0.85rem;
            }

            .btn .icon {
                font-size: 1rem;
            }
        }
    </style>
</x-guest-layout>
