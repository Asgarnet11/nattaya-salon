<?= $this->extend('admin/layout/template') ?>
<?= $this->section('content') ?>
<div class="card shadow">
    <div class="card-header">
        <h5 class="mb-0">Kelola Booking</h5>
    </div>
    <div class="card-body">
        <form action="/admin/booking/<?= $booking['id'] ?>" method="post">
            <?= csrf_field() ?>
            <input type="hidden" name="_method" value="PUT">

            <?php if (!empty($booking['bukti_pembayaran'])): ?>
                <div class="mb-4">
                    <h6 class="mb-3">Bukti Pembayaran Pelanggan</h6>
                    <a href="/uploads/bukti_pembayaran/<?= esc($booking['bukti_pembayaran']) ?>" target="_blank">
                        <img src="/uploads/bukti_pembayaran/<?= esc($booking['bukti_pembayaran']) ?>" class="img-thumbnail" style="max-width: 300px; cursor: pointer;">
                    </a>
                    <small class="form-text d-block mt-2">Klik gambar untuk melihat ukuran penuh.</small>
                </div>
                <hr>
            <?php endif; ?>

            <div class="mb-3">
                <label for="id_karyawan" class="form-label">Tugaskan Karyawan</label>
                <select id="id_karyawan" name="id_karyawan" class="form-select">
                    <option value="">-- Pilih Karyawan (Opsional) --</option>
                    <?php if (!empty($karyawan)): ?>
                        <?php foreach ($karyawan as $k): ?>
                            <option value="<?= $k['id'] ?>" <?= ($k['id'] == $booking['id_karyawan']) ? 'selected' : '' ?>>
                                <?= esc($k['nama_karyawan']) ?>
                            </option>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <option value="" disabled>Tidak ada karyawan aktif di cabang ini</option>
                    <?php endif; ?>
                </select>
            </div>
            <div class="mb-3">
                <label for="status" class="form-label">Ubah Status Booking</label>
                <select id="status" name="status" class="form-select" required>
                    <option value="waiting_payment" <?= ($booking['status'] == 'waiting_payment') ? 'selected' : '' ?>>Menunggu Pembayaran</option>
                    <option value="waiting_verification" <?= ($booking['status'] == 'waiting_verification') ? 'selected' : '' ?>>Menunggu Verifikasi</option>
                    <option value="confirmed" <?= ($booking['status'] == 'confirmed') ? 'selected' : '' ?>>Confirmed (Lunas)</option>
                    <option value="completed" <?= ($booking['status'] == 'completed') ? 'selected' : '' ?>>Completed (Selesai)</option>
                    <option value="canceled" <?= ($booking['status'] == 'canceled') ? 'selected' : '' ?>>Canceled (Dibatalkan)</option>
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Update Booking</button>
            <a href="/admin/booking" class="btn btn-secondary">Batal</a>
        </form>
    </div>
</div>
<?= $this->endSection() ?>