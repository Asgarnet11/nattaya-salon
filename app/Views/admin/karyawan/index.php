<?= $this->extend('admin/layout/template') ?>

<?= $this->section('content') ?>
<div class="card shadow">
    <div class="card-header">
        <a href="/admin/karyawan/new" class="btn btn-primary">Tambah Karyawan Baru</a>
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
                    <th>Nama</th>
                    <th>Cabang</th>
                    <th>Spesialisasi</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($karyawan as $k): ?>
                    <tr>
                        <td><?= esc($k['nama_karyawan']) ?></td>
                        <td><?= esc($k['nama_cabang']) ?></td>
                        <td><?= esc($k['spesialisasi']) ?></td>
                        <td><span class="badge bg-<?= ($k['status'] == 'aktif') ? 'success' : 'danger' ?>"><?= esc($k['status']) ?></span></td>
                        <td>
                            <a href="/admin/karyawan/<?= $k['id'] ?>/edit" class="btn btn-warning btn-sm">Edit</a>
                            <form action="/admin/karyawan/<?= $k['id'] ?>" method="post" class="d-inline">
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