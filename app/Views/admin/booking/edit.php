<?= $this->extend('admin/layout/template') ?>
<?= $this->section('content') ?>
<div class="card shadow">
    <div class="card-header">
        <h5>Kelola Booking</h5>
    </div>
    <div class="card-body">
        <form action="/admin/booking/<?= $booking['id'] ?>" method="post">
            <?= csrf_field() ?>
            <input type="hidden" name="_method" value="PUT">
            <div class="mb-3">
                <label class="form-label">Tugaskan Karyawan</label>
                <select name="id_karyawan" class="form-select">
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
                <label class="form-label">Ubah Status Booking</label>
                <select name="status" class="form-select" required>
                    <option value="pending" <?= ($booking['status'] == 'pending') ? 'selected' : '' ?>>Pending</option>
                    <option value="confirmed" <?= ($booking['status'] == 'confirmed') ? 'selected' : '' ?>>Confirmed</option>
                    <option value="completed" <?= ($booking['status'] == 'completed') ? 'selected' : '' ?>>Completed</option>
                    <option value="canceled" <?= ($booking['status'] == 'canceled') ? 'selected' : '' ?>>Canceled</option>
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Update Booking</button>
            <a href="/admin/booking" class="btn btn-secondary">Batal</a>
        </form>
    </div>
</div>
<?= $this->endSection() ?>