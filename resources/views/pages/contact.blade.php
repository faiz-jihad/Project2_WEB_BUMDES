@extends('layouts.master')

@section('title', 'Kontak Kami')

@section('content')
    <div style="font-family: 'Poppins', sans-serif; overflow-x:hidden;">

        {{-- HERO CONTACT --}}
        <section
            class="hero-contact position-relative text-white text-center d-flex align-items-center justify-content-center overflow-hidden"
            style="height:60vh;">
            <div class="hero-slideshow position-absolute w-100 h-100">
                <div class="slide active" style="background-image: url('{{ asset('images/bgutama.jpg') }}');"></div>
            </div>
            <div class="position-absolute top-0 start-0 w-100 h-100"
                style="background: linear-gradient(to bottom, rgba(0,0,0,0.4), rgba(0,0,0,0.85));"></div>
            <div class="text-center px-3 hero-content" data-aos="fade-up" data-aos-duration="1200">
                <h1 class="fw-bold display-4 mb-2 text-uppercase" style="letter-spacing:1px;">
                    Hubungi <span class="text-success">Kami</span>
                </h1>
                <p class="lead mb-4 text-light">Kami siap membantu dan mendengarkan kebutuhan Anda</p>
            </div>
        </section>

        {{-- KONTAK INFO --}}
        <section class="py-5 bg-light">
            <div class="container">
                <div class="text-center mb-5" data-aos="fade-down">
                    <h2 class="fw-bold text-success">Informasi Kontak</h2>
                    <p class="text-muted">Berbagai cara untuk menghubungi kami</p>
                </div>
                <div class="row g-4">
                    <div class="col-md-4" data-aos="fade-up" data-aos-delay="100">
                        <div class="contact-card card border-0 shadow-lg text-center h-100">
                            <div class="card-body">
                                <div class="contact-icon mb-3">
                                    <i class="bi bi-geo-alt-fill display-4 text-success"></i>
                                </div>
                                <h5 class="card-title fw-bold">Lokasi</h5>
                                <p class="card-text">Bayalangu Kidul, Kabupaten Indramayu, Jawa Barat</p>
                                <a href="https://maps.google.com/?q=Bayalangu+Kidul,+Indramayu" target="_blank"
                                    class="btn btn-outline-success">
                                    <i class="bi bi-map me-2"></i>Lihat di Maps
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4" data-aos="fade-up" data-aos-delay="200">
                        <div class="contact-card card border-0 shadow-lg text-center h-100">
                            <div class="card-body">
                                <div class="contact-icon mb-3">
                                    <i class="bi bi-telephone-fill display-4 text-success"></i>
                                </div>
                                <h5 class="card-title fw-bold">Telepon</h5>
                                <p class="card-text">+62 123 4567 890</p>
                                <p class="card-text text-muted">Senin - Jumat: 08:00 - 17:00 WIB</p>
                                <a href="tel:+621234567890" class="btn btn-outline-success">
                                    <i class="bi bi-telephone me-2"></i>Hubungi Sekarang
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4" data-aos="fade-up" data-aos-delay="300">
                        <div class="contact-card card border-0 shadow-lg text-center h-100">
                            <div class="card-body">
                                <div class="contact-icon mb-3">
                                    <i class="bi bi-envelope-fill display-4 text-success"></i>
                                </div>
                                <h5 class="card-title fw-bold">Email</h5>
                                <p class="card-text">info@bumdesmadusari.id</p>
                                <p class="card-text text-muted">Kami akan merespons dalam 24 jam</p>
                                <a href="mailto:info@bumdesmadusari.id" class="btn btn-outline-success">
                                    <i class="bi bi-envelope me-2"></i>Kirim Email
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        {{-- FORM KONTAK & MAP --}}
        <section class="py-5">
            <div class="container">
                <div class="row g-5">
                    <div class="col-lg-6" data-aos="fade-right">
                        <h3 class="fw-bold text-success mb-4">Kirim Pesan</h3>
                        <form id="contactForm" action="{{ route('contact.kirim') }}" method="POST" class="needs-validation"
                            novalidate>
                            @csrf
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <label for="nama" class="form-label fw-semibold">Nama Lengkap</label>
                                    <input type="text" class="form-control" id="nama" name="nama" required>
                                    <div class="invalid-feedback">Nama wajib diisi.</div>
                                </div>
                                <div class="col-md-6">
                                    <label for="email" class="form-label fw-semibold">Email</label>
                                    <input type="email" class="form-control" id="email" name="email" required>
                                    <div class="invalid-feedback">Email valid diperlukan.</div>
                                </div>
                                <div class="col-12">
                                    <label for="subjek" class="form-label fw-semibold">Subjek</label>
                                    <input type="text" class="form-control" id="subjek" name="subjek" required>
                                    <div class="invalid-feedback">Subjek wajib diisi.</div>
                                </div>
                                <div class="col-12">
                                    <label for="pesan" class="form-label fw-semibold">Pesan</label>
                                    <textarea class="form-control" id="pesan" name="pesan" rows="5" required></textarea>
                                    <div class="invalid-feedback">Pesan wajib diisi.</div>
                                </div>
                                <div class="col-12">
                                    <button type="submit" class="btn btn-success btn-lg px-5">
                                        <i class="bi bi-send me-2"></i>Kirim Pesan
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="col-lg-6" data-aos="fade-left">
                        <h3 class="fw-bold text-success mb-4">Lokasi Kami</h3>
                        <div class="map-container shadow-lg rounded-4 overflow-hidden">
                            <iframe
                                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3960.902!2d107.889!3d-6.456!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x0!2zNsKwMjcnMjEuNiJTIDEwN8KwNTMnMjQuMCJF!5e0!3m2!1sen!2sid!4v1635000000000!5m2!1sen!2sid"
                                width="100%" height="400" style="border:0;" allowfullscreen="" loading="lazy">
                            </iframe>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        {{-- SOSIAL MEDIA --}}
        <section class="py-5 bg-success text-white">
            <div class="container">
                <div class="text-center mb-5" data-aos="zoom-in">
                    <h2 class="fw-bold">Ikuti Kami</h2>
                    <p class="mb-0">Terhubung dengan kami di media sosial</p>
                </div>
                <div class="row justify-content-center">
                    <div class="col-md-8">
                        <div class="row g-4">
                            <div class="col-6 col-md-3 text-center" data-aos="fade-up" data-aos-delay="100">
                                <a href="#" class="social-link">
                                    <div class="social-icon mb-2">
                                        <i class="bi bi-facebook display-4"></i>
                                    </div>
                                    <h6 class="mb-0">Facebook</h6>
                                </a>
                            </div>
                            <div class="col-6 col-md-3 text-center" data-aos="fade-up" data-aos-delay="200">
                                <a href="#" class="social-link">
                                    <div class="social-icon mb-2">
                                        <i class="bi bi-instagram display-4"></i>
                                    </div>
                                    <h6 class="mb-0">Instagram</h6>
                                </a>
                            </div>
                            <div class="col-6 col-md-3 text-center" data-aos="fade-up" data-aos-delay="300">
                                <a href="#" class="social-link">
                                    <div class="social-icon mb-2">
                                        <i class="bi bi-twitter display-4"></i>
                                    </div>
                                    <h6 class="mb-0">Twitter</h6>
                                </a>
                            </div>
                            <div class="col-6 col-md-3 text-center" data-aos="fade-up" data-aos-delay="400">
                                <a href="#" class="social-link">
                                    <div class="social-icon mb-2">
                                        <i class="bi bi-youtube display-4"></i>
                                    </div>
                                    <h6 class="mb-0">YouTube</h6>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        {{-- FAQ --}}
        <section class="py-5 bg-light">
            <div class="container">
                <div class="text-center mb-5" data-aos="fade-down">
                    <h2 class="fw-bold text-success">Pertanyaan Umum</h2>
                    <p class="text-muted">Jawaban atas pertanyaan yang sering ditanyakan</p>
                </div>
                <div class="row justify-content-center">
                    <div class="col-lg-8">
                        <div class="accordion" id="faqAccordion">
                            <div class="accordion-item" data-aos="fade-up" data-aos-delay="100">
                                <h2 class="accordion-header">
                                    <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#faq1">
                                        Bagaimana cara membeli produk BUMDes?
                                    </button>
                                </h2>
                                <div id="faq1" class="accordion-collapse collapse show"
                                    data-bs-parent="#faqAccordion">
                                    <div class="accordion-body">
                                        Anda dapat membeli produk kami melalui website ini dengan mendaftar akun terlebih
                                        dahulu, kemudian pilih produk yang diinginkan dan lakukan checkout.
                                    </div>
                                </div>
                            </div>
                            <div class="accordion-item" data-aos="fade-up" data-aos-delay="200">
                                <h2 class="accordion-header">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#faq2">
                                        Apakah ada pengiriman ke luar daerah?
                                    </button>
                                </h2>
                                <div id="faq2" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                                    <div class="accordion-body">
                                        Ya, kami melayani pengiriman ke seluruh Indonesia dengan biaya sesuai jarak dan
                                        berat produk.
                                    </div>
                                </div>
                            </div>
                            <div class="accordion-item" data-aos="fade-up" data-aos-delay="300">
                                <h2 class="accordion-header">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#faq3">
                                        Bagaimana cara bergabung sebagai mitra?
                                    </button>
                                </h2>
                                <div id="faq3" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                                    <div class="accordion-body">
                                        Untuk bergabung sebagai mitra, silakan hubungi kami melalui email atau telepon untuk
                                        mendapatkan informasi lebih lanjut tentang program kemitraan.
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

    </div>

    {{-- CSS --}}
    <link href="https://unpkg.com/aos@next/dist/aos.css" rel="stylesheet">

    {{-- JS --}}
    <script src="https://unpkg.com/aos@next/dist/aos.js" defer></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" defer></script>

    <script defer>
        document.addEventListener("DOMContentLoaded", () => {
            // AOS Init
            AOS.init({
                once: true,
                duration: 1000
            });

            // Form validation
            const contactForm = document.getElementById('contactForm');
            if (contactForm) {
                contactForm.addEventListener('submit', function(event) {
                    if (!contactForm.checkValidity()) {
                        event.preventDefault();
                        event.stopPropagation();
                        contactForm.classList.add('was-validated');
                        return;
                    }
                    const submitBtn = contactForm.querySelector('button[type="submit"]');
                    if (submitBtn) {
                        submitBtn.disabled = true;
                        submitBtn.innerHTML = '<i class="bi bi-hourglass-split me-2"></i>Mengirim...';
                    }
                }, false);
            }

            // Show success/error messages
            @if (session('success'))
                showToast('{{ session('success') }}', 'success');
            @endif

            @if (session('error'))
                showToast('{{ session('error') }}', 'error');
            @endif
        });

        // Toast notification function
        function showToast(message, type = 'info') {
            const toastContainer = document.createElement('div');
            toastContainer.className = 'toast-container position-fixed top-0 end-0 p-3';
            toastContainer.style.zIndex = '9999';

            const toast = document.createElement('div');
            toast.className =
            `toast align-items-center text-white bg-${type === 'success' ? 'success' : 'danger'} border-0`;
            toast.setAttribute('role', 'alert');
            toast.setAttribute('aria-live', 'assertive');
            toast.setAttribute('aria-atomic', 'true');

            toast.innerHTML = `
                <div class="d-flex">
                    <div class="toast-body">
                        <i class="bi bi-${type === 'success' ? 'check-circle' : 'exclamation-circle'} me-2"></i>
                        ${message}
                    </div>
                    <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast"></button>
                </div>
            `;

            toastContainer.appendChild(toast);
            document.body.appendChild(toastContainer);

            const bsToast = new bootstrap.Toast(toast);
            bsToast.show();

            // Remove toast after it's hidden
            toast.addEventListener('hidden.bs.toast', () => {
                toastContainer.remove();
            });
        }
    </script>

    <style>
        .hero-contact {
            background: linear-gradient(135deg, #198754 0%, #146c43 100%);
        }

        .hero-slideshow {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            overflow: hidden;
        }

        .slide {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-size: cover;
            background-position: center;
            opacity: 0;
            transition: opacity 2.5s ease-in-out;
        }

        .slide.active {
            opacity: 1;
        }

        .hero-content {
            position: relative;
            z-index: 3;
            animation: fadeIn 1.5s ease forwards;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(25px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .contact-card {
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .contact-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15) !important;
        }

        .contact-icon {
            transition: transform 0.3s ease;
        }

        .contact-card:hover .contact-icon {
            transform: scale(1.1);
        }

        .social-link {
            color: white;
            text-decoration: none;
            transition: transform 0.3s ease;
        }

        .social-link:hover {
            color: white;
            transform: translateY(-5px);
        }

        .social-icon {
            transition: transform 0.3s ease;
        }

        .social-link:hover .social-icon {
            transform: scale(1.1);
        }

        .map-container {
            border-radius: 15px;
            overflow: hidden;
        }

        .accordion-button:not(.collapsed) {
            background-color: rgba(25, 135, 84, 0.1);
            color: #198754;
        }

        .accordion-button:focus {
            box-shadow: 0 0 0 0.2rem rgba(25, 135, 84, 0.25);
        }
    </style>
@endsection
