<?= $this->extend('admin/layout/template') ?>

<?= $this->section('content') ?>
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-lg-8 col-md-10">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-burgundy text-white py-3">
                    <h5 class="card-title mb-0 fw-semibold">
                        <i class="fas fa-plus-circle me-2"></i>
                        Tambah Cabang Baru
                    </h5>
                </div>

                <div class="card-body p-4">
                    <form action="/admin/cabang" method="post">
                        <?= csrf_field() ?>

                        <div class="mb-4">
                            <label for="nama_cabang" class="form-label fw-semibold text-dark">
                                <i class="fas fa-building me-2 text-gold"></i>
                                Nama Cabang
                            </label>
                            <input type="text"
                                class="form-control form-control-lg border-burgundy-light"
                                id="nama_cabang"
                                name="nama_cabang"
                                placeholder="Masukkan nama cabang (contoh: Cabang Kendari..)"
                                required>
                            <div class="form-text text-muted">
                                <i class="fas fa-info-circle me-1"></i>
                                Nama cabang akan ditampilkan kepada pelanggan saat booking
                            </div>
                        </div>

                        <div class="mb-4">
                            <label for="alamat" class="form-label fw-semibold text-dark">
                                <i class="fas fa-map-marker-alt me-2 text-gold"></i>
                                Alamat Lengkap
                            </label>
                            <textarea class="form-control border-burgundy-light"
                                id="alamat"
                                name="alamat"
                                rows="4"
                                placeholder="Masukkan alamat lengkap cabang...&#10;Contoh:&#10;Jl. Sudirman No. 123, Lantai 2&#10;Jakarta Pusat 10220"></textarea>
                            <div class="form-text text-muted">
                                <i class="fas fa-info-circle me-1"></i>
                                Alamat yang detail membantu pelanggan menemukan lokasi dengan mudah
                            </div>
                        </div>

                        <div class="mb-4">
                            <label for="no_telepon" class="form-label fw-semibold text-dark">
                                <i class="fas fa-phone me-2 text-gold"></i>
                                Nomor Telepon
                            </label>
                            <input type="tel"
                                class="form-control border-burgundy-light"
                                id="no_telepon"
                                name="no_telepon"
                                placeholder="Contoh: 021-12345678 atau 0812-3456-7890">
                            <div class="form-text text-muted">
                                <i class="fas fa-info-circle me-1"></i>
                                Nomor telepon untuk dihubungi pelanggan (opsional)
                            </div>
                        </div>

                        <hr class="my-4">

                        <div class="d-flex gap-3 justify-content-end">
                            <a href="/admin/cabang" class="btn btn-outline-secondary px-4 py-2 fw-medium">
                                <i class="fas fa-times me-2"></i>
                                Batal
                            </a>
                            <button type="submit" class="btn btn-burgundy px-4 py-2 fw-medium">
                                <i class="fas fa-save me-2"></i>
                                Simpan Cabang
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    :root {
        --burgundy: #800020;
        --burgundy-light: #a0002a;
        --burgundy-dark: #600018;
        --gold: #ffd700;
        --gold-light: #fff8dc;
        --gold-dark: #daa520;
    }

    .bg-burgundy {
        background-color: var(--burgundy) !important;
    }

    .text-burgundy {
        color: var(--burgundy) !important;
    }

    .text-gold {
        color: var(--gold-dark) !important;
    }

    .border-burgundy-light {
        border-color: rgba(128, 0, 32, 0.3) !important;
    }

    .btn-burgundy {
        background-color: var(--burgundy);
        border-color: var(--burgundy);
        color: white;
        transition: all 0.3s ease;
    }

    .btn-burgundy:hover {
        background-color: var(--burgundy-dark);
        border-color: var(--burgundy-dark);
        color: white;
        transform: translateY(-1px);
        box-shadow: 0 4px 8px rgba(128, 0, 32, 0.3);
    }

    .form-control {
        transition: all 0.3s ease;
        border-width: 1.5px;
    }

    .form-control:focus {
        border-color: var(--burgundy-light);
        box-shadow: 0 0 0 0.2rem rgba(128, 0, 32, 0.25);
        transform: translateY(-1px);
    }

    .form-control-lg {
        padding: 0.75rem 1rem;
        font-size: 1.1rem;
    }

    .form-label {
        margin-bottom: 0.75rem;
        font-size: 0.95rem;
    }

    .form-text {
        font-size: 0.825rem;
        margin-top: 0.5rem;
    }

    .card {
        transition: all 0.3s ease;
    }

    .card:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 25px rgba(0, 0, 0, 0.1) !important;
    }

    .btn {
        transition: all 0.3s ease;
        border-radius: 0.5rem;
    }

    .btn:hover {
        transform: translateY(-1px);
    }

    .btn-outline-secondary {
        border-color: #6c757d;
        color: #6c757d;
    }

    .btn-outline-secondary:hover {
        background-color: #6c757d;
        border-color: #6c757d;
        color: white;
        box-shadow: 0 2px 4px rgba(108, 117, 125, 0.2);
    }

    /* Input animations */
    .form-control:focus+.form-text {
        color: var(--burgundy) !important;
        transform: translateX(2px);
        transition: all 0.3s ease;
    }

    /* Icon animations */
    .fas {
        transition: all 0.3s ease;
    }

    .btn:hover .fas {
        transform: scale(1.1);
    }

    .form-label:hover .fas {
        transform: scale(1.1);
        color: var(--burgundy) !important;
    }

    /* Tips card styling */
    .bg-light {
        background-color: rgba(255, 215, 0, 0.05) !important;
        border: 1px solid rgba(255, 215, 0, 0.2);
        border-radius: 0.75rem;
    }

    /* Placeholder styling */
    .form-control::placeholder {
        color: #adb5bd;
        opacity: 0.8;
    }

    .form-control:focus::placeholder {
        opacity: 0.5;
        transform: translateX(2px);
        transition: all 0.3s ease;
    }

    /* Mobile responsiveness */
    @media (max-width: 768px) {
        .d-flex.gap-3 {
            flex-direction: column;
        }

        .d-flex.gap-3 .btn {
            width: 100%;
            margin-bottom: 0.5rem;
        }

        .form-control-lg {
            font-size: 1rem;
        }

        .card-body {
            padding: 1.5rem !important;
        }
    }
</style>

<?= $this->endSection() ?>