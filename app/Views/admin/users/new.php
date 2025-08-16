<?= $this->extend('admin/layout/template') ?>

<?= $this->section('content') ?>
<div class="card shadow">
    <div class="card-header">
        <h5 class="mb-0">Tambah User Baru</h5>
    </div>
    <div class="card-body">
        <?php if (session()->getFlashdata('errors')): ?>
            <div class="alert alert-danger">
                <ul>
                    <?php foreach (session()->getFlashdata('errors') as $error): ?>
                        <li><?= esc($error) ?></li>
                    <?php endforeach ?>
                </ul>
            </div>
        <?php endif ?>

        <form action="/admin/users" method="post">
            <?= csrf_field() ?>
            <div class="mb-3">
                <label class="form-label">Nama Lengkap</label>
                <input type="text" name="nama_lengkap" class="form-control" value="<?= old('nama_lengkap') ?>" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Username</label>
                <input type="text" name="username" class="form-control" value="<?= old('username') ?>" required>
            </div>
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label">Password</label>
                    <input type="password" name="password" class="form-control" required>
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label">Ulangi Password</label>
                    <input type="password" name="pass_confirm" class="form-control" required>
                </div>
            </div>
            <div class="mb-3">
                <label class="form-label">Role</label>
                <select name="role" class="form-select" required>
                    <option value="admin" <?= old('role') == 'admin' ? 'selected' : '' ?>>Admin</option>
                    <option value="superadmin" <?= old('role') == 'superadmin' ? 'selected' : '' ?>>Superadmin</option>
                </select>
            </div>
            <div class="mb-3">
                <label class="form-label">Tugas di Cabang (Kosongkan jika Superadmin)</label>
                <select name="id_cabang" class="form-select">
                    <option value="">-- Pilih Cabang --</option>
                    <?php foreach ($cabang as $c): ?>
                        <option value="<?= $c['id'] ?>" <?= old('id_cabang') == $c['id'] ? 'selected' : '' ?>><?= esc($c['nama_cabang']) ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Simpan</button>
            <a href="/admin/users" class="btn btn-secondary">Batal</a>
        </form>
    </div>
</div>
<?= $this->endSection() ?>