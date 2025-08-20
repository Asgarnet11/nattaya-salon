<?= $this->extend('frontend/layout/template') ?>

<?= $this->section('head') ?>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="container my-5">
    <div class="row justify-content-center">
        <div class="col-lg-6 col-md-8">
            <div class="card shadow-burgundy">
                <div class="card-header bg-burgundy text-center py-4">
                    <div class="upload-icon mb-3">
                        <i class="fas fa-cloud-upload-alt fa-3x text-gold"></i>
                    </div>
                    <h3 class="text-white playfair-display mb-0 fw-bold">Upload Bukti Pembayaran</h3>
                    <p class="text-gold mb-0 mt-2 small">Unggah bukti transfer untuk konfirmasi pembayaran Anda</p>
                </div>
                <div class="card-body p-sm-5 p-4">
                    <?php if (session()->getFlashdata('error')): ?>
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <strong>Error!</strong> <?= esc(session()->getFlashdata('error')) ?>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    <?php endif; ?>
                    <?php if (session()->getFlashdata('errors')): ?>
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <strong>Terjadi kesalahan:</strong>
                            <ul class="mb-0 mt-2 ps-3">
                                <?php foreach (session()->getFlashdata('errors') as $error): ?>
                                    <li><?= esc($error) ?></li>
                                <?php endforeach ?>
                            </ul>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    <?php endif; ?>
                    <?php if (session()->getFlashdata('success')): ?>
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <strong>Berhasil!</strong> <?= esc(session()->getFlashdata('success')) ?>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    <?php endif; ?>

                    <?php if (!empty($id_booking) && is_numeric($id_booking)): ?>
                        <form action="/proses-konfirmasi" method="post" enctype="multipart/form-data" id="uploadForm" novalidate>
                            <?= csrf_field() ?>
                            <input type="hidden" name="id_booking" value="<?= esc($id_booking) ?>">

                            <div class="mb-4">
                                <label for="bukti_pembayaran" class="form-label fw-semibold text-burgundy">
                                    <i class="fas fa-file-upload me-2"></i>Pilih File Bukti Transfer
                                </label>
                                <div class="upload-area" id="uploadArea">
                                    <input type="file"
                                        class="form-control form-control-lg"
                                        id="bukti_pembayaran"
                                        name="bukti_pembayaran"
                                        accept="image/*,.pdf"
                                        required>
                                    <div class="upload-placeholder" id="uploadPlaceholder">
                                        <i class="fas fa-cloud-upload-alt fa-2x text-muted mb-2"></i>
                                        <p class="text-muted mb-1">Drag & drop file atau klik untuk browse</p>
                                        <small class="text-muted">JPG, PNG, PDF - Max 5MB</small>
                                    </div>
                                </div>
                                <div class="invalid-feedback">
                                    Silakan pilih file bukti pembayaran yang valid.
                                </div>
                            </div>

                            <div id="filePreview" class="mb-4 text-center" style="display: none;">
                                <div class="preview-container">
                                    <img id="previewImage" src="" alt="Preview" class="img-thumbnail mb-2" style="max-height: 200px;">
                                    <div id="previewPdf" class="pdf-preview" style="display: none;">
                                        <i class="fas fa-file-pdf fa-3x text-danger mb-2"></i>
                                        <p class="mb-0" id="pdfName"></p>
                                    </div>
                                    <button type="button" class="btn btn-sm btn-outline-danger" id="removeFile">
                                        <i class="fas fa-trash me-1"></i>Hapus File
                                    </button>
                                </div>
                            </div>

                            <div class="mb-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="confirmCheck" required>
                                    <label class="form-check-label text-muted" for="confirmCheck">
                                        Saya menyatakan bahwa bukti pembayaran yang diupload adalah <strong>benar dan sesuai</strong>.
                                    </label>
                                    <div class="invalid-feedback">
                                        Anda harus menyetujui pernyataan ini untuk melanjutkan.
                                    </div>
                                </div>
                            </div>

                            <div class="d-grid gap-2">
                                <button type="submit" class="btn btn-gold btn-lg fw-semibold" id="submitBtn">
                                    <span class="btn-text">
                                        <i class="fas fa-paper-plane me-2"></i>Kirim Konfirmasi
                                    </span>
                                    <span class="btn-loading" style="display: none;">
                                        <i class="fas fa-spinner fa-spin me-2"></i>Mengirim...
                                    </span>
                                </button>
                                <div class="row mt-2">
                                    <div class="col-6">
                                        <a href="/riwayat-booking" class="btn btn-outline-burgundy w-100">
                                            <i class="fas fa-history me-1"></i>Riwayat
                                        </a>
                                    </div>
                                    <div class="col-6">
                                        <a href="/pembayaran/<?= esc($id_booking) ?>" class="btn btn-outline-secondary w-100">
                                            Instruksi Bayar
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </form>
                    <?php else: ?>
                        <div class="text-center py-4">
                            <i class="fas fa-exclamation-triangle fa-3x text-warning mb-3"></i>
                            <h5 class="text-danger mb-3">ID Booking Tidak Valid</h5>
                            <p class="text-muted mb-4">Silakan kembali ke halaman riwayat booking untuk memilih booking yang benar.</p>
                            <div class="d-grid">
                                <a href="/riwayat-booking" class="btn btn-burgundy">
                                    <i class="fas fa-history me-2"></i>Lihat Riwayat Booking
                                </a>
                            </div>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    /* STYLE ANDA TETAP DI SINI, TIDAK DIUBAH */
    :root {
        --burgundy: #800020;
        --burgundy-dark: #660019;
        --gold: #FFD700;
        --gold-dark: #B8860B;
    }

    .bg-burgundy {
        background: linear-gradient(135deg, var(--burgundy) 0%, var(--burgundy-dark) 100%) !important;
    }

    .text-burgundy {
        color: var(--burgundy) !important;
    }

    .text-gold {
        color: var(--gold) !important;
    }

    .border-gold {
        border: 2px solid var(--gold) !important;
    }

    .shadow-burgundy {
        box-shadow: 0 15px 35px rgba(128, 0, 32, 0.15) !important;
        border: none;
        border-radius: 20px;
        overflow: hidden;
    }

    .playfair-display {
        font-family: 'Playfair Display', serif;
    }

    .upload-icon {
        animation: float 3s ease-in-out infinite;
    }

    @keyframes float {

        0%,
        100% {
            transform: translateY(0px);
        }

        50% {
            transform: translateY(-10px);
        }
    }

    .card-header {
        border-bottom: 3px solid var(--gold);
    }

    .upload-area {
        position: relative;
        border: 2px dashed #ddd;
        border-radius: 15px;
        padding: 20px;
        text-align: center;
        transition: all 0.3s ease;
        background: #fafafa;
    }

    .upload-area:hover {
        border-color: var(--burgundy);
        background: #f8f9fa;
    }

    .upload-area.dragover {
        border-color: var(--gold);
        background: #fff8e1;
        transform: scale(1.02);
    }

    .upload-area input[type="file"] {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        opacity: 0;
        cursor: pointer;
    }

    .upload-placeholder {
        pointer-events: none;
    }

    .form-control {
        border: 2px solid #e9ecef;
        border-radius: 10px;
        transition: all 0.3s ease;
    }

    .form-control:focus {
        border-color: var(--burgundy);
        box-shadow: 0 0 0 0.2rem rgba(128, 0, 32, 0.15);
    }

    .btn-gold {
        background: linear-gradient(135deg, var(--gold) 0%, var(--gold-dark) 100%);
        border: none;
        color: var(--burgundy) !important;
        font-weight: 700;
        border-radius: 50px;
        transition: all 0.3s ease;
    }

    .btn-gold:hover {
        color: white !important;
        transform: translateY(-2px);
        box-shadow: 0 8px 25px rgba(255, 215, 0, 0.4);
    }

    .btn-outline-burgundy {
        border: 2px solid var(--burgundy);
        color: var(--burgundy);
        background: transparent;
        border-radius: 50px;
        font-weight: 600;
        transition: all 0.3s ease;
    }

    .btn-outline-burgundy:hover {
        background: var(--burgundy);
        color: white;
    }

    .preview-container {
        position: relative;
    }

    .img-thumbnail {
        border: 3px solid var(--gold);
        border-radius: 15px;
    }

    .pdf-preview {
        padding: 20px;
        background: #f8f9fa;
        border: 2px dashed var(--burgundy);
        border-radius: 15px;
        margin-bottom: 10px;
    }

    .form-check-input:checked {
        background-color: var(--burgundy);
        border-color: var(--burgundy);
    }

    .form-check-input:focus {
        border-color: var(--burgundy);
        box-shadow: 0 0 0 0.25rem rgba(128, 0, 32, 0.15);
    }

    .form-control.is-invalid {
        border-color: #dc3545 !important;
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const fileInput = document.getElementById('bukti_pembayaran');
        const uploadArea = document.getElementById('uploadArea');
        const uploadPlaceholder = document.getElementById('uploadPlaceholder');
        const filePreview = document.getElementById('filePreview');
        const previewImage = document.getElementById('previewImage');
        const previewPdf = document.getElementById('previewPdf');
        const pdfName = document.getElementById('pdfName');
        const removeFileBtn = document.getElementById('removeFile');
        const form = document.getElementById('uploadForm');
        const submitBtn = document.getElementById('submitBtn');

        if (!form) return; // Hentikan script jika form tidak ada

        // Drag and drop functionality
        if (uploadArea && fileInput) {
            ['dragenter', 'dragover', 'dragleave', 'drop'].forEach(eventName => {
                uploadArea.addEventListener(eventName, preventDefaults, false);
            });

            function preventDefaults(e) {
                e.preventDefault();
                e.stopPropagation();
            }
            ['dragenter', 'dragover'].forEach(eventName => {
                uploadArea.addEventListener(eventName, () => uploadArea.classList.add('dragover'), false);
            });
            ['dragleave', 'drop'].forEach(eventName => {
                uploadArea.addEventListener(eventName, () => uploadArea.classList.remove('dragover'), false);
            });
            uploadArea.addEventListener('drop', handleDrop, false);

            function handleDrop(e) {
                const dt = e.dataTransfer;
                const files = dt.files;
                if (files.length > 0) {
                    fileInput.files = files;
                    handleFileSelect(files[0]);
                }
            }
        }

        // File input change handler
        if (fileInput) {
            fileInput.addEventListener('change', function(e) {
                const file = e.target.files[0];
                if (file) handleFileSelect(file);
            });
        }

        // File selection handler
        function handleFileSelect(file) {
            fileInput.classList.remove('is-invalid', 'is-valid');
            if (file.size > 5 * 1024 * 1024) { // Max 5MB
                alert('Ukuran file terlalu besar. Maksimal 5MB.');
                clearFileInput();
                return;
            }
            const validTypes = ['image/jpeg', 'image/png', 'application/pdf'];
            if (!validTypes.includes(file.type)) {
                alert('Format file tidak didukung. Gunakan JPG, PNG, atau PDF.');
                clearFileInput();
                return;
            }
            fileInput.classList.add('is-valid');
            if (uploadPlaceholder) uploadPlaceholder.style.display = 'none';
            showFilePreview(file);
        }

        // Show file preview
        function showFilePreview(file) {
            if (file.type.startsWith('image/')) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    previewImage.src = e.target.result;
                    previewImage.style.display = 'block';
                    previewPdf.style.display = 'none';
                    filePreview.style.display = 'block';
                };
                reader.readAsDataURL(file);
            } else if (file.type === 'application/pdf') {
                previewImage.style.display = 'none';
                pdfName.textContent = file.name;
                previewPdf.style.display = 'block';
                filePreview.style.display = 'block';
            }
        }

        // Remove file handler
        if (removeFileBtn) {
            removeFileBtn.addEventListener('click', clearFileInput);
        }

        function clearFileInput() {
            if (fileInput) fileInput.value = '';
            if (fileInput) fileInput.classList.remove('is-invalid', 'is-valid');
            if (uploadPlaceholder) uploadPlaceholder.style.display = 'block';
            if (filePreview) filePreview.style.display = 'none';
        }

        // Form submission handler
        if (form && submitBtn) {
            form.addEventListener('submit', function(e) {
                if (!form.checkValidity()) {
                    e.preventDefault();
                    e.stopPropagation();
                    form.classList.add('was-validated');
                    return;
                }
                submitBtn.disabled = true;
                submitBtn.querySelector('.btn-text').style.display = 'none';
                submitBtn.querySelector('.btn-loading').style.display = 'inline';
            });
        }
    });
</script>
<?= $this->endSection() ?>