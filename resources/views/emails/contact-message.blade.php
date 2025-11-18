<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pesan Kontak Baru</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            line-height: 1.6;
            color: #333;
            max-width: 600px;
            margin: 0 auto;
            background-color: #f8f9fa;
        }

        .container {
            background-color: white;
            margin: 20px;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        .header {
            background: linear-gradient(135deg, #198754 0%, #146c43 100%);
            color: white;
            padding: 20px;
            border-radius: 8px 8px 0 0;
            text-align: center;
            margin: -30px -30px 30px -30px;
        }

        .header h1 {
            margin: 0;
            font-size: 24px;
            font-weight: 600;
        }

        .content {
            margin-bottom: 30px;
        }

        .field {
            margin-bottom: 20px;
            padding: 15px;
            background-color: #f8f9fa;
            border-radius: 6px;
            border-left: 4px solid #198754;
        }

        .field-label {
            font-weight: bold;
            color: #198754;
            margin-bottom: 5px;
            display: block;
        }

        .field-value {
            margin: 0;
            color: #333;
        }

        .message-content {
            background-color: #f8f9fa;
            padding: 20px;
            border-radius: 6px;
            border-left: 4px solid #198754;
            white-space: pre-wrap;
            font-family: 'Courier New', monospace;
        }

        .footer {
            margin-top: 30px;
            padding-top: 20px;
            border-top: 1px solid #dee2e6;
            text-align: center;
            color: #6c757d;
            font-size: 14px;
        }

        .logo {
            text-align: center;
            margin-bottom: 20px;
        }

        .logo img {
            max-width: 150px;
            height: auto;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="header">
            <div class="logo">
                <h1>BUMDes Madusari</h1>
            </div>
            <h1>Pesan Kontak Baru</h1>
            <p>Anda menerima pesan baru dari website</p>
        </div>

        <div class="content">
            <div class="field">
                <span class="field-label">Nama Pengirim:</span>
                <p class="field-value">{{ $nama }}</p>
            </div>

            <div class="field">
                <span class="field-label">Email Pengirim:</span>
                <p class="field-value">{{ $email }}</p>
            </div>

            <div class="field">
                <span class="field-label">Subjek:</span>
                <p class="field-value">{{ $subjek }}</p>
            </div>

            <div class="field">
                <span class="field-label">Pesan:</span>
                <div class="message-content">{{ $pesan }}</div>
            </div>
        </div>

        <div class="footer">
            <p><strong>BUMDes Madusari</strong></p>
            <p>Bayalangu Kidul, Kabupaten Indramayu</p>
            <p>Email ini dikirim secara otomatis dari sistem website BUMDes Madusari</p>
            <p>&copy; {{ date('Y') }} BUMDes Madusari. All rights reserved.</p>
        </div>
    </div>
</body>

</html>
