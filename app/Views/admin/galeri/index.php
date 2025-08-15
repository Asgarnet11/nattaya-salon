<?= $this->extend('admin/layout/template') ?>

<?= $this->section('content') ?>
<div class="card shadow">
    <div class="card-header">
        <a href="/admin/galeri/new" class="btn btn-primary">Upload Gambar Baru</a>
    </div>
    <div class="card-body">
        <?php if (session()->getFlashdata('success')): ?>
            <div class="alert alert-success" role="alert">
                <?= session()->getFlashdata('success') ?>
            </div>
        <?php endif; ?>

        <div class="row">
            <?php if (!empty($galeri)): ?>
                <?php foreach ($galeri as $g): ?>
                    <div class="col-md-3 mb-4">
                        <div class="card">
                            <img src="/uploads/gallery/<?= esc($g['nama_file']) ?>" class="card-img-top" alt="<?= esc($g['judul']) ?>" style="height: 200px; object-fit: cover;">
                            <div class="card-body">
                                <p class="card-text"><?= esc($g['judul']) ?: '...' ?></p>
                                <form action="/admin/galeri/<?= $g['id'] ?>" method="post" class="d-inline">
                                    <?= csrf_field() ?>
                                    <input type="hidden" name="_method" value="DELETE">
                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin?')">Hapus</button>
                                </form>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <p class="text-center">Belum ada gambar di galeri.</p>
            <?php endif; ?>
        </div>
    </div>
</div>
<?= $this->endSection() ?>