<!-- 🌿 FOOTER -->
<footer class="footer">
    <div class="footer-container">
        <!-- Map -->
        <div class="footer-map">
            <iframe
                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d94785.86416288807!2d108.27500789166334!3d-6.625543742625704!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e6edd8be2a2be19%3A0xa32edfcca5dff2bc!2sBayalangu%20Kidul%2C%20Kec.%20Gegesik%2C%20Kabupaten%20Cirebon%2C%20Jawa%20Barat!5e1!3m2!1sid!2sid!4v1759338364051!5m2!1sid!2sid"
                style="border:0;" allowfullscreen="" loading="lazy">
            </iframe>
        </div>

        <!-- Links -->
        <div class="footer-links">
            <div>
                <h3>Tentang</h3>
                <a href="#">Tentang Kami</a>
                <a href="#">Kebijakan</a>
                <a href="#">Program</a>
                <a href="#">Kontak</a>
            </div>
            <div>
                <h3>Layanan</h3>
                <a href="#">FAQ</a>
                <a href="#">Bantuan</a>
                <a href="#">Karir</a>
            </div>
            <div>
                <h3>Ikuti Kami</h3>
                <a href="#"><i class="bi bi-facebook"></i> Facebook</a>
                <a href="#"><i class="bi bi-twitter"></i> Twitter</a>
                <a href="#"><i class="bi bi-instagram"></i> Instagram</a>
            </div>
        </div>
    </div>

    <div class="footer-bottom">
        <p>&copy; {{ date('Y') }} BUMDes Madusari. Semua Hak Dilindungi.</p>
    </div>
</footer>

<!-- Icon CDN -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">

<!-- 🌿 CSS -->
<style>
    :root {
        --green: #0c6435;
        --light-green: #16a34a;
        --white: #ffffff;
        --yellow: #ffc107;
    }

    .footer {
        background: var(--green);
        color: var(--white);
        padding: 60px 30px 30px;
        text-align: center;
        font-family: "Poppins", sans-serif;
    }

    .footer-container {
        display: flex;
        flex-wrap: wrap;
        justify-content: space-between;
        align-items: flex-start;
        max-width: 1200px;
        margin: auto;
        gap: 40px;
    }

    .footer-map {
        flex: 1 1 300px;
        border-radius: 12px;
        overflow: hidden;
        box-shadow: 0 5px 20px rgba(0, 0, 0, 0.3);
        transition: transform 0.3s ease;
    }

    .footer-map:hover {
        transform: scale(1.03);
    }

    .footer-map iframe {
        width: 100%;
        height: 220px;
        border: none;
    }

    .footer-links {
        flex: 2 1 500px;
        display: flex;
        flex-wrap: wrap;
        justify-content: space-around;
        text-align: left;
    }

    .footer-links div {
        min-width: 150px;
    }

    .footer-links h3 {
        font-size: 1.1rem;
        margin-bottom: 12px;
        color: var(--white);
        border-left: 3px solid var(--light-green);
        padding-left: 8px;
    }

    .footer-links a {
        display: block;
        color: var(--white);
        text-decoration: none;
        font-size: 0.95rem;
        margin-bottom: 8px;
        transition: all 0.3s ease;
    }

    .footer-links a i {
        margin-right: 8px;
        transition: transform 0.3s ease;
    }

    .footer-links a:hover {
        color: var(--yellow);
        transform: translateX(4px);
    }

    .footer-links a:hover i {
        transform: scale(1.2) rotate(-10deg);
    }

    .footer-bottom {
        border-top: 1px solid rgba(255, 255, 255, 0.2);
        margin-top: 40px;
        padding-top: 15px;
        font-size: 0.9rem;
        color: #d1e7dd;
    }

    /* Responsif */
    @media (max-width: 900px) {
        .footer-container {
            flex-direction: column;
            align-items: center;
        }

        .footer-links {
            justify-content: center;
            text-align: center;
        }

        .footer-links div {
            margin-bottom: 20px;
        }
    }
</style>

<script>
    document.querySelectorAll('footer a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function(e) {
            e.preventDefault();
            document.querySelector(this.getAttribute('href'))
                ?.scrollIntoView({
                    behavior: 'smooth'
                });
        });
    });
</script>
