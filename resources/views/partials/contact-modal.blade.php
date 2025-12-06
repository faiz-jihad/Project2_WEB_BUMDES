<!-- Contact Modal -->
<div class="modal fade" id="contactModal" tabindex="-1" aria-labelledby="contactModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="contactModalLabel">
                    <i class="fas fa-envelope me-2"></i>Kirim Pesan ke BUMDes Madusari
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="contactForm">
                    @csrf
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="name" class="form-label">Nama Lengkap <span
                                    class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="name" name="name" required>
                            <div class="invalid-feedback">
                                Nama lengkap wajib diisi.
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="email" class="form-label">Email <span class="text-danger">*</span></label>
                            <input type="email" class="form-control" id="email" name="email" required>
                            <div class="invalid-feedback">
                                Email yang valid wajib diisi.
                            </div>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="phone" class="form-label">Nomor Telepon</label>
                        <input type="tel" class="form-control" id="phone" name="phone">
                        <div class="form-text">Opsional, untuk follow-up lebih lanjut</div>
                    </div>

                    <div class="mb-3">
                        <label for="subject" class="form-label">Subjek <span class="text-danger">*</span></label>
                        <select class="form-select" id="subject" name="subject" required>
                            <option value="">Pilih subjek pesan</option>
                            <option value="informasi">Informasi Produk</option>
                            <option value="kerjasama">Kerjasama Bisnis</option>
                            <option value="keluhan">Keluhan/Pengaduan</option>
                            <option value="saran">Saran & Masukan</option>
                            <option value="umkm">Pendaftaran UMKM</option>
                            <option value="lainnya">Lainnya</option>
                        </select>
                        <div class="invalid-feedback">
                            Subjek pesan wajib dipilih.
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="message" class="form-label">Pesan <span class="text-danger">*</span></label>
                        <textarea class="form-control" id="message" name="message" rows="5" required
                            placeholder="Tuliskan pesan Anda di sini..."></textarea>
                        <div class="invalid-feedback">
                            Pesan wajib diisi.
                        </div>
                    </div>

                    <div class="mb-3">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="newsletter" name="newsletter">
                            <label class="form-check-label" for="newsletter">
                                Saya ingin menerima informasi terbaru dari BUMDes Madusari
                            </label>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                    <i class="fas fa-times me-1"></i>Batal
                </button>
                <button type="submit" form="contactForm" class="btn btn-success">
                    <i class="fas fa-paper-plane me-1"></i>Kirim Pesan
                </button>
            </div>
        </div>
    </div>
</div>

<style>
    /* Contact Modal Styles */
    .modal-content {
        border: none;
        border-radius: 12px;
        box-shadow: 0 20px 60px rgba(0, 0, 0, 0.2);
    }

    .modal-header {
        background: linear-gradient(135deg, #198754, #146c43);
        color: white;
        border: none;
        border-radius: 12px 12px 0 0;
        padding: 1.5rem;
    }

    .modal-title {
        font-weight: 600;
        margin: 0;
    }

    .btn-close {
        background-color: rgba(255, 255, 255, 0.8);
        border-radius: 50%;
        width: 32px;
        height: 32px;
    }

    .btn-close:hover {
        background-color: white;
    }

    .modal-body {
        padding: 2rem;
    }

    .form-label {
        font-weight: 600;
        color: #374151;
        margin-bottom: 0.5rem;
    }

    .form-control,
    .form-select {
        border: 2px solid #e5e7eb;
        border-radius: 8px;
        padding: 0.75rem;
        font-size: 0.95rem;
        transition: all 0.3s ease;
    }

    .form-control:focus,
    .form-select:focus {
        border-color: #198754;
        box-shadow: 0 0 0 3px rgba(25, 135, 84, 0.1);
        outline: none;
    }

    .form-control::placeholder {
        color: #9ca3af;
    }

    .form-text {
        font-size: 0.85rem;
        color: #6b7280;
        margin-top: 0.25rem;
    }

    .form-check {
        margin-top: 1rem;
    }

    .form-check-input:checked {
        background-color: #198754;
        border-color: #198754;
    }

    .form-check-label {
        color: #374151;
        font-size: 0.9rem;
    }

    .modal-footer {
        border: none;
        padding: 1.5rem 2rem;
        background: #f9fafb;
        border-radius: 0 0 12px 12px;
    }

    .btn {
        padding: 0.75rem 1.5rem;
        border-radius: 8px;
        font-weight: 600;
        transition: all 0.3s ease;
        border: none;
    }

    .btn-secondary {
        background: #6b7280;
    }

    .btn-secondary:hover {
        background: #4b5563;
        transform: translateY(-1px);
    }

    .btn-success {
        background: linear-gradient(135deg, #198754, #146c43);
    }

    .btn-success:hover {
        background: linear-gradient(135deg, #146c43, #0f5132);
        transform: translateY(-1px);
        box-shadow: 0 4px 12px rgba(25, 135, 84, 0.3);
    }

    .invalid-feedback {
        display: none;
        font-size: 0.85rem;
        margin-top: 0.25rem;
    }

    .was-validated .form-control:invalid,
    .was-validated .form-select:invalid {
        border-color: #dc3545;
    }

    .was-validated .form-control:invalid:focus,
    .was-validated .form-select:invalid:focus {
        border-color: #dc3545;
        box-shadow: 0 0 0 3px rgba(220, 53, 69, 0.1);
    }

    .was-validated .invalid-feedback {
        display: block;
    }

    /* Responsive */
    @media (max-width: 768px) {
        .modal-dialog {
            margin: 1rem;
        }

        .modal-header,
        .modal-body,
        .modal-footer {
            padding: 1rem;
        }

        .modal-title {
            font-size: 1.1rem;
        }

        .btn {
            padding: 0.6rem 1.2rem;
            font-size: 0.9rem;
        }
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const contactForm = document.getElementById('contactForm');

        if (contactForm) {
            contactForm.addEventListener('submit', async function(e) {
                e.preventDefault();

                if (!this.checkValidity()) {
                    this.classList.add('was-validated');
                    return;
                }

                const submitBtn = this.querySelector('button[type="submit"]');
                const originalText = submitBtn.innerHTML;

                // Show loading state
                submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin me-1"></i>Mengirim...';
                submitBtn.disabled = true;

                try {
                    const formData = new FormData(this);

                    const response = await fetch('/contact/send', {
                        method: 'POST',
                        body: formData,
                        headers: {
                            'X-Requested-With': 'XMLHttpRequest',
                            'X-CSRF-TOKEN': document.querySelector(
                                'meta[name="csrf-token"]').getAttribute('content')
                        }
                    });

                    const result = await response.json();

                    if (response.ok) {
                        // Success
                        if (typeof Swal !== 'undefined') {
                            Swal.fire({
                                icon: 'success',
                                title: 'Berhasil!',
                                text: 'Pesan Anda telah berhasil dikirim. Kami akan segera menghubungi Anda.',
                                confirmButtonColor: '#198754'
                            });
                        } else {
                            alert('Pesan berhasil dikirim!');
                        }

                        // Reset form and close modal
                        this.reset();
                        this.classList.remove('was-validated');
                        const modal = bootstrap.Modal.getInstance(document.getElementById(
                            'contactModal'));
                        modal.hide();

                    } else {
                        // Error
                        throw new Error(result.message || 'Terjadi kesalahan saat mengirim pesan');
                    }

                } catch (error) {
                    console.error('Contact form error:', error);

                    if (typeof Swal !== 'undefined') {
                        Swal.fire({
                            icon: 'error',
                            title: 'Gagal!',
                            text: error.message ||
                                'Terjadi kesalahan saat mengirim pesan. Silakan coba lagi.',
                            confirmButtonColor: '#dc3545'
                        });
                    } else {
                        alert('Gagal mengirim pesan: ' + error.message);
                    }
                } finally {
                    // Reset button
                    submitBtn.innerHTML = originalText;
                    submitBtn.disabled = false;
                }
            });
        }
    });
</script>
