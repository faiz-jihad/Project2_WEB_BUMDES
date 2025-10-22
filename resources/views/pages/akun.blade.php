@extends('layouts.master')

@section('title', 'Akun Saya - BUMDes Madusari')

@section('content')
    <section class="akun-section">
        <div class="akun-wrapper" data-aos="fade-up">

            <div class="akun-header">
                <h1>Akun Saya</h1>
                <p>Kelola informasi pribadi dan pengaturan akun Anda.</p>
            </div>

            @if (session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            <div class="akun-card shadow-lg">
                <div class="akun-left">
                    <div class="avatar-wrapper">
                        <img src="{{ $user->avatar ? asset($user->avatar) : asset('images/default-avatar.png') }}"
                            alt="Avatar">
                    </div>
                    <h3>{{ $user->name }}</h3>
                    <p class="email">{{ $user->email }}</p>
                    <span class="role">{{ ucfirst($user->role ?? 'User') }}</span>
                </div>

                <div class="akun-right">
                    <form action="{{ route('akun.update') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="name">Nama Lengkap</label>
                            <input type="text" id="name" name="name" value="{{ $user->name }}" required>
                        </div>

                        <div class="form-group">
                            <label for="email">Alamat Email</label>
                            <input type="email" id="email" name="email" value="{{ $user->email }}" required>
                        </div>

                        <div class="form-group">
                            <label for="avatar">Foto Profil</label>
                            <input type="file" id="avatar" name="avatar" accept="image/*">
                            <small>Unggah gambar maksimal 2MB</small>
                        </div>

                        <div class="akun-buttons">
                            <button type="submit" class="btn-simpan">Simpan Perubahan</button>
                            <a href="{{ route('logout') }}" class="btn-logout"
                                onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                Keluar
                            </a>
                        </div>
                    </form>

                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display:none;">
                        @csrf
                    </form>
                </div>
            </div>
        </div>
    </section>

    <style>
        :root {
            --green: #198754;
            --green-dark: #146c43;
            --bg-light: #f7faf8;
            --text: #333;
        }

        body {
            background: var(--bg-light);
            font-family: 'Poppins', sans-serif;
        }

        .akun-section {
            padding: 120px 20px 80px;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .akun-wrapper {
            max-width: 1000px;
            width: 100%;
        }

        .akun-header {
            text-align: center;
            margin-bottom: 40px;
        }

        .akun-header h1 {
            font-size: 2rem;
            font-weight: 700;
            color: var(--green-dark);
        }

        .akun-header p {
            color: #666;
            margin-top: 8px;
            font-size: 1rem;
        }

        .akun-card {
            display: flex;
            flex-wrap: wrap;
            background: #fff;
            border-radius: 18px;
            overflow: hidden;
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.08);
        }

        .akun-left {
            flex: 1;
            min-width: 260px;
            background: linear-gradient(135deg, var(--green) 0%, var(--green-dark) 100%);
            color: #fff;
            padding: 40px 25px;
            text-align: center;
        }

        .avatar-wrapper {
            width: 120px;
            height: 120px;
            margin: 0 auto 15px;
            border-radius: 50%;
            overflow: hidden;
            border: 3px solid #fff;
        }

        .avatar-wrapper img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .akun-left h3 {
            font-weight: 700;
            font-size: 1.2rem;
            margin-bottom: 5px;
        }

        .akun-left .email {
            font-size: 0.9rem;
            opacity: 0.9;
        }

        .role {
            display: inline-block;
            margin-top: 8px;
            background: rgba(255, 255, 255, 0.2);
            padding: 5px 14px;
            border-radius: 20px;
            font-size: 0.85rem;
            font-weight: 600;
        }

        .akun-right {
            flex: 2;
            padding: 40px;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            font-weight: 600;
            color: var(--green-dark);
            display: block;
            margin-bottom: 6px;
        }

        .form-group input {
            width: 100%;
            padding: 10px 14px;
            border: 1.5px solid #ccc;
            border-radius: 10px;
            font-size: 0.95rem;
            transition: all 0.3s ease;
        }

        .form-group input:focus {
            border-color: var(--green);
            box-shadow: 0 0 0 3px rgba(25, 135, 84, 0.1);
            outline: none;
        }

        .form-group small {
            color: #888;
            font-size: 0.85rem;
        }

        .akun-buttons {
            display: flex;
            align-items: center;
            gap: 20px;
            margin-top: 25px;
        }

        .btn-simpan {
            background: var(--green);
            color: white;
            font-weight: 600;
            padding: 10px 25px;
            border-radius: 10px;
            border: none;
            cursor: pointer;
            transition: 0.3s;
        }

        .btn-simpan:hover {
            background: var(--green-dark);
        }

        .btn-logout {
            color: #c0392b;
            font-weight: 600;
            text-decoration: none;
            transition: 0.3s;
        }

        .btn-logout:hover {
            text-decoration: underline;
        }

        @media (max-width: 768px) {
            .akun-card {
                flex-direction: column;
            }

            .akun-left {
                border-radius: 18px 18px 0 0;
                padding: 30px 20px;
            }

            .akun-right {
                padding: 25px 20px;
            }

            .akun-buttons {
                flex-direction: column;
                gap: 15px;
                align-items: stretch;
            }

            .btn-simpan,
            .btn-logout {
                width: 100%;
                text-align: center;
            }
        }
    </style>
@endsection
