<?= $this->extend('frontend/layout/template') ?>
<?= $this->section('content') ?>
<div class="container my-5">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <h1 class="playfair-display mb-3"><?= esc($artikel['judul']) ?></h1>
            <p class="text-muted">Ditulis oleh <?= esc($artikel['penulis']) ?> pada <?= date('d M Y', strtotime($artikel['created_at'])) ?></p>
            <hr>
            <div class="mt-4">
                <?= nl2br(esc($artikel['isi_artikel'])) // nl2br untuk mengubah baris baru menjadi <br> 
                ?>
            </div>
            <a href="/artikel" class="btn btn-primary mt-5">Kembali ke Daftar Artikel</a>
        </div>
    </div>
</div>
<?= $this->endSection() ?>