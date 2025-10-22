<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password</title>
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
            overflow: hidden;
            color: white;
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
            top: 80px;
            left: 100px;
        }

        .blur2 {
            width: 400px;
            height: 400px;
            background: rgba(255, 192, 203, 0.3);
            bottom: 60px;
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
            max-width: 420px;
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.3);
        }

        h1 {
            text-align: center;
            margin-bottom: 10px;
            font-size: 28px;
        }

        p {
            text-align: center;
            color: rgba(255, 255, 255, 0.8);
            margin-bottom: 30px;
        }

        label {
            font-weight: 600;
            display: block;
            margin-bottom: 5px;
        }

        input {
            width: 100%;
            padding: 12px 14px;
            border-radius: 10px;
            border: none;
            outline: none;
            background: rgba(255, 255, 255, 0.7);
            color: #222;
            margin-bottom: 10px;
            transition: box-shadow 0.3s;
        }

        input:focus {
            box-shadow: 0 0 0 3px rgba(99, 102, 241, 0.5);
        }

        .btn {
            width: 100%;
            padding: 12px;
            border: none;
            background: #4f46e5;
            color: white;
            font-weight: bold;
            border-radius: 10px;
            cursor: pointer;
            transition: 0.3s;
            box-shadow: 0 4px 10px rgba(99, 102, 241, 0.4);
        }

        .btn:hover {
            background: #4338ca;
        }

        .text-center {
            text-align: center;
            margin-top: 15px;
        }

        .text-center a {
            color: rgba(255, 255, 255, 0.8);
            text-decoration: none;
        }

        .text-center a:hover {
            text-decoration: underline;
        }

        /* Password toggle */
        .password-wrapper {
            position: relative;
        }

        .toggle-password {
            position: absolute;
            right: 12px;
            top: 50%;
            transform: translateY(-50%);
            cursor: pointer;
            color: #444;
        }

        /* Strength bar */
        .strength-bar {
            height: 6px;
            width: 100%;
            background: rgba(255, 255, 255, 0.3);
            border-radius: 6px;
            overflow: hidden;
            margin-top: 5px;
        }

        .strength-fill {
            height: 6px;
            width: 0;
            border-radius: 6px;
            transition: width 0.3s ease;
        }

        .strength-text {
            font-size: 13px;
            margin-top: 5px;
        }
    </style>
</head>

<body>
    <div class="blur-circle blur1"></div>
    <div class="blur-circle blur2"></div>

    <div class="card">
        <h1>Reset Password</h1>
        <p>Masukkan email dan password baru Anda.</p>

        <form method="POST" action="{{ route('password.store') }}">
            @csrf
            <input type="hidden" name="token" value="{{ $request->route('token') }}">

            <label>Email</label>
            <input type="email" name="email" placeholder="Email" value="{{ old('email', $request->email) }}"
                required>

            <label>Password Baru</label>
            <div class="password-wrapper">
                <input type="password" id="password" name="password" placeholder="Password baru" required>
                <span class="toggle-password" id="togglePassword">👁️</span>
            </div>

            <div class="strength-bar">
                <div id="strengthBar" class="strength-fill"></div>
            </div>
            <p id="strengthText" class="strength-text"></p>

            <label>Konfirmasi Password</label>
            <input type="password" id="password_confirmation" name="password_confirmation"
                placeholder="Konfirmasi password" required>

            <button type="submit" class="btn">Reset Password</button>

            <p class="text-center"><a href="{{ route('login') }}">Kembali ke Login</a></p>
        </form>
    </div>

    <script>
        const password = document.getElementById('password');
        const passwordConfirmation = document.getElementById('password_confirmation');
        const togglePassword = document.getElementById('togglePassword');
        const bar = document.getElementById('strengthBar');
        const text = document.getElementById('strengthText');

        togglePassword.addEventListener('click', () => {
            const isHidden = password.type === 'password';
            password.type = isHidden ? 'text' : 'password';
            passwordConfirmation.type = isHidden ? 'text' : 'password';
            togglePassword.textContent = isHidden ? '🙈' : '👁️';
        });

        password.addEventListener('input', () => {
            const val = password.value;
            let strength = 0;

            if (val.length >= 6) strength++;
            if (/[a-z]/.test(val)) strength++;
            if (/[A-Z]/.test(val)) strength++;
            if (/[0-9]/.test(val)) strength++;
            if (/[^a-zA-Z0-9]/.test(val)) strength++;

            const width = (strength / 5) * 100;
            bar.style.width = width + "%";

            if (strength <= 2) {
                bar.style.background = "#ef4444";
                text.textContent = "Lemah";
                text.style.color = "#ef4444";
            } else if (strength === 3 || strength === 4) {
                bar.style.background = "#facc15";
                text.textContent = "Sedang";
                text.style.color = "#facc15";
            } else {
                bar.style.background = "#22c55e";
                text.textContent = "Kuat";
                text.style.color = "#22c55e";
            }
        });
    </script>
</body>

</html>
