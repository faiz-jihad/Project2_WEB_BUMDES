<!-- Footer -->
<footer class="py-5 mt-4">
    <div class="container">
        <div class="row gy-4">
            <!-- Map -->
            <div class="col-12 col-md-3 text-center">
                <div class="ratio ratio-4x3" style="min-width: 100%; max-width: 100%;">
                    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d94785.86416288807!2d108.27500789166334!3d-6.625543742625704!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e6edd8be2a2be19%3A0xa32edfcca5dff2bc!2sBayalangu%20Kidul%2C%20Kec.%20Gegesik%2C%20Kabupaten%20Cirebon%2C%20Jawa%20Barat!5e1!3m2!1sid!2sid!4v1759338364051!5m2!1sid!2sid" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                </div>
            </div>

            <!-- Links -->
            <div class="col-12 col-md-8">
                <div class="row">
                    <div class="col-12 col-md-4 mb-3">
                        <h6 class="fw-bold">Tentang</h6>
                        <nav>
                            <a href="#">Tentang Kami</a>
                            <a href="#">Kebijakan</a>
                            <a href="#">Program</a>
                            <a href="#">Kontak</a>
                        </nav>
                    </div>
                    <div class="col-12 col-md-4 mb-3">
                        <h6 class="fw-bold">Layanan</h6>
                        <nav>
                            <a href="#">FAQ</a>
                            <a href="#">Bantuan</a>
                            <a href="#">Karir</a>
                        </nav>
                    </div>
                    <div class="col-12 col-md-4 mb-3">
                        <h6 class="fw-bold">Ikuti Kami</h6>
                        <nav>
                            <a href="#" aria-label="Facebook"><i class="bi bi-facebook me-2"></i>Facebook</a>
                            <a href="#" aria-label="Twitter"><i class="bi bi-twitter me-2"></i>Twitter</a>
                            <a href="#" aria-label="Instagram"><i class="bi bi-instagram me-2"></i>Instagram</a>
                        </nav>
                    </div>
                </div>
            </div>
        </div>

        <hr class="mt-4 bg-light">
        <div class="text-center small text-light">
            &copy; {{ date('Y') }} Bumdes Madusari. All rights reserved.
        </div>
    </div>
</footer>

<!-- Bootstrap JS & Icon -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet" />

<!-- Footer CSS -->
<style>
footer {
    background-color: #0c6435; /* hijau utama */
    padding: 40px 20px;
    text-align: center;
}

footer h6 {
    color: #ffffff;
    margin-bottom: 15px;
}

footer a {
    display: block;
    color: #ffffff;
    text-decoration: none;
    margin-bottom: 8px;
    padding: 6px 10px;
    position: relative;
    transition: all 0.3s ease;
    border-radius: 6px;
}

footer a::after {
    content: "";
    position: absolute;
    left: 0;
    bottom: 0;
    width: 0%;
    height: 2px;
    background-color: #ffffff;
    transition: width 0.4s ease, opacity 0.4s ease;
    opacity: 0;
}

footer a:hover::after {
    width: 100%;
    opacity: 1;
}

footer a:hover {
    transform: translateY(-5px) scale(1.05);
    color: #128548;
    background: linear-gradient(90deg, #ffffff 0%, #d9f2e6 100%);
    box-shadow: 0 6px 15px rgba(255,255,255,0.2);
}

footer a i {
    transition: transform 0.3s ease, color 0.3s ease;
}

footer a:hover i {
    transform: rotate(-15deg) scale(1.2);
    color: #128548;
}

footer iframe {
    transition: transform 0.3s ease, box-shadow 0.3s ease;
    border-radius: 10px;
}

footer iframe:hover {
    transform: scale(1.05);
    box-shadow: 0 10px 25px rgba(0,0,0,0.3);
}

@media (max-width: 768px) {
    footer a {
        display: inline-block;
        margin-right: 10px;
    }
}
</style>

<!-- Smooth Scroll for Footer Links -->
<script>
document.querySelectorAll('footer a[href^="#"]').forEach(anchor => {
    anchor.addEventListener('click', function(e) {
        e.preventDefault();
        document.querySelector(this.getAttribute('href'))
                .scrollIntoView({ behavior: 'smooth' });
    });
});
</script>
