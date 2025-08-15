<?= $this->extend('admin/layout/template') ?>
<?= $this->section('content') ?>
<div class="card shadow">
    <div class="card-header">
        <a href="/admin/artikel/new" class="btn btn-primary">Tulis Artikel Baru</a>
    </div>
    <div class="card-body">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Judul</th>
                    <th>Penulis</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($artikel as $a): ?>
                    <tr>
                        <td><?= esc($a['judul']) ?></td>
                        <td><?= esc($a['penulis']) ?></td>
                        <td>
                            <a href="/admin/artikel/<?= $a['id'] ?>/edit" class="btn btn-warning btn-sm">Edit</a>
                            <form action="/admin/artikel/<?= $a['id'] ?>" method="post" class="d-inline">
                                <?= csrf_field() ?>
                                <input type="hidden" name="_method" value="DELETE">
                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Yakin?')">Hapus</button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>
<?= $this->endSection() ?>