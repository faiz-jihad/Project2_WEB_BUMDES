@extends('layouts.master')

@section('content')
    <link rel="stylesheet" href="{{ asset('css/berita.css') }}">

    <main class="main-content">
        <!-- Laravel Notify -->
        @include('notify::components.notify')

        <!-- Header Section -->
        <section class="header-section">
            <!-- Main Header Card -->
            <div class="header-card">
                <h1 class="header-title">
                    <i class="bi bi-newspaper"></i>
                    Manajemen Berita Saya
                </h1>
                <p class="header-subtitle">Buat Beritamu Sekarang</p>
            </div>

            <!-- Info Cards Section -->
            <div class="header-info">
                <!-- Date Card -->
                <div class="info-card">
                    <div class="date-badge">
                        <i class="bi bi-calendar3"></i>
                        {{ now()->timezone('Asia/Jakarta')->isoFormat('dddd, D MMMM Y') }}
                    </div>
                </div>

                <!-- Welcome Card -->
                <div class="info-card welcome-card">
                    <div class="welcome-label">Welcome back,</div>
                    <div class="welcome-name">
                        <i class="bi bi-person-circle"></i>
                        {{ ucwords(auth()->user()->name) }}
                    </div>
                </div>

                <!-- Stats Summary Card -->
                <div class="info-card stats-summary">
                    <div class="stats-grid">
                        <div class="stats-item">
                            <div class="stats-label">
                                <i class="bi bi-check-circle-fill text-success"></i>
                                Published
                            </div>
                            <div class="stats-value">{{ $berita->where('status', 'published')->count() }}</div>
                        </div>
                        <div class="stats-item">
                            <div class="stats-label">
                                <i class="bi bi-file-earmark-text text-primary"></i>
                                Drafts
                            </div>
                            <div class="stats-value">{{ $berita->where('status', 'draft')->count() }}</div>
                        </div>
                        <div class="stats-item">
                            <div class="stats-label">
                                <i class="bi bi-clock-fill text-warning"></i>
                                Pending
                            </div>
                            <div class="stats-value">{{ $berita->where('status', 'pending')->count() }}</div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Statistics Section -->
        <section class="stats-section">
            @php
                $thisMonth = $berita->where('created_at', '>=', now()->startOfMonth())->count();
            @endphp
            <div class="stat-card" style="background: linear-gradient(135deg, #059669, #059669aa);">
                <div class="card stats-card shadow-sm border-0 rounded-4 text-center p-4 bg-gradient"
                    style="background:linear-gradient(135deg,#059669,#059669aa);color:white;">
                    <i class="bi bi-newspaper fs-2 mb-2"></i>
                    <h3 class="fw-bold mb-0">{{ $berita->total() }}</h3>
                    <p class="mb-0">Total Berita</p>
                </div>
            </div>
            <div class="stat-card" style="background: linear-gradient(135deg, #2563eb, #2563ebaa);">
                <div class="card stats-card shadow-sm border-0 rounded-4 text-center p-4 bg-gradient"
                    style="background:linear-gradient(135deg,#2563eb,#2563ebaa);color:white;">
                    <i class="bi bi-tags fs-2 mb-2"></i>
                    <h3 class="fw-bold mb-0">{{ $kategori->count() }}</h3>
                    <p class="mb-0">Kategori</p>
                </div>
            </div>
            <div class="stat-card" style="background: linear-gradient(135deg, #d97706, #d97706aa);">
                <div class="card stats-card shadow-sm border-0 rounded-4 text-center p-4 bg-gradient"
                    style="background:linear-gradient(135deg,#d97706,#d97706aa);color:white;">
                    <i class="bi bi-calendar3 fs-2 mb-2"></i>
                    <h3 class="fw-bold mb-0">{{ $thisMonth }}</h3>
                    <p class="mb-0">Bulan Ini</p>
                </div>
            </div>
        </section>

        <!-- Form Section -->
        <section class="form-section" id="formTambahBerita">
            <div class="form-header">
                <i class="bi bi-plus-circle-fill form-header-icon"></i>
                <div class="form-header-content">
                    <h5>Buat Berita Baru</h5>
                    <small>Tulis dan publikasikan berita berkualitas untuk pembaca Anda</small>
                </div>
            </div>
            <div class="form-content">
                <form action="{{ route('penulis.berita.store') }}" method="POST" enctype="multipart/form-data"
                    id="beritaForm">
                    @csrf

                    <!-- Progress Indicator -->
                    <div class="form-progress">
                        <div class="progress-steps">
                            <div class="step active" data-step="1">
                                <span class="step-number">1</span>
                                <span class="step-label">Informasi Dasar</span>
                            </div>
                            <div class="step" data-step="2">
                                <span class="step-number">2</span>
                                <span class="step-label">Konten & Media</span>
                            </div>
                            <div class="step" data-step="3">
                                <span class="step-number">3</span>
                                <span class="step-label">Publikasi</span>
                            </div>
                        </div>
                        <div class="progress-bar">
                            <div class="progress-fill" style="width: 33%"></div>
                        </div>
                    </div>

                    <!-- Step 1: Basic Information -->
                    <div class="form-step active" data-step="1">
                        <div class="step-header">
                            <h6 class="step-title">
                                <i class="bi bi-info-circle"></i>
                                Informasi Dasar Berita
                            </h6>
                            <p class="step-description">Masukkan informasi utama berita Anda</p>
                        </div>

                        <div class="form-grid">
                            <div class="form-group">
                                <label class="form-label">
                                    <i class="bi bi-type-h1"></i>
                                    Judul Berita *
                                </label>
                                <input type="text" name="judul" id="judul" class="form-input"
                                    placeholder="Contoh: Teknologi AI Berkembang Pesat di Indonesia" required>
                                <small class="form-help">Judul harus menarik dan maksimal 100 karakter</small>
                            </div>

                            <div class="form-group">
                                <label class="form-label">
                                    <i class="bi bi-link-45deg"></i>
                                    Slug URL (Opsional)
                                </label>
                                <input type="text" name="slug" id="slug" class="form-input"
                                    placeholder="teknologi-ai-berkembang-pesat">
                                <small class="form-help">URL-friendly, otomatis dari judul jika kosong</small>
                            </div>

                            <div class="form-group">
                                <label class="form-label">
                                    <i class="bi bi-tags-fill"></i>
                                    Kategori Berita *
                                </label>
                                <select name="kategori_id" id="kategori_id" class="form-select" required>
                                    <option value="">-- Pilih Kategori --</option>
                                    @foreach ($kategori as $k)
                                        <option value="{{ $k->id_kategori }}">{{ $k->Judul }}</option>
                                    @endforeach
                                </select>
                                <small class="form-help">Pilih kategori yang sesuai dengan topik berita</small>
                            </div>

                            <div class="form-group">
                                <label class="form-label">
                                    <i class="bi bi-hash"></i>
                                    Tag/Keyword (Opsional)
                                </label>
                                <input type="text" name="tags" id="tags" class="form-input"
                                    placeholder="teknologi, AI, Indonesia (pisahkan dengan koma)">
                                <small class="form-help">Bantu pembaca menemukan berita Anda</small>
                            </div>
                        </div>
                    </div>

                    <!-- Step 2: Content & Media -->
                    <div class="form-step" data-step="2">
                        <div class="step-header">
                            <h6 class="step-title">
                                <i class="bi bi-file-earmark-text"></i>
                                Konten & Media Berita
                            </h6>
                            <p class="step-description">Tambahkan isi berita dan gambar pendukung</p>
                        </div>

                        <div class="form-grid">
                            <div class="form-group" style="grid-column: 1 / -1;">
                                <label class="form-label">
                                    <i class="bi bi-image-fill"></i>
                                    Thumbnail/Gambar Utama *
                                </label>
                                <div class="file-upload-area" id="thumbnailUpload">
                                    <div class="upload-placeholder">
                                        <i class="bi bi-cloud-upload"></i>
                                        <p>Klik untuk upload gambar atau drag & drop</p>
                                        <small>Format: JPG, PNG, WebP. Maksimal 2MB</small>
                                    </div>
                                    <input type="file" name="thumbnail" id="thumbnail" class="file-input"
                                        accept="image/*" onchange="handleFileUpload(event)">
                                </div>
                                <div class="thumbnail-preview">
                                    <img id="preview" src="{{ asset('images/no-image.webp') }}"
                                        class="preview-image d-none" alt="Preview">
                                    <div class="preview-info">
                                        <span id="fileName"></span>
                                        <button type="button" class="btn-remove" onclick="removeThumbnail()">
                                            <i class="bi bi-x"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group" style="grid-column: 1 / -1;">
                                <label class="form-label">
                                    <i class="bi bi-pencil-square"></i>
                                    Isi Berita *
                                </label>
                                <div class="editor-toolbar">
                                    <button type="button" class="toolbar-btn" onclick="formatText('bold')"
                                        title="Bold">
                                        <i class="bi bi-type-bold"></i>
                                    </button>
                                    <button type="button" class="toolbar-btn" onclick="formatText('italic')"
                                        title="Italic">
                                        <i class="bi bi-type-italic"></i>
                                    </button>
                                    <button type="button" class="toolbar-btn" onclick="formatText('underline')"
                                        title="Underline">
                                        <i class="bi bi-type-underline"></i>
                                    </button>
                                    <div class="toolbar-separator"></div>
                                    <button type="button" class="toolbar-btn"
                                        onclick="formatText('insertUnorderedList')" title="Bullet List">
                                        <i class="bi bi-list-ul"></i>
                                    </button>
                                    <button type="button" class="toolbar-btn" onclick="formatText('insertOrderedList')"
                                        title="Numbered List">
                                        <i class="bi bi-list-ol"></i>
                                    </button>
                                    <div class="toolbar-separator"></div>
                                    <button type="button" class="toolbar-btn" onclick="formatText('justifyLeft')"
                                        title="Align Left">
                                        <i class="bi bi-text-left"></i>
                                    </button>
                                    <button type="button" class="toolbar-btn" onclick="formatText('justifyCenter')"
                                        title="Align Center">
                                        <i class="bi bi-text-center"></i>
                                    </button>
                                    <button type="button" class="toolbar-btn" onclick="formatText('justifyRight')"
                                        title="Align Right">
                                        <i class="bi bi-text-right"></i>
                                    </button>
                                </div>
                                <textarea name="isi_berita" id="isi_berita" class="form-textarea editor" required
                                    placeholder="Tulis isi berita lengkap di sini...&#10;&#10;Tips:&#10;- Mulai dengan lead yang menarik&#10;- Gunakan paragraf pendek&#10;- Sertakan fakta dan data&#10;- Akhiri dengan kesimpulan"></textarea>
                                <small class="form-help">Gunakan toolbar di atas untuk memformat teks. Minimal 100
                                    karakter.</small>
                            </div>
                        </div>
                    </div>

                    <!-- Step 3: Publication -->
                    <div class="form-step" data-step="3">
                        <div class="step-header">
                            <h6 class="step-title">
                                <i class="bi bi-send"></i>
                                Pengaturan Publikasi
                            </h6>
                            <p class="step-description">Atur kapan dan bagaimana berita akan dipublikasikan</p>
                        </div>

                        <div class="form-grid">
                            <div class="form-group">
                                <label class="form-label">
                                    <i class="bi bi-calendar-event"></i>
                                    Jadwalkan Publikasi (Opsional)
                                </label>
                                <input type="datetime-local" name="publish_at" id="publish_at" class="form-input">
                                <small class="form-help">Biarkan kosong untuk publikasikan segera</small>
                            </div>

                            <div class="form-group">
                                <label class="form-label">
                                    <i class="bi bi-eye"></i>
                                    Status Publikasi
                                </label>
                                <select name="status" id="status" class="form-select">
                                    <option value="published">Publikasikan Sekarang</option>
                                    <option value="draft">Simpan sebagai Draft</option>
                                    <option value="scheduled">Jadwalkan Publikasi</option>
                                </select>
                            </div>

                            <div class="form-group" style="grid-column: 1 / -1;">
                                <label class="form-label">
                                    <i class="bi bi-card-text"></i>
                                    Ringkasan/Summary (Opsional)
                                </label>
                                <textarea name="summary" id="summary" class="form-textarea" rows="3"
                                    placeholder="Ringkasan singkat berita untuk SEO dan preview..."></textarea>
                                <small class="form-help">Maksimal 160 karakter untuk SEO yang optimal</small>
                            </div>
                        </div>
                    </div>

                    <!-- Form Actions -->
                    <div class="form-actions">
                        <button type="button" class="btn btn-outline-secondary" id="btnPrev" disabled>
                            <i class="bi bi-arrow-left"></i>
                            Sebelumnya
                        </button>
                        <button type="button" class="btn btn-secondary" onclick="resetForm()">
                            <i class="bi bi-arrow-counterclockwise"></i>
                            Reset Form
                        </button>
                        <button type="button" class="btn btn-primary" id="btnNext">
                            Selanjutnya
                            <i class="bi bi-arrow-right"></i>
                        </button>
                        <button type="submit" class="btn btn-success d-none" id="btnSubmit">
                            <i class="bi bi-check-circle"></i>
                            Publikasikan Berita
                        </button>
                    </div>
                </form>
            </div>
        </section>

        <!-- News List Section -->
        <section class="news-section" id="daftarBerita">
            <div class="news-header">
                <div class="news-header-left">
                    <span class="news-header-icon"></span>
                    <div class="news-header-content">
                        <h5>Daftar Berita Saya</h5>
                        <small>{{ $berita->total() }} berita total</small>
                    </div>
                </div>
                <div class="search-filters">
                    <input type="text" id="searchBerita" class="search-input" placeholder="Cari berita...">
                    <select id="filterKategori" class="filter-select">
                        <option value="">Semua Kategori</option>
                        @foreach ($kategori as $k)
                            <option value="{{ $k->id }}">{{ $k->Judul }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="news-content">
                @if ($berita->isEmpty())
                    <div class="empty-state">
                        <div class="empty-icon"></div>
                        <h3 class="empty-title">Belum ada berita yang dibuat</h3>
                        <p class="empty-text">Mulai buat berita pertama Anda dengan mengisi form di atas.</p>
                        <button class="btn btn-success"
                            onclick="document.getElementById('formTambahBerita').scrollIntoView({behavior:'smooth'})">
                            <span>➕</span> Buat Berita Pertama
                        </button>
                    </div>
                @else
                    <div class="news-grid" id="beritaCards">
                        @foreach ($berita as $b)
                            <div class="news-card" data-kategori="{{ $b->kategori_id }}"
                                data-judul="{{ strtolower($b->Judul) }}">
                                <div class="news-image">
                                    <img src="{{ $b->Thumbnail ? asset('storage/' . $b->Thumbnail) : asset('images/no-image.webp') }}"
                                        alt="Thumbnail">
                                    <div class="status-badge">
                                        <span>✅</span> Published
                                    </div>
                                    <div class="category-badge">
                                        {{ $b->kategoriBerita->Judul ?? '-' }}
                                    </div>
                                </div>
                                <div class="news-body">
                                    <h3 class="news-title">{{ Str::limit($b->Judul, 60) }}</h3>
                                    <p class="news-excerpt">{{ Str::limit(strip_tags($b->Isi_Berita), 120) }}</p>
                                    <div class="news-meta">
                                        <div class="news-date">
                                            <span></span>
                                            {{ $b->created_at->format('d M Y') }}
                                        </div>
                                        <div class="news-slug">
                                            <span></span>
                                            {{ Str::limit($b->slug, 20) }}
                                        </div>
                                    </div>
                                    <div class="news-actions">
                                        <button class="btn btn-sm btn-outline-primary"
                                            onclick="viewBerita({{ $b->id }})">
                                            <span></span> Lihat
                                        </button>
                                        <button class="btn btn-sm btn-outline-warning" data-bs-toggle="modal"
                                            data-bs-target="#editModal{{ $b->id }}">
                                            <span></span> Edit
                                        </button>
                                        <form action="/penulis/berita/{{ $b->id }}" method="POST"
                                            class="d-inline">
                                            @csrf @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-outline-danger"
                                                onclick="return confirm('Hapus berita ini?')">
                                                <span></span> Hapus
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <div class="pagination-section">
                        <div class="pagination-info">
                            Menampilkan {{ $berita->firstItem() }}-{{ $berita->lastItem() }} dari {{ $berita->total() }}
                            berita
                        </div>
                        <div>{{ $berita->links() }}</div>
                    </div>
                @endif
            </div>
        </section>
    </main>

    <!-- Modal Preview -->
    <div class="modal" id="previewModal">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">
                    <span>👁️</span> Preview Berita
                </h5>
                <button class="modal-close" onclick="closeModal()">&times;</button>
            </div>
            <div class="modal-body">
                <img id="previewImage" src="" class="modal-image" alt="Preview">
                <h4 id="previewTitle"></h4>
                <div id="previewContent" class="modal-content-text"></div>
            </div>
        </div>
    </div>

    <script>
        // Multi-step form functionality
        let currentStep = 1;
        const totalSteps = 3;

        document.addEventListener('DOMContentLoaded', function() {
            initializeForm();

            // Preview Thumbnail
            window.previewThumbnail = (e) => {
                const [file] = e.target.files;
                const img = document.getElementById('preview');
                if (file) {
                    img.src = URL.createObjectURL(file);
                    img.classList.remove('d-none');
                }
            }

            // Reset form
            window.resetForm = () => {
                document.getElementById('beritaForm').reset();
                document.getElementById('preview').classList.add('d-none');
                document.getElementById('preview').src = '{{ asset('images/no-image.webp') }}';
                document.getElementById('fileName').textContent = '';
                document.getElementById('preview').classList.add('d-none');
                goToStep(1);
            }

            // Auto slug generation
            const judulInput = document.getElementById('judul');
            if (judulInput) {
                judulInput.addEventListener('input', function() {
                    const slug = this.value.toLowerCase()
                        .replace(/[^a-z0-9\s-]/g, '')
                        .replace(/\s+/g, '-')
                        .replace(/-+/g, '-')
                        .replace(/(^-|-$)/g, '');
                    const slugInput = document.getElementById('slug');
                    if (slugInput) {
                        slugInput.value = slug;
                    }
                });
            }

            // Search and Filter functionality
            const searchInput = document.getElementById('searchBerita');
            const filterSelect = document.getElementById('filterKategori');
            const beritaCards = document.querySelectorAll('.news-card');

            function filterBerita() {
                const searchTerm = searchInput.value.toLowerCase();
                const selectedCategory = filterSelect.value;

                beritaCards.forEach(card => {
                    const judul = card.dataset.judul;
                    const kategori = card.dataset.kategori;
                    const matchesSearch = judul.includes(searchTerm);
                    const matchesCategory = !selectedCategory || kategori === selectedCategory;

                    if (matchesSearch && matchesCategory) {
                        card.style.display = '';
                    } else {
                        card.style.display = 'none';
                    }
                });
            }

            if (searchInput) {
                searchInput.addEventListener('input', filterBerita);
            }

            if (filterSelect) {
                filterSelect.addEventListener('change', filterBerita);
            }
        });

        function initializeForm() {
            updateStepIndicator();
            updateButtons();
        }

        function goToStep(step) {
            currentStep = step;
            updateStepDisplay();
            updateStepIndicator();
            updateButtons();
            updateProgressBar();
        }

        function updateStepDisplay() {
            document.querySelectorAll('.form-step').forEach((stepEl, index) => {
                if (index + 1 === currentStep) {
                    stepEl.classList.add('active');
                } else {
                    stepEl.classList.remove('active');
                }
            });
        }

        function updateStepIndicator() {
            document.querySelectorAll('.step').forEach((stepEl, index) => {
                const stepNum = index + 1;
                stepEl.classList.remove('active', 'completed');

                if (stepNum === currentStep) {
                    stepEl.classList.add('active');
                } else if (stepNum < currentStep) {
                    stepEl.classList.add('completed');
                }
            });
        }

        function updateProgressBar() {
            const progress = (currentStep / totalSteps) * 100;
            document.querySelector('.progress-fill').style.width = progress + '%';
        }

        function updateButtons() {
            const btnPrev = document.getElementById('btnPrev');
            const btnNext = document.getElementById('btnNext');
            const btnSubmit = document.getElementById('btnSubmit');

            btnPrev.disabled = currentStep === 1;
            btnPrev.style.opacity = currentStep === 1 ? '0.5' : '1';

            if (currentStep === totalSteps) {
                btnNext.classList.add('d-none');
                btnSubmit.classList.remove('d-none');
            } else {
                btnNext.classList.remove('d-none');
                btnSubmit.classList.add('d-none');
            }
        }

        function nextStep() {
            if (validateCurrentStep()) {
                if (currentStep < totalSteps) {
                    goToStep(currentStep + 1);
                }
            }
        }

        function prevStep() {
            if (currentStep > 1) {
                goToStep(currentStep - 1);
            }
        }

        function validateCurrentStep() {
            const currentStepEl = document.querySelector(`.form-step[data-step="${currentStep}"]`);
            const requiredFields = currentStepEl.querySelectorAll('[required]');
            let isValid = true;

            requiredFields.forEach(field => {
                if (!field.value.trim()) {
                    field.style.borderColor = 'var(--danger-color)';
                    isValid = false;
                } else {
                    field.style.borderColor = 'var(--gray-200)';
                }
            });

            if (!isValid) {
                showNotification('Harap lengkapi semua field yang wajib diisi', 'error');
            }

            return isValid;
        }

        // File upload handling
        function handleFileUpload(event) {
            const file = event.target.files[0];
            if (file) {
                // Validate file type
                const allowedTypes = ['image/jpeg', 'image/jpg', 'image/png', 'image/webp'];
                if (!allowedTypes.includes(file.type)) {
                    showNotification('Format file tidak didukung. Gunakan JPG, PNG, atau WebP', 'error');
                    return;
                }

                // Validate file size (2MB)
                if (file.size > 2 * 1024 * 1024) {
                    showNotification('Ukuran file maksimal 2MB', 'error');
                    return;
                }

                const reader = new FileReader();
                reader.onload = function(e) {
                    const img = document.getElementById('preview');
                    img.src = e.target.result;
                    img.classList.remove('d-none');
                    document.getElementById('fileName').textContent = file.name;
                };
                reader.readAsDataURL(file);
            }
        }

        function removeThumbnail() {
            document.getElementById('thumbnail').value = '';
            document.getElementById('preview').classList.add('d-none');
            document.getElementById('preview').src = '{{ asset('images/no-image.webp') }}';
            document.getElementById('fileName').textContent = '';
        }

        // Rich text editor functionality
        function formatText(command) {
            document.execCommand(command, false, null);
            document.getElementById('isi_berita').focus();
        }

        // Drag and drop for file upload
        document.addEventListener('DOMContentLoaded', function() {
            const uploadArea = document.getElementById('thumbnailUpload');

            if (uploadArea) {
                ['dragenter', 'dragover', 'dragleave', 'drop'].forEach(eventName => {
                    uploadArea.addEventListener(eventName, preventDefaults, false);
                });

                ['dragenter', 'dragover'].forEach(eventName => {
                    uploadArea.addEventListener(eventName, highlight, false);
                });

                ['dragleave', 'drop'].forEach(eventName => {
                    uploadArea.addEventListener(eventName, unhighlight, false);
                });

                uploadArea.addEventListener('drop', handleDrop, false);
            }

            function preventDefaults(e) {
                e.preventDefault();
                e.stopPropagation();
            }

            function highlight() {
                uploadArea.classList.add('dragover');
            }

            function unhighlight() {
                uploadArea.classList.remove('dragover');
            }

            function handleDrop(e) {
                const dt = e.dataTransfer;
                const files = dt.files;

                if (files.length > 0) {
                    const input = document.getElementById('thumbnail');
                    if (input) {
                        try {
                            // Use DataTransfer API to create a FileList that can be assigned to input.files
                            const dataTransfer = new DataTransfer();
                            for (let i = 0; i < files.length; i++) {
                                dataTransfer.items.add(files[i]);
                            }
                            input.files = dataTransfer.files;
                        } catch (err) {
                            // Some environments may not allow assigning files; fall back to directly calling handler
                        }
                        handleFileUpload({
                            target: {
                                files: files
                            }
                        });
                    }
                }
            }



            // Event listeners for form navigation
            const btnNextEl = document.getElementById('btnNext');
            const btnPrevEl = document.getElementById('btnPrev');
            if (btnNextEl) btnNextEl.addEventListener('click', nextStep);
            if (btnPrevEl) btnPrevEl.addEventListener('click', prevStep);
        });

        // Notification system
        function showNotification(message, type = 'info') {
            // Simple notification - you can enhance this with a proper notification library
            alert(message);
        }

        // Modal
        function viewBerita(id) {
            console.log('View berita:', id);
        }

        function closeModal() {
            document.getElementById('previewModal').classList.remove('show');
        }
    </script>
@endsection


