<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            color: #333;
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            background-color: #f4f4f4;
        }

        .container {
            background-color: #ffffff;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .header {
            text-align: center;
            margin-bottom: 30px;
        }

        .logo {
            font-size: 24px;
            font-weight: bold;
            color: #5b4df1;
            margin-bottom: 10px;
        }

        .title {
            font-size: 20px;
            color: #333;
            margin-bottom: 20px;
        }

        .content {
            margin-bottom: 30px;
        }

        .button {
            display: inline-block;
            background-color: #5b4df1;
            color: #ffffff;
            text-decoration: none;
            padding: 12px 30px;
            border-radius: 5px;
            font-weight: bold;
            text-align: center;
            margin: 20px 0;
        }

        .button:hover {
            background-color: #4b3ed6;
        }

        .footer {
            margin-top: 30px;
            padding-top: 20px;
            border-top: 1px solid #eee;
            font-size: 12px;
            color: #666;
            text-align: center;
        }

        .warning {
            background-color: #fff3cd;
            border: 1px solid #ffeaa7;
            color: #856404;
            padding: 15px;
            border-radius: 5px;
            margin: 20px 0;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="header">
            <div class="logo">{{ config('app.name') }}</div>
            <h1 class="title">Reset Password Anda</h1>
        </div>

        <div class="content">
            <p>Halo <strong>{{ $user->name }}</strong>,</p>

            <p>Anda menerima email ini karena kami menerima permintaan reset password untuk akun Anda.</p>

            <p>Klik tombol di bawah ini untuk mereset password Anda:</p>

            <div style="text-align: center;">
                <a href="{{ $resetUrl }}" class="button">Reset Password</a>
            </div>

            <div class="warning">
                <strong>Peringatan:</strong> Link ini akan kedaluwarsa dalam 60 menit. Jika Anda tidak meminta reset
                password, abaikan email ini.
            </div>

            <p>Jika tombol tidak berfungsi, Anda dapat menyalin dan menempelkan URL berikut ke browser Anda:</p>
            <p
                style="word-break: break-all; background-color: #f8f9fa; padding: 10px; border-radius: 5px; font-family: monospace; font-size: 12px;">
                {{ $resetUrl }}
            </p>
        </div>

        <div class="footer">
            <p>Email ini dikirim secara otomatis. Mohon jangan membalas email ini.</p>
            <p>&copy; {{ date('Y') }} {{ config('app.name') }}. All rights reserved.</p>
        </div>
    </div>
</body>

</html>
