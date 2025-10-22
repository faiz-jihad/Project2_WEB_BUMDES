<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verifikasi Email</title>
    <style>
        body {
            min-height: 100vh;
            margin: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            background: url('{{ asset('images/bgutama.jpg') }}') center/cover no-repeat;
            font-family: 'Poppins', sans-serif;
            position: relative;
            color: white;
            overflow: hidden;
        }

        /* Overlay gelap */
        body::before {
            content: "";
            position: absolute;
            inset: 0;
            background: linear-gradient(to bottom, rgba(0, 0, 0, 0.85), rgba(0, 0, 0, 0.95));
        }

        /* Efek blur */
        .blur-circle {
            position: absolute;
            border-radius: 50%;
            filter: blur(100px);
            animation: pulse 4s ease-in-out infinite alternate;
        }

        .blur1 {
            width: 300px;
            height: 300px;
            background: rgba(255, 255, 255, 0.15);
            top: 100px;
            left: 80px;
        }

        .blur2 {
            width: 400px;
            height: 400px;
            background: rgba(255, 192, 203, 0.3);
            bottom: 80px;
            right: 100px;
        }

        @keyframes pulse {
            from {
                transform: scale(1);
                opacity: 0.9;
            }

            to {
                transform: scale(1.1);
                opacity: 0.6;
            }
        }

        /* Card utama */
        .card {
            position: relative;
            z-index: 10;
            background: rgba(255, 255, 255, 0.15);
            border: 1px solid rgba(255, 255, 255, 0.25);
            backdrop-filter: blur(15px);
            border-radius: 20px;
            padding: 40px;
            width: 100%;
            max-width: 480px;
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.3);
            text-align: center;
        }

        h1 {
            font-size: 28px;
            margin-bottom: 15px;
            color: #fff;
        }

        p {
            font-size: 15px;
            color: rgba(255, 255, 255, 0.8);
            margin-bottom: 25px;
            line-height: 1.6;
        }

        .alert-success {
            background: rgba(34, 197, 94, 0.2);
            color: #86efac;
            border: 1px solid rgba(34, 197, 94, 0.4);
            padding: 10px 15px;
            border-radius: 10px;
            font-size: 14px;
            margin-bottom: 20px;
        }

        .btn {
            display: inline-block;
            padding: 12px 18px;
            border: none;
            border-radius: 10px;
            cursor: pointer;
            font-weight: bold;
            color: white;
            background: #4f46e5;
            transition: 0.3s;
            box-shadow: 0 4px 10px rgba(99, 102, 241, 0.4);
        }

        .btn:hover {
            background: #4338ca;
        }

        .btn-outline {
            background: transparent;
            border: 1px solid rgba(255, 255, 255, 0.6);
            color: rgba(255, 255, 255, 0.9);
        }

        .btn-outline:hover {
            background: rgba(255, 255, 255, 0.15);
        }

        .button-group {
            display: flex;
            justify-content: space-between;
            gap: 10px;
        }

        @media (max-width: 480px) {
            .card {
                padding: 30px 20px;
            }

            .button-group {
                flex-direction: column;
            }

            .btn {
                width: 100%;
            }
        }
    </style>
</head>

<body>
    <div class="blur-circle blur1"></div>
    <div class="blur-circle blur2"></div>

    <div class="card">
        <h1>Verifikasi Email Anda</h1>
        <p>
            Terima kasih telah mendaftar!
            Sebelum mulai, silakan verifikasi alamat email Anda dengan mengklik tautan yang telah kami kirimkan.
            Jika belum menerima email, Anda dapat mengirim ulang tautan verifikasi di bawah ini.
        </p>

        @if (session('status') == 'verification-link-sent')
            <div class="alert-success">
                Tautan verifikasi baru telah dikirim ke email Anda.
            </div>
        @endif

        <div class="button-group">
            <form method="POST" action="{{ route('verification.send') }}">
                @csrf
                <button type="submit" class="btn">Kirim Ulang Email</button>
            </form>

            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="btn btn-outline">Keluar</button>
            </form>
        </div>
    </div>
</body>

</html>
