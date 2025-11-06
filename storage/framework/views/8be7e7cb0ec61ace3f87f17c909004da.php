<!-- FOOTER -->
<footer class="footer">
    <div class="footer-container">
        <!-- Map -->
        <div class="footer-map">
            <iframe
                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d94785.86416288807!2d108.27500789166334!3d-6.625543742625704!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e6edd8be2a2be19%3A0xa32edfcca5dff2bc!2sBayalangu%20Kidul%2C%20Kec.%20Gegesik%2C%20Kabupaten%20Cirebon%2C%20Jawa%20Barat!5e1!3m2!1sid!2sid!4v1759338364051!5m2!1sid!2sid"
                allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade">
            </iframe>
        </div>

        <!-- Links -->
        <div class="footer-links">
            <div class="footer-section">
                <h3>Tentang</h3>
                <a href="<?php echo e(route('about')); ?>">Tentang Kami</a>
                <a href="<?php echo e(route('contact')); ?>">Kontak</a>
                <a href="<?php echo e(route('berita.index')); ?>">Berita</a>
            </div>
            <div class="footer-section">
                <h3>Layanan</h3>
                <a href="<?php echo e(route('produk.index')); ?>">Produk</a>
                <a href="<?php echo e(route('galeri.index')); ?>">Galeri</a>
                <a href="<?php echo e(route('beranda')); ?>">Beranda</a>
            </div>
            <div class="footer-section">
                <h3>Ikuti Kami</h3>
                <a href="#" target="_blank"><i class="bi bi-facebook"></i> Facebook</a>
                <a href="#" target="_blank"><i class="bi bi-twitter"></i> Twitter</a>
                <a href="#" target="_blank"><i class="bi bi-instagram"></i> Instagram</a>
            </div>
        </div>
    </div>

    <div class="footer-bottom">
        <p>&copy; <?php echo e(date('Y')); ?> BUMDes Madusari. Semua Hak Dilindungi.</p>
    </div>
</footer>

<style>
    /* Footer Styles - Efisien dan Responsif */
    :root {
        --green: #0c6435;
        --light-green: #16a34a;
        --white: #ffffff;
        --yellow: #ffc107;
    }

    .footer {
        background: var(--green);
        color: var(--white);
        padding: 40px 20px 20px;
        font-family: "Poppins", sans-serif;
    }

    .footer-container {
        display: grid;
        grid-template-columns: 1fr 2fr;
        gap: 40px;
        max-width: 1200px;
        margin: 0 auto;
        align-items: start;
    }

    .footer-map {
        border-radius: 12px;
        overflow: hidden;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
        transition: transform 0.3s ease;
    }

    .footer-map:hover {
        transform: scale(1.02);
    }

    .footer-map iframe {
        width: 100%;
        height: 250px;
        border: none;
    }

    .footer-links {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        gap: 30px;
    }

    .footer-section h3 {
        font-size: 1.1rem;
        font-weight: 600;
        margin-bottom: 15px;
        color: var(--white);
        border-left: 3px solid var(--light-green);
        padding-left: 10px;
    }

    .footer-section a {
        display: block;
        color: var(--white);
        text-decoration: none;
        font-size: 0.95rem;
        margin-bottom: 8px;
        transition: all 0.3s ease;
        padding: 5px 0;
    }

    .footer-section a:hover {
        color: var(--yellow);
        transform: translateX(5px);
    }

    .footer-section a i {
        margin-right: 8px;
        transition: transform 0.3s ease;
    }

    .footer-section a:hover i {
        transform: scale(1.1);
    }

    .footer-bottom {
        border-top: 1px solid rgba(255, 255, 255, 0.2);
        margin-top: 30px;
        padding-top: 15px;
        text-align: center;
        font-size: 0.9rem;
        color: rgba(255, 255, 255, 0.8);
    }

    /* Tablet */
    @media (max-width: 768px) {
        .footer-container {
            grid-template-columns: 1fr;
            gap: 30px;
        }

        .footer-map iframe {
            height: 200px;
        }

        .footer-links {
            grid-template-columns: repeat(2, 1fr);
            gap: 25px;
        }

        .footer {
            padding: 30px 15px 15px;
        }
    }

    /* Mobile */
    @media (max-width: 480px) {
        .footer-container {
            gap: 25px;
        }

        .footer-links {
            grid-template-columns: 1fr;
            gap: 20px;
        }

        .footer-section {
            text-align: center;
            padding: 15px;
            background: rgba(255, 255, 255, 0.05);
            border-radius: 10px;
            backdrop-filter: blur(5px);
        }

        .footer-section h3 {
            border-left: none;
            border-bottom: 2px solid var(--light-green);
            padding-left: 0;
            padding-bottom: 8px;
            margin-bottom: 12px;
        }

        .footer-map iframe {
            height: 180px;
        }

        .footer {
            padding: 25px 10px 15px;
        }

        .footer-bottom {
            font-size: 0.85rem;
            margin-top: 20px;
        }
    }
</style>
<?php /**PATH C:\laragon\www\belajar_laravel\resources\views/layouts/footer.blade.php ENDPATH**/ ?>