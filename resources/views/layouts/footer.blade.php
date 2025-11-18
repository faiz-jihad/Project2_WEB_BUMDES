<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Footer</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet" />
    <style>
        :root {
            --kuning: #ffc107;
            --putih: #ffffff;
            --hijau: #227c41;
        }

        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            font-family: "Poppins", sans-serif;
            background: #f8f9fa;
        }

        /* === FOOTER === */
        .footer-persib {
            background: linear-gradient(135deg, var(--hijau) 70%, #0c8216 100%);
            color: var(--putih);
            padding: 0 20px 40px;
        }

        .footer-container {
            max-width: 1200px;
            margin: 0 auto;
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
            align-items: stretch;
            justify-content: space-between;
            gap: 0;
            text-align: center;
        }

        .footer-column {
            /* Hilangkan padding untuk menghilangkan gap */
            padding: 0;
            position: relative;
            display: flex;
            flex-direction: column;
            justify-content: center;
            height: 100%;
        }

        /* Border kanan sebagai garis pembatas, lebih rapih dan tidak ada gap */
        .footer-column:not(:last-child) {
            border-right: 1px solid rgba(255, 255, 255, 0.3);
        }

        .footer-column h4 {
            font-size: 0.9rem;
            text-transform: uppercase;
            margin: 10px 0;
            letter-spacing: 1px;
            color: rgba(255, 255, 255, 0.8);
        }

        .footer-column a {
            color: var(--putih);
            text-decoration: none;
            font-weight: 600;
            transition: 0.3s;
            display: inline-block;
        }

        .footer-column a:hover {
            color: var(--kuning);
            transform: translateY(-2px);
        }

        .footer-logo {
            width: 90px;
            margin: 0 auto;
            display: block;
        }

        .social-icons {
            display: flex;
            justify-content: center;
            gap: 18px;
            margin-top: 10px;
        }

        .social-icons a {
            color: var(--putih);
            font-size: 1.4rem;
            transition: 0.3s;
        }

        .social-icons a:hover {
            color: var(--kuning);
            transform: scale(1.1);
        }

        .app-buttons {
            display: flex;
            justify-content: center;
            gap: 12px;
            flex-wrap: wrap;
            margin-top: 10px;
        }

        .app-buttons img {
            height: 42px;
            transition: transform 0.3s;
            cursor: pointer;
        }

        .app-buttons img:hover {
            transform: scale(1.05);
        }

        /* === Efek Ketik === */
        .footer-bottom {
            text-align: center;
            padding: 20px 20px 40px;
        }

        .footer-bottom h1 {
            font-size: 5rem;
            font-weight: 900;
            letter-spacing: 4px;
            color: var(--putih);
            white-space: nowrap;
            overflow: hidden;
            text-transform: uppercase;
            margin: 0;
        }

        .cursor {
            display: inline-block;
            color: var(--putih);
            font-weight: 300;
            animation: blink 0.8s infinite;
        }

        @keyframes blink {

            0%,
            50% {
                opacity: 1;
            }

            51%,
            100% {
                opacity: 0;
            }
        }

        /* === RESPONSIF === */
        @media (max-width: 992px) {
            .footer-bottom h1 {
                font-size: 3.5rem;
            }
        }

        @media (max-width: 768px) {
            .footer-container {
                grid-template-columns: 1fr 1fr;
            }

            .footer-bottom h1 {
                font-size: 3rem;
            }
        }

        @media (max-width: 576px) {
            .footer-container {
                grid-template-columns: 1fr;
            }

            .footer-column:not(:last-child) {
                border-right: none;
            }

            .footer-bottom h1 {
                font-size: 2.2rem;
                letter-spacing: 2px;
            }

            .social-icons a {
                font-size: 1.2rem;
            }

            .app-buttons img {
                height: 35px;
            }
        }

        @media (max-width: 400px) {
            .footer-bottom h1 {
                font-size: 1.8rem;
            }
        }
    </style>
</head>

<body>
    <!-- === FOOTER === -->
    <footer class="footer-persib">
        <div class="footer-container">
            <!-- Logo -->
            <div class="footer-column logo-column">
                <img src="{{ asset('images/bumdes.jpg') }}" class="footer-logo" />
            </div>

            <!-- Email -->
            <div class="footer-column">
                <h4>EMAIL</h4>
                <a href="mailto:bumdesmadusari@gmail.com">bumdesmadusari2025@gmail.com</a>
            </div>

            <!-- Media Sosial -->
            <div class="footer-column">
                <h4>MEDIA SOSIAL</h4>
                <div class="social-icons">
                    <a href="#" aria-label="Facebook"><i class="bi bi-facebook"></i></a>
                    <a href="#" aria-label="Instagram"><i class="bi bi-instagram"></i></a>
                    <a href="#" aria-label="X Twitter"><i class="bi bi-twitter-x"></i></a>
                    <a href="#" aria-label="LinkedIn"><i class="bi bi-linkedin"></i></a>
                </div>
            </div>

            <!-- Unduh Aplikasi -->
            <div class="footer-column">
                <h4>UNDUH APLIKASI</h4>
                <div class="app-buttons">
                    <a href="#">
                        <img src="https://upload.wikimedia.org/wikipedia/commons/7/78/Google_Play_Store_badge_EN.svg"
                            alt="Google Play" />
                    </a>
                </div>
            </div>
        </div>

        <div class="footer-bottom">
            <h1><span id="typing-text"></span><span class="cursor">|</span></h1>
        </div>
    </footer>

    <!-- === SCRIPT EFEK KETIK === -->
    <script>
        const texts = ["BERSAMA", "MEMBANGUN", "KEMAJUAN", "DAERAH"];
        let count = 0;
        let index = 0;
        let currentText = "";
        let letter = "";

        function type() {
            if (count === texts.length) count = 0;
            currentText = texts[count];
            letter = currentText.slice(0, ++index);
            document.getElementById("typing-text").textContent = letter;

            if (letter.length === currentText.length) {
                setTimeout(erase, 1200);
            } else {
                setTimeout(type, 150);
            }
        }

        function erase() {
            letter = currentText.slice(0, --index);
            document.getElementById("typing-text").textContent = letter;

            if (letter.length === 0) {
                count++;
                index = 0;
                setTimeout(type, 400);
            } else {
                setTimeout(erase, 50);
            }
        }

        document.addEventListener("DOMContentLoaded", type);
    </script>
</body>

</html>
