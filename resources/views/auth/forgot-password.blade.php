<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lupa Password</title>
    <style>
        body {
            margin: 0;
            font-family: "Poppins", sans-serif;
            background: url('{{ asset('images/bgutama.jpg') }}') center/cover no-repeat;
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
            position: relative;
            color: #fff;
            overflow: hidden;
        }

        body::before {
            content: "";
            position: absolute;
            inset: 0;
            background: linear-gradient(to bottom, rgba(0, 0, 0, 0.8), rgba(0, 0, 0, 0.95));
        }

        .blur {
            position: absolute;
            border-radius: 50%;
            filter: blur(100px);
            animation: pulse 4s ease-in-out infinite alternate;
        }

        .blur1 {
            width: 280px;
            height: 280px;
            background: rgba(255, 255, 255, 0.15);
            top: 80px;
            left: 50px;
        }

        .blur2 {
            width: 380px;
            height: 380px;
            background: rgba(173, 131, 255, 0.25);
            bottom: 60px;
            right: 80px;
        }

        @keyframes pulse {
            from {
                transform: scale(1);
                opacity: 0.8;
            }

            to {
                transform: scale(1.1);
                opacity: 0.5;
            }
        }

        .card {
            position: relative;
            z-index: 10;
            background: rgba(255, 255, 255, 0.12);
            backdrop-filter: blur(15px);
            border: 1px solid rgba(255, 255, 255, 0.2);
            border-radius: 20px;
            padding: 40px 45px;
            width: 100%;
            max-width: 460px;
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.4);
            text-align: center;
            animation: fadeIn 0.8s ease;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        h1 {
            font-size: 26px;
            margin-bottom: 10px;
            font-weight: 700;
        }

        p {
            font-size: 15px;
            color: rgba(255, 255, 255, 0.9);
            margin-bottom: 25px;
            line-height: 1.6;
        }

        input[type="email"] {
            width: 100%;
            padding: 14px 18px;
            border-radius: 12px;
            border: 1px solid rgba(255, 255, 255, 0.4);
            background: rgba(255, 255, 255, 0.85);
            color: #222;
            font-size: 15px;
            outline: none;
            transition: all 0.3s ease;
            box-sizing: border-box;
        }

        input[type="email"]:focus {
            border-color: #7a5cf0;
            box-shadow: 0 0 8px rgba(122, 92, 240, 0.4);
            background: #fff;
        }

        .btn {
            width: 100%;
            padding: 14px 18px;
            border: none;
            border-radius: 12px;
            background: linear-gradient(135deg, #5b4df1, #5141e0);
            color: #fff;
            font-weight: 600;
            font-size: 15px;
            cursor: pointer;
            margin-top: 10px;
            transition: all 0.3s ease;
            box-shadow: 0 4px 12px rgba(91, 77, 241, 0.5);
        }

        .btn:hover {
            background: linear-gradient(135deg, #4b3ed6, #3f35c7);
            transform: translateY(-1px);
        }

        .alert {
            background: rgba(34, 197, 94, 0.25);
            color: #bbf7d0;
            border: 1px solid rgba(34, 197, 94, 0.5);
            padding: 10px 15px;
            border-radius: 10px;
            font-size: 14px;
            margin-bottom: 15px;
        }

        a {
            display: inline-block;
            color: #d0d3ff;
            font-size: 14px;
            margin-top: 15px;
            text-decoration: none;
            transition: color 0.2s;
        }

        a:hover {
            color: #fff;
            text-decoration: underline;
        }

        @media (max-width: 480px) {
            .card {
                padding: 30px 25px;
            }

            h1 {
                font-size: 22px;
            }
        }
    </style>
</head>

<body>
    <div class="blur blur1"></div>
    <div class="blur blur2"></div>

    <div class="card">
        <h1>Lupa Password</h1>
        <p>Masukkan alamat email Anda. Kami akan mengirimkan tautan untuk mengatur ulang password Anda.</p>

        @if (session('status'))
            <div class="alert">{{ session('status') }}</div>
        @endif

        <form method="POST" action="{{ route('password.email') }}">
            @csrf
            <input type="email" name="email" value="{{ old('email') }}" placeholder="Alamat Email" required
                autofocus>
            <button type="submit" class="btn">Kirim Tautan Reset</button>
        </form>

        <a href="{{ route('login') }}">← Kembali ke Login</a>
    </div>
</body>

</html>
