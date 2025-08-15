<?= $this->extend('admin/layout/template') ?>
<?= $this->section('content') ?>
<div class="card shadow">
    <div class="card-header">
        <h5>Daftar Booking Masuk</h5>
    </div>
    <div class="card-body">
        <?php if (session()->getFlashdata('success')): ?>
            <div class="alert alert-success" role="alert">
                <?= session()->getFlashdata('success') ?>
            </div>
        <?php endif; ?>
        <div class="table-responsive">
            <table class="table table-bordered table-hover align-middle">
                <thead class="table-light">
                    <tr>
                        <th>Pelanggan</th>
                        <th>Kontak</th>
                        <th>Layanan & Paket</th>
                        <th>Cabang</th>
                        <th>Jadwal</th>
                        <th>Karyawan</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($bookings)): ?>
                        <?php foreach ($bookings as $b): ?>
                            <tr>
                                <td><?= esc($b['nama_pelanggan']) ?></td>
                                <td><?= esc($b['no_telepon']) ?></td>
                                <td>
                                    <strong><?= esc($b['nama_layanan']) ?></strong><br>
                                    <small class="text-muted"><?= esc($b['nama_paket']) ?></small>
                                </td>
                                <td><?= esc($b['nama_cabang']) ?></td>
                                <td><?= date('d M Y, H:i', strtotime($b['tanggal_booking'] . ' ' . $b['jam_booking'])) ?></td>
                                <td><?= esc($b['nama_karyawan']) ?? '<i>Belum Ditugaskan</i>' ?></td>
                                <td>
                                    <?php
                                    $statusClass = ['pending' => 'warning', 'confirmed' => 'success', 'canceled' => 'danger', 'completed' => 'secondary'];
                                    $statusText = ucfirst($b['status']);
                                    ?>
                                    <span class="badge bg-<?= $statusClass[$b['status']] ?>"><?= $statusText ?></span>
                                </td>
                                <td>
                                    <a href="/admin/booking/<?= $b['id'] ?>/edit" class="btn btn-sm btn-primary">Kelola</a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="8" class="text-center py-4">Belum ada data booking.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<?= $this->endSection() ?>