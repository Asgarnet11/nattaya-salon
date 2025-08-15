<?= $this->extend('admin/layout/template') ?>

<?= $this->section('content') ?>

<div class="card shadow">
    <div class="card-header">
        <a href="/admin/cabang/new" class="btn btn-primary">Tambah Cabang Baru</a>
    </div>
    <div class="card-body">
        <?php if (session()->getFlashdata('success')): ?>
            <div class="alert alert-success" role="alert">
                <?= session()->getFlashdata('success') ?>
            </div>
        <?php endif; ?>

        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nama Cabang</th>
                    <th>Alamat</th>
                    <th>No. Telepon</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($cabang as $c): ?>
                    <tr>
                        <td><?= $c['id'] ?></td>
                        <td><?= esc($c['nama_cabang']) ?></td>
                        <td><?= esc($c['alamat']) ?></td>
                        <td><?= esc($c['no_telepon']) ?></td>
                        <td>
                            <a href="/admin/cabang/<?= $c['id'] ?>/edit" class="btn btn-warning btn-sm">Edit</a>
                            <form action="/admin/cabang/<?= $c['id'] ?>" method="post" class="d-inline">
                                <?= csrf_field() ?>
                                <input type="hidden" name="_method" value="DELETE">
                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin?')">Hapus</button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>

<?= $this->endSection() ?>