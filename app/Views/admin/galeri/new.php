<?= $this->extend('admin/layout/template') ?>

<?= $this->section('content') ?>
<div class="card shadow">
    <div class="card-header">
        <h5>Upload Gambar Baru</h5>
    </div>
    <div class="card-body">
        <form action="/admin/galeri" method="post" enctype="multipart/form-data">
            <?= csrf_field() ?>
            <div class="mb-3">
                <label for="judul" class="form-label">Judul Gambar (Opsional)</label>
                <input type="text" class="form-control" id="judul" name="judul">
            </div>
            <div class="mb-3">
                <label for="gambar" class="form-label">Pilih File Gambar</label>
                <input type="file" class="form-control" id="gambar" name="gambar" required>
            </div>
            <button type="submit" class="btn btn-primary">Upload</button>
            <a href="/admin/galeri" class="btn btn-secondary">Batal</a>
        </form>
    </div>
</div>
<?= $this->endSection() ?>