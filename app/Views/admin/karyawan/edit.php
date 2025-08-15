<?= $this->extend('admin/layout/template') ?>

<?= $this->section('content') ?>
<div class="card shadow">
    <div class="card-body">
        <form action="/admin/karyawan/<?= $karyawan['id'] ?>" method="post">
            <?= csrf_field() ?>
            <input type="hidden" name="_method" value="PUT">
            <div class="mb-3">
                <label class="form-label">Nama Karyawan</label>
                <input type="text" class="form-control" name="nama_karyawan" value="<?= esc($karyawan['nama_karyawan']) ?>" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Cabang</label>
                <select name="id_cabang" class="form-control" required>
                    <option value="">-- Pilih Cabang --</option>
                    <?php foreach ($cabang as $c): ?>
                        <option value="<?= $c['id'] ?>" <?= ($c['id'] == $karyawan['id_cabang']) ? 'selected' : '' ?>>
                            <?= esc($c['nama_cabang']) ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="mb-3">
                <label class="form-label">Spesialisasi</label>
                <input type="text" class="form-control" name="spesialisasi" value="<?= esc($karyawan['spesialisasi']) ?>">
            </div>

            <div class="mb-3">
                <label class="form-label">Status</label>
                <select name="status" class="form-control" required>
                    <option value="aktif" <?= ($karyawan['status'] == 'aktif') ? 'selected' : '' ?>>Aktif</option>
                    <option value="tidak_aktif" <?= ($karyawan['status'] == 'tidak_aktif') ? 'selected' : '' ?>>Tidak Aktif</option>
                </select>
            </div>

            <button type="submit" class="btn btn-primary">Update</button>
            <a href="/admin/karyawan" class="btn btn-secondary">Batal</a>
        </form>
    </div>
</div>
<?= $this->endSection() ?>