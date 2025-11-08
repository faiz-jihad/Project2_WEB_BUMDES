<!doctype html>
<html lang="id">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width,initial-scale=1" />
    <title>404 — Halaman Tidak Ditemukan</title>
    <meta name="description"
        content="404 — Halaman tidak ditemukan. Kembali ke beranda pertanian atau cari yang kamu butuhkan." />
    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0
        }

        html,
        body {
            height: 100%
        }

        body {
            font-family: Inter, ui-sans-serif, system-ui, -apple-system, Segoe UI, Roboto, "Helvetica Neue", Arial;
            background: linear-gradient(180deg, #1b5e20 0%, #2e7d32 60%);
            color: #f1f8e9;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 32px;
        }

        .card {
            width: 100%;
            max-width: 1000px;
            background: rgba(255, 255, 255, 0.05);
            border: 1px solid rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(8px);
            border-radius: 18px;
            padding: 36px;
            display: grid;
            grid-template-columns: 1fr 400px;
            gap: 28px;
            align-items: center;
            box-shadow: 0 8px 30px rgba(27, 94, 32, 0.5);
        }

        .info h1 {
            font-size: 72px;
            line-height: 0.85;
            margin-bottom: 6px;
            color: #c8e6c9
        }

        .muted {
            color: rgba(241, 248, 233, 0.7);
            font-size: 16px;
            margin-bottom: 18px
        }

        .desc {
            font-size: 18px;
            color: rgba(241, 248, 233, 0.9);
            margin-bottom: 22px;
            max-width: 60ch
        }

        .actions {
            display: flex;
            gap: 12px;
            align-items: center
        }

        .btn {
            background: linear-gradient(90deg, #a5d6a7, #66bb6a);
            color: #1b5e20;
            padding: 12px 18px;
            border-radius: 12px;
            border: none;
            font-weight: 600;
            cursor: pointer;
            box-shadow: 0 6px 18px rgba(102, 187, 106, 0.3);
            transition: transform .18s ease, box-shadow .18s ease
        }

        .btn:active {
            transform: translateY(1px)
        }

        .btn.ghost {
            background: transparent;
            color: #dcedc8;
            border: 1px solid rgba(255, 255, 255, 0.2);
            box-shadow: none
        }

        .search {
            display: flex;
            gap: 8px;
            margin-top: 10px
        }

        .search input {
            flex: 1;
            padding: 12px 14px;
            border-radius: 10px;
            border: 1px solid rgba(255, 255, 255, 0.1);
            background: rgba(255, 255, 255, 0.1);
            color: inherit
        }

        .scene {
            position: relative;
            height: 340px;
            display: flex;
            align-items: center;
            justify-content: center
        }

        .farm {
            width: 100%;
            height: 100%;
            position: relative
        }

        .field {
            position: absolute;
            bottom: 0;
            width: 100%;
            height: 60%;
            background: linear-gradient(to top, #33691e, #558b2f 60%);
            border-radius: 50%/20%;
        }

        .barn {
            position: absolute;
            bottom: 25%;
            left: 35%;
            width: 120px;
            height: 100px;
            background: #d84315;
            border-radius: 6px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.3)
        }

        .roof {
            position: absolute;
            bottom: calc(25% + 100px);
            left: 35%;
            width: 120px;
            height: 60px;
            background: #bf360c;
            clip-path: polygon(0 100%, 50% 0, 100% 100%)
        }

        .sun {
            position: absolute;
            top: 20%;
            right: 15%;
            width: 80px;
            height: 80px;
            background: #ffeb3b;
            border-radius: 50%;
            box-shadow: 0 0 40px #ffeb3b
        }

        @media (max-width:920px) {
            .card {
                grid-template-columns: 1fr;
                padding: 24px
            }

            .scene {
                height: 260px
            }
        }

        @media (max-width:520px) {
            .info h1 {
                font-size: 44px
            }

            .desc {
                font-size: 15px
            }
        }
    </style>
</head>

<body>
    <main class="card" role="main" aria-labelledby="title">
        <section class="info">
            <h1 id="title">404</h1>
            <div class="muted">Ups — Ladang yang kamu cari tidak ditemukan 🌾</div>
            <p class="desc">Mungkin halaman ini sudah dipanen atau berpindah ladang. Coba kembali ke beranda
                pertanian, atau cari informasi lain yang tumbuh di sini.</p>

            <div class="actions">
                <button class="btn" id="homeBtn" onclick="goHome()" aria-label="Kembali ke beranda">Kembali ke
                    Beranda</button>
                <button class="btn ghost" onclick="report()" aria-label="Laporkan kesalahan">Laporkan masalah</button>
            </div>

            <form class="search" onsubmit="event.preventDefault(); doSearch();">
                <input id="searchInput" type="search" placeholder="Cari topik pertanian..."
                    aria-label="Cari halaman" />
                <button class="btn" type="submit">Cari</button>
            </form>
        </section>

        <aside class="scene" aria-hidden="true">
            <div class="farm">
                <div class="sun"></div>
                <div class="roof"></div>
                <div class="barn"></div>
                <div class="field"></div>
            </div>
        </aside>
    </main>

    <script>
        function goHome() {
            window.location.href = '/';
        }

        function report() {
            alert('Terima kasih! Masalah akan ditinjau.');
        }

        function doSearch() {
            const q = document.getElementById('searchInput').value.trim();
            if (!q) return;
            const site = location.hostname;
            const target = `https://www.google.com/search?q=site:${site}+${encodeURIComponent(q)}`;
            window.open(target, '_blank');
        }
    </script>
</body>

</html>
