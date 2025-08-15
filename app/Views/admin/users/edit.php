<?= $this->extend('admin/layout/template') ?>
<?= $this->section('content') ?>
<div class="card shadow">
    <div class="card-body">
        <form action="/admin/users/<?= $user['id'] ?>" method="post">
            <?= csrf_field() ?>
            <input type="hidden" name="_method" value="PUT">
            <div class="mb-3">
                <label class="form-label">Nama Lengkap</label>
                <input type="text" name="nama_lengkap" class="form-control" value="<?= esc($user['nama_lengkap']) ?>" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Username</label>
                <input type="text" name="username" class="form-control" value="<?= esc($user['username']) ?>" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Password (Kosongkan jika tidak ingin diubah)</label>
                <input type="password" name="password" class="form-control">
            </div>
            <div class="mb-3">
                <label class="form-label">Role</label>
                <select name="role" class="form-control" required>
                    <option value="admin" <?= ($user['role'] == 'admin') ? 'selected' : '' ?>>Admin</option>
                    <option value="superadmin" <?= ($user['role'] == 'superadmin') ? 'selected' : '' ?>>Superadmin</option>
                </select>
            </div>
            <div class="mb-3">
                <label class="form-label">Tugas di Cabang</label>
                <select name="id_cabang" class="form-control">
                    <option value="">-- Tidak Ditugaskan --</option>
                    <?php foreach ($cabang as $c): ?>
                        <option value="<?= $c['id'] ?>" <?= ($c['id'] == $user['id_cabang']) ? 'selected' : '' ?>><?= esc($c['nama_cabang']) ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Update</button>
        </form>
    </div>
</div>
<?= $this->endSection() ?>