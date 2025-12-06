@extends('layouts.master')

@section('content')
    <link rel="stylesheet" href="{{ asset('css/berita.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <main class="main-content">
        <!-- Header Section -->
        <section class="header-section">
            <div class="header-card">
                <h1 class="header-title">
                    <i class="fas fa-newspaper"></i>
                    Manajemen Berita Saya
                </h1>
                <p class="header-subtitle">Buat Beritamu Sekarang</p>
            </div>

            <div class="header-info">
                <div class="info-card combined-card">
                    <div class="card-content">
                        <div class="date-badge">
                            <i class="fas fa-calendar-alt"></i>
                            {{ now()->timezone('Asia/Jakarta')->isoFormat('dddd, D MMMM Y') }}
                        </div>

                        <div class="welcome-section">
                            <div class="welcome-label">Welcome back,</div>
                            <div class="welcome-name">
                                <i class="fas fa-user-circle"></i>
                                {{ ucwords(auth()->user()->name) }}
                            </div>
                        </div>

                        <div class="stats-summary">
                            <div class="stats-grid">
                                <div class="stats-item">
                                    <div class="stats-label">
                                        <i class="fas fa-check-circle text-success"></i>
                                        Disetujui
                                    </div>
                                    <div class="stats-value">{{ $berita->where('status', 'approved')->count() }}</div>
                                </div>
                                <div class="stats-item">
                                    <div class="stats-label">
                                        <i class="fas fa-clock text-warning"></i>
                                        Menunggu
                                    </div>
                                    <div class="stats-value">{{ $berita->where('status', 'pending')->count() }}</div>
                                </div>
                                <div class="stats-item">
                                    <div class="stats-label">
                                        <i class="fas fa-times-circle text-danger"></i>
                                        Ditolak
                                    </div>
                                    <div class="stats-value">{{ $berita->where('status', 'rejected')->count() }}</div>
                                </div>
                            </div>
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

            <div class="stat-card">
                <div class="card stats-card" style="background: linear-gradient(135deg, #059669, #059669aa);">
                    <i class="fas fa-newspaper fs-2 mb-2"></i>
                    <h3 class="fw-bold mb-0">{{ $berita->total() }}</h3>
                    <p class="mb-0">Total Berita</p>
                </div>
            </div>

            <div class="stat-card">
                <div class="card stats-card" style="background: linear-gradient(135deg, #07701e, #0a7915aa);">
                    <i class="fas fa-tags fs-2 mb-2"></i>
                    <h3 class="fw-bold mb-0">{{ $kategori->count() }}</h3>
                    <p class="mb-0">Kategori</p>
                </div>
            </div>

            <div class="stat-card">
                <div class="card stats-card" style="background: linear-gradient(135deg, #d97706, #d97706aa);">
                    <i class="fas fa-calendar-alt fs-2 mb-2"></i>
                    <h3 class="fw-bold mb-0">{{ $thisMonth }}</h3>
                    <p class="mb-0">Bulan Ini</p>
                </div>
            </div>
        </section>

        <!-- Form Section -->
        <section class="form-section" id="formTambahBerita">
            <div class="form-header">
                <i class="fas fa-plus-circle form-header-icon"></i>
                <div class="form-header-content">
                    <h5>Buat Berita Baru</h5>
                    <small>Tulis dan publikasikan berita berkualitas untuk pembaca Anda</small>
                </div>
            </div>

            <div class="form-content">
                <form action="{{ route('penulis.berita.store') }}" method="POST" enctype="multipart/form-data" id="beritaForm">
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
                                <i class="fas fa-info-circle"></i>
                                Informasi Dasar Berita
                            </h6>
                            <p class="step-description">Masukkan informasi utama berita Anda</p>
                        </div>

                        <div class="form-grid">
                            <div class="form-group">
                                <label class="form-label">
                                    <i class="fas fa-heading"></i>
                                    Judul Berita *
                                </label>
                                <input type="text" name="judul" id="judul" class="form-input"
                                    placeholder="Contoh: Teknologi AI Berkembang Pesat di Indonesia" required>
                                <small class="form-help">Judul harus menarik dan maksimal 100 karakter</small>
                            </div>

                            <div class="form-group">
                                <label class="form-label">
                                    <i class="fas fa-link"></i>
                                    Slug URL (Opsional)
                                </label>
                                <input type="text" name="slug" id="slug" class="form-input"
                                    placeholder="teknologi-ai-berkembang-pesat">
                                <small class="form-help">URL-friendly, otomatis dari judul jika kosong</small>
                            </div>

                            <div class="form-group">
                                <label class="form-label">
                                    <i class="fas fa-tags"></i>
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
                                    <i class="fas fa-hashtag"></i>
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
                                <i class="fas fa-file-alt"></i>
                                Konten & Media Berita
                            </h6>
                            <p class="step-description">Tambahkan isi berita dan gambar pendukung</p>
                        </div>

                        <div class="form-grid">
                            <div class="form-group full-width">
                                <label class="form-label">
                                    <i class="fas fa-image"></i>
                                    Thumbnail/Gambar Utama *
                                </label>
                                <div class="file-upload-area" id="thumbnailUpload">
                                    <div class="upload-placeholder">
                                        <i class="fas fa-cloud-upload-alt"></i>
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
                                            <i class="fas fa-times"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group full-width">
                                <label class="form-label">
                                    <i class="fas fa-edit"></i>
                                    Isi Berita *
                                </label>
                                <div class="editor-toolbar">
                                    <button type="button" class="toolbar-btn" onclick="formatText('bold')" title="Bold">
                                        <i class="fas fa-bold"></i>
                                    </button>
                                    <button type="button" class="toolbar-btn" onclick="formatText('italic')" title="Italic">
                                        <i class="fas fa-italic"></i>
                                    </button>
                                    <button type="button" class="toolbar-btn" onclick="formatText('underline')" title="Underline">
                                        <i class="fas fa-underline"></i>
                                    </button>
                                    <div class="toolbar-separator"></div>
                                    <button type="button" class="toolbar-btn" onclick="formatText('insertUnorderedList')" title="Bullet List">
                                        <i class="fas fa-list-ul"></i>
                                    </button>
                                    <button type="button" class="toolbar-btn" onclick="formatText('insertOrderedList')" title="Numbered List">
                                        <i class="fas fa-list-ol"></i>
                                    </button>
                                    <div class="toolbar-separator"></div>
                                    <button type="button" class="toolbar-btn" onclick="formatText('justifyLeft')" title="Align Left">
                                        <i class="fas fa-align-left"></i>
                                    </button>
                                    <button type="button" class="toolbar-btn" onclick="formatText('justifyCenter')" title="Align Center">
                                        <i class="fas fa-align-center"></i>
                                    </button>
                                    <button type="button" class="toolbar-btn" onclick="formatText('justifyRight')" title="Align Right">
                                        <i class="fas fa-align-right"></i>
                                    </button>
                                </div>
                                <textarea name="isi_berita" id="isi_berita" class="form-textarea editor" required
                                    placeholder="Tulis isi berita lengkap di sini...&#10;&#10;Tips:&#10;- Mulai dengan lead yang menarik&#10;- Gunakan paragraf pendek&#10;- Sertakan fakta dan data&#10;- Akhiri dengan kesimpulan"></textarea>
                                <small class="form-help">Gunakan toolbar di atas untuk memformat teks. Minimal 100 karakter.</small>
                            </div>
                        </div>
                    </div>

                    <!-- Step 3: Publication -->
                    <div class="form-step" data-step="3">
                        <div class="step-header">
                            <h6 class="step-title">
                                <i class="fas fa-paper-plane"></i>
                                Pengaturan Publikasi
                            </h6>
                            <p class="step-description">Atur kapan dan bagaimana berita akan dipublikasikan</p>
                        </div>

                        <div class="form-grid">
                            <div class="form-group">
                                <label class="form-label">
                                    <i class="fas fa-calendar-alt"></i>
                                    Jadwalkan Publikasi (Opsional)
                                </label>
                                <input type="datetime-local" name="publish_at" id="publish_at" class="form-input"
                                    min="{{ now()->format('Y-m-d\TH:i') }}">
                                <small class="form-help">Biarkan kosong untuk publikasikan segera</small>
                            </div>

                            <div class="form-group">
                                <label class="form-label">
                                    <i class="fas fa-info-circle"></i>
                                    Catatan
                                </label>
                                <div class="alert alert-info">
                                    <i class="fas fa-info-circle"></i>
                                    <strong>Informasi:</strong> Berita yang Anda buat akan otomatis dalam status "Menunggu
                                    Persetujuan" dan akan ditinjau oleh admin sebelum dipublikasikan.
                                </div>
                            </div>

                            <div class="form-group full-width">
                                <label class="form-label">
                                    <i class="fas fa-file-alt"></i>
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
                            <i class="fas fa-arrow-left"></i>
                            Sebelumnya
                        </button>
                        <button type="button" class="btn btn-secondary" onclick="resetForm()">
                            <i class="fas fa-undo"></i>
                            Reset Form
                        </button>
                        <button type="button" class="btn btn-primary" id="btnNext">
                            Selanjutnya
                            <i class="fas fa-arrow-right"></i>
                        </button>
                        <button type="submit" class="btn btn-success d-none" id="btnSubmit">
                            <i class="fas fa-check-circle"></i>
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
                    <i class="fas fa-list-alt news-header-icon"></i>
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
                        <i class="fas fa-newspaper empty-icon"></i>
                        <h3 class="empty-title">Belum ada berita yang dibuat</h3>
                        <p class="empty-text">Mulai buat berita pertama Anda dengan mengisi form di atas.</p>
                        <button class="btn btn-success" onclick="scrollToForm()">
                            <i class="fas fa-plus"></i> Buat Berita Pertama
                        </button>
                    </div>
                @else
                    <div class="news-grid" id="beritaCards">
                        @foreach ($berita as $b)
                            <div class="news-card" data-kategori="{{ $b->kategori_id }}" data-judul="{{ strtolower($b->Judul) }}">
                                <div class="news-image">
                                    <img src="{{ $b->Thumbnail ? asset('storage/' . $b->Thumbnail) : asset('images/no-image.webp') }}"
                                        alt="Thumbnail">
                                    <div class="status-badge">
                                        @if ($b->status === 'approved')
                                            <span style="color: #198754;">✅</span> Disetujui
                                        @elseif($b->status === 'pending')
                                            <span style="color: #ffc107;">⏳</span> Menunggu
                                        @elseif($b->status === 'rejected')
                                            <span style="color: #dc3545;">❌</span> Ditolak
                                        @endif
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
                                            <i class="fas fa-calendar-alt"></i>
                                            {{ $b->created_at->format('d M Y') }}
                                        </div>
                                        <div class="news-slug">
                                            <i class="fas fa-link"></i>
                                            {{ Str::limit($b->slug, 20) }}
                                        </div>
                                    </div>
                                    <div class="news-actions">
                                        <button class="btn btn-sm btn-outline-primary" data-bs-toggle="modal"
                                            data-bs-target="#previewModal" onclick="viewBerita({{ $b->id_berita }})">
                                            <i class="fas fa-eye"></i> Lihat
                                        </button>
                                        <button class="btn btn-sm btn-outline-warning" onclick="editBerita({{ $b->id_berita }})">
                                            <i class="fas fa-edit"></i> Edit
                                        </button>
                                        <form action="{{ route('penulis.berita.destroy', $b->id_berita) }}"
                                            method="POST" class="d-inline">
                                            @csrf
                                            <button type="submit" class="btn btn-sm btn-outline-danger"
                                                onclick="return confirmDelete()">
                                                <i class="fas fa-trash"></i> Hapus
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <div class="pagination-section">
                        <div class="pagination-info">
                            Menampilkan {{ $berita->firstItem() }}-{{ $berita->lastItem() }} dari {{ $berita->total() }} berita
                        </div>
                        <div class="pagination-links">
                            {{ $berita->links() }}
                        </div>
                    </div>
                @endif
            </div>
        </section>
    </main>

    <!-- Modal Preview -->
    <div class="modal fade" id="previewModal" tabindex="-1" aria-labelledby="previewModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="previewModalLabel">
                        <i class="fas fa-eye"></i> Detail Berita
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="berita-detail">
                        <div class="berita-image-container mb-4">
                            <img id="previewImage" src="" class="img-fluid rounded" alt="Berita Image">
                        </div>
                        <div class="berita-info mb-3">
                            <h4 id="previewTitle" class="berita-title"></h4>
                            <div class="berita-meta">
                                <span class="badge bg-primary me-2" id="previewCategory"></span>
                                <small class="text-muted">
                                    <i class="fas fa-calendar-alt"></i>
                                    <span id="previewDate"></span>
                                </small>
                            </div>
                        </div>
                        <div id="previewContent" class="berita-content"></div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                        <i class="fas fa-times-circle"></i> Tutup
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Edit -->
    <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editModalLabel">
                        <i class="fas fa-edit"></i> Edit Berita
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="editForm" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="modal-body">
                        <div class="form-grid">
                            <div class="form-group">
                                <label class="form-label">
                                    <i class="fas fa-heading"></i>
                                    Judul Berita *
                                </label>
                                <input type="text" name="judul" id="edit_judul" class="form-input" required>
                            </div>

                            <div class="form-group">
                                <label class="form-label">
                                    <i class="fas fa-tags"></i>
                                    Kategori Berita *
                                </label>
                                <select name="kategori_id" id="edit_kategori_id" class="form-select" required>
                                    <option value="">-- Pilih Kategori --</option>
                                    @foreach ($kategori as $k)
                                        <option value="{{ $k->id_kategori }}">{{ $k->Judul }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group full-width">
                                <label class="form-label">
                                    <i class="fas fa-image"></i>
                                    Thumbnail/Gambar Utama
                                </label>
                                <div class="file-upload-area" id="editThumbnailUpload">
                                    <div class="upload-placeholder">
                                        <i class="fas fa-cloud-upload-alt"></i>
                                        <p>Klik untuk upload gambar baru atau drag & drop</p>
                                        <small>Format: JPG, PNG, WebP. Maksimal 2MB</small>
                                    </div>
                                    <input type="file" name="thumbnail" id="edit_thumbnail" class="file-input"
                                        accept="image/*" onchange="handleEditFileUpload(event)">
                                </div>
                                <div class="thumbnail-preview">
                                    <img id="edit_preview" src="{{ asset('images/no-image.webp') }}"
                                        class="preview-image" alt="Preview">
                                    <div class="preview-info">
                                        <span id="edit_fileName"></span>
                                        <button type="button" class="btn-remove" onclick="removeEditThumbnail()">
                                            <i class="fas fa-times"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="form-label">
                                    <i class="fas fa-calendar-alt"></i>
                                    Jadwalkan Publikasi (Opsional)
                                </label>
                                <input type="datetime-local" name="publish_at" id="edit_publish_at" class="form-input"
                                    min="{{ now()->format('Y-m-d\TH:i') }}">
                                <small class="form-help">Biarkan kosong untuk publikasikan segera</small>
                            </div>

                            <div class="form-group full-width">
                                <label class="form-label">
                                    <i class="fas fa-edit"></i>
                                    Isi Berita *
                                </label>
                                <textarea name="isi_berita" id="edit_isi_berita" class="form-textarea editor" required></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                            <i class="fas fa-times-circle"></i> Batal
                        </button>
                        <button type="submit" class="btn btn-success">
                            <i class="fas fa-check-circle"></i> Simpan Perubahan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        // Form variables
        let currentStep = 1;
        const totalSteps = 3;

        // Initialize when DOM is loaded
        document.addEventListener('DOMContentLoaded', function() {
            initializeForm();
            setupEventListeners();
        });

        // Initialize form state
        function initializeForm() {
            updateStepDisplay();
            updateButtons();
            setupAutoSlug();
        }

        // Setup all event listeners
        function setupEventListeners() {
            // Form navigation
            document.getElementById('btnNext').addEventListener('click', nextStep);
            document.getElementById('btnPrev').addEventListener('click', prevStep);

            // Search and filter
            const searchInput = document.getElementById('searchBerita');
            const filterSelect = document.getElementById('filterKategori');

            if (searchInput) {
                searchInput.addEventListener('input', filterBerita);
            }

            if (filterSelect) {
                filterSelect.addEventListener('change', filterBerita);
            }

            // Drag and drop for file upload
            setupDragAndDrop();
        }

        // Auto slug generation
        function setupAutoSlug() {
            const judulInput = document.getElementById('judul');
            if (judulInput) {
                judulInput.addEventListener('input', function() {
                    const slug = this.value.toLowerCase()
                        .replace(/[^a-z0-9\s-]/g, '')
                        .replace(/\s+/g, '-')
                        .replace(/-+/g, '-')
                        .replace(/(^-|-$)/g, '');
                    document.getElementById('slug').value = slug;
                });
            }
        }

        // Form navigation functions
        function goToStep(step) {
            currentStep = step;
            updateStepDisplay();
            updateButtons();
            updateProgressBar();
        }

        function updateStepDisplay() {
            document.querySelectorAll('.form-step').forEach((stepEl, index) => {
                stepEl.classList.toggle('active', index + 1 === currentStep);
            });

            updateStepIndicator();
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
                    field.style.borderColor = '#dc3545';
                    isValid = false;
                } else {
                    field.style.borderColor = '';
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
                // Validate file
                if (!validateFile(file)) return;

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

        function validateFile(file) {
            const allowedTypes = ['image/jpeg', 'image/jpg', 'image/png', 'image/webp'];
            if (!allowedTypes.includes(file.type)) {
                showNotification('Format file tidak didukung. Gunakan JPG, PNG, atau WebP', 'error');
                return false;
            }

            if (file.size > 2 * 1024 * 1024) {
                showNotification('Ukuran file maksimal 2MB', 'error');
                return false;
            }

            return true;
        }

        function removeThumbnail() {
            document.getElementById('thumbnail').value = '';
            document.getElementById('preview').classList.add('d-none');
            document.getElementById('preview').src = '{{ asset('images/no-image.webp') }}';
            document.getElementById('fileName').textContent = '';
        }

        // Drag and drop setup
        function setupDragAndDrop() {
            const uploadArea = document.getElementById('thumbnailUpload');
            if (!uploadArea) return;

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
            document.getElementById('thumbnailUpload').classList.add('dragover');
        }

        function unhighlight() {
            document.getElementById('thumbnailUpload').classList.remove('dragover');
        }

        function handleDrop(e) {
            const dt = e.dataTransfer;
            const files = dt.files;

            if (files.length > 0) {
                const input = document.getElementById('thumbnail');
                if (input) {
                    input.files = files;
                    handleFileUpload({ target: { files: files } });
                }
            }
        }

        // Rich text editor
        function formatText(command) {
            document.execCommand(command, false, null);
            document.getElementById('isi_berita').focus();
        }

        // Search and filter functionality
        function filterBerita() {
            const searchTerm = document.getElementById('searchBerita').value.toLowerCase();
            const selectedCategory = document.getElementById('filterKategori').value;
            const beritaCards = document.querySelectorAll('.news-card');

            beritaCards.forEach(card => {
                const judul = card.dataset.judul;
                const kategori = card.dataset.kategori;
                const matchesSearch = judul.includes(searchTerm);
                const matchesCategory = !selectedCategory || kategori === selectedCategory;

                card.style.display = matchesSearch && matchesCategory ? '' : 'none';
            });
        }

        // Reset form
        window.resetForm = function() {
            if (confirm('Yakin ingin mereset form? Semua data yang telah diisi akan hilang.')) {
                document.getElementById('beritaForm').reset();
                removeThumbnail();
                goToStep(1);
                showNotification('Form telah direset', 'success');
            }
        }

        // Scroll to form
        window.scrollToForm = function() {
            document.getElementById('formTambahBerita').scrollIntoView({
                behavior: 'smooth',
                block: 'start'
            });
        }

        // Confirm delete
        function confirmDelete() {
            return confirm('Apakah Anda yakin ingin menghapus berita ini?');
        }

        // Modal functions
        async function viewBerita(id) {
            try {
                const response = await fetch(`/penulis/berita/${id}`);
                const data = await response.json();

                if (data.success) {
                    const berita = data.berita;

                    document.getElementById('previewImage').src = berita.thumbnail
                        ? `/storage/${berita.thumbnail}`
                        : '{{ asset('images/no-image.webp') }}';

                    document.getElementById('previewTitle').textContent = berita.judul;
                    document.getElementById('previewCategory').textContent = berita.kategori_berita?.judul || 'Tidak ada kategori';
                    document.getElementById('previewDate').textContent = new Date(berita.created_at)
                        .toLocaleDateString('id-ID', { year: 'numeric', month: 'long', day: 'numeric' });
                    document.getElementById('previewContent').innerHTML = berita.isi_berita;
                } else {
                    showNotification('Gagal memuat detail berita', 'error');
                }
            } catch (error) {
                console.error('Error:', error);
                showNotification('Terjadi kesalahan saat memuat berita', 'error');
            }
        }

        async function editBerita(id) {
            try {
                const response = await fetch(`/penulis/berita/${id}`);
                const data = await response.json();

                if (data.success) {
                    const berita = data.berita;

                    // Populate form fields
                    document.getElementById('edit_judul').value = berita.judul;
                    document.getElementById('edit_kategori_id').value = berita.kategori_berita?.id || '';
                    document.getElementById('edit_isi_berita').value = berita.isi_berita;

                    // Handle publish_at
                    if (berita.publish_at) {
                        const publishDate = new Date(berita.publish_at);
                        document.getElementById('edit_publish_at').value = publishDate.toISOString().slice(0, 16);
                    } else {
                        document.getElementById('edit_publish_at').value = '';
                    }

                    // Set thumbnail preview
                    const editPreview = document.getElementById('edit_preview');
                    editPreview.src = berita.thumbnail
                        ? `/storage/${berita.thumbnail}`
                        : '{{ asset('images/no-image.webp') }}';
                    editPreview.classList.remove('d-none');

                    // Update form action
                    document.getElementById('editForm').action = `/penulis/berita/${id}`;

                    // Show modal
                    const editModal = new bootstrap.Modal(document.getElementById('editModal'));
                    editModal.show();
                } else {
                    showNotification('Gagal memuat data berita untuk edit', 'error');
                }
            } catch (error) {
                console.error('Error:', error);
                showNotification('Terjadi kesalahan saat memuat data berita', 'error');
            }
        }

        // Edit modal file upload
        function handleEditFileUpload(event) {
            const file = event.target.files[0];
            if (file) {
                if (!validateFile(file)) return;

                const reader = new FileReader();
                reader.onload = function(e) {
                    const img = document.getElementById('edit_preview');
                    img.src = e.target.result;
                    img.classList.remove('d-none');
                    document.getElementById('edit_fileName').textContent = file.name;
                };
                reader.readAsDataURL(file);
            }
        }

        function removeEditThumbnail() {
            document.getElementById('edit_thumbnail').value = '';
            document.getElementById('edit_preview').classList.add('d-none');
            document.getElementById('edit_preview').src = '{{ asset('images/no-image.webp') }}';
            document.getElementById('edit_fileName').textContent = '';
        }

        // Notification system
        function showNotification(message, type = 'info') {
            Swal.fire({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 3000,
                timerProgressBar: true,
                icon: type,
                title: message,
                didOpen: (toast) => {
                    toast.addEventListener('mouseenter', Swal.stopTimer);
                    toast.addEventListener('mouseleave', Swal.resumeTimer);
                }
            });
        }
    </script>
@endsection
