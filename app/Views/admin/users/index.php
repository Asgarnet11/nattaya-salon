<?= $this->extend('admin/layout/template') ?>
<?= $this->section('content') ?>
<div class="card shadow">
    <div class="card-header">
        <a href="/admin/users/new" class="btn btn-primary">Tambah User Baru</a>
    </div>
    <div class="card-body">
        <table class="table">
            <thead>
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
                        <td><?= esc($user['role']) ?></td>
                        <td><?= esc($user['nama_cabang']) ?? 'Semua Cabang' ?></td>
                        <td>
                            <a href="#" class="btn btn-sm btn-warning">Edit</a>
                            <button class="btn btn-sm btn-danger">Hapus</button>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>
<?= $this->endSection() ?>