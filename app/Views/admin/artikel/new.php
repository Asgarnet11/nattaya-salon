<?= $this->extend('admin/layout/template') ?>
<?= $this->section('content') ?>
<div class="card shadow">
    <div class="card-body">
        <form action="/admin/artikel" method="post">
            <?= csrf_field() ?>
            <div class="mb-3">
                <label class="form-label">Judul Artikel</label>
                <input type="text" name="judul" class="form-control" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Isi Artikel</label>
                <textarea name="isi_artikel" class="form-control" rows="10"></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Terbitkan</button>
        </form>
    </div>
</div>
<?= $this->endSection() ?>