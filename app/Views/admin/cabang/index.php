<?= $this->extend('admin/layout/template') ?>

<?= $this->section('content') ?>
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-burgundy text-white py-3">
                    <div class="d-flex justify-content-between align-items-center">
                        <h5 class="card-title mb-0 fw-semibold">
                            <i class="fas fa-building me-2"></i>
                            Daftar Cabang
                        </h5>
                        <a href="/admin/cabang/new" class="btn btn-gold px-4 py-2 fw-medium">
                            <i class="fas fa-plus me-2"></i>
                            Tambah Cabang Baru
                        </a>
                    </div>
                </div>

                <div class="card-body p-0">
                    <?php if (session()->getFlashdata('success')): ?>
                        <div class="alert alert-success mx-4 mt-4 mb-0 border-0" role="alert">
                            <i class="fas fa-check-circle me-2 text-success"></i>
                            <?= session()->getFlashdata('success') ?>
                        </div>
                    <?php endif; ?>

                    <div class="table-responsive">
                        <table class="table table-hover align-middle mb-0">
                            <thead class="table-light">
                                <tr>
                                    <th class="px-4 py-3 fw-semibold text-dark text-center" style="width: 80px;">ID</th>
                                    <th class="px-4 py-3 fw-semibold text-dark">Nama Cabang</th>
                                    <th class="px-4 py-3 fw-semibold text-dark">Alamat</th>
                                    <th class="px-4 py-3 fw-semibold text-dark">No. Telepon</th>
                                    <th class="px-4 py-3 fw-semibold text-dark text-center" style="width: 200px;">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (!empty($cabang)): ?>
                                    <?php foreach ($cabang as $c): ?>
                                        <tr class="border-bottom">
                                            <td class="px-4 py-4 text-center">
                                                <span class="badge bg-burgundy-light text-white px-3 py-2 fw-medium">
                                                    <?= $c['id'] ?>
                                                </span>
                                            </td>
                                            <td class="px-4 py-4">
                                                <div class="fw-semibold text-dark fs-6">
                                                    <i class="fas fa-map-marker-alt me-2 text-gold"></i>
                                                    <?= esc($c['nama_cabang']) ?>
                                                </div>
                                            </td>
                                            <td class="px-4 py-4">
                                                <span class="text-muted">
                                                    <i class="fas fa-home me-2"></i>
                                                    <?= esc($c['alamat']) ?>
                                                </span>
                                            </td>
                                            <td class="px-4 py-4">
                                                <span class="text-dark fw-medium">
                                                    <i class="fas fa-phone me-2 text-burgundy"></i>
                                                    <?= esc($c['no_telepon']) ?>
                                                </span>
                                            </td>
                                            <td class="px-4 py-4 text-center">
                                                <div class="btn-group" role="group">
                                                    <a href="/admin/cabang/<?= $c['id'] ?>/edit"
                                                        class="btn btn-outline-burgundy btn-sm px-3 py-2 fw-medium">
                                                        <i class="fas fa-edit me-1"></i>
                                                        Edit
                                                    </a>
                                                    <form action="/admin/cabang/<?= $c['id'] ?>" method="post" class="d-inline">
                                                        <?= csrf_field() ?>
                                                        <input type="hidden" name="_method" value="DELETE">
                                                        <button type="submit"
                                                            class="btn btn-outline-danger btn-sm px-3 py-2 fw-medium"
                                                            onclick="return confirm('Yakin ingin menghapus cabang <?= esc($c['nama_cabang']) ?>?')">
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
                                        <td colspan="5" class="text-center py-5">
                                            <div class="text-muted">
                                                <i class="fas fa-building fa-2x mb-3 d-block"></i>
                                                <span>Belum ada data cabang</span>
                                                <div class="mt-3">
                                                    <a href="/admin/cabang/new" class="btn btn-burgundy btn-sm">
                                                        <i class="fas fa-plus me-1"></i>
                                                        Tambah Cabang Pertama
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

    .btn-outline-burgundy {
        border-color: var(--burgundy);
        color: var(--burgundy);
        transition: all 0.3s ease;
    }

    .btn-outline-burgundy:hover {
        background-color: var(--burgundy);
        border-color: var(--burgundy);
        color: white;
        transform: translateY(-1px);
        box-shadow: 0 2px 4px rgba(128, 0, 32, 0.2);
    }

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
        background-color: rgba(255, 215, 0, 0.1);
        transition: all 0.3s ease;
    }

    .btn-group .btn {
        border-radius: 0.375rem;
        margin-right: 0.25rem;
        transition: all 0.15s ease-in-out;
    }

    .btn-group .btn:last-child {
        margin-right: 0;
    }

    .btn-outline-danger {
        border-color: #dc3545;
        color: #dc3545;
        transition: all 0.3s ease;
    }

    .btn-outline-danger:hover {
        background-color: #dc3545;
        border-color: #dc3545;
        color: #ffffff;
        transform: translateY(-1px);
        box-shadow: 0 2px 4px rgba(220, 53, 69, 0.2);
    }

    .badge {
        font-size: 0.75rem;
        letter-spacing: 0.3px;
        border-radius: 0.5rem;
    }

    .alert-success {
        background-color: rgba(25, 135, 84, 0.1);
        border-color: rgba(25, 135, 84, 0.2);
        color: #155724;
        border-radius: 0.5rem;
    }

    .card {
        transition: all 0.3s ease;
    }

    .card:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 25px rgba(0, 0, 0, 0.1) !important;
    }

    .table tbody tr {
        transition: all 0.3s ease;
    }

    .fas {
        transition: all 0.3s ease;
    }

    .btn:hover .fas {
        transform: scale(1.1);
    }

    /* Mobile responsiveness */
    @media (max-width: 768px) {
        .btn-group {
            flex-direction: column;
            width: 100%;
        }

        .btn-group .btn {
            margin-right: 0;
            margin-bottom: 0.25rem;
            width: 100%;
        }

        .btn-group .btn:last-child {
            margin-bottom: 0;
        }

        .card-header .d-flex {
            flex-direction: column;
            gap: 1rem;
        }

        .table-responsive {
            font-size: 0.875rem;
        }
    }
</style>

<?= $this->endSection() ?>