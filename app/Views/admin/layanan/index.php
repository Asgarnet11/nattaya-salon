<?= $this->extend('admin/layout/template') ?>

<?= $this->section('content') ?>
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-white border-bottom py-3">
                    <div class="d-flex justify-content-between align-items-center">
                        <h5 class="card-title mb-0 fw-semibold text-dark">Daftar Layanan</h5>
                        <a href="/admin/layanan/new" class="btn btn-primary px-4 py-2 fw-medium">
                            <i class="fas fa-plus me-2"></i>
                            Tambah Layanan Baru
                        </a>
                    </div>
                </div>

                <div class="card-body p-0">
                    <?php if (session()->getFlashdata('success')): ?>
                        <div class="alert alert-success mx-4 mt-4 mb-0" role="alert">
                            <i class="fas fa-check-circle me-2"></i>
                            <?= session()->getFlashdata('success') ?>
                        </div>
                    <?php endif; ?>

                    <div class="table-responsive">
                        <table class="table table-hover align-middle mb-0">
                            <thead class="table-light">
                                <tr>
                                    <th class="px-4 py-3 fw-semibold text-dark">Nama Layanan</th>
                                    <th class="px-4 py-3 fw-semibold text-dark">Deskripsi</th>
                                    <th class="px-4 py-3 fw-semibold text-dark text-center" style="width: 200px;">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (!empty($layanan)): ?>
                                    <?php foreach ($layanan as $l): ?>
                                        <tr class="border-bottom">
                                            <td class="px-4 py-4">
                                                <div class="fw-semibold text-dark fs-6"><?= esc($l['nama_layanan']) ?></div>
                                            </td>
                                            <td class="px-4 py-4">
                                                <?php if (!empty($l['deskripsi'])): ?>
                                                    <span class="text-muted"><?= esc(word_limiter($l['deskripsi'], 15)) ?></span>
                                                <?php else: ?>
                                                    <span class="text-muted fst-italic">Tidak ada deskripsi</span>
                                                <?php endif; ?>
                                            </td>
                                            <td class="px-4 py-4 text-center">
                                                <div class="btn-group" role="group">
                                                    <a href="/admin/layanan/<?= $l['id'] ?>/edit"
                                                        class="btn btn-outline-primary btn-sm px-3 py-2 fw-medium">
                                                        <i class="fas fa-edit me-1"></i>
                                                        Kelola
                                                    </a>
                                                    <form action="/admin/layanan/<?= $l['id'] ?>" method="post" class="d-inline">
                                                        <?= csrf_field() ?>
                                                        <input type="hidden" name="_method" value="DELETE">
                                                        <button type="submit"
                                                            class="btn btn-outline-danger btn-sm px-3 py-2 fw-medium"
                                                            onclick="return confirm('Yakin ingin menghapus layanan ini beserta semua paket dan gambarnya?')">
                                                            <i class="fas fa-trash me-1"></i>
                                                            Hapus
                                                        </button>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                <?php else: ?>
                                    <tr>
                                        <td colspan="3" class="text-center py-5">
                                            <div class="text-muted">
                                                <i class="fas fa-concierge-bell fa-2x mb-3 d-block"></i>
                                                <span>Belum ada data layanan</span>
                                                <div class="mt-2">
                                                    <a href="/admin/layanan/new" class="btn btn-primary btn-sm">
                                                        <i class="fas fa-plus me-1"></i>
                                                        Tambah Layanan Pertama
                                                    </a>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .table th {
        border-top: none;
        border-bottom: 2px solid #dee2e6;
        font-size: 0.875rem;
        letter-spacing: 0.3px;
    }

    .table td {
        border-top: 1px solid #f1f3f4;
        border-bottom: none;
        vertical-align: middle;
    }

    .table-hover tbody tr:hover {
        background-color: #f8f9fa;
    }

    .btn-group .btn {
        border-radius: 0.375rem;
        margin-right: 0.25rem;
        transition: all 0.15s ease-in-out;
    }

    .btn-group .btn:last-child {
        margin-right: 0;
    }

    .btn-outline-primary {
        border-color: #0d6efd;
        color: #0d6efd;
    }

    .btn-outline-primary:hover {
        background-color: #0d6efd;
        border-color: #0d6efd;
        color: #ffffff;
        transform: translateY(-1px);
        box-shadow: 0 2px 4px rgba(13, 110, 253, 0.2);
    }

    .btn-outline-danger {
        border-color: #dc3545;
        color: #dc3545;
    }

    .btn-outline-danger:hover {
        background-color: #dc3545;
        border-color: #dc3545;
        color: #ffffff;
        transform: translateY(-1px);
        box-shadow: 0 2px 4px rgba(220, 53, 69, 0.2);
    }

    .btn-primary {
        background-color: #0d6efd;
        border-color: #0d6efd;
        transition: all 0.15s ease-in-out;
    }

    .btn-primary:hover {
        transform: translateY(-1px);
        box-shadow: 0 2px 6px rgba(13, 110, 253, 0.3);
    }

    .alert {
        border-radius: 0.5rem;
        border: none;
    }

    .alert-success {
        background-color: #d1e7dd;
        color: #0a3622;
    }

    .card-header {
        background-color: #ffffff !important;
    }
</style>

<?= $this->endSection() ?>