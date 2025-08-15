<?= $this->extend('admin/layout/template') ?>

<?= $this->section('content') ?>

<div class="container mt-5">
    <h1><?= esc($title) ?></h1>

    <form action="/admin/cabang/<?= $cabang['id'] ?>" method="post">
        <?= csrf_field() ?>
        <input type="hidden" name="_method" value="PUT">
        <div class="mb-3">
            <label for="nama_cabang" class="form-label">Nama Cabang</label>
            <input type="text" class="form-control" id="nama_cabang" name="nama_cabang" value="<?= esc($cabang['nama_cabang']) ?>" required>
        </div>
        <div class="mb-3">
            <label for="alamat" class="form-label">Alamat</label>
            <textarea class="form-control" id="alamat" name="alamat" rows="3"><?= esc($cabang['alamat']) ?></textarea>
        </div>
        <div class="mb-3">
            <label for="no_telepon" class="form-label">Nomor Telepon</label>
            <input type="text" class="form-control" id="no_telepon" name="no_telepon" value="<?= esc($cabang['no_telepon']) ?>">
        </div>
        <button type="submit" class="btn btn-primary">Update</button>
        <a href="/admin/cabang" class="btn btn-secondary">Batal</a>
    </form>
</div>

<?= $this->endSection() ?>