<?= $this->extend('frontend/layout/template') ?>

<?= $this->section('content') ?>
<div class="container my-5">
    <div class="text-center mb-5">
        <h1 class="playfair-display"><?= esc($title) ?></h1>
        <p>Berikut adalah daftar semua janji temu yang pernah Anda buat.</p>
    </div>

    <div class="card shadow-sm">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead>
                        <tr>
                            <th>Tanggal Booking</th>
                            <th>Layanan & Paket</th>
                            <th>Cabang</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($riwayat)): ?>
                            <?php foreach ($riwayat as $item): ?>
                                <tr>
                                    <td><?= date('d M Y, H:i', strtotime($item['tanggal_booking'] . ' ' . $item['jam_booking'])) ?></td>
                                    <td>
                                        <strong><?= esc($item['nama_layanan']) ?></strong><br>
                                        <small class="text-muted"><?= esc($item['nama_paket']) ?></small>
                                    </td>
                                    <td><?= esc($item['nama_cabang']) ?></td>
                                    <td>
                                        <?php
                                        $statusClass = ['pending' => 'warning', 'confirmed' => 'success', 'canceled' => 'danger', 'completed' => 'secondary'];
                                        $statusText = ucfirst($item['status']);
                                        ?>
                                        <span class="badge bg-<?= $statusClass[$item['status']] ?>"><?= $statusText ?></span>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="4" class="text-center py-4">Anda belum memiliki riwayat booking.</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>