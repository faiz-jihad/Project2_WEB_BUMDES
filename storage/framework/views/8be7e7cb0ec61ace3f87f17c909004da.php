<!-- Footer -->
<footer class="bg-light py-5 mt-4">
    <div class="container">
        <div class="row gy-4">
            <!-- Map -->
            <div class="col-md-3 text-center">
                <div class="ratio ratio-4x3" style="min-width: 100%; max-width: 100%;">
                    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d94785.86416288807!2d108.27500789166334!3d-6.625543742625704!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e6edd8be2a2be19%3A0xa32edfcca5dff2bc!2sBayalangu%20Kidul%2C%20Kec.%20Gegesik%2C%20Kabupaten%20Cirebon%2C%20Jawa%20Barat!5e1!3m2!1sid!2sid!4v1759338364051!5m2!1sid!2sid" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                </div>
            </div>

            <!-- Links -->
            <div class="col-md-9">
                <div class="row">
                    <div class="col-md-4">
                        <h6 class="fw-bold">Tentang</h6>
                        <a href="#">Tentang Kami</a>
                        <a href="#">Kebijakan</a>
                        <a href="#">Program</a>
                        <a href="#">Kontak</a>
                    </div>
                    <div class="col-md-4">
                        <h6 class="fw-bold">Layanan</h6>
                        <a href="#">FAQ</a>
                        <a href="#">Bantuan</a>
                        <a href="#">Karir</a>
                    </div>
                    <div class="col-md-4">
                        <h6 class="fw-bold">Ikuti Kami</h6>
                        <a href="#"><i class="bi bi-facebook me-2"></i> Facebook</a>
                        <a href="#"><i class="bi bi-twitter me-2"></i> Twitter</a>
                        <a href="#"><i class="bi bi-instagram me-2"></i> Instagram</a>
                    </div>
                </div>
            </div>
        </div>

        <hr class="mt-4">
        <div class="text-center small text-muted">
            &copy; <?php echo e(date('Y')); ?> Bumdes Madusari. All rights reserved.
        </div>
    </div>
</footer>

<!-- Bootstrap JS & Icon -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet" />

<style>
    footer a {
        display: inline-block;
        position: relative;
        color: #000;
        text-decoration: none;
        margin-bottom: 8px;
        padding: 4px 6px;
        transition: all 0.3s ease;
    }

    footer a::after {
        content: "";
        position: absolute;
        left: 0;
        bottom: 0;
        width: 0%;
        height: 2px;
        background-color: #0d6efd;
        transition: width 0.3s ease;
    }

    footer a:hover {
        color: #0d6efd;
        background: linear-gradient(90deg, #e3f2fd 0%, #fff 100%);
        border-radius: 6px;
        box-shadow: 0 3px 10px rgba(13, 110, 253, 0.1);
        transform: translateY(-2px);
        /* efek naik sedikit */
    }

    footer a:hover::after {
        width: 100%;
    }
</style>
<?php /**PATH C:\laragon\www\belajar_laravel\resources\views/layouts/footer.blade.php ENDPATH**/ ?>