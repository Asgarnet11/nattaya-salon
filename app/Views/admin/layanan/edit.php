<?= $this->extend('admin/layout/template') ?>

<?= $this->section('content') ?>
<?php if (session()->getFlashdata('success')): ?>
    <div class="alert alert-success" role="alert">
        <?= session()->getFlashdata('success') ?>
    </div>
<?php endif; ?>

<div class="row">
    <div class="col-lg-8">
        <div class="card shadow mb-4">
            <div class="card-header">
                <h5 class="mb-0">Edit Detail Layanan</h5>
            </div>
            <div class="card-body">
                <form action="/admin/layanan/<?= $layanan['id'] ?>" method="post">
                    <?= csrf_field() ?>
                    <input type="hidden" name="_method" value="PUT">
                    <div class="mb-3">
                        <label for="nama_layanan" class="form-label">Nama Layanan</label>
                        <input type="text" class="form-control" id="nama_layanan" name="nama_layanan" value="<?= esc($layanan['nama_layanan']) ?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="deskripsi" class="form-label">Deskripsi</label>
                        <textarea class="form-control" id="deskripsi" name="deskripsi" rows="5"><?= esc($layanan['deskripsi']) ?></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">Update Detail</button>
                    <a href="/admin/layanan" class="btn btn-secondary">Kembali</a>
                </form>
            </div>
        </div>

        <div class="card shadow mb-4">
            <div class="card-header">
                <h5 class="mb-0">Manajemen Gambar</h5>
            </div>
            <div class="card-body">
                <h6>Gambar Saat Ini</h6>
                <div class="row">
                    <?php if (!empty($gambar)): ?>
                        <?php foreach ($gambar as $g): ?>
                            <div class="col-md-4 text-center mb-3">
                                <img src="/uploads/layanan/<?= esc($g['nama_file']) ?>" class="img-thumbnail mb-2" style="height: 150px; width: 100%; object-fit: cover;">
                                <form action="/admin/layanan/delete-image/<?= $g['id'] ?>" method="post">
                                    <?= csrf_field() ?>
                                    <input type="hidden" name="_method" value="DELETE">
                                    <button type="submit" class="btn btn-sm btn-outline-danger" onclick="return confirm('Yakin ingin menghapus gambar ini?')">Hapus</button>
                                </form>
                            </div>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <p class="text-muted">Belum ada gambar untuk layanan ini.</p>
                    <?php endif; ?>
                </div>
                <hr>
                <form action="/admin/layanan/<?= $layanan['id'] ?>" method="post" enctype="multipart/form-data" class="mt-3">
                    <?= csrf_field() ?>
                    <input type="hidden" name="_method" value="PUT">
                    <div class="mb-3">
                        <label for="gambar_baru" class="form-label"><strong>Tambah Gambar Baru</strong></label>
                        <input type="file" class="form-control" id="gambar_baru" name="gambar_baru[]" multiple>
                    </div>
                    <button type="submit" class="btn btn-info text-white">Upload Gambar</button>
                </form>
            </div>
        </div>
    </div>

    <div class="col-lg-4">
        <div class="card shadow mb-4">
            <div class="card-header">
                <h5 class="mb-0">Paket Layanan</h5>
            </div>
            <div class="card-body">
                <h6>Daftar Paket</h6>
                <table class="table table-sm table-borderless table-striped">
                    <tbody>
                        <?php if (!empty($paket)): ?>
                            <?php foreach ($paket as $p): ?>
                                <tr>
                                    <td class="align-middle">
                                        <strong><?= esc($p['nama_paket']) ?></strong><br>
                                        <small>Rp <?= number_format($p['harga'], 0, ',', '.') ?> - <?= $p['durasi_menit'] ?> mnt</small>
                                    </td>
                                    <td class="text-end align-middle">
                                        <form action="/admin/layanan/hapus-paket/<?= $p['id'] ?>" method="post">
                                            <?= csrf_field() ?>
                                            <input type="hidden" name="_method" value="DELETE">
                                            <button type="submit" class="btn btn-sm btn-outline-danger" onclick="return confirm('Yakin?')">X</button>
                                        </form>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td class="text-center text-muted">Belum ada paket.</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
                <hr>
                <h6 class="mt-3">Tambah Paket Baru</h6>
                <form action="/admin/layanan/tambah-paket" method="post">
                    <?= csrf_field() ?>
                    <input type="hidden" name="id_layanan" value="<?= $layanan['id'] ?>">
                    <div class="mb-2">
                        <label for="nama_paket" class="form-label visually-hidden">Nama Paket</label>
                        <input type="text" id="nama_paket" name="nama_paket" class="form-control" placeholder="Nama Paket (cth: Basic)" required>
                    </div>
                    <div class="mb-2">
                        <label for="harga" class="form-label visually-hidden">Harga</label>
                        <input type="number" id="harga" name="harga" class="form-control" placeholder="Harga (cth: 300000)" required>
                    </div>
                    <div class="mb-2">
                        <label for="durasi_menit" class="form-label visually-hidden">Durasi</label>
                        <input type="number" id="durasi_menit" name="durasi_menit" class="form-control" placeholder="Durasi (menit)" required>
                    </div>
                    <div class="d-grid">
                        <button type="submit" class="btn btn-success">Tambah Paket</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>