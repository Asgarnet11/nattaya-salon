<?= $this->extend('admin/layout/template') ?>

<?= $this->section('content') ?>
<div class="card shadow">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h5 class="mb-0">Daftar Layanan</h5>
        <a href="/admin/layanan/new" class="btn btn-primary">Tambah Layanan Baru</a>
    </div>
    <div class="card-body">
        <?php if (session()->getFlashdata('success')): ?>
            <div class="alert alert-success" role="alert">
                <?= session()->getFlashdata('success') ?>
            </div>
        <?php endif; ?>

        <div class="table-responsive">
            <table class="table table-bordered table-hover">
                <thead class="table-light">
                    <tr>
                        <th>Nama Layanan</th>
                        <th>Deskripsi Singkat</th>
                        <th style="width: 150px;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($layanan)): ?>
                        <?php foreach ($layanan as $l): ?>
                            <tr>
                                <td><strong><?= esc($l['nama_layanan']) ?></strong></td>
                                <td><?= !empty($l['deskripsi']) ? esc(word_limiter($l['deskripsi'], 15)) : '<i>Tidak ada deskripsi</i>' ?></td>
                                <td>
                                    <a href="/admin/layanan/<?= $l['id'] ?>/edit" class="btn btn-warning btn-sm">Kelola</a>
                                    <form action="/admin/layanan/<?= $l['id'] ?>" method="post" class="d-inline">
                                        <?= csrf_field() ?>
                                        <input type="hidden" name="_method" value="DELETE">
                                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus layanan ini beserta semua paket dan gambarnya?')">Hapus</button>
                                    </form>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="3" class="text-center">Belum ada data layanan.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<script>
    // Memuat text helper secara manual jika belum ada di controller (opsional)
    <?php helper('text'); ?>
</script>

<?= $this->endSection() ?>