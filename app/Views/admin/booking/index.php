<?= $this->extend('admin/layout/template') ?>

<?= $this->section('content') ?>
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-white border-bottom py-3">
                    <h5 class="card-title mb-0 fw-semibold text-dark">Daftar Booking Masuk</h5>
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
                                    <th class="px-4 py-3 fw-semibold text-dark">Pelanggan</th>
                                    <th class="px-4 py-3 fw-semibold text-dark">Kontak</th>
                                    <th class="px-4 py-3 fw-semibold text-dark">Layanan & Paket</th>
                                    <th class="px-4 py-3 fw-semibold text-dark">Cabang</th>
                                    <th class="px-4 py-3 fw-semibold text-dark">Jadwal</th>
                                    <th class="px-4 py-3 fw-semibold text-dark">Karyawan</th>
                                    <th class="px-4 py-3 fw-semibold text-dark">Status</th>
                                    <th class="px-4 py-3 fw-semibold text-dark text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (!empty($bookings)): ?>
                                    <?php foreach ($bookings as $b): ?>
                                        <tr class="border-bottom">
                                            <td class="px-4 py-3">
                                                <div class="fw-medium text-dark"><?= esc($b['nama_pelanggan']) ?></div>
                                            </td>
                                            <td class="px-4 py-3">
                                                <span class="text-muted"><?= esc($b['no_telepon']) ?></span>
                                            </td>
                                            <td class="px-4 py-3">
                                                <div class="fw-medium text-dark"><?= esc($b['nama_layanan']) ?></div>
                                                <small class="text-muted d-block mt-1"><?= esc($b['nama_paket']) ?></small>
                                            </td>
                                            <td class="px-4 py-3">
                                                <span class="text-dark"><?= esc($b['nama_cabang']) ?></span>
                                            </td>
                                            <td class="px-4 py-3">
                                                <div class="text-dark fw-medium"><?= date('d M Y', strtotime($b['tanggal_booking'])) ?></div>
                                                <small class="text-muted d-block"><?= date('H:i', strtotime($b['jam_booking'])) ?> WIB</small>
                                            </td>
                                            <td class="px-4 py-3">
                                                <?php if (!empty($b['nama_karyawan'])): ?>
                                                    <span class="text-dark"><?= esc($b['nama_karyawan']) ?></span>
                                                <?php else: ?>
                                                    <span class="text-muted fst-italic">Belum Ditugaskan</span>
                                                <?php endif; ?>
                                            </td>
                                            <td class="px-4 py-3">
                                                <?php
                                                $statusConfig = [
                                                    'pending' => ['class' => 'warning', 'text' => 'Pending'],
                                                    'confirmed' => ['class' => 'success', 'text' => 'Dikonfirmasi'],
                                                    'canceled' => ['class' => 'danger', 'text' => 'Dibatalkan'],
                                                    'completed' => ['class' => 'secondary', 'text' => 'Selesai']
                                                ];
                                                $status = $statusConfig[$b['status']] ?? ['class' => 'secondary', 'text' => ucfirst($b['status'])];
                                                ?>
                                                <span class="badge bg-<?= $status['class'] ?> px-3 py-2 fw-medium">
                                                    <?= $status['text'] ?>
                                                </span>
                                            </td>
                                            <td class="px-4 py-3 text-center">
                                                <a href="/admin/booking/<?= $b['id'] ?>/edit"
                                                    class="btn btn-outline-primary btn-sm px-3 py-2 fw-medium">
                                                    <i class="fas fa-edit me-1"></i>
                                                    Kelola
                                                </a>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                <?php else: ?>
                                    <tr>
                                        <td colspan="8" class="text-center py-5">
                                            <div class="text-muted">
                                                <i class="fas fa-inbox fa-2x mb-3 d-block"></i>
                                                <span>Belum ada data booking</span>
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

    .badge {
        font-size: 0.75rem;
        letter-spacing: 0.3px;
    }

    .btn-outline-primary {
        border-color: #0d6efd;
        color: #0d6efd;
        transition: all 0.15s ease-in-out;
    }

    .btn-outline-primary:hover {
        background-color: #0d6efd;
        border-color: #0d6efd;
        color: #ffffff;
        transform: translateY(-1px);
        box-shadow: 0 2px 4px rgba(13, 110, 253, 0.2);
    }

    .alert {
        border-radius: 0.5rem;
        border: none;
    }

    .alert-success {
        background-color: #d1e7dd;
        color: #0a3622;
    }
</style>
<?= $this->endSection() ?>