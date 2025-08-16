<?= $this->extend('admin/layout/template') ?>
<?= $this->section('content') ?>
<div class="card shadow">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h5 class="mb-0">Daftar User (Total: <?= count($users) ?>)</h5>
        <a href="/admin/users/new" class="btn btn-primary">Tambah User Baru</a>
    </div>
    <div class="card-body">
        <?php if (session()->getFlashdata('success')): ?>
            <div class="alert alert-success"><?= session()->getFlashdata('success') ?></div>
        <?php endif; ?>
        <?php if (session()->getFlashdata('error')): ?>
            <div class="alert alert-danger"><?= session()->getFlashdata('error') ?></div>
        <?php endif; ?>
        <table class="table table-hover">
            <thead class="table-light">
                <tr>
                    <th>Nama</th>
                    <th>Username</th>
                    <th>Role</th>
                    <th>Cabang</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($users as $user): ?>
                    <tr>
                        <td><?= esc($user['nama_lengkap']) ?></td>
                        <td><?= esc($user['username']) ?></td>
                        <td>
                            <?php if ($user['role'] == 'superadmin'): ?>
                                <span class="badge bg-success">Superadmin</span>
                            <?php else: ?>
                                <span class="badge bg-info">Admin</span>
                            <?php endif; ?>
                        </td>
                        <td><?= esc($user['nama_cabang']) ?? '<i>Semua Cabang</i>' ?></td>
                        <td>
                            <a href="/admin/users/<?= $user['id'] ?>/edit" class="btn btn-sm btn-warning">Edit</a>
                            <form action="/admin/users/<?= $user['id'] ?>" method="post" class="d-inline">
                                <?= csrf_field() ?>
                                <input type="hidden" name="_method" value="DELETE">
                                <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Yakin?')">Hapus</button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>
<?= $this->endSection() ?>