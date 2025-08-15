<?= $this->extend('admin/layout/template') ?>

<?= $this->section('content') ?>

<div class="card shadow">
    <div class="card-body">
        <form action="/admin/cabang" method="post">
            <?= csrf_field() ?>
            <div class="mb-3">
                <label for="nama_cabang" class="form-label">Nama Cabang</label>
                <input type="text" class="form-control" id="nama_cabang" name="nama_cabang" required>
            </div>
            <div class="mb-3">
                <label for="alamat" class="form-label">Alamat</label>
                <textarea class="form-control" id="alamat" name="alamat" rows="3"></textarea>
            </div>
            <div class="mb-3">
                <label for="no_telepon" class="form-label">Nomor Telepon</label>
                <input type="text" class="form-control" id="no_telepon" name="no_telepon">
            </div>
            <button type="submit" class="btn btn-primary">Simpan</button>
            <a href="/admin/cabang" class="btn btn-secondary">Batal</a>
        </form>
    </div>
</div>

<?= $this->endSection() ?>