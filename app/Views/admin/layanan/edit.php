<?= $this->extend('admin/layout/template') ?>

<?= $this->section('content') ?>
<div class="container-fluid">
    <?php if (session()->getFlashdata('success')): ?>
        <div class="alert alert-success border-0 shadow-sm mb-4" role="alert">
            <i class="fas fa-check-circle me-2 text-success"></i>
            <?= session()->getFlashdata('success') ?>
        </div>
    <?php endif; ?>

    <div class="row g-4">
        <!-- Main Content -->
        <div class="col-lg-8">
            <!-- Edit Detail Layanan -->
            <div class="card border-0 shadow-sm mb-4">
                <div class="card-header bg-burgundy text-white py-3">
                    <h5 class="mb-0 fw-semibold">
                        <i class="fas fa-edit me-2"></i>
                        Edit Detail Layanan
                    </h5>
                </div>
                <div class="card-body p-4">
                    <form action="/admin/layanan/<?= $layanan['id'] ?>" method="post">
                        <?= csrf_field() ?>
                        <input type="hidden" name="_method" value="PUT">

                        <div class="mb-4">
                            <label for="nama_layanan" class="form-label fw-semibold text-dark">Nama Layanan</label>
                            <input type="text" class="form-control form-control-lg border-burgundy-light"
                                id="nama_layanan" name="nama_layanan"
                                value="<?= esc($layanan['nama_layanan']) ?>" required>
                        </div>

                        <div class="mb-4">
                            <label for="deskripsi" class="form-label fw-semibold text-dark">Deskripsi</label>
                            <textarea class="form-control border-burgundy-light"
                                id="deskripsi" name="deskripsi" rows="5"
                                placeholder="Masukkan deskripsi layanan..."><?= esc($layanan['deskripsi']) ?></textarea>
                        </div>

                        <div class="d-flex gap-3">
                            <button type="submit" class="btn btn-burgundy px-4 py-2 fw-medium">
                                <i class="fas fa-save me-2"></i>
                                Update Detail
                            </button>
                            <a href="/admin/layanan" class="btn btn-outline-secondary px-4 py-2 fw-medium">
                                <i class="fas fa-arrow-left me-2"></i>
                                Kembali
                            </a>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Manajemen Gambar -->
            <div class="card border-0 shadow-sm mb-4">
                <div class="card-header bg-burgundy text-white py-3">
                    <h5 class="mb-0 fw-semibold">
                        <i class="fas fa-images me-2"></i>
                        Manajemen Gambar
                    </h5>
                </div>
                <div class="card-body p-4">
                    <h6 class="text-dark mb-3 fw-semibold">Gambar Saat Ini</h6>
                    <div class="row g-3 mb-4">
                        <?php if (!empty($gambar)): ?>
                            <?php foreach ($gambar as $g): ?>
                                <div class="col-md-4">
                                    <div class="image-card position-relative">
                                        <img src="/uploads/layanan/<?= esc($g['nama_file']) ?>"
                                            class="img-thumbnail border-gold shadow-sm w-100"
                                            style="height: 200px; object-fit: cover;">
                                        <form action="/admin/layanan/delete-image/<?= $g['id'] ?>" method="post" class="mt-2">
                                            <?= csrf_field() ?>
                                            <input type="hidden" name="_method" value="DELETE">
                                            <button type="submit" class="btn btn-outline-danger btn-sm w-100 fw-medium"
                                                onclick="return confirm('Yakin ingin menghapus gambar ini?')">
                                                <i class="fas fa-trash me-1"></i>
                                                Hapus
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <div class="col-12">
                                <div class="text-center py-4 text-muted">
                                    <i class="fas fa-image fa-2x mb-3"></i>
                                    <p class="mb-0">Belum ada gambar untuk layanan ini</p>
                                </div>
                            </div>
                        <?php endif; ?>
                    </div>

                    <hr class="my-4">

                    <form action="/admin/layanan/<?= $layanan['id'] ?>" method="post" enctype="multipart/form-data">
                        <?= csrf_field() ?>
                        <input type="hidden" name="_method" value="PUT">

                        <div class="mb-3">
                            <label for="gambar_baru" class="form-label fw-semibold text-dark">
                                <i class="fas fa-plus-circle me-2 text-gold"></i>
                                Tambah Gambar Baru
                            </label>
                            <input type="file" class="form-control border-burgundy-light"
                                id="gambar_baru" name="gambar_baru[]" multiple
                                accept="image/*">
                            <div class="form-text">Pilih satu atau beberapa gambar (JPG, PNG, GIF)</div>
                        </div>

                        <button type="submit" class="btn btn-gold px-4 py-2 fw-medium">
                            <i class="fas fa-upload me-2"></i>
                            Upload Gambar
                        </button>
                    </form>
                </div>
            </div>
        </div>

        <!-- Sidebar -->
        <div class="col-lg-4">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-burgundy text-white py-3">
                    <h5 class="mb-0 fw-semibold">
                        <i class="fas fa-box-open me-2"></i>
                        Paket Layanan
                    </h5>
                </div>
                <div class="card-body p-4">
                    <h6 class="text-dark mb-3 fw-semibold">Daftar Paket</h6>

                    <div class="packages-list mb-4">
                        <?php if (!empty($paket)): ?>
                            <?php foreach ($paket as $p): ?>
                                <div class="package-item bg-light rounded-3 p-3 mb-3 border-gold-light">
                                    <div class="d-flex justify-content-between align-items-start">
                                        <div class="flex-grow-1">
                                            <h6 class="mb-1 text-dark fw-semibold"><?= esc($p['nama_paket']) ?></h6>
                                            <div class="text-muted small">
                                                <span class="badge bg-gold text-dark me-2">
                                                    Rp <?= number_format($p['harga'], 0, ',', '.') ?>
                                                </span>
                                                <span class="badge bg-burgundy-light text-white">
                                                    <?= $p['durasi_menit'] ?> menit
                                                </span>
                                            </div>
                                        </div>
                                        <form action="/admin/layanan/hapus-paket/<?= $p['id'] ?>" method="post" class="ms-2">
                                            <?= csrf_field() ?>
                                            <input type="hidden" name="_method" value="DELETE">
                                            <button type="submit" class="btn btn-outline-danger btn-sm"
                                                onclick="return confirm('Yakin ingin menghapus paket ini?')"
                                                title="Hapus paket">
                                                <i class="fas fa-times"></i>
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <div class="text-center py-4 text-muted">
                                <i class="fas fa-box fa-2x mb-3"></i>
                                <p class="mb-0">Belum ada paket tersedia</p>
                            </div>
                        <?php endif; ?>
                    </div>

                    <hr class="my-4">

                    <h6 class="text-dark mb-3 fw-semibold">
                        <i class="fas fa-plus-circle me-2 text-gold"></i>
                        Tambah Paket Baru
                    </h6>

                    <form action="/admin/layanan/tambah-paket" method="post">
                        <?= csrf_field() ?>
                        <input type="hidden" name="id_layanan" value="<?= $layanan['id'] ?>">

                        <div class="mb-3">
                            <input type="text" id="nama_paket" name="nama_paket"
                                class="form-control border-burgundy-light"
                                placeholder="Nama Paket (contoh: Basic)" required>
                        </div>

                        <div class="mb-3">
                            <input type="number" id="harga" name="harga"
                                class="form-control border-burgundy-light"
                                placeholder="Harga (contoh: 300000)" required>
                        </div>

                        <div class="mb-4">
                            <input type="number" id="durasi_menit" name="durasi_menit"
                                class="form-control border-burgundy-light"
                                placeholder="Durasi dalam menit" required>
                        </div>

                        <button type="submit" class="btn btn-gold w-100 py-2 fw-medium">
                            <i class="fas fa-plus me-2"></i>
                            Tambah Paket
                        </button>
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

    .bg-burgundy-light {
        background-color: var(--burgundy-light) !important;
    }

    .text-burgundy {
        color: var(--burgundy) !important;
    }

    .text-gold {
        color: var(--gold-dark) !important;
    }

    .bg-gold {
        background-color: var(--gold) !important;
        color: #333 !important;
    }

    .border-burgundy-light {
        border-color: rgba(128, 0, 32, 0.3) !important;
    }

    .border-gold {
        border-color: var(--gold) !important;
    }

    .border-gold-light {
        border-left: 4px solid var(--gold) !important;
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

    .btn-gold {
        background-color: var(--gold);
        border-color: var(--gold);
        color: #333;
        font-weight: 600;
        transition: all 0.3s ease;
    }

    .btn-gold:hover {
        background-color: var(--gold-dark);
        border-color: var(--gold-dark);
        color: #333;
        transform: translateY(-1px);
        box-shadow: 0 4px 8px rgba(218, 165, 32, 0.3);
    }

    .form-control:focus {
        border-color: var(--burgundy-light);
        box-shadow: 0 0 0 0.2rem rgba(128, 0, 32, 0.25);
    }

    .alert-success {
        background-color: rgba(25, 135, 84, 0.1);
        border-color: rgba(25, 135, 84, 0.2);
        color: #155724;
    }

    .card {
        transition: all 0.3s ease;
    }

    .card:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 25px rgba(0, 0, 0, 0.1) !important;
    }

    .image-card img {
        transition: all 0.3s ease;
        border-width: 2px;
    }

    .image-card:hover img {
        transform: scale(1.02);
    }

    .package-item {
        transition: all 0.3s ease;
        border: 1px solid rgba(255, 215, 0, 0.3);
    }

    .package-item:hover {
        background-color: var(--gold-light) !important;
        transform: translateX(5px);
    }

    .badge {
        font-weight: 500;
        font-size: 0.75rem;
    }

    .btn-outline-danger:hover {
        transform: translateY(-1px);
    }

    .btn-outline-secondary:hover {
        transform: translateY(-1px);
    }
</style>

<?= $this->endSection() ?>