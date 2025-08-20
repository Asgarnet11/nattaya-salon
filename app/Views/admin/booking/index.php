<?= $this->extend('admin/layout/template') ?>

<?= $this->section('content') ?>
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-burgundy border-bottom py-3">
                    <h5 class="card-title mb-0 fw-semibold text-white">Daftar Booking Masuk</h5>
                </div>
                <div class="card-body p-0">
                    <?php if (session()->getFlashdata('success')): ?>
                        <div class="alert alert-success mx-4 mt-4 mb-0" role="alert">
                            <?= session()->getFlashdata('success') ?>
                        </div>
                    <?php endif; ?>

                    <?php if (session()->getFlashdata('error')): ?>
                        <div class="alert alert-danger mx-4 mt-4 mb-0" role="alert">
                            <?= session()->getFlashdata('error') ?>
                        </div>
                    <?php endif; ?>

                    <div class="table-responsive">
                        <table class="table table-hover align-middle mb-0">
                            <thead class="table-burgundy">
                                <tr>
                                    <th class="px-4 py-3 fw-semibold text-white">No</th>
                                    <th class="px-4 py-3 fw-semibold text-white">Pelanggan</th>
                                    <th class="px-4 py-3 fw-semibold text-white">Layanan & Paket</th>
                                    <th class="px-4 py-3 fw-semibold text-white">Jadwal</th>
                                    <th class="px-4 py-3 fw-semibold text-white">Bukti Bayar</th>
                                    <th class="px-4 py-3 fw-semibold text-white">Status</th>
                                    <th class="px-4 py-3 fw-semibold text-white text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (!empty($bookings) && is_array($bookings)): ?>
                                    <?php $no = 1; ?>
                                    <?php foreach ($bookings as $b): ?>
                                        <tr class="border-bottom">
                                            <td class="px-4 py-3 fw-medium text-burgundy">
                                                <?= $no++ ?>
                                            </td>
                                            <td class="px-4 py-3">
                                                <div class="fw-medium text-dark"><?= esc($b['nama_pelanggan'] ?? '-') ?></div>
                                                <small class="text-muted d-block"><?= esc($b['no_telepon'] ?? '-') ?></small>
                                            </td>
                                            <td class="px-4 py-3">
                                                <div class="fw-medium text-dark"><?= esc($b['nama_layanan'] ?? '-') ?></div>
                                                <small class="text-muted d-block mt-1"><?= esc($b['nama_paket'] ?? '-') ?></small>
                                            </td>
                                            <td class="px-4 py-3">
                                                <?php if (!empty($b['tanggal_booking'])): ?>
                                                    <div class="text-dark fw-medium"><?= date('d M Y', strtotime($b['tanggal_booking'])) ?></div>
                                                    <?php if (!empty($b['jam_booking'])): ?>
                                                        <small class="text-muted d-block"><?= date('H:i', strtotime($b['jam_booking'])) ?> WITA</small>
                                                    <?php endif; ?>
                                                <?php else: ?>
                                                    <span class="text-muted">Belum dijadwalkan</span>
                                                <?php endif; ?>
                                            </td>
                                            <td class="px-4 py-3 text-center">
                                                <?php if (!empty($b['bukti_pembayaran'])): ?>
                                                    <a href="<?= base_url('uploads/bukti_pembayaran/' . esc($b['bukti_pembayaran'])) ?>"
                                                        target="_blank"
                                                        class="btn btn-outline-burgundy btn-sm">
                                                        <i class="fas fa-eye me-1"></i>Lihat
                                                    </a>
                                                <?php else: ?>
                                                    <span class="text-muted fst-italic">Belum upload</span>
                                                <?php endif; ?>
                                            </td>
                                            <td class="px-4 py-3">
                                                <?php
                                                $statusConfig = [
                                                    'waiting_payment'      => ['class' => 'warning', 'text' => 'Menunggu Pembayaran'],
                                                    'waiting_verification' => ['class' => 'info', 'text' => 'Verifikasi Bayar'],
                                                    'confirmed'            => ['class' => 'success', 'text' => 'Dikonfirmasi'],
                                                    'completed'            => ['class' => 'gold', 'text' => 'Selesai'],
                                                    'cancelled'            => ['class' => 'danger', 'text' => 'Dibatalkan'],
                                                    'canceled'             => ['class' => 'danger', 'text' => 'Dibatalkan'],
                                                    'pending'              => ['class' => 'secondary', 'text' => 'Pending']
                                                ];
                                                $currentStatus = $b['status'] ?? 'pending';
                                                $status = $statusConfig[$currentStatus] ?? ['class' => 'dark', 'text' => ucfirst($currentStatus)];
                                                ?>
                                                <span class="badge bg-<?= $status['class'] ?> px-3 py-2 fw-medium">
                                                    <?= $status['text'] ?>
                                                </span>
                                            </td>
                                            <td class="px-4 py-3 text-center">
                                                <?php if (!empty($b['id'])): ?>
                                                    <a href="<?= base_url('admin/booking/' . $b['id'] . '/edit') ?>"
                                                        class="btn btn-gold btn-sm px-3 py-1 fw-medium">
                                                        <i class="fas fa-edit me-1"></i>Kelola
                                                    </a>
                                                <?php endif; ?>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                <?php else: ?>
                                    <tr>
                                        <td colspan="7" class="text-center py-5">
                                            <div class="text-muted">
                                                <i class="fas fa-inbox fa-2x mb-3 d-block text-burgundy opacity-50"></i>
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
    :root {
        --burgundy: #800020;
        --burgundy-dark: #660019;
        --burgundy-light: #a6002b;
        --gold: #FFD700;
        --gold-dark: #B8860B;
        --gold-light: #FFDF00;
    }

    .bg-burgundy {
        background-color: var(--burgundy) !important;
    }

    .text-burgundy {
        color: var(--burgundy) !important;
    }

    .table-burgundy {
        background-color: var(--burgundy);
    }

    .table-burgundy th {
        background-color: var(--burgundy);
        color: white;
        border-color: var(--burgundy-dark);
    }

    .table th {
        border-top: none;
        border-bottom: 2px solid var(--burgundy-dark);
        font-size: 0.875rem;
        letter-spacing: 0.3px;
    }

    .table td {
        border-top: 1px solid #f1f3f4;
        border-bottom: none;
        vertical-align: middle;
    }

    .table-hover tbody tr:hover {
        background-color: #faf8f8;
    }

    .badge {
        font-size: 0.75rem;
        letter-spacing: 0.3px;
        border-radius: 20px;
    }

    .bg-gold {
        background-color: var(--gold) !important;
        color: var(--burgundy) !important;
    }

    .btn-gold {
        background-color: var(--gold);
        border-color: var(--gold);
        color: var(--burgundy);
        font-weight: 600;
        transition: all 0.15s ease-in-out;
    }

    .btn-gold:hover {
        background-color: var(--gold-dark);
        border-color: var(--gold-dark);
        color: white;
        transform: translateY(-1px);
        box-shadow: 0 3px 8px rgba(255, 215, 0, 0.3);
    }

    .btn-outline-burgundy {
        border-color: var(--burgundy);
        color: var(--burgundy);
        transition: all 0.15s ease-in-out;
    }

    .btn-outline-burgundy:hover {
        background-color: var(--burgundy);
        border-color: var(--burgundy);
        color: white;
        transform: translateY(-1px);
        box-shadow: 0 3px 8px rgba(128, 0, 32, 0.3);
    }

    .card {
        border-radius: 12px;
        overflow: hidden;
    }

    .card-header {
        border-bottom: 2px solid var(--gold);
    }

    .alert-success {
        background-color: #d1e7dd;
        border-color: #badbcc;
        color: #0f5132;
        border-radius: 8px;
    }

    .alert-danger {
        background-color: #f8d7da;
        border-color: #f5c2c7;
        color: #842029;
        border-radius: 8px;
    }

    .fas {
        font-size: 0.875rem;
    }

    .shadow-sm {
        box-shadow: 0 0.125rem 0.25rem rgba(128, 0, 32, 0.075) !important;
    }
</style>
<?= $this->endSection() ?>